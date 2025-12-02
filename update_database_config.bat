@echo off
echo ========================================
echo   Update Database Configuration
echo ========================================
echo.
echo This script will:
echo   1. Clear Laravel config cache
echo   2. Clear application cache
echo   3. Test database connection
echo.
pause

echo.
echo Step 1: Clearing config cache...
php artisan config:clear
if %ERRORLEVEL% NEQ 0 (
    echo ERROR: Failed to clear config cache
    pause
    exit /b 1
)

echo.
echo Step 2: Clearing application cache...
php artisan cache:clear
if %ERRORLEVEL% NEQ 0 (
    echo ERROR: Failed to clear cache
    pause
    exit /b 1
)

echo.
echo Step 3: Testing database connection...
php artisan migrate:status
if %ERRORLEVEL% NEQ 0 (
    echo.
    echo WARNING: Database connection test failed!
    echo Please check your .env file settings:
    echo   - DB_CONNECTION
    echo   - DB_HOST
    echo   - DB_DATABASE
    echo   - DB_USERNAME
    echo   - DB_PASSWORD
) else (
    echo.
    echo Database connection successful!
)

echo.
echo ========================================
echo   Configuration updated!
echo ========================================
echo.
echo IMPORTANT: Make sure your .env file has:
echo   DB_CONNECTION=mysql
echo   DB_DATABASE=your_database_name
echo   DB_USERNAME=your_username
echo   DB_PASSWORD=your_password
echo.
pause


