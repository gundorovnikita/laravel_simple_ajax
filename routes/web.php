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


Route::get('/', 'Text@index');

Route::post('/ajax','Text@send');

Route::post('/delete','Text@delete');

Route::get('cart', 'Text@cart');
 
Route::get('add-to-cart/{id}', 'Text@addToCart');

Route::delete('remove-from-cart', 'Text@remove');







Route::get('ajaxtest',function() {
   return view('message');
});
Route::post('/getmsg','AjaxController@index');