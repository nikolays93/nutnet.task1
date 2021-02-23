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

Auth::routes([
    'register' => false,
    'reset' => false,
]);

Route::get('/admin', 'Admin\AdminController@index')->name('admin');
Route::get('/admin/records', 'Admin\RecordController@index')->name('records');
Route::get('/admin/record/update', 'Admin\RecordController@updateForm')->name('record.update.form');
Route::post('/admin/record/update', 'Admin\RecordController@update')->name('record.update');
Route::match(['get', 'post', 'delete'], '/admin/record/delete', 'Admin\RecordController@delete')->name('record.delete');
