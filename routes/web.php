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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/product/random', 'ProductController@random')->name('product.random');
Route::resource('/product', 'ProductController');

Route::get('/order/random', 'OrderController@random')->name('order.random');
Route::resource('/order', 'OrderController');

