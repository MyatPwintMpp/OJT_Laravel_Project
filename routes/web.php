<?php

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
    Route::get('delete/{id}', 'destroy')->name('delete');
    Route::get('edit/{id}', 'edit')->name('edit');
    Route::post('update', 'update')->name('update');
});
