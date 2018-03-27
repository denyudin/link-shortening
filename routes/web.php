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

Route::get('/', 'LinkController@index')->name('links');

Auth::routes();

Route::resource('links', 'LinkController', ['only' => [
    'index', 'create', 'store', 'destroy'
]]);


Route::get('/{short_url}', 'LinkController@go');
