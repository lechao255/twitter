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

// 指定静态页面的路由
Route::get('/help', 'StaticPagesController@help');
Route::get('/about', 'StaticPagesController@about');
Route::get('/', 'StaticPagesController@home');
