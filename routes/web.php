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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/weather', 'WeatherController@index')->name('weather.index');
Route::resource('order', 'OrderController');
Route::get('product', 'ProductController@index')->name('product.index');
Route::post('product/update-price', 'ProductController@updatePrice')->name('product.update-price');
