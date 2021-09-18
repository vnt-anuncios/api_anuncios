<?php

use App\Http\Controllers\ApiControllers\ApiAuth\AuthApiController;
use App\Http\Controllers\ApiControllers\UserController;
use App\Http\Controllers\ApiControllers\UserFavorito;
use App\Http\Controllers\ApiControllers\CategoriaController;
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

    //favoritos
    Route::post("favoritos/{anuncio}", [UserFavorito::class, 'addFavorito'])->name("add.favorito.anuncio");
    Route::delete("favoritos/{anuncio}", [UserFavorito::class, 'deleteFavorito'])->name("delete.favorito.anuncio");
    Route::get("favoritos", [UserFavorito::class, 'getFavoritos'])->name("get.favoritos");
    //end favoritos

    //anuncios de una categoria
    Route::get('categoria/{categoria}/anuncios', 'ApiControllers\CategoriaAnuncioController@anunciosOfCategoria')->name('anuncios.categoria');

    //anuncios de una categoria
    Route::get('misanuncios', 'ApiControllers\UserAnuncioController@misAnuncios')->name('anuncios.categoria');
});
//categorias
Route::get("categorias", [CategoriaController::class, 'categorias'])->name("categorias");

/* OSWALDO ORELLANA*/
Route::apiResource('categoria', CategoriaController::class, ['only' => ['index', 'show']]);
Route::get('categoriascredito', 'CreditoCategoriaController@categoriaCredito');
//Route::apiResource('anuncios',AnuncioController::class,['only' => ['index','show']]);


//destacados
Route::get('destacados', 'ApiControllers\DestacadoAnuncioController@index')->name('destacado.anuncio.detail');

//anuncios de una categoria
Route::get('categorias/{categoria}/anuncios', 'ApiControllers\CategoriaAnuncioController@anuncioOfTheCategoria')->name('anuncio.categoria.detail');
Route::get('anuncioswithdestacado/', 'ApiControllers\CategoriaAnuncioController@anuncioOrderByDestacadoFirst')->name('anuncio.orderby.destacados');

/* OSWALDO ORELLANA*/
