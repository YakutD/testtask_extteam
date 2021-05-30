<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EntryController;

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

Route::get('/', [EntryController::class, 'index'])->name('home');

Route::prefix('entry')->group(function () {
    Route::post('/add', [EntryController::class, 'store'])->name('add entry');
    Route::middleware(['auth'])->group(function () {
        Route::get('/edit/{id}', [EntryController::class, 'edit'])->name('edit entry');
        Route::get('/delete/{id}', [EntryController::class, 'delete'])->name('delete entry');
        Route::post('/update/{id}', [EntryController::class, 'update'])->name('update entry');
    });
});

Auth::routes();
Route::get('register', function(){
    abort(404);
})->name('register');
Route::post('register', function(){
    abort(404);
});

Route::get('admin', [AdminController::class, 'index'])->name('admin');
