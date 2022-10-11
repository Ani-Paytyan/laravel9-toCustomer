<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;

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

Route::group(['middleware' => ['auth', 'IwmsAuth']], static function () {
    Route::resource('employees', EmployeeController::class);
});
