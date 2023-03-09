<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('/employees', [EmployeeController::class, 'create']);
Route::get('/employees', [EmployeeController::class, 'list']);
Route::get('/employees/{id}', [EmployeeController::class, 'get']);
Route::patch('/employees/{id}', [EmployeeController::class, 'update']);
