<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PostController;

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

// Route::get('/', function () {
//     return view('frontend.home');
// });

Route::get('/about', function () {
    return view('frontend.about');
});

Route::get('/', [FrontendController::class, 'index'])->name('home');




Auth::routes();
Route::resource('post', PostController::class);
Route::resource('category', CategoryController::class);
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
