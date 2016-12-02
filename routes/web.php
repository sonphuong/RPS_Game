<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('','PagesController@home');
Route::get('about','PagesController@about');
Route::get('contact','PagesController@contact');
Route::get('people','PagesController@people');
Route::get('products','PagesController@product');
//for RPS game
Route::get('game','PagesController@game');
Route::get('cvsc','PagesController@cvsc');
Route::post('game/playCVSC','GameController@playCVSC');
Route::post('game/play','GameController@play');

