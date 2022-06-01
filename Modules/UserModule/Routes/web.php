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


Route::get('login','UsersController@login')->name('login');
Route::post('login','UsersController@doLogin');
Route::middleware('auth')->group(function (){
//roles and permissions

    Route::resource('roles', 'RolesController')->except('show', 'destroy');
//    Route::get('roles','RolesController@index')->name('roles.index');
//    Route::get('roles/create','RolesController@create')->name('roles.create');
//    Route::post('roles','RolesController@store')->name('roles.store');
//    Route::get('roles/{role}/edit','RolesController@edit')->name('roles.edit');
//    Route::post('roles/{id}','RolesController@update')->name('roles.update');

    Route::resource('permissions', 'PermissionsController')->except('show', 'create', 'edit');
    Route::get('assign-permission/{role}/{permission}', 'PermissionsController@assign')->name('permission.assign');
//    Route::post('permission','PermissionsController@store')->name('permission');


//administrator routes

    Route::resource('admin', 'AdminsController')->only('index', 'show', 'store', 'destroy');
    Route::get('datatables/admin','AdminsController@datatables');

//supervisor routes
    Route::resource('supervisor', 'SupervisorsController')->except('create', 'edit', 'update');
    Route::get('datatables/supervisor','SupervisorsController@datatables');

    Route::get('user_addresses/{id}','AdminsController@userAddress');


//driver routes
    Route::resource('driver', 'DriversController')->except('create', 'edit', 'update');
    Route::get('datatables/driver','DriversController@datatables');


//clients routes
    Route::resource('client', 'ClientsController')->except('create', 'edit', 'update');
    Route::get('datatables/client','ClientsController@datatables');

    Route::post('set_user_account','UsersController@setUserAccount');

    Route::get('logout','UsersController@logout');
    Route::get('changeStatus/{id}','UsersController@changeStatus');
    Route::get('reigons/{id}','AdminsController@regions');
    Route::get('getreigons/{govern}/{region}','AdminsController@getreigons');
    Route::post('saveAddress','AdminsController@saveAddress');
    Route::get('deleteAddress/{id}','AdminsController@deleteAddress');

    Route::resource('governments', 'GovernmentController')->except(['create', 'edit', 'show']);
    Route::resource('regions', 'RegionController')->except(['create', 'edit', 'show']);

});
