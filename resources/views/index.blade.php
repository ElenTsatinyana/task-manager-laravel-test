<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Task Manager</title>
    <style>
        :root { 
            --primary: #4f46e5; 
            --danger: #ef4444; 
            --success: #10b981; 
            --bg: #f8fafc; 
            --text: #1e293b;
        }

        body { 
            font-family: 'Inter', sans-serif; 
            background: var(--bg); 
            display: flex; 
            justify-content: center; 
            padding: 40px 20px; 
            color: var(--text); 
        }

        .card { 
            background: white; 
            width: 100%; 
            max-width: 500px; 
            padding: 32px; 
            border-radius: 16px; 
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1); 
        }

        h2 { margin-top: 0; font-size: 24px; text-align: center; color: var(--primary); }
        
        .input-form { display: flex; flex-direction: column; gap: 12px; margin-bottom: 30px; }
        input, textarea { border: 1px solid #e2e8f0; padding: 12px; border-radius: 8px; outline: none; transition: 0.2s; font-family: inherit; }
        input:focus { border-color: var(--primary); }

        .btn-add { 
            background: var(--primary); 
            color: white; 
            border: none; 
            padding: 12px; 
            border-radius: 8px; 
            cursor: pointer; 
            font-weight: 600; 
            transition: 0.3s; 
        }
        .btn-add:hover { opacity: 0.9; transform: translateY(-1px); }

        .task-list { display: flex; flex-direction: column; gap: 12px; }
        .task-item { 
            background: #fff; 
            border: 1px solid #f1f5f9; 
            padding: 16px; 
            border-radius: 12px; 
            transition: all 0.3s ease; 
        }
        .task-item:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.05); transform: scale(1.01); }
        
        .task-main { display: flex; justify-content: space-between; align-items: flex-start; }
        .task-info { flex-grow: 1; cursor: pointer; }
        .task-title { font-weight: 600; display: block; margin-bottom: 4px; }
        .task-desc { font-size: 14px; color: #64748b; }
        
        .actions { display: flex; gap: 8px; margin-left: 15px; }
        .action-btn { border: none; background: none; cursor: pointer; padding: 5px; border-radius: 4px; transition: 0.2s; font-size: 18px; }
        .edit-btn:hover { background: #e0e7ff; }
        .del-btn:hover { background: #fee2e2; }

        .edit-area { display: none; margin-top: 10px; border-top: 1px dashed #e2e8f0; padding-top: 10px; }
        .edit-area.active { display: block; }
        .save-btn { background: var(--success); color: white; border: none; padding: 8px 16px; border-radius: 6px; font-size: 12px; cursor: pointer; margin-top: 5px; font-weight: bold; }

        /* Toast Styles */
        #toast {
            visibility: hidden;
            min-width: 250px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 8px;
            padding: 16px;
            position: fixed;
            z-index: 100;
            left: 50%;
            bottom: 30px;
            transform: translateX(-50%);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        #toast.show { visibility: visible; animation: fadein 0.5s, fadeout 0.5s 2.5s; }
        @keyframes fadein { from {bottom: 0; opacity: 0;} to {bottom: 30px; opacity: 1;} }
        @keyframes fadeout { from {bottom: 30px; opacity: 1;} to {bottom: 0; opacity: 0;} }
        .toast-success { background-color: var(--success) !important; }
        .toast-error { background-color: var(--danger) !important; }
    </style>
</head>
<body>

<div class="card">
    <h2>Task Dashboard</h2>
    
    <div class="input-form">
        <input type="text" id="taskTitle" placeholder="What needs to be done?">
        <textarea id="taskDesc" placeholder="Add some details..." rows="2"></textarea>
        <button class="btn-add" onclick="addTask()">Create Task</button>
    </div>

    <div id="taskList" class="task-list"></div>
</div>

<div id="toast"></div>

<script>
    // 1. Toast Notification Logic
    function showToast(message, type = 'success') {
        const toast = document.getElementById("toast");
        toast.innerText = message;
        toast.className = "show " + (type === 'success' ? "toast-success" : "toast-error");
        setTimeout(() => { toast.className = ""; }, 3000);
    }

    // 2. Load Tasks
    async function loadTasks() {
        try {
            const response = await fetch('/api/tasks');
            const tasks = await response.json();
            const list = document.getElementById('taskList');
            list.innerHTML = '';
            
            tasks.forEach(task => {
                list.innerHTML += `
                    <div class="task-item" id="item-${task.id}">
                        <div class="task-main">
                            <div class="task-info" onclick="toggleEdit(${task.id})">
                                <span class="task-title">${task.title}</span>
                                <span class="task-desc">${task.description || 'No description'}</span>
                            </div>
                            <div class="actions">
                                <button class="action-btn edit-btn" title="Edit" onclick="toggleEdit(${task.id})">✏️</button>
                                <button class="action-btn del-btn" title="Delete" onclick="deleteTask(${task.id})">🗑️</button>
                            </div>
                        </div>
                        <div id="edit-area-${task.id}" class="edit-area">
                            <input type="text" id="edit-title-${task.id}" value="${task.title}" style="width:95%; margin-bottom:5px;">
                            <textarea id="edit-desc-${task.id}" style="width:95%;" rows="2">${task.description || ''}</textarea>
                            <button class="save-btn" onclick="updateTask(${task.id})">Save Changes</button>
                        </div>
                    </div>
                `;
            });
        } catch (e) {
            showToast("Failed to connect to server", "error");
        }
    }

    function toggleEdit(id) {
        document.getElementById(`edit-area-${id}`).classList.toggle('active');
    }

    // 3. Add Task
    async function addTask() {
        const titleEl = document.getElementById('taskTitle');
        const descEl = document.getElementById('taskDesc');
        const title = titleEl.value;

        if (!title.trim()) {
            showToast("Title is required!", "error");
            return;
        }

        try {
            const response = await fetch('/api/tasks', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({ title, description: descEl.value, status: 'pending' })
            });

            if (response.ok) {
                showToast("Task created successfully!");
                titleEl.value = '';
                descEl.value = '';
                loadTasks();
            } else {
                showToast("Error creating task", "error");
            }
        } catch (e) {
            showToast("Network error", "error");
        }
    }

    // 4. Update Task
    async function updateTask(id) {
        const title = document.getElementById(`edit-title-${id}`).value;
        const description = document.getElementById(`edit-desc-${id}`).value;

        try {
            const response = await fetch(`/api/tasks/${id}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({ title, description })
            });

            if (response.ok) {
                showToast("Task updated successfully!");
                loadTasks();
            } else {
                showToast("Update failed", "error");
            }
        } catch (e) {
            showToast("Network error", "error");
        }
    }

    // 5. Delete Task
    async function deleteTask(id) {
        if (!confirm('Are you sure you want to delete this task?')) return;

        try {
            const response = await fetch(`/api/tasks/${id}`, { method: 'DELETE' });
            if (response.ok) {
                showToast("Task deleted successfully!");
                loadTasks();
            } else {
                showToast("Delete failed", "error");
            }
        } catch (e) {
            showToast("Network error", "error");
        }
    }

    // Initial load
    loadTasks();
</script>

</body>
</html>