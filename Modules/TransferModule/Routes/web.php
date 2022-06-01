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

Route::middleware('auth')->group(function (){


    Route::resource('brands', 'BrandController')->only('index', 'show', 'store', 'destroy');
    Route::get('datatables/brands','BrandController@datatables');

    Route::resource('vehicle-types', 'VehicleTypeController')->only('index', 'show', 'store', 'destroy');
    Route::get('datatables/VehiclesType','VehicleTypeController@datatables');
    Route::get('VehiclesType/changeVehicle/{id}/{vehicle?}','VehicleTypeController@changeVehicle');



    Route::get('driver-vehicles', 'DriverVehicleController@index')->name('driver_vehicles.index');

    Route::resource('attach-vehicle', 'AttachVehicleController')->only('index', 'store');
    Route::get('get-attached-vehicle-data/{id}', 'AttachVehicleController@getData');
    Route::post('approve-attached-vehicle/{id}', 'AttachVehicleController@approve');
    Route::post('revert-attached-vehicle/{id}', 'AttachVehicleController@revert');

    Route::resource('transfer-vehicle', 'TransferVehicleController')->only('index', 'store');
    Route::get('get-transferred-vehicle-data/{id}', 'TransferVehicleController@getData');
    Route::post('approve-transferred-vehicle/{id}', 'TransferVehicleController@approve');
    Route::post('revert-transferred-vehicle/{id}', 'TransferVehicleController@revert');

    Route::get('get-drive-except/{id}', 'TransferVehicleController@getDriversExcept');

});
