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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::middleware('auth')->group(function() {
	Route::get('/home', 'HomeController@index')->name('home');
});
//Admin Routes

Route::namespace('Admin')->prefix('admin')->group(function() {
	Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'LoginController@login')->name('admin.login');

	Route::middleware('auth:admin')->group(function() {
		Route::post('logout', 'LoginController@logout')->name('admin.logout');
		Route::get('home', 'HomeController@index')->name('admin.home');
	});
});