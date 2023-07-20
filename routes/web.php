<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\auth\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'index']);
Route::get('register', [AuthController::class, 'registrationView']);
Route::post('login', [AuthController::class, 'login']);
Route::post('registration', [AuthController::class, 'registration']);
Route::get('dashboard', [AuthController::class, 'dashboard']);
Route::post('logout', [AuthController::class, 'logout']);

Route::get('forget-password', [ForgotPasswordController::class, 'forgetPasswordForm'])->name('forget-password-get');
Route::post('forget-password', [ForgotPasswordController::class, 'forgetPassword'])->name('forget-password-post');
Route::get('reset-password', [ForgotPasswordController::class, 'resetPasswordForm'])->name('reset-password-get');
Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('reset-password-post');