<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SettingsController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/updateHistory', [EmployeeController::class, 'updateHistory']);
Route::post('/auth/login', [EmployeeController::class, 'loginOrCreateEmployee']);
Route::get('/get-password', [SettingsController::class, 'getPassword']);


Route::post('/image-upload', [EmployeeController::class, 'imageUploadPost']);

Route::post('/start', [EmployeeController::class, 'start']);
Route::post('/stop', [EmployeeController::class, 'stop']);
Route::post('/duration', [EmployeeController::class, 'durationThisMonth']);
