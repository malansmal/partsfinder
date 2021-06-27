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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::group(['middleware' => 'web'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/findme', 'HomeController@findMe')->name('findme');
    Route::get('/myPart/{id}', 'HomeController@myPart')->name('myPart');
    Route::get('/sendQuote/{id}/{quote}', 'HomeController@sendQuote')->name('sendQuote');
    Route::post('/insertQuote', ['as' => 'insertQuote',    'uses' => 'HomeController@insertQuote']);
    Route::post('/order', ['as' => 'insertOrder',    'uses' => 'HomeController@order']);

    Route::group(array('prefix' => 'admin'), function(){
        Route::get('/', 'AdminController@index');
        Route::post('/viewQuote', 'AdminController@viewQuote');
        Route::post('/viewSupplier', 'AdminController@viewSupplier');
    });
});


