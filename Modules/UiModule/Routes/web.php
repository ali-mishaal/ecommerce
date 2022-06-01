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


Route::get('/', 'UiModuleController@index');

Route::prefix('register')->group(function(){
    Route::get('/{type}', 'RegisterController@register')
        ->name('ui.register')
        ->where(['supervisor','client','driver']);

    Route::post('/do/supervisor','RegisterController@supervisorRegister')
        ->name('supervisor.register');
    Route::post('/do/client','RegisterController@clientRegister')
        ->name('client.register');
    Route::post('/do/driver','RegisterController@driverRegister')
        ->name('driver.register');
});
