<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Frontend\SiteController;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

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
Route::get('/post/{slug}', [SiteController::class, 'singlepost'])->name('post');

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
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Category Routes
    Route::prefix('category')->name('category.')->group(function(){
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('destroy');
    });

    //Post Routes
    Route::prefix('post')->name('post.')->group(function(){
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/store', [PostController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PostController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [PostController::class, 'update'])->name('update');
        Route::delete('/{id}', [PostController::class, 'destroy'])->name('destroy');
    });
});
