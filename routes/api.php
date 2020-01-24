<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/external-books',[
    'uses' => 'ExternalController@searchExternalBooks',
    'as' => 'view.external-books',
]);

Route::resources([
    '/v1/books' => 'BookController',
    '/v1/books' => 'BookController',
    '/v1/books/{id}' => 'BookController',
]);
