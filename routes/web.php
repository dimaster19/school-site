<?php

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
Route::get('/novosti/{{id}}', [App\Http\Controllers\NewsController::class, 'getNews'])->name('novosti');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/news', function () {
    return view('news');
});

Route::get('/aboutUs', function () {
    return view('aboutUs');
});


Route::get('/contacts', function () {
    return view('contacts');
});
Route::get('/distance-education', function () {
    return view('distance');
});




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
