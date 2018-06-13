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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

include base_path("routes/backend/route.php");
include base_path("routes/frontend/route.php");


Route::get('/test/mail', function () {
    return new \App\Mail\PasswordResetMail();
});
