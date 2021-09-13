<?php

use App\Http\Controllers\ApiControllers\ApiAuth\AuthApiController;
use App\Http\Controllers\ApiControllers\UserController;
use App\Http\Controllers\ApiControllers\UserFavorito;
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


Route::post('requestToken', [AuthApiController::class, 'requestToken']);
Route::post('requestTokenGoogle', [AuthApiController::class, 'requestTokenGoogle']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('logout', [AuthApiController::class, 'logout']);

    //user
    Route::post("user/{user}/telefono", [UserController::class, 'saveTelefono']);
    Route::get("user", [UserController::class, 'getUser']);
    Route::post("user", [UserController::class, 'updateUser']);
    //end user
    // anuncios detail
    Route::get('anunciosdetails', 'ApiControllers\UserAnuncioController@getAnuncioDetail')->name('user.anuncio.detail');
    //Route::get('anunciosdetailsdestacado', 'ApiControllers\UserAnuncioController@getAnuncioDetail')->name('user.anuncio.detail');
    //anuncios

    //add favorito
    Route::get("favorito/{anuncio}", [UserFavorito::class, 'addFavorito'])->name("add.favorito.anuncio");
    Route::delete("favorito/{anuncio}", [UserFavorito::class, 'deleteFavorito'])->name("delete.favorito.anuncio");
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




//destacados


Route::get('destacados', 'ApiControllers\DestacadoAnuncioController@index')->name('destacado.anuncio.detail');

//anuncios de una categoria
Route::get('categorias/{categoria}/anuncios', 'ApiControllers\CategoriaAnuncioController@anuncioOfTheCategoria')->name('anuncio.categoria.detail');
Route::get('anuncioswithdestacado/', 'ApiControllers\CategoriaAnuncioController@anuncioOrderByDestacadoFirst')->name('anuncio.orderby.destacados');
