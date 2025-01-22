<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home.index');

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard.index');

