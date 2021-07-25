<?php

use App\Http\Controllers\OrderController;
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

Route::get('/', function () {
    return view('index');
});

Route::get('/order-list', [OrderController::class, 'orderList']);
Route::get('/order/edit/{id}', ['as' => 'order.edit', 'uses' => 'OrderController@edit']);
Route::patch('/order/update/{id}', ['as' => 'order.update', 'uses' => 'OrderController@update']);
