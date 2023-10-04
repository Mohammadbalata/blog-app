<?php

use App\Http\Controllers\Dashboard\ArticlesController;
use App\Models\Article;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $articles = Article::all();
    return view('home',compact('articles'));
});
Route::get('/articles/{article}', [ArticlesController::class,'show']);
Route::view('/about', 'about')->name('about');


require __DIR__.'/dashboard.php';

require __DIR__.'/auth.php';
