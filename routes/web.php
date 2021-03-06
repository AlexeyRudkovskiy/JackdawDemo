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

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function () {
    session()->flash('test', 1);
    return 1;
});

Route::get('foo', function () {
    dd(session()->all());
    return 1;
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('post2/{post}', function ($post) {
    return $post;
})->name('first_extension.settings2');
