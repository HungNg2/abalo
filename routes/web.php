<?php

use Illuminate\Support\Facades\Route;

/** Route for M1
 */

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [
    App\Http\Controllers\AuthController::class,
    'login',
])->name('login');
Route::get('/logout', [
    App\Http\Controllers\AuthController::class,
    'logout',
])->name('logout');
Route::get('/isloggedin', [
    App\Http\Controllers\AuthController::class,
    'isloggedin',
])->name('haslogin');

Route::get('/articles', [
    App\Http\Controllers\ArtikelController::class,
    'getArticles',
]);

/** Route for M2
*/

Route::get('/newarticle', function () {
    return view('Artikeleingabe');
});

Route::post('/articles', [
    App\Http\Controllers\ArtikelController::class,
    'store',
]);
Route::get('/debug/cookietest', function () {
    return view('cookietest');
});

Route::get('/debug/sessions', function () {
    return view('debugsessions');
});


/** Route for M3
*/

Route::get('/3-ajax1-static', function () {
    return view('3-ajax1-static');
});
Route::get('/3-ajax2-periodic', function () {
    return view('3-ajax2-periodic');
});

Route::get('/articlesapi', [
    App\Http\Controllers\ArtikelController::class,
    'search_api',
]);

Route::get('/newarticleapi', function () {
    return view('Artikeleingabeapi');
});

Route::post('/articlesapi',[
    App\Http\Controllers\ArtikelController::class,
    'store_api',
]);

