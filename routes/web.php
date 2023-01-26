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

Route::get('/', 'App\Http\Controllers\TaskController@index')->name('index');
Route::get('index', 'App\Http\Controllers\TaskController@index')->name('index');
Route::get('active', 'App\Http\Controllers\TaskController@active')->name('active');
Route::get('completed', 'App\Http\Controllers\TaskController@completed')->name('completed');

Route::match(['get', 'post'], 'search', 'App\Http\Controllers\TaskController@search')->name('search');

Route::get('create', 'App\Http\Controllers\TaskController@create')->name('create')->middleware('auth');;
Route::post('store', 'App\Http\Controllers\TaskController@store')->name('store')->middleware('auth');;

Route::get('show/{id}', 'App\Http\Controllers\TaskController@show')->name('show');
Route::get('edit/{id}', 'App\Http\Controllers\TaskController@edit')->name('edit')->middleware('auth');;
Route::patch('update/{id}', 'App\Http\Controllers\TaskController@update')->name('update')->middleware('auth');;
Route::delete('destroy/{id}', 'App\Http\Controllers\TaskController@destroy')->name('destroy')->middleware('auth');;

Auth::routes();
