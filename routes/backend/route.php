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
        Route::get("/duzenle/{id}", "UserController@edit")->name(".edit");
        Route::post("/update/{id}", "UserController@update")->name(".update");
        Route::post("/delete", "UserController@destroy")->name(".delete");

    });

    Route::group(["prefix" => "kategori", "as" => ".category", "namespace" => "Category"], function () {
        Route::get("/", "CategoryController@index")->name(".index");
        Route::get("/duzenle/{id}", "CategoryController@edit")->name(".edit");
        Route::post("/update/{id}", "CategoryController@update")->name(".update");
        Route::post("/delete", "CategoryController@destroy")->name(".delete");
        Route::get("/ekle", "CategoryController@create")->name(".create");
        Route::post("/store", "CategoryController@store")->name(".store");
    });

    Route::group(["prefix" => "yazi", "as" => ".article", "namespace" => "Article"], function () {
        Route::get("/", "ArticleController@index")->name(".index");
        Route::get("/duzenle/{id}", "ArticleController@edit")->name(".edit");
        Route::post("/update/{id}", "ArticleController@update")->name(".update");
        Route::post("/delete", "ArticleController@destroy")->name(".delete");
        Route::get("/ekle", "ArticleController@create")->name(".create");
        Route::post("/store", "ArticleController@store")->name(".store");
        Route::post("/status", "ArticleController@status")->name(".status");
    });


});
