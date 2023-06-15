<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**API Route for M3
 * */
Route::get('/articles',[\App\Http\Controllers\ArtikelController::class ,'search_api']);
Route::Post('/articles',[\App\Http\Controllers\ArtikelController::class ,'store_api']);
Route::get('/articles2',[\App\Http\Controllers\ArtikelController::class ,'search_offset']);

Route::Delete('/articles/{id}', [\App\Http\Controllers\ArtikelController::class ,'delete_api']);
Route::Post('/articles/{id}/sold',[\App\Http\Controllers\ArtikelController::class ,'sold_api']);

Route::post('/shoppingcart', [App\Http\Controllers\APIShoppingCartController::class, '_apiAddToCart',]);

Route::delete('/shoppingcart/2/articles/{articleId}',
    [App\Http\Controllers\APIShoppingCartController::class, '_apiRemoveFromCart',]);
Route::Post('/articles/{id}/sold',[\App\Http\Controllers\ArtikelController::class ,'sold_api']);

Route::Post('/articles/{id}/makeoffer', [\App\Http\Controllers\ArtikelController::class, 'makeOffer']);

