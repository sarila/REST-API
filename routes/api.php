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


//Routes related Categories
Route::resource('categories', 'CategoryController', ['except' => ['create', 'edit']]);
Route::resource('categories.products', 'CategoryProductController', ['only' => ['index']]);
Route::resource('categories.sellers', 'CategorySellerController', ['only' => ['index']]);
Route::resource('categories.transactions', 'CategoryTransactionController', ['only' => ['index']]);
Route::resource('categories.buyers', 'CategoryBuyerController', ['only' => ['index']]);


//Routes related Product
Route::resource('products', 'ProductController', ['only' => ['index', 'show']]);
Route::resource('products.transactions', 'ProductTransactionController', ['only' => ['index']]);
Route::resource('products.buyers', 'ProductBuyerController', ['only' => ['index']]);
Route::resource('products.categories', 'ProductCategoryController', ['only' => ['index', 'destroy', 'update']]);

//Create transactions with product and  buyer 
Route::resource('products.buyers.transactions', 'ProductBuyerTransactionController', ['only' => ['store']]);


//Routes related Seller
Route::resource('sellers', 'SellerController', ['only' => ['index', 'show']]);
Route::resource('sellers.transactions', 'SellerTransactionController', ['only' => ['index']]);
Route::resource('sellers.categories', 'SellerCategoryController', ['only' => ['index']]);
Route::resource('sellers.buyers', 'SellerBuyerController', ['only' => ['index']]);
Route::resource('sellers.products', 'SellerProductController', ['except' => ['create', 'edit', 'show']]);


//Routes related Transactions
Route::resource('transactions', 'TransactionController', ['only' => ['index', 'show']]);
Route::resource('transactions.categories', 'TransactionCategoryController', ['only' => ['index']]);
Route::resource('transactions.sellers', 'TransactionSellerController', ['only' => ['index']]);


//Routes for user
Route::name('me')->get('users/me', 'UserController@me');
Route::resource('users', 'UserController', ['except' => ['create', 'edit']]);
Route::name('verify')->get('users/verify/{token}', 'UserController@verify');
Route::name('resend')->get('users/{user}/resend', 'UserController@resend');

//Routes added for laravel Passport
Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');

