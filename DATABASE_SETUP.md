# Database Setup Guide for abasola_laravel

## Step 1: Create the Database

### Option A: Using phpMyAdmin
1. Open phpMyAdmin (usually at http://localhost/phpmyadmin)
2. Click on "New" to create a new database
3. Enter database name: `abasola_laravel`
4. Select collation: `utf8mb4_unicode_ci`
5. Click "Create"

### Option B: Using MySQL Command Line
```sql
CREATE DATABASE IF NOT EXISTS `abasola_laravel` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Option C: Using the SQL Script
Run the `setup_database.sql` file in phpMyAdmin or MySQL command line.

## Step 2: Configure .env File

Make sure your `.env` file has the following database configuration:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=abasola_laravel
DB_USERNAME=root
DB_PASSWORD=
```

(Adjust `DB_PASSWORD` if your MySQL root user has a password)

## Step 3: Run Migrations

Open terminal/command prompt in the project directory and run:

```bash
php artisan migrate
```

This will create all the necessary tables:
- users
- plans
- members
- cache
- jobs
- migrations (tracking table)

## Step 4: Seed the Database (Optional)

To populate the database with sample gym data:

```bash
php artisan db:seed --class=GymSeeder
```

Or to seed everything:

```bash
php artisan db:seed
```

## Step 5: Verify Setup

1. Check that the database `abasola_laravel` exists
2. Verify tables are created: `users`, `plans`, `members`, `migrations`
3. If seeded, check that you have 5 plans and 7 members in the database

## Troubleshooting

### Error: "Access denied for user"
- Check your MySQL username and password in `.env`
- Make sure MySQL service is running (XAMPP Control Panel)

### Error: "Unknown database 'abasola_laravel'"
- Make sure you created the database first (Step 1)
- Verify the database name in `.env` matches exactly

### Error: "Table already exists"
- If you need to reset, run: `php artisan migrate:fresh`
- Warning: This will drop all tables and recreate them (data will be lost)

### Reset Everything
```bash
php artisan migrate:fresh --seed
```
This will drop all tables, recreate them, and seed with sample data.


