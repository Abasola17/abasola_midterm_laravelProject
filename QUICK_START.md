# Quick Start Guide - Database Setup

## ⚠️ Database Empty? Quick Fix!

If your database is empty, run this ONE command:
```bash
php artisan migrate:fresh --seed
```

This will create all tables and populate with sample data!

---

## Quick Setup (3 Steps)

### 1. Create Database
Open phpMyAdmin (http://localhost/phpmyadmin) and create database:
- Name: `abasola_laravel`
- Collation: `utf8mb4_unicode_ci`

### 2. Update .env File
Make sure your `.env` has:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=abasola_laravel
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Run Setup Commands

**Option A: One Command (Recommended)**
```bash
php artisan migrate:fresh --seed
```

**Option B: Step by Step**
```bash
php artisan migrate
php artisan db:seed
```

**Option C: Use Scripts**
- Windows: Double-click `populate_database.bat`
- PowerShell: `.\populate_database.ps1`

## Or Use the Setup Script

Run the PowerShell script:
```powershell
powershell -ExecutionPolicy Bypass -File .\setup_database.ps1
```

## Login Credentials (after seeding)

- **Email:** demo@example.com
- **Password:** password

## What Gets Created

After running migrations and seeding:
- ✅ Users table (with 1 demo user)
- ✅ Plans table (with 5 sample plans)
- ✅ Members table (with 7 sample members)
- ✅ All relationships and foreign keys

## Need Help?

See `DATABASE_SETUP.md` for detailed instructions and troubleshooting.

