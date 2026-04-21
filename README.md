# 🚀 Laravel Modern Task Manager (SPA)

A high-performance, single-page application (SPA) for task management built with **Laravel 12** and **Vanilla JavaScript**. This project demonstrates a clean separation between backend API logic and a dynamic frontend.

## 🌟 Features

- **Full CRUD Functionality**: Create, Read, Update, and Delete tasks without any page reloads.
- **Dynamic UI/UX**: Smooth CSS transitions, hover effects, and a responsive card-based layout.
- **Real-time Feedback**: Integrated **Toast Notifications** to inform the user about successful operations (Creation, Update, Deletion) or errors.
- **In-place Editing**: Tasks can be edited directly within the list through a smooth toggle mechanism.
- **Form Validation**: Client-side validation to ensure task titles are never empty.

## 🛠️ Tech Stack

- **Backend**: Laravel 12 (PHP)
- **Frontend**: Vanilla JavaScript (Fetch API), HTML5, CSS3 (Inter Font)
- **Database**: MySQL / SQLite
- **API Testing**: Thunder Client (VS Code Extension)

## 🛰️ API Testing & Development

The backend RESTful API was rigorously tested using **Thunder Client** to ensure all endpoints (`GET`, `POST`, `PUT`, `DELETE`) return the correct JSON responses and status codes before frontend integration.

| Method | Endpoint | Description |
| :--- | :--- | :--- |
| GET | `/api/tasks` | Fetch all tasks |
| POST | `/api/tasks` | Create a new task |
| PUT | `/api/tasks/{id}` | Update an existing task |
| DELETE | `/api/tasks/{id}` | Remove a task |


## ⚙️ Installation & Setup

1. **Clone the repository:**
   ```bash
git clone https://github.com/ElenTsatinyana/task-manager-laravel-test.git
cd task-manager-laravel-test

Install Composer dependencies:

Bash
composer install
Configure Environment:

Bash
cp .env.example .env
php artisan key:generate
Database Setup:
Update your .env with your database credentials.

Bash
php artisan migrate
Run the Application:

Bash
php artisan serve
Visit http://127.0.0.1:8000 in your browser.

Developed by Elen Tsatinyan.