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

//company vehicles

Route::middleware('auth')->get('/dashboard','DashboardController@index');

Route::resource('vehicles', 'VehiclesController')->only('index', 'show', 'store', 'destroy');
Route::get('datatables/vehicles','VehiclesController@datatables');

Route::get('terms', 'TermsController@index')->name('terms.index');
Route::post('terms/store', 'TermsController@store')->name('terms.store');
Route::get('terms/show/{type}', 'TermsController@show')->name('terms.show');

Route::get('change-language/{locale}', function ($locale) {
    session()->put('lang', $locale);
//    return redirect()->back();
});

Route::get('toggle-language', function () {
    session()->put('lang', session()->get('lang') == 'en' ? 'ar' : 'en');
    return redirect()->back();
});

