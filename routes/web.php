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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/chat', 'HomeController@chat')->name('chat');

Route::post('messages' , 'MessageController@getMessages');
Route::post('send/message' , 'MessageController@sendMessages');

Route::post('readMessages' , 'MessageController@readMessages');
