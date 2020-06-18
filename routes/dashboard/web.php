<?php

use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->name('dashboard.')->middleware(['auth','role:super_admin|admin'])->group(function () {

    Route::get('/', 'WelcomeController@index')->name('welcome');

    //category routes
    Route::resource('categories', 'CategoryController')->except(['show']);

    //product routes
    Route::resource('products', 'ProductController')->except(['show']);

    //client routes
    Route::resource('clients', 'ClientController')->except(['show']);
    Route::resource('clients.orders', 'Client\OrderController')->except(['show']);

    //order routes
    Route::resource('orders', 'OrderController');
    Route::get('/orders/{order}/products', 'OrderController@products')->name('orders.products');


    //user routes
    Route::resource('users', 'UserController')->except(['show']);

});//end of dashboard routes


