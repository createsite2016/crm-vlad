<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get(
    'user/login',
    [LoginController::class, 'index']
)->name('page.user.login.index');