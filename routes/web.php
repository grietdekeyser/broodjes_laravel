<?php

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

Auth::routes();

Route::get('/', 'PageController@index');
Route::get('/order', 'PageController@order');
Route::get('/clear', 'PageController@clear');
Route::post('/order', 'PageController@store');
Route::get('/overview', 'PageController@overview');
Route::post('/overview', 'SandwichController@store');


/* 
 * controleren: uit session na store to db?????
 * controleren knop leeg winkelmandje
 */
