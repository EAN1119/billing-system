<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Order;
use App\Models\Invoice;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('accounts', 'App\Http\Controllers\AccountsController'); //shortcut for pages instead of listing every route  //will auto map routes
Route::resource('orders', 'App\Http\Controllers\OrdersController');
Route::resource('invoices', 'App\Http\Controllers\InvoicesController');

Route::post('/accounts/search', 'App\Http\Controllers\AccountsController@search');
Route::post('/orders/search', 'App\Http\Controllers\OrdersController@search');
Route::post('/invoices/search', 'App\Http\Controllers\InvoicesController@search');

