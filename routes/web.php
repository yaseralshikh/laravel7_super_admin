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

Route::get('/dashboard', function () {
    return redirect()->route('dashboard.welcome');
});

Auth::routes();
//Auth::routes(['register' => false]);

Route::get('/{id?}', 'HomeController@index')->name('home');

Route::get('product/{id}', 'HomeController@show')->name('show_product');

Route::post('search', 'HomeController@search_product')->name('search');
Route::get('profile/{id}', 'HomeController@profile')->name('profile');
Route::get('profile/edit/{id}', 'HomeController@edit_profile')->name('edit_profile');
Route::PUT('profile/edit/{id}', 'HomeController@update_profile')->name('update_profile');

Route::prefix('cart')->name('cart.')->middleware(['auth'])->group(function () {

    Route::get('/addToCart/{product}', 'CartController@addToCart')->name('add');
    Route::get('/shopping-cart', 'CartController@index')->name('show');
    Route::delete('/remove/{product}', 'CartController@destroy')->name('remove');
    Route::PUT('/update/{product}', 'CartController@update')->name('update');
    Route::post('client/{client}/orders', 'CartController@store')->name('store');
    Route::get('client/{client}/orders', 'CartController@client_orders')->name('client_orders');
    Route::get('order/{order}/invoice', 'CartController@invoice')->name('invoice');

});//end of dashboard routes