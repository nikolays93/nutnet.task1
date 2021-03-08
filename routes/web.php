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

Route::get('/', function () {
    return view('welcome');
});

/**
 * Authorization pages.
 */
Auth::routes([
    'register' => false,
    'reset' => false,
]);

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
	/**
	 * Admin index page.
	 */
	Route::get('/', 'Admin\AdminController@index')->name('admin');

	/*
	 * Records resource.
	 *
	 * @link https://laravel.com/docs/8.x/controllers#resource-controllers
	 */
	Route::resource('records', 'Admin\RecordController', [
		'as' => 'admin',
	]);
});
