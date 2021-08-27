<?php

use App\Http\Controllers\BotController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'user');
Route::post('bot', [BotController::class, 'index'])->middleware('web');

//  Аудентификация
Route::get('login', [LoginController::class, 'index'])->name('user.login.index')->middleware('guest');
Route::post('login', [LoginController::class, 'store'])->name('login.store')->middleware('guest');

Route::prefix('user')->middleware('auth')->group(function(){
// главная
    Route::get('/', [UserController::class, 'index'])->name('user.index');
// регистрация
    Route::get('registration', [RegistrationController::class, 'index'])->name('user.registration.index');
    Route::post('registration', [RegistrationController::class, 'store'])->name('user.registration.store');
// выход
    Route::get('logout', [LoginController::class, 'logout'])->name('user.logout');
// заявки
    Route::get('tasks', [TaskController::class, 'index'])->name('user.tasks.index');
    Route::get('tasks/team', [TaskController::class, 'team'])->name('user.tasks.team');
    Route::get('tasks/control', [TaskController::class, 'control'])->name('user.tasks.control');
    Route::get('tasks/complete', [TaskController::class, 'complete'])->name('user.tasks.complete');
    Route::post('tasks', [TaskController::class, 'store'])->name('user.tasks.store');
    Route::get('tasks/{task}/edit', [TaskController::class, 'edit'])->name('user.tasks.edit');
    Route::patch('tasks/{task}', [TaskController::class, 'update'])->name('user.tasks.update');
    Route::patch('tasks/player/{task}', [TaskController::class, 'update_player'])->name('user.tasks.update_player');
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
    Route::patch('players/{player}', [UserController::class, 'update'])->name('user.players.update');
// автомобили
    Route::get('cars', [CarController::class, 'index'])->name('user.cars.index');
    Route::post('cars', [CarController::class, 'store'])->name('user.cars.store');
    Route::get('cars/{car}/edit', [CarController::class, 'edit'])->name('user.cars.edit');
    Route::patch('cars/{car}', [CarController::class, 'update'])->name('user.cars.update');
// сообщения
    Route::get('messages', [MessageController::class, 'index'])->name('user.messages.index');
    Route::post('messages', [MessageController::class, 'store'])->name('user.messages.store');
    Route::post('messages/chat', [MessageController::class, 'store_chat'])->name('user.messages.store_chat');
    Route::get('messages/{dialog}', [MessageController::class, 'show'])->name('user.messages.show');
// профиль
    Route::get('profile', [ProfileController::class, 'index'])->name('user.profile.index');
    Route::get('profile/car/{car_id}', [CarController::class, 'select'])->name('user.profile.car.select');
    Route::post('profile/update', [ProfileController::class, 'update'])->name('user.profile.update');
});

Route::post('media', [MediaController::class, 'index'])->middleware('auth');
