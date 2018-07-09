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

    Route::group(["middleware" => "author"], function () {
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
    Route::group(["prefix" => "yazarlik", "as" => ".writer", "namespace" => "Writer"], function () {
        Route::get("/", "WriterController@index")->name(".index");
        Route::post("/store", "WriterController@store")->name(".store");
    });


});
