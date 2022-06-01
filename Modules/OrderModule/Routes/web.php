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

Route::middleware('auth')->group(function() {
//    Route::get('/', 'OrderModuleController@index');
    Route::resource('orders','OrderController')->except( 'destroy');
    Route::get('orders-createq','OrderController@createQ')->name('orders.createQ');
    Route::post('orders-storeq','OrderController@storeQ')->name('orders.storeQ');

    Route::resource('customers', 'CustomerController')->except('show', 'edit', 'create');
    Route::get('get-customer-data/{customer}', 'CustomerController@getData')->name('get.customer_data');

    Route::get('get-customers-select2', 'OrderController@getCustomersSelect2')->name('get.customers.select2');
    Route::get('get-supervisors-select2', 'OrderController@getSupervisorsSelect2')->name('get.supervisors.select2');
    Route::get('get-drivers-select2', 'OrderController@getDriversSelect2')->name('get.drivers.select2');


    Route::get('get-clients-select2', 'OrderController@getClientsSelect2')->name('get.clients.select2');
    Route::get('orders/get-client-data/{id}','OrderController@getClientData');
    Route::get('orders/get-client-address/{id}','OrderController@getClientAddress');
    Route::get('orders/driver-approve/{order}', 'OrderController@driverApprove');
    Route::get('orders/new-driver-refuse/{order}', 'OrderController@newDriverRefuse');

    Route::post('orders/change-driver/{order}', 'OrderController@changeDriver')->name('order.change.driver');
    Route::post('orders/change-status/{order}', 'OrderController@changeStatus')->name('order.change.status');
    Route::post('orders/assign-multiple-drivers/{order}', 'OrderController@assignMultipleDrivers')->name('order.assign.multiple.driver');
    Route::post('orders/edit-fees-calculation/{order}', 'OrderController@editFeesCalculation')->name('order.edit_fees_calculation');
    Route::post('orders/send-to-another-supervisor/{order}', 'OrderController@SendToAnotherSupervisor')->name('order.send_to_another_supervisor');

    Route::get('orders/supervisor-approve/{order}', 'OrderController@supervisorApprove')->name('order.supervisor_approve');
    Route::get('orders/supervisor-refuse/{order}', 'OrderController@supervisorRefuse')->name('order.supervisor_refuse');
});
