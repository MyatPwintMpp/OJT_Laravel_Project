<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('users.index');
});

Route::prefix('users')->controller(UserController::class)->name('users.')->group(function () {
    Route::get('create', 'create')->name('create');
    Route::post('store', 'store')->name('store');
    Route::get('detail/{id}', 'show')->name('detail');
    Route::get('index', 'index')->name('index');
    Route::post('delete/{id}', 'destroy')->name('delete');
    Route::get('edit/{id}', 'edit')->name('edit');
    Route::post('update', 'update')->name('update');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'create')->name('loginScreen');
    Route::post('login', 'authenticate')->name('login');
    Route::get('changePassword/{id}', 'changePassword')->name('changePasswordScreen');
    Route::post('changePassword', 'changePasswordStore')->name('changePassword');
    Route::get('forgot-password', 'forgotPassword')->name('password.request');
    Route::post('forgot-password', 'forgotPasswordEmail')->name('password.email');
    Route::get('reset-password/{token}', 'resetPassword')->name('password.reset');
    Route::post('reset-password', 'resetPasswordStore')->name('password.update');
});

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('posts')->controller(PostController::class)->name('posts.')->group(function () {
    Route::get('index', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::post('create', 'store')->name('store');
    Route::get('edit/{id}', 'edit')->name('edit');
    Route::post('edit', 'update')->name('update');
    Route::get('{id}', 'show')->name('show');
    Route::get('delete/{id}', 'destroy')->name('delete');
});
