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

    Route::prefix('users')->group(function () {
        Route::get('/', 'UsersController@index')->name('users.list');
        Route::get('create', 'UsersController@create')->name('users.create');
        Route::post('/', 'UsersController@store')->name('users.store');
        Route::get('{user}', 'UsersController@edit')->name('users.edit');
        Route::put('{user}', 'UsersController@update')->name('users.update');
    });

    Route::prefix('roles')->group(function () {
        Route::get('/', 'RolesController@index')->name('roles.list');
        Route::get('create', 'RolesController@create')->name('roles.create');
        Route::post('/', 'RolesController@store')->name('roles.store');
        Route::get('{role}', 'RolesController@edit')->name('roles.edit');
        Route::put('{role}', 'RolesController@update')->name('roles.update');
    });

    Route::prefix('permissions')->group(function () {
        Route::get('/', 'PermissionsController@index')->name('permissions.list');
        Route::get('create', 'PermissionsController@create')->name('permissions.create');
        Route::post('/', 'PermissionsController@store')->name('permissions.store');
        Route::get('{permission}', 'PermissionsController@edit')->name('permissions.edit');
        Route::put('{permission}', 'PermissionsController@update')->name('permissions.update');
    });
});
