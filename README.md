# 🚀 Laravel Role-Based Blog System

A simple Laravel application with authentication, role-based access control, and CRUD functionality for posts.

---

## ✨ Features

* 🔐 User Authentication (Login / Logout)
* 👥 Role-Based Access Control:

  * **Admin** → Full access (dashboard + management)
  * **Editor** → Create & edit posts
  * **Viewer** → View only published posts
* 📝 CRUD system for posts
* 🔍 Search posts by title
* 📄 Pagination (5 posts per page)
* 👁️ Views counter for each post
* 👤 User profile management (update / delete account)


 * **Admin** → pass:user1234
  * **Editor** → pass:user1234
  * **Viewer** → pass:user1234
---

## 🛠️ Tech Stack

* PHP (Laravel Framework)
* MySQL
* Blade Templates
* Bootstrap / Tailwind (if used)

---

## ⚙️ Installation

```bash 
git clone https://github.com/your-username/Repo_laravel.git
cd Repo_laravel
composer install
cp .env.example .env
php artisan key:generate
```

---

### 📦 Setup Database

Update `.env` file:

```env  "
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=
```

Run migrations:

```bash "
php artisan migrate
```

---

### ▶️ Run Project

```bash"
php artisan serve
```

Open in browser:

```
http://127.0.0.1:8000
```

---

## 🔑 Roles System

| Role   | Permissions                     |
| ------ | ------------------------------- |
| Admin  | Full access (manage everything) |
| Editor | Create & edit posts             |
| Viewer | View only published posts       |

---

## 🔐 Authentication Flow

* Login required for dashboard access
* After login:

  * Admin → Dashboard
  * Editor → Create Post page
  * Viewer → Posts list

---

## 📁 Main Features Structure

* `PostController` → CRUD operations
* `AuthenticatedSessionController` → Login/Logout logic
* `ProfileController` → User profile management
* `Policies` → Authorization rules

---

## 📌 Future Improvements

* Image upload for posts
* API version (Laravel API)
* Soft delete system
* Admin dashboard analytics

---

## 👩‍💻 Author

**Elen Tsatinyan**

---

