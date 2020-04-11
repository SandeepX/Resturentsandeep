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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
/***********************Admin Route************/
Route::group(['prefix'=>'admin','middleware'=>['auth','admin']],
	function(){
		Route::get('/','HomeController@admin')->name('admin');
		Route::resource('menu','MenuController');
		Route::post('menu/detail','MenuController@getMenuById')->name('menu-detail');

		Route::resource('user','UserController');
		Route::post('user/detail','UserController@getUserById')->name('user-detail');

		Route::resource('reporting', 'ReportingController');
		



		
	});

















/***********************staff Route************/
Route::group(['prefix'=>'staff','middleware'=>['auth','staff']],
	function(){
		Route::get('/','HomeController@staff')->name('staff');

		Route::resource('setmenu','SetmenuController');
		Route::resource('viewOrder','VieworderController');
		Route::post('viewOrder/update','VieworderController@update2')->name('order-update');
	});


/***********************customer Route************/
Route::group(['prefix'=>'customer','middleware'=>['auth','customer']],
	function(){
		Route::get('/','HomeController@customer')->name('customer');

		Route::resource('Makeorder','OrderController');
		Route::post('Makeorder/price' ,'MenuController@getprice')->name('get-price');
		

	});