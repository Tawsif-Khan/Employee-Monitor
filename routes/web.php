<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [EmployeeController::class, 'dashboard']);
// Route::post('/search', [EmployeeController::class, 'dashboard']);
Route::get('/search', [EmployeeController::class, 'dashboard']);
Route::get('/employees', [EmployeeController::class, 'employees']);
Route::get('/settings', [SettingsController::class, 'settings']);
Route::post('/insert-password', [SettingsController::class, 'insertNewPassword']);
Route::get('/employee/delete/{employee_id}', [EmployeeController::class, 'deleteEmployee']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/employee/edit/{id}', [App\Http\Controllers\EmployeeController::class, 'editEmployee'])->name('editEmployee');
Route::post('/employee/update', [App\Http\Controllers\EmployeeController::class, 'updateEmployee'])->name('update');
