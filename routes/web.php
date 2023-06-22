<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Models\Employee;
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
Route::get('/novosti/{news}', [App\Http\Controllers\NewsController::class, 'getNews'])->name('novost');

Route::get('/o-nas', [App\Http\Controllers\AboutUsController::class, 'index'])->name('o-nas');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('glavnaya');

Route::get('/distancionnoe-obuchenie', [App\Http\Controllers\ResourcesController::class, 'index'])->name('distance');


Route::get('/kontakti', function () {
    return view('contacts');
})->name('contacts');

Route::get('/raspisanie', function () {
    return response()->download(public_path('build/files/raspisanie.pdf'));
});


Route::group(['middleware' => ['guest']], function() {
    /**
     * Register Routes
     */
    Route::get('/login',  [App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/login',  [App\Http\Controllers\AuthController::class, 'auth'])->name('auth');

});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/admin-panel', [App\Http\Controllers\AdminController::class, 'index'])->name('admin-panel');
    Route::get('/get-db-columns', [App\Http\Controllers\AdminController::class, 'getColumns'])->name('getDbColumns');
    Route::get('/row', [App\Http\Controllers\AdminController::class, 'getRow'])->name('getRow');
    Route::post('/row', [App\Http\Controllers\AdminController::class, 'createRow'])->name('createRow');
    Route::put('/row', [App\Http\Controllers\AdminController::class, 'updateRow'])->name('updateRow');
    Route::delete('/row', [App\Http\Controllers\AdminController::class, 'removeRow'])->name('removeRow');
    Route::post('/upload-files', [App\Http\Controllers\AdminController::class, 'uploadFiles'])->name('uploadFiles');
    Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::get('/viewDb/{db}', [App\Http\Controllers\AdminController::class, 'viewDb'])->name('viewDb');

});
