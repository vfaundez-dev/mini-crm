<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::get('/', [HomeController::class, 'index'])->name('home.index');

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard.index');


/*
|--------------------------------------------------------------------------
| CRM Routes
|--------------------------------------------------------------------------
*/

Route::resource('client', ClientController::class)->middleware('auth');
Route::resource('contact', ContactController::class)->middleware('auth');