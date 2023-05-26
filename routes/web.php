<?php

use App\Models\Employee;
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

// СДЕЛАТЬ РОУТЫ РУССКИМ ТРАНСЛИТОМ


Route::get('/novosti', [App\Http\Controllers\NewsController::class, 'index'])->name('novosti');
Route::get('/novosti/{name}', [App\Http\Controllers\NewsController::class, 'getNews'])->name('novosti');

Route::get('/o-nas', [App\Http\Controllers\NewsController::class, 'getNews'])->name('o-nas');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('glavnaya');



Route::get('/o-nas', function () {
    return view('aboutUs');
});


Route::get('/contacts', function () {
    return view('contacts');
});
Route::get('/distance-education', function () {
    return view('distance');
});




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
