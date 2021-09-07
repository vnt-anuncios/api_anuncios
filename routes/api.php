<?php

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

//social Acount

Route::get('login/{provider}', 'SocialAcountController@redirectToProvider')->name('redirectToProvider');
Route::get('login/{provider}/callback', 'SocialAcountController@handleProviderCallBack')->name('handleProviderCallBack');


//categorias credito
Route::get('categoriascredito', 'CreditoCategoriaController@categoriaCredito');

//user api
Route::apiResource('users', UserController::class, ['only' => ['show', 'index']]);

//categorias
Route::apiResource('categorias', CategoriaController::class, ['only' => ['index', 'show']]);

//anuncios
Route::apiResource('anuncios', AnuncioController::class, ['only' => ['index', 'show']]);

//photo de un anuncio
Route::apiResource('fotos', FotoController::class, ['only' => ['index', 'show', 'destroy']]);

//userFavoritos
Route::apiResource('users.favoritos', Favorito\UserFavoritoController::class, ['only' => ['index']]);
Route::delete('users/{user}/anuncios/{anuncio}/favoritos', 'Favorito\UserFavoritoController@destroy')->name('user.anuncios.favorito.destroy');
Route::apiResource('users.anuncios.favoritos', Favorito\UserFavoritoController::class, ['only' => ['store']]);
