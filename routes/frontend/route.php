<?php
/**
 * Created by PhpStorm.
 * User: mmehe
 * Date: 13.06.2018
 * Time: 01:06
 */


Route::group(["as" => "frontend", "namespace" => "Frontend"], function () {
    Route::group(["as" => ".home", "namespace" => "Home"], function () {
        Route::get("/", "HomeController@index")->name(".index");

    });



});
