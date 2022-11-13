<?php

use App\Http\Controllers\MainController;
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

Route::get('/', [MainController::class, 'index'])->name('homepage');
Route::post('/', [MainController::class, 'store'])->name('homestoreData');
Route::get('/delete', [MainController::class, 'destroy'])->name('homedeleteData');
Route::get('/removeItem/{key}', [MainController::class, 'removeItem'])->name('removeItem');
