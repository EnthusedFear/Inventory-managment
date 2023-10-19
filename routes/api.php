<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\OutletController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WarehouseController;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::get('logout', 'logout');
        Route::patch('changePassword', 'changePassword');
        Route::get('checkAuth', 'checkAuth');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('user', 'user');
        Route::patch('changeName', 'changeName');
        Route::get('getUserOrganisation', 'getUserOrganisation');
    });

    Route::apiResource('warehouse', WarehouseController::class);
    Route::apiResource('inventory', InventoryController::class);
    Route::apiResource('outlet', OutletController::class);
    Route::apiResource('employee', EmployeeController::class);
});
//        Route::patch('changeName', 'changeName')->middleware('restrictRole:admin');
