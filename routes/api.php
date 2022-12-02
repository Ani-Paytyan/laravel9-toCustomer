<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\EmployeeController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], static function () {
    Route::post('auth/login', [AuthController::class, 'login'])->name('login');
});

Route::group(['middleware' => 'api_auth', 'prefix' => 'v1'], static function () {
    Route::get('user/info', [UserController::class, 'index']);

    Route::controller(EmployeeController::class)->group(function () {
        Route::get('employee', 'index')->name('api.employee.index');
        Route::get('employee/{employee}', 'show')->name('api.employee.show');

        #Route::delete('employee/{employee}/archive', 'archive')->name('api.employee.archive');
        #Route::patch('employee/{employee}/restore/', 'restore')->name('api.employee.restore')->withTrashed();
    });
});
