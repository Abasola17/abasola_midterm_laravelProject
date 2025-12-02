# Populate Database Script for abasola_laravel
# This script runs migrations and seeds the database

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Populate Database - abasola_laravel" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Check if .env exists
if (-not (Test-Path ".env")) {
    Write-Host "ERROR: .env file not found!" -ForegroundColor Red
    Write-Host "Please create a .env file first." -ForegroundColor Yellow
    exit 1
}

Write-Host "Prerequisites Check:" -ForegroundColor Yellow
Write-Host "  ✓ Make sure database 'abasola_laravel' exists" -ForegroundColor White
Write-Host "  ✓ Make sure MySQL is running" -ForegroundColor White
Write-Host "  ✓ Make sure .env file is configured" -ForegroundColor White
Write-Host ""

$continue = Read-Host "Ready to populate database? (y/n)"
if ($continue -ne "y" -and $continue -ne "Y") {
    Write-Host "Cancelled." -ForegroundColor Yellow
    exit 0
}

Write-Host ""
Write-Host "Step 1: Running migrations..." -ForegroundColor Yellow
php artisan migrate

if ($LASTEXITCODE -ne 0) {
    Write-Host ""
    Write-Host "ERROR: Migrations failed!" -ForegroundColor Red
    Write-Host "Please check:" -ForegroundColor Yellow
    Write-Host "  - Database 'abasola_laravel' exists" -ForegroundColor White
    Write-Host "  - MySQL service is running" -ForegroundColor White
    Write-Host "  - .env file has correct database credentials" -ForegroundColor White
    exit 1
}

Write-Host ""
Write-Host "Step 2: Seeding database..." -ForegroundColor Yellow
php artisan db:seed

if ($LASTEXITCODE -ne 0) {
    Write-Host ""
    Write-Host "ERROR: Seeding failed!" -ForegroundColor Red
    exit 1
}

Write-Host ""
Write-Host "========================================" -ForegroundColor Green
Write-Host "  Database populated successfully!" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Green
Write-Host ""
Write-Host "Your database now contains:" -ForegroundColor Cyan
Write-Host "  ✓ 1 Demo User" -ForegroundColor White
Write-Host "     Email: demo@example.com" -ForegroundColor Gray
Write-Host "     Password: password" -ForegroundColor Gray
Write-Host "  ✓ 5 Gym Plans (Basic, Premium, VIP, Student, Annual)" -ForegroundColor White
Write-Host "  ✓ 7 Gym Members" -ForegroundColor White
Write-Host ""
Write-Host "You can now:" -ForegroundColor Cyan
Write-Host "  1. Start server: php artisan serve" -ForegroundColor White
Write-Host "  2. Visit http://localhost:8000" -ForegroundColor White
Write-Host "  3. Login with demo@example.com / password" -ForegroundColor White
Write-Host ""


