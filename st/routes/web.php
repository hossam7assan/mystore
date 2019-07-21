<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('home','HomeController@index')->name('myHome');

Route::resource('categories', 'CategoryController');
// Route::resource('products', 'ProductController');

Route::get('categories','CategoryController@index')->name('categories.index');
Route::get('categories/create','CategoryController@create')->name('categories.create')->middleware('auth');
Route::post('categories','CategoryController@store')->name('categories.store');
Route::get('categories/{category}','CategoryController@show')->name('categories.show');
Route::delete('categories/{category}','CategoryController@destroy')->name('categories.destroy');
// Route::get('categories','CategoryController@index')->name('myHome');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
