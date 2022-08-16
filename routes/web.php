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
/*404*/
Route::any('/404.html', 'PageController@not_found');

Route::get('/','HomeController@index');
/*Post*/
Route::get('/{slug}-p{id}.html','PostController@index')->where(['slug' => '[\s\S]+','id' => '[0-9]+']);
/*Category*/
Route::get('/collections/all','CategoryController@index')->where(['slug' => '[\s\S]+','id' => '[0-9]+']);

