<?php

use Illuminate\Http\Request;

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

/*to call one of these routes:
	{host}/trabbd/imoveis/public/api/{route}
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/administradora', 'AdministradoraController@index');
Route::get('/administradora/{query}', 'AdministradoraController@read');
Route::get('/administradora/erase/{query}', 'AdministradoraController@erase');
Route::post('/administradora/create', 'AdministradoraController@create');
Route::post('/administradora/updateField', 'AdministradoraController@updateField');

Route::get('/aluguel', 'AluguelController@index');
Route::get('/aluguel/{query}', 'AluguelController@read');
Route::get('/aluguel/erase/{query}', 'AluguelController@erase');
Route::post('/aluguel/create', 'AluguelController@create');
Route::post('/aluguel/updateField', 'AluguelController@updateField');

Route::get('/cliente', 'ClienteController@index')->name('cliente.index');
Route::get('/cliente/{query}', 'ClienteController@read');
Route::get('/cliente/erase/{query}', 'ClienteController@erase');
Route::post('/cliente/create', 'ClienteController@create');
Route::post('/cliente/updateField', 'ClienteController@updateField');

Route::get('/condominio', 'CondominioController@index');
Route::get('/condominio/{query}', 'CondominioController@read');
Route::get('/condominio/erase/{query}', 'CondominioController@erase');
Route::post('/condominio/create', 'CondominioController@create');
Route::post('/condominio/updateField', 'CondominioController@updateField');

Route::get('/endereco', 'EnderecoController@index');
Route::get('/endereco/{query}', 'EnderecoController@read');
Route::get('/endereco/erase/{query}', 'EnderecoController@erase');
Route::post('/endereco/create', 'EnderecoController@create');
Route::post('/endereco/updateField', 'EnderecoController@updateField');

Route::get('/posse', 'PosseController@index');
Route::get('/posse/{query}', 'PosseController@read');
Route::get('/posse/erase/{query}', 'PosseController@erase');
Route::post('/posse/create', 'PosseController@create');
Route::post('/posse/updateField', 'PosseController@updateField');

Route::get('/unidade', 'UnidadeController@index');
Route::get('/unidade/{query}', 'UnidadeController@read');
Route::get('/unidade/erase/{query}', 'UnidadeController@erase');
Route::post('/unidade/create', 'UnidadeController@create');
Route::post('/unidade/updateField', 'UnidadeController@updateField');