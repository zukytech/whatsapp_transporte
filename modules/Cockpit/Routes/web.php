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



Route::group([
    'middleware' =>[ 'web','impersonate'],
    'namespace' => 'Modules\Cockpit\Http\Controllers'
], function () {
    Route::prefix('cockpit')->group(function() { 
        Route::get('/orders', 'Main@index')->name('cockpit.index');
        Route::get('/test', 'Main@create')->name('cockpit.test');
    });
    Route::get('/findtaxi', 'Main@findtaxi')->name('cockpit.findtaxi');
    Route::get('/p/{md}', 'Main@pickup')->name('cockpit.pickup');
    Route::get('/d/{md}', 'Main@directions')->name('cockpit.directions');
    Route::get('/l/{md}', 'Main@live')->name('cockpit.live');
    Route::get('/ll/{md}', 'Main@livelocationapi')->name('cockpit.liveapi');
});
