# Database Configuration Guide

## Current Configuration

The application is configured to read database settings from your `.env` file. The default values in `config/database.php` are:

- **Connection:** MySQL (can be changed to sqlite, pgsql, etc.)
- **Default Database:** `abasola_laravel` (reads from `DB_DATABASE` in `.env`)
- **Host:** `127.0.0.1` (reads from `DB_HOST` in `.env`)
- **Port:** `3306` (reads from `DB_PORT` in `.env`)
- **Username:** `root` (reads from `DB_USERNAME` in `.env`)
- **Password:** Empty (reads from `DB_PASSWORD` in `.env`)

## How It Works

Laravel uses the `env()` function to read values from your `.env` file. The second parameter is the default value if the environment variable is not set.

Example from `config/database.php`:
```php
'database' => env('DB_DATABASE', 'abasola_laravel'),
```

This means:
- If `DB_DATABASE` exists in `.env`, use that value
- If not, use `abasola_laravel` as default

## Changing Database

### Method 1: Update .env File (Recommended)

1. Open `.env` file in project root
2. Update these lines:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_new_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```
3. Clear config cache:
   ```bash
   php artisan config:clear
   ```
4. Or use the script: `update_database_config.bat`

### Method 2: Update config/database.php

You can change the default values directly in `config/database.php`, but this is NOT recommended because:
- `.env` file is easier to manage
- Different environments (dev, production) can have different values
- `.env` is typically not committed to version control

## Important Notes

⚠️ **After changing database settings:**
1. Always clear config cache: `php artisan config:clear`
2. Create the new database if you changed the name
3. Run migrations: `php artisan migrate`

## Files Related to Database

- `config/database.php` - Database configuration
- `.env` - Environment variables (database credentials)
- `database/migrations/` - Database table definitions
- `database/seeders/` - Sample data seeders

## Quick Commands

```bash
# Clear config cache (after changing .env)
php artisan config:clear

# Test database connection
php artisan migrate:status

# Run migrations
php artisan migrate

# Reset and seed database
php artisan migrate:fresh --seed
```


