<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'admin'])->group(function() {
    Route::resource('product', ProductController::class);
});
Route::middleware(['auth'])->group(function() {
    Route::resource('cart', CartController::class);
    Route::put('cart/{cart}/increment', [CartController::class, 'increment'])->name('cart.increment');
    Route::put('cart/{cart}/decrement', [CartController::class, 'decrement'])->name('cart.decrement');;
    Route::post('cart/checkout', [CartController::class, 'checkOut'])->name('cart.checkout');;
    Route::get('history', [HistoryController::class, 'index'])->name('history.index');;
});
