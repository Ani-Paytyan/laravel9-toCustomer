<?php

use App\Http\Controllers\UniqueItemContactController;
use App\Http\Controllers\WorkPlaceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamContactController;
use App\Http\Controllers\WorkPlaceController;
use App\Http\Controllers\UniqueItemController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$basePath = base_path('routes/web');

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

Route::prefix('auth')->name('auth.')->group($basePath . '/auth.php');

Route::group(['middleware' => ['auth', 'SetIwmsApiToken']], static function () {
    Route::resource('employees', EmployeeController::class);
    Route::get('/employee-teams/{id}', [EmployeeController::class, 'employeeTeams'])->name('teams.employee-teams');

    Route::resource('workplaces', WorkPlaceController::class);
    Route::resource('teams', TeamController::class);
    Route::resource('team-contacts', TeamContactController::class);
    Route::resource('team_users', TeamUserController::class);
    Route::get('/employee-teams/{id}', [TeamUserController::class, 'employeeTeams'])->name('teams.employee-teams');
    Route::resource('unique-items', UniqueItemController::class);
    Route::resource('unique-item-contacts', UniqueItemContactController::class);
});
