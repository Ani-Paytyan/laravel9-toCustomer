<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamUserController;
use App\Http\Controllers\WorkPlaceController;

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
    Route::resource('workplaces', WorkPlaceController::class);
    Route::resource('teams', TeamController::class);
    Route::resource('team_users', TeamUserController::class);
    Route::get('/employee-teams/{id}', [TeamUserController::class, 'employeeTeams'])->name('teams.employee-teams');
});
