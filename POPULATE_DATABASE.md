# Why is the Database Empty?

The database is empty because you need to:
1. **Run migrations** - Creates the tables
2. **Run seeders** - Populates the tables with data

## Quick Fix - Populate Database Now

### Option 1: One Command (Recommended)
```bash
php artisan migrate:fresh --seed
```
This will:
- Drop all existing tables
- Recreate all tables
- Populate with sample data

### Option 2: Step by Step

**Step 1: Run Migrations** (Creates tables)
```bash
php artisan migrate
```

**Step 2: Seed Database** (Adds data)
```bash
php artisan db:seed
```

Or seed only gym data:
```bash
php artisan db:seed --class=GymSeeder
```

## What Data Will Be Created?

After seeding, you'll have:

### Users Table
- 1 demo user
  - Email: `demo@example.com`
  - Password: `password`

### Plans Table
- 5 membership plans:
  1. Basic Plan - ₱29.99/month
  2. Premium Plan - ₱49.99/month
  3. VIP Plan - ₱79.99/month
  4. Student Plan - ₱19.99/month
  5. Annual Plan - ₱399.99/year

### Members Table
- 7 sample members with different statuses and plans

## Verify Database is Populated

### Check in phpMyAdmin:
1. Open phpMyAdmin (http://localhost/phpmyadmin)
2. Select database: `abasola_laravel`
3. Check tables:
   - `users` - Should have 1 record
   - `plans` - Should have 5 records
   - `members` - Should have 7 records

### Check via Command Line:
```bash
php artisan tinker
```
Then run:
```php
\App\Models\User::count();      // Should return 1
\App\Models\Plan::count();      // Should return 5
\App\Models\Member::count();    // Should return 7
```

## Common Issues

### Issue: "No such file or directory" or "Command not found"
**Solution:** Make sure you're in the project directory and PHP is in your PATH.

### Issue: "Access denied for user"
**Solution:** Check your `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=abasola_laravel
DB_USERNAME=root
DB_PASSWORD=    (leave empty if no password)
```

### Issue: "Unknown database 'abasola_laravel'"
**Solution:** Create the database first:
1. Open phpMyAdmin
2. Click "New"
3. Database name: `abasola_laravel`
4. Collation: `utf8mb4_unicode_ci`
5. Click "Create"

### Issue: "Table already exists"
**Solution:** If you want to start fresh:
```bash
php artisan migrate:fresh --seed
```
⚠️ **Warning:** This deletes all existing data!

## Still Having Issues?

1. Make sure MySQL is running (check XAMPP Control Panel)
2. Verify database name in `.env` matches exactly
3. Check MySQL username/password are correct
4. Try clearing config cache:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```


