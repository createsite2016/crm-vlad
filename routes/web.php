<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'user');

//  Аудентификация
Route::get('login', [LoginController::class, 'index'])->name('user.login.index')->middleware('guest');
Route::post('login', [LoginController::class, 'store'])->name('login.store')->middleware('guest');

Route::prefix('user')->middleware('auth')->group(function(){
// главная
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('/', [UserController::class, 'index'])->name('user.index');
// регистрация
    Route::get('registration', [RegistrationController::class, 'index'])->name('user.registration.index');
    Route::post('registration', [RegistrationController::class, 'store'])->name('user.registration.store');
// выход
    Route::get('logout', [LoginController::class, 'logout'])->name('user.logout');
// заявки
    Route::get('tasks', [TaskController::class, 'index'])->name('user.tasks.index');
    Route::post('tasks', [TaskController::class, 'store'])->name('user.tasks.store');
// компании
    Route::get('companies', [CompanyController::class, 'index'])->name('user.companies.index');
    Route::post('companies', [CompanyController::class, 'store'])->name('user.companies.store');
    Route::get('companies/{company}/edit', [CompanyController::class, 'edit'])->name('user.companies.edit');
    Route::patch('companies/{company}', [CompanyController::class, 'update'])->name('user.companies.update');
    Route::get('companies/{company}', [CompanyController::class, 'destroy'])->name('user.companies.destroy');
// города
    Route::get('cities', [CityController::class, 'index'])->name('user.cities.index');
    Route::post('cities', [CityController::class, 'store'])->name('user.cities.store');
    Route::get('cities/{city}/edit', [CityController::class, 'edit'])->name('user.cities.edit');
    Route::patch('cities/{city}', [CityController::class, 'update'])->name('user.cities.update');
    Route::get('cities/{city}', [CityController::class, 'destroy'])->name('user.cities.destroy');
// склады
    Route::get('staffs', [StaffController::class, 'index'])->name('user.staffs.index');
    Route::post('staffs', [StaffController::class, 'store'])->name('user.staffs.store');
    Route::get('staffs/{staff}/edit', [StaffController::class, 'edit'])->name('user.staffs.edit');
    Route::patch('staffs/{staff}', [StaffController::class, 'update'])->name('user.staffs.update');
    Route::get('staffs/{staff}', [StaffController::class, 'destroy'])->name('user.staffs.destroy');
// оборудование
    Route::get('devices', [DeviceController::class, 'index'])->name('user.devices.index');
    Route::post('devices', [DeviceController::class, 'store'])->name('user.devices.store');
    Route::get('devices/{device}/edit', [DeviceController::class, 'edit'])->name('user.devices.edit');
    Route::patch('devices/{device}', [DeviceController::class, 'update'])->name('user.devices.update');
    Route::get('devices/{device}', [DeviceController::class, 'destroy'])->name('user.devices.destroy');
// исполнители
    Route::get('players', [UserController::class, 'players'])->name('user.players.index');
    Route::get('players/{player}', [UserController::class, 'destroy'])->name('user.players.destroy');
// автомобили
    Route::get('cars', function (){
        return view('page.user.cars.index');
    })->name('user.cars.index');
});
