<?php

use App\Http\Controllers\UniqueItemContactController;
use App\Http\Controllers\WorkPlaceController;
use App\Http\Controllers\WorkDaysController;
use App\Http\Controllers\WorkPlaceContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamContactController;
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
    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/employee-teams/{employee}', 'employeeTeams')->name('teams.employee-teams');
        Route::get('/employee-workplaces/{employee}', 'employeeWorkPlaces')->name('employee.employee-workplaces');
        Route::get('/employee-unique-items/{employee}', [EmployeeController::class, 'employeeUniqueItems'])->name('employee.unique-items');
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

    Route::resource('unique-items', UniqueItemController::class);
    Route::resource('unique-item-contacts', UniqueItemContactController::class);
});
