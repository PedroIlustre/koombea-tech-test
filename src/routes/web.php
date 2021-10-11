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


Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::post('/save_file', 'SaveFileController@save')->name('save_file');
Route::get('/show_upload/{id}', 'UploadedFileController@show')->name('show_upload');
Route::post('/save_contact', 'UploadContactFileController@uploadFile')->name('save_contact');
Route::get('/list', 'ListContactController@list')->name('list_contact');