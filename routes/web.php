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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'ProductController@index')->name('home');
    Route::resource('/products', 'ProductController');
    Route::resource('/brands', 'BrandController')->middleware('Admin');
    Route::get('/product/search', 'ProductController@search')->name('products.search');
});






