<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function (){
    Route::get('/admin', 'AdminsController@index')->name('admin.index');
});


