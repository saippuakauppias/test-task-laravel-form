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

Route::get('/', 'IndexController@show')->name('index_show');

Route::get('/clients', 'ClientsController@index')->name('clients_index');

Route::get('/orders', 'OrdersController@index')->name('orders_index');
Route::post('/orders/store', 'OrdersController@store')->name('orders_store');

Route::get('/adv/show1', 'AdvancedController@show1')->name('advanced_show1');
Route::get('/adv/show2', 'AdvancedController@show2')->name('advanced_show2');
Route::get('/adv/show3', 'AdvancedController@show3')->name('advanced_show3');
