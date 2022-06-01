<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/driver-vehicle', function () {
    return view('driver-vehicle');
});
Route::get('/transfer-vehicle', function () {
    return view('transfer-vehicle');
});
