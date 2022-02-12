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

//Route::resource('cliente', 'App\Http\Controllers\ClienteController');
// Route::group(['prefix' => 'cliente'], function(){
//     Route::get('/',['as' => 'cliente.index', 'uses' => 'App\Http\Controllers\ClienteController@index']);
// });


//Rotas JWT
Route::post("login","App\Http\Controllers\AuthController@login");

//Rotas que necessitam de autenticação JWT
Route::group(['middleware' => 'jwt.auth', 'prefix' => 'v1'], function(){
    Route::apiResource('cliente', 'App\Http\Controllers\ClienteController');
    Route::apiResource('carro', 'App\Http\Controllers\CarroController');
    Route::apiResource('locacao', 'App\Http\Controllers\LocacaoController');
    Route::apiResource('marca', 'App\Http\Controllers\MarcaController');
    Route::apiResource('modelo', 'App\Http\Controllers\ModeloController');

    Route::post("/me","App\Http\Controllers\AuthController@me");
    Route::post("/refresh","App\Http\Controllers\AuthController@refresh");
});