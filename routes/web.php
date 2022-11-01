<?php

use App\Http\Controllers\WorkDaysController;
use App\Http\Controllers\WorkPlaceContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamContactController;
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
    Route::get('/employee-teams/{employee}', [EmployeeController::class, 'employeeTeams'])->name('teams.employee-teams');
    Route::get('/employee-workplaces/{employee}', [EmployeeController::class, 'employeWorkPlaces'])->name('employee.employee-workplaces');

    Route::resource('workplaces', WorkPlaceController::class);
    Route::resource('workplace-contacts', WorkPlaceContactController::class);

    Route::resource('teams', TeamController::class);
    Route::resource('team-contacts', TeamContactController::class);

    Route::get('company-workdays', [WorkDaysController::class, 'companyWorkdays'])->name('company.workdays');
    Route::post('company-workdays', [WorkDaysController::class, 'storeCompanyWorkdays'])->name('company-workdays.store');
    Route::delete('company-workdays', [WorkDaysController::class, 'deleteCompanyWorkdays'])->name('company-workdays.delete');

    Route::get('workplace-workdays/{workPlace}', [WorkDaysController::class, 'workPlaceWorkdays'])->name('workplace.workdays');
    Route::post('workplace-workdays/{workPlace}', [WorkDaysController::class, 'storeWorkPlaceWorkdays'])->name('workplace-workdays.store');
    Route::delete('workplace-workdays/{workPlace}', [WorkDaysController::class, 'deleteWorkPlaceWorkdays'])->name('workplace-workdays.delete');
});
