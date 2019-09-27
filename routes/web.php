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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'ChatsController@index');
Route::get('user', function (Request $request) {
    return Auth::user();
});
Route::get('messages', 'ChatsController@fetchMessages');
Route::get('messages/{id}', 'ChatsController@fetchChat');
Route::post('messages', 'ChatsController@sendMessage');
Route::get('all-users', 'ChatsController@getUsers');
Route::get('user/{id}', 'ChatsController@getUser');


Route::get('/{any}', 'ChatsController@index')->where('any', '.*');

