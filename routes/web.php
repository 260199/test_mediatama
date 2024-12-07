<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TagController;
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

Route::get('/',[LayoutController::class,'index']);

Route::controller(LoginController::class)->group(function () {
    Route::get('login','index')->name('login');
    Route::post('login/proses','proses');
    Route::get('logout','logout');
});



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [LayoutController::class, 'dashboard']);
    
    Route::resources([
        'artikel' => ArtikelController::class,
        'tag' => TagController::class,
        'kategori' => KategoriController::class,
        'author' => AuthorController::class,
    ]);
});