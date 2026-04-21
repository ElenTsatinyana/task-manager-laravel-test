<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // GET /tasks
    public function index()
    {
        return Task::all();
    }

    // POST /tasks
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'status' => 'in:pending,done'
        ]);

        return Task::create($request->all());
    }

    // GET /tasks/{id}
    public function show($id)
    {
        return Task::findOrFail($id);
    }

    // PUT /tasks/{id}
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->all());

        return $task;
    }

    // DELETE /tasks/{id}
    public function destroy($id)
    {
        Task::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}