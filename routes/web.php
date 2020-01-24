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

Route::get('/',[
    'as' => 'homepage',
    'uses' => 'Web\WebController@Homepage',
]);

Route::get('/delete-book/{id}',[
    'as' => 'delete-book',
    'uses' => 'Web\WebController@deleteBook',
]);

Route::post('/update-book/{id}',[
    'as' => 'update-book',
    'uses' => 'Web\WebController@updateBook',
]);

