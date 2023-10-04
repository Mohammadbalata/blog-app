<?php

use App\Http\Controllers\Dashboard\ArticlesController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\TagsController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;



Route::group([
    'middleware' => ['auth', 'verified'],
    'as' => 'dashboard.',
    'prefix' => 'dashboard',
], function () {


    Route::view('/', 'dashboard')->name('dashboard');

    Route::resource('/articles', ArticlesController::class)
    ->except('show');
    
    Route::resource('/categories', CategoriesController::class)
    ->middleware(['admin' => IsAdmin::class,]);

    Route::resource('/tags', TagsController::class)
    ->middleware(['admin' => IsAdmin::class,]);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
