<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'PessoaController@index');
Route::get('/pessoas/index', 'PessoaController@index')->name('pessoas.index');

Route::get('/pessoas/edit', 'PessoaController@edit')->name('pessoas.edit');
Route::get('/pessoas/show', 'PessoaController@show')->name('pessoas.show');

Route::post('/pessoas/store', 'PessoaController@store')->name('pessoas.create');
Route::put('/pessoas/{id}/update', 'PessoaController@update')->name('pessoas.update');

// Route::get('/pessoas/remove/{id}', 'PessoaController@remover')->name('pessoas.remove');

Route::delete('/pessoas/{id}/destroy', 'PessoaController@destroy')->name('pessoas.remover');
// Route::resource('pessoas', 'PessoaController');
