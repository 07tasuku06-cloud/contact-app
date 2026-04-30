<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;

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

Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/store', [ContactController::class, 'store']);
Route::get('/thanks', [ContactController::class, 'thanks']);

Route::get('/admin', [ContactController::class, 'admin']);
Route::get('/search', [ContactController::class, 'search']);
Route::delete('/delete/{id}', [ContactController::class, 'destroy']);
Route::get('/reset', [ContactController::class, 'reset']);
Route::get('/export', [ContactController::class, 'export']);
Route::get('/admin/{id}', [ContactController::class, 'show']);
