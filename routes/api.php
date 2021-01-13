<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Restricts buyer to only two methods index and show
Route::resource('buyers', 'BuyerController', ['only' => ['index', 'show']]);

Route::resource('categories', 'CategoryController', ['except' => ['create', 'edit']]);

Route::resource('products', 'ProductController', ['only' => ['index', 'show']]);

Route::resource('sellers', 'SellerController', ['only' => ['index', 'show']]);

Route::resource('transactions', 'TransactionController', ['only' => ['index', 'show']]);

Route::resource('users', 'userController', ['except' => ['create', 'edit']]);
