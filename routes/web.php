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

Route::get('/o-nas', [App\Http\Controllers\AboutUsController::class, 'index'])->name('o-nas');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('glavnaya');



Route::get('/distancionnoe-obuchenie', function () {
    return view('distance');
});

Route::get('/uchebniy-proces', function () {
    return view('study');
});

Route::get('/kontakti', function () {
    return view('contacts');
});

Route::get('/raspisanie', function () {
    return response()->download(public_path('build/files/raspisanie.pdf'));
});


Route::group(['middleware' => ['guest']], function() {
    /**
     * Register Routes
     */
    Route::get('/login',  [App\Http\Controllers\AuthController::class, 'login'])->name('register.show');
    Route::post('/login',  [App\Http\Controllers\AuthController::class, 'auth'])->name('register.perform');

});

Route::group(['middleware' => ['auth']], function() {

    Route::get('/logout',  [LogoutController::class, 'perform'])->name('logout.perform');
    Route::get('/admin-panel', [App\Http\Controllers\AdminController::class, 'index'])->name('admin-panel');

    Route::get('/profile', [ProfileController::class, 'load'])->name('profile.show');
    Route::post('/profile',  [LoginController::class, 'login1'])->name('login.perform1');
    Route::get('/adminpanel',  [AdminPanelController::class, 'load'])->name('admin-panel');
    Route::get('/getdbdata',  [AdminPanelController::class, 'getColumns'])->name('getdbdata');
    Route::get('/adminpanel/{db}',  [AdminPanelController::class, 'getData'])->name('getdb');
    Route::get('/updatedata',  [AdminPanelController::class, 'getUpdateData'])->name('getUpdateData');
    Route::post('/adminaction',  [AdminPanelController::class, 'adminAction'])->name('adminaction');
    Route::post('/carousel',  [AdminPanelController::class, 'editCarousel'])->name('editCarousel');
    Route::post('/filesupload',  [AdminPanelController::class, 'uploadFiles'])->name('filesupload');

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
