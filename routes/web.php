<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NewslatterController;
use App\Http\Controllers\AdminController;

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

Route::post('newslatterUser', [NewslatterController::class, 'regsiterUser']);
Route::get('unsubscribe/{userId}', [NewslatterController::class, 'unsubscribe']);

Route::get('admin', [AdminController::class, 'index']);
Route::post('adminLogin', [AdminController::class, 'adminLogin']);
Route::get('logout', [AdminController::class, 'logout']);
Route::post('newPost', [AdminController::class, 'post']);
