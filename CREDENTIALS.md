# Task Manager - Login Credentials

## Admin Account
- **Email:** admin@example.com
- **Password:** password
- **Role:** Admin (Full access to all features)

## Demo User Account
- **Email:** demo@example.com
- **Password:** password
- **Role:** User (Regular user access)

---

## How to Login

1. Start the server: `php artisan serve`
2. Visit: http://127.0.0.1:8000
3. Click "Login" or go to: http://127.0.0.1:8000/login
4. Use one of the credentials above

## Features by Role

### Admin Features:
- View all tasks
- Create, edit, and delete any task
- Manage categories (create, edit, delete)
- Assign tasks to users
- Full dashboard access

### Regular User Features:
- View their own tasks
- Create new tasks
- Edit/delete only their own tasks
- View categories (read-only)
- Personal dashboard

---

## Database Information
- **Type:** SQLite
- **Location:** `database/database.sqlite`
- **Reset Database:** `php artisan migrate:fresh --seed`

---

## Changing Passwords

To change the default passwords, edit the file:
`database/seeders/AdminSeeder.php`

Then run: `php artisan migrate:fresh --seed`
