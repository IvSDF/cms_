<?php

use Illuminate\Support\Facades\Route;

Route::get('/roles', 'RoleController@index')->name('role.index');

Route::post('/roles', 'RoleController@store')->name('role.store');

Route::get('/roles/{role}/edit', 'RoleController@edit')->name('role.edit');
Route::put('/roles/{role}/update', 'RoleController@update')->name('role.update');

Route::delete('/roles/{role}/destroy', 'RoleController@destroy')->name('role.destroy');

Route::put('/roles/{role}/attach', 'RoleController@attach')->name('role.permission.attach');
Route::put('/roles/{role}/detach', 'RoleController@detach')->name('role.permission.detach');


