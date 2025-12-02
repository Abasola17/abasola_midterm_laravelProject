# PowerShell Script to Transfer Gym Management Database to abasola_laravel
# This script copies all gym management related files from LlantoProjectmain to abasola_laravel

$sourcePath = "C:\xampp\htdocs\LlantoProjectmain"
$targetPath = "C:\xampp\htdocs\abasola_laravel"

Write-Host "Starting Gym Management Database Transfer..." -ForegroundColor Green
Write-Host "Source: $sourcePath" -ForegroundColor Cyan
Write-Host "Target: $targetPath" -ForegroundColor Cyan

# Check if source exists
if (-not (Test-Path $sourcePath)) {
    Write-Host "ERROR: Source path does not exist: $sourcePath" -ForegroundColor Red
    exit 1
}

# Check if target exists
if (-not (Test-Path $targetPath)) {
    Write-Host "Target path does not exist. Creating directory structure..." -ForegroundColor Yellow
    New-Item -ItemType Directory -Path $targetPath -Force | Out-Null
    Write-Host "NOTE: You need to create a Laravel project in $targetPath first!" -ForegroundColor Yellow
    Write-Host "Run: cd $targetPath && composer create-project laravel/laravel ." -ForegroundColor Yellow
    exit 1
}

# Files to copy
$filesToCopy = @(
    # Migrations
    @{Source = "database\migrations\2025_12_01_000001_create_plans_table.php"; Target = "database\migrations\2025_12_01_000001_create_plans_table.php"}
    @{Source = "database\migrations\2025_12_01_000002_create_members_table.php"; Target = "database\migrations\2025_12_01_000002_create_members_table.php"}
    
    # Models
    @{Source = "app\Models\Plan.php"; Target = "app\Models\Plan.php"}
    @{Source = "app\Models\Member.php"; Target = "app\Models\Member.php"}
    
    # Seeders
    @{Source = "database\seeders\GymSeeder.php"; Target = "database\seeders\GymSeeder.php"}
    
    # Controllers
    @{Source = "app\Http\Controllers\MemberController.php"; Target = "app\Http\Controllers\MemberController.php"}
    @{Source = "app\Http\Controllers\PlanController.php"; Target = "app\Http\Controllers\PlanController.php"}
    
    # Views
    @{Source = "resources\views\gym\members.blade.php"; Target = "resources\views\gym\members.blade.php"}
    @{Source = "resources\views\gym\plans.blade.php"; Target = "resources\views\gym\plans.blade.php"}
    @{Source = "resources\views\layouts\gym.blade.php"; Target = "resources\views\layouts\gym.blade.php"}
)

Write-Host "`nCopying files..." -ForegroundColor Green

foreach ($file in $filesToCopy) {
    $sourceFile = Join-Path $sourcePath $file.Source
    $targetFile = Join-Path $targetPath $file.Target
    $targetDir = Split-Path $targetFile -Parent
    
    if (Test-Path $sourceFile) {
        # Create target directory if it doesn't exist
        if (-not (Test-Path $targetDir)) {
            New-Item -ItemType Directory -Path $targetDir -Force | Out-Null
            Write-Host "Created directory: $targetDir" -ForegroundColor Gray
        }
        
        # Copy file
        Copy-Item -Path $sourceFile -Destination $targetFile -Force
        Write-Host "Copied: $($file.Source)" -ForegroundColor Green
    } else {
        Write-Host "WARNING: Source file not found: $sourceFile" -ForegroundColor Yellow
    }
}

# Create a routes addition file
$routesAddition = @"
// Gym System - Members
Route::get('/members', [MemberController::class, 'index'])->name('members.index');
Route::post('/members', [MemberController::class, 'store'])->name('members.store');
Route::put('/members/{member}', [MemberController::class, 'update'])->name('members.update');
Route::delete('/members/{member}', [MemberController::class, 'destroy'])->name('members.destroy');

// Gym System - Plans
Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
Route::post('/plans', [PlanController::class, 'store'])->name('plans.store');
Route::put('/plans/{plan}', [PlanController::class, 'update'])->name('plans.update');
Route::delete('/plans/{plan}', [PlanController::class, 'destroy'])->name('plans.destroy');
"@

$routesFile = Join-Path $targetPath "routes_to_add.txt"
$routesAddition | Out-File -FilePath $routesFile -Encoding UTF8
Write-Host "`nRoutes addition saved to: routes_to_add.txt" -ForegroundColor Cyan

# Create instructions file
$instructions = @"
Gym Management Database Transfer Complete!

NEXT STEPS:

1. Add the routes to routes/web.php:
   - Open routes/web.php
   - Add these imports at the top:
     use App\Http\Controllers\MemberController;
     use App\Http\Controllers\PlanController;
   - Add the routes from routes_to_add.txt inside your auth middleware group

2. Update DatabaseSeeder.php:
   - Open database/seeders/DatabaseSeeder.php
   - Add: `\$this->call([GymSeeder::class]);` in the run() method

3. Run migrations:
   - php artisan migrate

4. (Optional) Seed the database:
   - php artisan db:seed --class=GymSeeder

5. Make sure your .env file has the correct database configuration.

6. If you want to export data from SQLite to MySQL:
   - Use phpMyAdmin or command line to create the database
   - Run the migrations
   - Import data manually or use the seeder

Files transferred:
- Migrations (plans and members tables)
- Models (Plan.php and Member.php)
- Controllers (MemberController.php and PlanController.php)
- Seeders (GymSeeder.php)
- Views (gym/members.blade.php, gym/plans.blade.php, layouts/gym.blade.php)
"@

$instructionsFile = Join-Path $targetPath "TRANSFER_INSTRUCTIONS.txt"
$instructions | Out-File -FilePath $instructionsFile -Encoding UTF8
Write-Host "Instructions saved to: TRANSFER_INSTRUCTIONS.txt" -ForegroundColor Cyan

Write-Host "`nTransfer complete!" -ForegroundColor Green
Write-Host "Please check TRANSFER_INSTRUCTIONS.txt for next steps." -ForegroundColor Yellow



