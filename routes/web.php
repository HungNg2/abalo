<?php

use Illuminate\Support\Facades\Route;

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
Route::post('/articles', [
    App\Http\Controllers\ArtikelController::class,
    'store',
]);
Route::get('/articles', [
    App\Http\Controllers\ArtikelController::class,
    'getArticles',
]);
/*Route::post('/articlesapi',[
    \App\Http\Controllers\ArtikelController::class,
    'store_api',
]);
Route::get('/articlesapi', [
    App\Http\Controllers\ArtikelController::class,
    'search_api',
]);*/


/*Route::get('/articles', function () {
    return view('view');
});*/
Route::get('/newarticle', function () {
    return view('Artikeleingabe');
});
/*Route::get('/newarticleapi', function () {
    //für M3
    return view('Artikeleingabeapi');
});*/

Route::get('/debug/cookietest', function () {
    return view('cookietest');
});

Route::get('/debug/sessions', function () {
    return view('debugsessions');
});

Route::get('/3-ajax1-static', function () {
    return view('3-ajax1-static');
});
Route::get('/3-ajax2-periodic', function () {
    return view('3-ajax2-periodic');
});
