<?php

use App\Http\Controllers\AdditionalWorkingDayController;
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
    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/employee-teams/{employee}', 'employeeTeams')->name('teams.employee-teams');
        Route::get('/employee-workplaces/{employee}', 'employeeWorkPlaces')->name('employee.employee-workplaces');
    });

    Route::resource('workplaces', WorkPlaceController::class);

    Route::controller(WorkPlaceContactController::class)->group(function () {
        Route::post('workplace-employees/{workPlace}', 'storeWorkPlaceEmployees')->name('workplace-employees.store');
        Route::delete('workplace-employees/{workPlace}/{employee}', 'deleteWorkPlaceEmployees')->name('workplace-employees.delete');

        Route::post('employee-workplaces/{employee}', 'storeEmployeeWorkplaces')->name('employee-workplaces.store');
        Route::delete('employee-workplaces/{employee}/{workPlace}', 'deleteEmployeeWorkplaces')->name('employee-workplaces.delete');
    });

    Route::resource('teams', TeamController::class);
    Route::resource('team-contacts', TeamContactController::class);

    Route::controller(WorkDaysController::class)->group(function () {
        Route::get('company-workdays', 'companyWorkdays')->name('company.workdays');
        Route::post('company-workdays', 'storeCompanyWorkdays')->name('company-workdays.store');
        Route::delete('company-workdays', 'deleteCompanyWorkdays')->name('company-workdays.delete');

        Route::get('workplace-workdays/{workPlace}', 'workPlaceWorkdays')->name('workplace.workdays');
        Route::post('workplace-workdays/{workPlace}', 'storeWorkPlaceWorkdays')->name('workplace-workdays.store');
        Route::delete('workplace-workdays/{workPlace}', 'deleteWorkPlaceWorkdays')->name('workplace-workdays.delete');
    });

    Route::controller(AdditionalWorkingDayController::class)->group(function () {
        Route::post('additional-working-days-store/{workPlace}', 'storeWorkPlaceWorkdays')->name('additional-working-days.store');
        Route::put('additional-working-days-update/{additionalWorkingDay}', 'updateWorkPlaceWorkdays')->name('additional-working-days.update');
        Route::delete('additional-working-days-delete/{additionalWorkingDay}', 'deleteWorkPlaceWorkdays')->name('additional-working-days.delete');
    });
});
