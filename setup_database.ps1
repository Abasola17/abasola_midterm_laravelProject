# Database Setup Script for abasola_laravel
# This script helps set up the database for the gym management system

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Database Setup for abasola_laravel" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Check if .env file exists
if (-not (Test-Path ".env")) {
    Write-Host "ERROR: .env file not found!" -ForegroundColor Red
    Write-Host "Please create a .env file from .env.example first." -ForegroundColor Yellow
    exit 1
}

Write-Host "Step 1: Checking database configuration..." -ForegroundColor Yellow

# Check if MySQL is running (XAMPP)
$mysqlRunning = Get-Process -Name "mysqld" -ErrorAction SilentlyContinue
if (-not $mysqlRunning) {
    Write-Host "WARNING: MySQL might not be running." -ForegroundColor Yellow
    Write-Host "Please start MySQL from XAMPP Control Panel." -ForegroundColor Yellow
    Write-Host ""
}

Write-Host "Step 2: Creating database..." -ForegroundColor Yellow
Write-Host "Please create the database manually:" -ForegroundColor Cyan
Write-Host "  1. Open phpMyAdmin (http://localhost/phpmyadmin)" -ForegroundColor White
Write-Host "  2. Click 'New' to create database" -ForegroundColor White
Write-Host "  3. Database name: abasola_laravel" -ForegroundColor White
Write-Host "  4. Collation: utf8mb4_unicode_ci" -ForegroundColor White
Write-Host "  5. Click 'Create'" -ForegroundColor White
Write-Host ""
Write-Host "Or run the SQL script: setup_database.sql" -ForegroundColor Cyan
Write-Host ""

$continue = Read-Host "Have you created the database? (y/n)"
if ($continue -ne "y" -and $continue -ne "Y") {
    Write-Host "Please create the database first and run this script again." -ForegroundColor Yellow
    exit 0
}

Write-Host ""
Write-Host "Step 3: Running migrations..." -ForegroundColor Yellow
php artisan migrate

if ($LASTEXITCODE -eq 0) {
    Write-Host ""
    Write-Host "Step 4: Seeding database..." -ForegroundColor Yellow
    $seed = Read-Host "Do you want to seed the database with sample data? (y/n)"
    
    if ($seed -eq "y" -or $seed -eq "Y") {
        php artisan db:seed
        Write-Host ""
        Write-Host "Database seeded successfully!" -ForegroundColor Green
        Write-Host "Sample data includes:" -ForegroundColor Cyan
        Write-Host "  - 1 Demo User (email: demo@example.com, password: password)" -ForegroundColor White
        Write-Host "  - 5 Gym Plans (Basic, Premium, VIP, Student, Annual)" -ForegroundColor White
        Write-Host "  - 7 Gym Members" -ForegroundColor White
    }
    
    Write-Host ""
    Write-Host "========================================" -ForegroundColor Green
    Write-Host "  Database setup completed!" -ForegroundColor Green
    Write-Host "========================================" -ForegroundColor Green
    Write-Host ""
    Write-Host "You can now:" -ForegroundColor Cyan
    Write-Host "  1. Start the server: php artisan serve" -ForegroundColor White
    Write-Host "  2. Visit http://localhost:8000" -ForegroundColor White
    Write-Host "  3. Login with: demo@example.com / password" -ForegroundColor White
} else {
    Write-Host ""
    Write-Host "ERROR: Migration failed!" -ForegroundColor Red
    Write-Host "Please check:" -ForegroundColor Yellow
    Write-Host "  1. Database exists and is accessible" -ForegroundColor White
    Write-Host "  2. .env file has correct database credentials" -ForegroundColor White
    Write-Host "  3. MySQL service is running" -ForegroundColor White
}


