<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\User\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// -----------------------------------------------------------------------------
//  Аудентификация
// -----------------------------------------------------------------------------
Route::get('login', [LoginController::class, 'index'])->name('login.index')->middleware('guest');
Route::post('login', [LoginController::class, 'store'])->name('login.store')->middleware('guest');

// -----------------------------------------------------------------------------
//  Регистрация
// -----------------------------------------------------------------------------
Route::get('user/registration/', [RegistrationController::class, 'index'])->name('user.registration.index');
Route::post('user/registration', [RegistrationController::class, 'store'])->name('user.registration.store');

// -----------------------------------------------------------------------------
//  Выход
// -----------------------------------------------------------------------------
Route::get('user/logout', [LoginController::class, 'logout'])->name('user.logout');

// -----------------------------------------------------------------------------
//  Пользователь
// -----------------------------------------------------------------------------
Route::get('user/', [UserController::class, 'index'])->middleware('auth')->name('user.index');
Route::get('user/', [UserController::class, 'index'])->middleware('auth')->name('user.index');
// заявки
Route::get('user/tasks/', [TaskController::class, 'index'])->middleware('auth')->name('user.tasks.index');
// компании
Route::get('user/companies', [CompanyController::class, 'index'])->middleware('auth')->name('user.companies.index');
// города
Route::get('user/cities', [CityController::class, 'index'])->middleware('auth')->name('user.cities.index');
Route::post('user/cities', [CityController::class, 'store'])->middleware('auth')->name('user.cities.store');
