<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('categorias', CategoriaController::class, ['only' => ['index', 'show']]);
Route::get('categoriascredito', 'CreditoCategoriaController@categoriaCredito');
//Route::apiResource('anuncios',AnuncioController::class,['only' => ['index','show']]);

//response anuncios
//Route::apiResource('anuncios', 'ApiControllers\AnuncioController')->only(['index', 'show']);

///anuncio details
Route::get('anuncios/{anuncio}/user', 'ApiControllers\AnuncioDetailController@getAnuncioUser')->name('anuncio.user');
Route::get('anuncios/{anuncio}/categoria', 'ApiControllers\AnuncioDetailController@getAnuncioCategoria')->name('anuncio.categoria');
Route::get('anuncios/{anuncio}/destacado', 'ApiControllers\AnuncioDetailController@getAnuncioDestacado')->name('anuncio.destacado');

Route::get('anuncios/{anuncio}/fotos', 'ApiControllers\AnuncioDetailController@getAnuncioFotos')->name('anuncio.fotos');

//user anuncio favorito
Route::get('anuncios/{anuncio}/user/{user}/isfavorito', 'ApiControllers\UserAnuncioController@isAnuncioFavorito')->name('user.isFavorito');
Route::get('anuncios', 'ApiControllers\UserAnuncioController@getAnuncioDetail2')->name('anuncio.detail');
Route::get('anuncios/user/{user}/detail', 'ApiControllers\UserAnuncioController@getAnuncioDetail')->name('user.anuncio.detail');
