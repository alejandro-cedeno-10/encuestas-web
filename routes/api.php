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


Route::post('/encuesta', 'EncuestaController@store');
Route::get('/encuesta', 'EncuestaController@index');

Route::get('/encuesta-download-excel', 'EncuestaController@downloadExcel')->name('excel.encuesta');

Route::get('/encuesta-q1-name', 'EncuestaController@getCountByName');
Route::get('/encuesta-q2-genero', 'EncuestaController@getCountByGenero');
Route::get('/encuesta-q3-hobby', 'EncuestaController@getCountByHobby');
Route::get('/encuesta-q4-dedicacion', 'EncuestaController@getCountByDedicacion');