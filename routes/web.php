<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PostController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/game/{category_id}', [App\Http\Controllers\GameController::class, 'index']);
Route::get('/post/{category_id}', [App\Http\Controllers\PostController::class, 'index']);
Route::post('/post/{category_id}', [App\Http\Controllers\PostController::class, 'add']);
