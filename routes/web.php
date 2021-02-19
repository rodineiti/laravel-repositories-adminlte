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

    /* Tests questions*/
    Route::any('institutions/search', 'InstitutionController@search')->name('institutions.search');
    Route::resource('institutions', 'InstitutionController')->middleware("can:pages-crud");

    Route::any('units/search', 'TeachingUnitController@search')->name('units.search');
    Route::resource('units', 'TeachingUnitController')->middleware("can:pages-crud");

    Route::any('offertypes/search', 'OfferTypeController@search')->name('offertypes.search');
    Route::resource('offertypes', 'OfferTypeController')->middleware("can:pages-crud");

    Route::any('disciplines/search', 'DisciplineController@search')->name('disciplines.search');
    Route::resource('disciplines', 'DisciplineController')->middleware("can:pages-crud");

    Route::any('subjects/search', 'SubjectController@search')->name('subjects.search');
    Route::resource('subjects', 'SubjectController')->middleware("can:pages-crud");

    Route::any('images/search', 'ImageController@search')->name('images.search');
    Route::resource('images', 'ImageController')->middleware("can:pages-crud");

    Route::any('tests/search', 'TestController@search')->name('tests.search');
    Route::resource('tests', 'TestController')->middleware("can:pages-crud");

    /**
     * Crud questions Test
    **/
    Route::get('tests/{test_id}/question/create', 'TestController@createQuestion')->name('tests.create.question');
    Route::post('tests/{test_id}/question/store', 'TestController@storeQuestion')->name('tests.store.question');
    Route::get('tests/{test_id}/question/{id}/edit', 'TestController@editQuestion')->name('tests.edit.question');
    Route::put('tests/{test_id}/question/{id}/update', 'TestController@updateQuestion')->name('tests.update.question');
    Route::delete('tests/{test_id}/question/{id}/destroy', 'TestController@destroyQuestion')->name('tests.destroy.question');
});

Auth::routes();

Route::get('/', 'HomeController@index');

Route::fallback('PagesController@index');
