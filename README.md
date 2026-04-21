# 🚀 Laravel Modern Task Manager (SPA)

A high-performance, single-page application (SPA) for task management built with **Laravel 12** and **Vanilla JavaScript**. This project demonstrates a professional approach to building RESTful APIs and integrating them with a dynamic frontend.

## 🌟 Features

- **Full CRUD Functionality**: Create, Read, Update, and Delete tasks without page refreshes.
- **Single Page Application (SPA)**: All operations happen on a single page for a seamless user experience.
- **Dynamic UI/UX**: Features smooth CSS transitions, hover effects, and a responsive layout.
- **Real-time Feedback**: Integrated **Toast Notifications** to provide instant feedback on success (creation, update, deletion) or error states.
- **In-place Editing**: Inline editing mechanism for tasks to keep the workflow fast and intuitive.

## 🛠️ Tech Stack

- **Backend**: Laravel 12 (PHP)
- **Frontend**: Vanilla JavaScript (Fetch API), HTML5, CSS3 (Inter Font)
- **Database**: MySQL / SQLite (fully managed via Migrations)
- **API Testing**: Tested and verified with **Thunder Client**.

## 🛰️ API Testing & Development

Before building the frontend, the RESTful API was rigorously tested using **Thunder Client** (VS Code extension) to ensure all endpoints return proper JSON responses and handle errors correctly.

| Method | Endpoint | Description |
| :--- | :--- | :--- |
| GET | `/api/tasks` | Retrieve all tasks from the database |
| POST | `/api/tasks` | Store a new task with title and description |
| PUT | `/api/tasks/{id}` | Update an existing task's details |
| DELETE | `/api/tasks/{id}` | Permanently remove a task |



## ⚙️ Installation & Setup

Follow these steps to run the project locally:

1. **repository:**
 

   git@github.com:ElenTsatinyana/task-manager-laravel-test.git
  




Install PHP dependencies:

Bash
composer install
Configure Environment:

Bash
cp .env.example .env
php artisan key:generate
Database Setup:
Update your .env file with your database credentials, then run:

Bash
php artisan migrate
Run the Application:

Bash
php artisan serve
Visit http://127.0.0.1:8000 in your browser.

Developed by  Elen Tsatinyan.



