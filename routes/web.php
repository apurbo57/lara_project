<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Frontend\SiteController;
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

Route::get('/', [SiteController::class, 'index'])->name('index');
Route::get('/post', [SiteController::class, 'singlepost']);

//user register login routes
Route::prefix('user')->name('user.')->group(function(){
    Route::get('/login', [SiteController::class, 'userLoginform'])->name('login-form');
    Route::post('/login', [SiteController::class, 'userLogin'])->name('login');
    Route::get('/logout', [SiteController::class, 'userLogout'])->name('logout');
    Route::get('/register', [SiteController::class, 'userRegisterform'])->name('register');
    Route::post('/register', [SiteController::class, 'userRegistration'])->name('registration');
});

//admin dashboard 
Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});
