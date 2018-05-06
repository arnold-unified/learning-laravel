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

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', 'UsersController@index')->name('list');
        Route::get('create', 'UsersController@create')->name('create');
        Route::post('/', 'UsersController@store')->name('store');
        Route::get('{user}', 'UsersController@edit')->name('edit');
        Route::put('{user}', 'UsersController@update')->name('update');
        Route::delete('{user}', 'UsersController@destroy')->name('destroy');
    });

    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', 'RolesController@index')->name('list');
        Route::get('create', 'RolesController@create')->name('create');
        Route::post('/', 'RolesController@store')->name('store');
        Route::get('{role}', 'RolesController@edit')->name('edit');
        Route::put('{role}', 'RolesController@update')->name('update');
        Route::delete('{role}', 'RolesController@destroy')->name('destroy');
    });

    Route::prefix('permissions')->name('permissions.')->group(function () {
        Route::get('/', 'PermissionsController@index')->name('list');
        Route::get('create', 'PermissionsController@create')->name('create');
        Route::post('/', 'PermissionsController@store')->name('store');
        Route::get('{permission}', 'PermissionsController@edit')->name('edit');
        Route::put('{permission}', 'PermissionsController@update')->name('update');
        Route::delete('{permission}', 'PermissionsController@destroy')->name('destroy');
    });

    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/', 'AuthorsPostsController@index')->name('list');
        Route::get('create', 'AuthorsPostsController@create')->name('create');
        Route::post('/', 'AuthorsPostsController@store')->name('store');
        Route::get('{post}', 'AuthorsPostsController@edit')->name('edit');
        Route::put('{post}', 'AuthorsPostsController@update')->name('update');
        Route::delete('{post}', 'AuthorsPostsController@destroy')->name('destroy');
    });
});
