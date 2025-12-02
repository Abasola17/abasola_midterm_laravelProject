# Update Database Configuration Script
# Use this after changing database settings in .env

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Update Database Configuration" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

Write-Host "This script will:" -ForegroundColor Yellow
Write-Host "  1. Clear Laravel config cache" -ForegroundColor White
Write-Host "  2. Clear application cache" -ForegroundColor White
Write-Host "  3. Test database connection" -ForegroundColor White
Write-Host ""

$continue = Read-Host "Continue? (y/n)"
if ($continue -ne "y" -and $continue -ne "Y") {
    Write-Host "Cancelled." -ForegroundColor Yellow
    exit 0
}

Write-Host ""
Write-Host "Step 1: Clearing config cache..." -ForegroundColor Yellow
php artisan config:clear

if ($LASTEXITCODE -ne 0) {
    Write-Host "ERROR: Failed to clear config cache" -ForegroundColor Red
    exit 1
}

Write-Host ""
Write-Host "Step 2: Clearing application cache..." -ForegroundColor Yellow
php artisan cache:clear

if ($LASTEXITCODE -ne 0) {
    Write-Host "ERROR: Failed to clear cache" -ForegroundColor Red
    exit 1
}

Write-Host ""
Write-Host "Step 3: Testing database connection..." -ForegroundColor Yellow
php artisan migrate:status

if ($LASTEXITCODE -ne 0) {
    Write-Host ""
    Write-Host "WARNING: Database connection test failed!" -ForegroundColor Red
    Write-Host "Please check your .env file settings:" -ForegroundColor Yellow
    Write-Host "  - DB_CONNECTION" -ForegroundColor White
    Write-Host "  - DB_HOST" -ForegroundColor White
    Write-Host "  - DB_DATABASE" -ForegroundColor White
    Write-Host "  - DB_USERNAME" -ForegroundColor White
    Write-Host "  - DB_PASSWORD" -ForegroundColor White
} else {
    Write-Host ""
    Write-Host "Database connection successful!" -ForegroundColor Green
}

Write-Host ""
Write-Host "========================================" -ForegroundColor Green
Write-Host "  Configuration updated!" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Green
Write-Host ""
Write-Host "IMPORTANT: Make sure your .env file has:" -ForegroundColor Yellow
Write-Host "  DB_CONNECTION=mysql" -ForegroundColor White
Write-Host "  DB_DATABASE=your_database_name" -ForegroundColor White
Write-Host "  DB_USERNAME=your_username" -ForegroundColor White
Write-Host "  DB_PASSWORD=your_password" -ForegroundColor White
Write-Host ""


