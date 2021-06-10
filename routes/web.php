<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// -----------------------------------------------------------------------------
//  Аудентификация
// -----------------------------------------------------------------------------
Route::get('user/login/', [LoginController::class, 'index'])->name('user.login.index')->middleware('guest');
Route::post('user/login/', [LoginController::class, 'store'])->name('user.login.store')->middleware('guest');

// -----------------------------------------------------------------------------
//  Регистрация
// -----------------------------------------------------------------------------
Route::get('user/registration/', [RegistrationController::class, 'index'])->name('user.registration.index');
Route::post('user/registration', [RegistrationController::class, 'store'])->name('user.registration.store');

// -----------------------------------------------------------------------------
//  Выход
// -----------------------------------------------------------------------------
Route::get('user/logout/', [LoginController::class, 'logout'])->name('user.logout');

// -----------------------------------------------------------------------------
//  Пользователь
// -----------------------------------------------------------------------------
Route::get('user/', [UserController::class, 'index'])->middleware('auth')->name('user.index');
Route::get('user/', [UserController::class, 'index'])->middleware('auth')->name('user.index');
