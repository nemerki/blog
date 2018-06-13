<?php
/**
 * Created by PhpStorm.
 * User: mmehe
 * Date: 13.06.2018
 * Time: 01:06
 */


Route::group(["prefix" => "admin", "as" => "backend", "namespace" => "Backend"/*,"middleware"=>"admin"*/], function () {
    Route::group(["as" => ".home", "namespace" => "Home"], function () {
        Route::get("/", "HomeController@index")->name(".index");

    });

    Route::group(["prefix" => "ayar", "as" => ".setting", "namespace" => "Setting"], function () {
        Route::get("/", "SettingController@index")->name(".index");
        Route::post("/update", "SettingController@update")->name(".update");

    });

    Route::group(["prefix" => "kullanici", "as" => ".user", "namespace" => "User"], function () {
        Route::get("/", "UserController@index")->name(".index");


    });


});
