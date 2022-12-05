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

Route::get('/', 'App\Http\Controllers\SubscriberController@index')->name('subscriber-index');    

Route::group(['prefix' => 'subscriber'], function(){
    Route::post('save', 'App\Http\Controllers\SubscriberController@store')->name('subscriber-store');    
});