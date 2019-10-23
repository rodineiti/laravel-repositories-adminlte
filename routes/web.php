<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth']], function() {
    Route::any('categories/search', 'CategoryController@search')->name('categories.search');
	Route::resource('categories', 'CategoryController');
	Route::any('products/search', 'ProductController@search')->name('products.search');
	Route::resource('products', 'ProductController');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');