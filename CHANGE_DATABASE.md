# How to Change Database Configuration

## After Changing Database in .env

When you change the database name, username, password, or host in your `.env` file, you need to:

### Step 1: Update .env File

Edit your `.env` file and update these values:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_new_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Step 2: Clear Laravel Cache

Laravel caches configuration, so you need to clear it:

**Option A: Use the Script (Recommended)**
- Windows: Double-click `update_database_config.bat`
- PowerShell: `.\update_database_config.ps1`

**Option B: Manual Commands**
```bash
php artisan config:clear
php artisan cache:clear
```

### Step 3: Create the New Database

If you changed the database name, create it first:

1. Open phpMyAdmin (http://localhost/phpmyadmin)
2. Click "New" to create database
3. Enter your new database name
4. Collation: `utf8mb4_unicode_ci`
5. Click "Create"

### Step 4: Run Migrations

After changing the database, run migrations:

```bash
php artisan migrate
```

Or if you want to start fresh with sample data:

```bash
php artisan migrate:fresh --seed
```

## Quick Reference

### Common Database Changes

**Change Database Name:**
1. Update `DB_DATABASE` in `.env`
2. Create new database in phpMyAdmin
3. Run `update_database_config.bat` or clear cache manually
4. Run `php artisan migrate`

**Change Username/Password:**
1. Update `DB_USERNAME` and `DB_PASSWORD` in `.env`
2. Run `update_database_config.bat` or clear cache manually
3. Test connection: `php artisan migrate:status`

**Change Host/Port:**
1. Update `DB_HOST` and `DB_PORT` in `.env`
2. Run `update_database_config.bat` or clear cache manually
3. Test connection: `php artisan migrate:status`

## Verify Configuration

Test your database connection:

```bash
php artisan migrate:status
```

If successful, you'll see the migration status. If it fails, check:
- Database exists
- MySQL is running
- Credentials in `.env` are correct
- Config cache is cleared

## Troubleshooting

### Error: "Access denied for user"
- Check username and password in `.env`
- Verify MySQL user has permissions

### Error: "Unknown database"
- Make sure database exists
- Check database name spelling in `.env`
- Clear config cache: `php artisan config:clear`

### Error: "Connection refused"
- Check MySQL is running (XAMPP Control Panel)
- Verify `DB_HOST` and `DB_PORT` in `.env`

### Configuration Not Updating
- Clear config cache: `php artisan config:clear`
- Clear all cache: `php artisan cache:clear`
- Restart Laravel server if running


