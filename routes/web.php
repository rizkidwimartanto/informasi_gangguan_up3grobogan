<?php

use App\Http\Controllers\DataGangguanController;
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

Route::controller(DataGangguanController::class)->group(function () {
    Route::get('/', 'index')->name('data-gangguan.index');
    Route::get('/create', 'create')->name('data-gangguan.create');
    Route::post('/', 'store')->name('data-gangguan.store');
    Route::get('/{id}', 'show')->name('data-gangguan.show');
    Route::get('/{id}/edit', 'edit')->name('data-gangguan.edit');
    Route::put('/{id}', 'update')->name('data-gangguan.update');
    Route::delete('/data-gangguan/{id}', 'destroy')->name('data-gangguan.destroy');
});