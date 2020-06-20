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

Route::post('search', 'HomeController@search_product')->name('search');
Route::get('profile/{id}', 'HomeController@profile')->name('profile');
Route::get('profile/edit/{id}', 'HomeController@edit_profile')->name('edit_profile');
Route::PUT('profile/edit/{id}', 'HomeController@update_profile')->name('update_profile');