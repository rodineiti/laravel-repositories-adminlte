<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth']], function() {

    Route::get('/home', 'HomeController@index')->name('admin.home');
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::post('/profile', 'ProfileController@update')->name('profile.update');

    Route::any('categories/search', 'CategoryController@search')->name('categories.search');
	Route::resource('categories', 'CategoryController');
	Route::any('products/search', 'ProductController@search')->name('products.search');
	Route::resource('products', 'ProductController');
    Route::any('users/search', 'UsersController@search')->name('users.search');
    Route::resource('users', 'UsersController')->middleware("can:users-crud");
    Route::any('pages/search', 'PagesController@search')->name('pages.search');
    Route::resource('pages', 'PagesController')->middleware("can:pages-crud");
    Route::any('subpages/search', 'SubPagesController@search')->name('subpages.search');
    Route::resource('subpages', 'SubPagesController')->middleware("can:pages-crud");

    Route::get('/settings', 'SettingsController@index')->name('settings.index');
    Route::post('/settings', 'SettingsController@update')->name('settings.update');
});

Auth::routes();

Route::get('/', 'HomeController@index');

Route::fallback('PagesController@index');
