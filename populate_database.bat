@echo off
echo ========================================
echo   Populate Database for abasola_laravel
echo ========================================
echo.

echo Step 1: Checking if database exists...
echo Please make sure:
echo   1. Database 'abasola_laravel' is created
echo   2. MySQL is running
echo   3. .env file is configured correctly
echo.
pause

echo.
echo Step 2: Running migrations...
php artisan migrate

if %ERRORLEVEL% NEQ 0 (
    echo.
    echo ERROR: Migrations failed!
    echo Please check:
    echo   - Database exists
    echo   - MySQL is running
    echo   - .env file is correct
    pause
    exit /b 1
)

echo.
echo Step 3: Seeding database with sample data...
php artisan db:seed

if %ERRORLEVEL% NEQ 0 (
    echo.
    echo ERROR: Seeding failed!
    pause
    exit /b 1
)

echo.
echo ========================================
echo   Database populated successfully!
echo ========================================
echo.
echo You now have:
echo   - 1 Demo User (demo@example.com / password)
echo   - 5 Gym Plans
echo   - 7 Gym Members
echo.
echo You can now login and use the gym management system!
echo.
pause


