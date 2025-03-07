<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\UserController;
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
Route::post('/opportunity/{opportunity}/close', [OpportunityController::class, 'close'])
      ->middleware('auth')->name('opportunity.close');
Route::resource('opportunity', OpportunityController::class)->middleware('auth');
Route::post('activity/{activity}/completed', [ActivityController::class, 'completed'])
      ->middleware('auth')->name('activity.completed');
Route::resource('activity', ActivityController::class)->middleware('auth');


/*
|--------------------------------------------------------------------------
| System Routes
|--------------------------------------------------------------------------
*/

Route::post('user/{user}/change-password', [Usercontroller::class, 'changePassword'])->middleware('auth')->name('user.change_password');
Route::resource('user', UserController::class)->middleware('auth');