<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('welcome');});
Route::get('/login', [App\Http\Controllers\AuthController::class, 'login',])->name('login');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout',])->name('logout');
Route::get('/isloggedin', [App\Http\Controllers\AuthController::class, 'isloggedin',])->name('haslogin');
Route::post('/articles', [App\Http\Controllers\ArtikelController::class, 'store',]);
Route::get('/articles', [App\Http\Controllers\ArtikelController::class, 'SearchArticle',]);

/*Route::get('/articles', function () { return view('view');});*/

Route::get('/newarticle', function () {return view('Artikeleingabe');});

Route::get('/debug/cookietest', function () {return view('cookietest');});

Route::get('/debug/sessions', function () {return view('debugsessions');});


/** Route for M3
*/

Route::get('/3-ajax1-static', function () {
    return view('3-ajax1-static');
});
Route::get('/3-ajax2-periodic', function () {
    return view('3-ajax2-periodic');
});

/** Route for M4
*/

Route::get('/newsite', function () {
    return view('Homepage');
});

