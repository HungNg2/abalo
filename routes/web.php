<?php
use App\Http\Controllers\AbTestDataController;
use App\Http\Controllers\ArticlesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('/isloggedin', [App\Http\Controllers\AuthController::class, 'isloggedin'])->name('haslogin');

Route::get('/testdata', [App\Http\Controllers\AbTestDataController::class, 'get_testdata'])->name('test');
Route::get("/articles", [App\Http\Controllers\ArticlesController::class, 'search'])->name("articleSearch");
