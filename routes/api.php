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
Route::resource('buyers.transactions', 'BuyerTransactionController', ['only' => ['index']]);
Route::resource('buyers.products', 'BuyerProductController', ['only' => ['index']]);
Route::resource('buyers.sellers', 'BuyerSellerController', ['only' => ['index']]);
Route::resource('buyers.categories', 'BuyerCategoryController', ['only' => ['index']]);

Route::resource('categories', 'CategoryController', ['except' => ['create', 'edit']]);
Route::resource('categories.products', 'CategoryProductController', ['only' => ['index']]);
Route::resource('categories.sellers', 'CategorySellerController', ['only' => ['index']]);
Route::resource('categories.transactions', 'CategoryTransactionController', ['only' => ['index']]);
Route::resource('categories.buyers', 'CategoryBuyerController', ['only' => ['index']]);

Route::resource('products', 'ProductController', ['only' => ['index', 'show']]);

Route::resource('sellers', 'SellerController', ['only' => ['index', 'show']]);
Route::resource('sellers.transactions', 'SellerTransactionController', ['only' => ['index']]);
Route::resource('sellers.categories', 'SellerCategoryController', ['only' => ['index']]);
Route::resource('sellers.buyers', 'SellerBuyerController', ['only' => ['index']]);
Route::resource('sellers.products', 'SellerProductController', ['except' => ['create', 'edit', 'show']]);

Route::resource('transactions', 'TransactionController', ['only' => ['index', 'show']]);
Route::resource('transactions.categories', 'TransactionCategoryController', ['only' => ['index']]);
Route::resource('transactions.sellers', 'TransactionSellerController', ['only' => ['index']]);

Route::resource('users', 'UserController', ['except' => ['create', 'edit']]);
