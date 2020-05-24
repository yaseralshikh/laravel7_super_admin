<?php

Route::prefix('dashboard')->name('dashboard.')->group(function(){
    Route::get('/', 'DashboardController@index')->name('index');
});


