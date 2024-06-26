<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Role;
use App\Http\Middleware\VerifyPostExists;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('users.index');
});

Route::prefix('users')->controller(UserController::class)->name('users.')->group(function () {
    Route::get('create', 'create')->name('create');
    Route::post('store', 'store')->name('store');
    Route::get('detail/{id}', 'show')->name('detail');
    Route::get('index', 'index')->name('index');
    Route::post('delete/{id}', 'destroy')->name('delete')->middleware([Role::class]);
    Route::get('edit/{id}', 'edit')->name('edit')->middleware([Role::class]);
    Route::post('update', 'update')->name('update')->middleware([Role::class]);
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
    Route::get('edit/{id}', 'edit')->name('edit')->middleware([Role::class]);
    Route::post('edit', 'update')->name('update')->middleware([Role::class]);
    Route::get('{id}', 'show')->name('show')->middleware([VerifyPostExists::class]);
    Route::post('delete/{id}', 'destroy')->name('delete')->middleware([Role::class]);
});

Route::controller(CommentController::class)->group(function () {
    Route::post('posts/comments', 'store')->name('comment.store');
    Route::post('comments/delete/{id}', 'destroy')->name('comments.delete');
    Route::get('comments/edit/{id}', 'edit')->name('comments.edit');
    Route::post('comments/update', 'update')->name('comments.update');
});

Route::prefix('admin')->controller(AdminController::class)->name('admin.')->group(function () {
    Route::get('file/csv', 'csvShow')->middleware(Admin::class)->name('file.csv.show');
    Route::get('file/csv/userTableDownload', 'userCsvDownload')->middleware(Admin::class)->name('file.csv.users.download');
    Route::post('file/csv/userCsvUpload', 'userCsvUpload')->name('file.csv.users.upload');
    Route::get('file/csv/postTableDownload', 'postCsvDownload')->middleware(Admin::class)->name('file.csv.posts.download');
    Route::post('file/csv/postCsvUpload', 'postCsvUpload')->name('file.csv.posts.upload');
});
