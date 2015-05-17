<?php

Route::any("/", [
    "as" => "user/login",
    "uses" => "UserController@login"
]);

Route::group(["before" => "auth"], function () {

    //Routes for administrator
    Route::any("/dashboard", [
        "as" => "user/dashboard",
        "uses" => "UserController@dashboard"
    ]);

    Route::any("/profile", [
        "as" => "user/profile",
        "uses" => "UserController@profile"
    ]);

    Route::any("/logout", [
        "as" => "user/logout",
        "uses" => "UserController@logout"
    ]);

    //Routes for Accounting
    Route::any("/account/create", [
        "as" => "account/create",
        "uses" => "AccountController@create"
    ]);

    Route::any("/account/store", [
        "as" => "account/store",
        "uses" => "AccountController@store"
    ]);

    //Routes for Currency
    Route::any("/currency", [
        "as" => "currency",
        "uses" => "CurrencyController@index"
    ]);
    Route::any("/currency/create", [
        "as" => "currency/create",
        "uses" => "CurrencyController@create"
    ]);
    Route::any("/currency/store", [
        "as" => "currency/store",
        "uses" => "CurrencyController@store"
    ]);

    Route::any("/currency/{id}/edit", [
        "as" => "currency/edit",
        "uses" => "CurrencyController@edit"
    ]);

    Route::any("/currency/update", [
        "as" => "currency/update",
        "uses" => "CurrencyController@update"
    ]);

    Route::any("/currency/{id}/delete", [
        "as" => "currency/delete",
        "uses" => "CurrencyController@destroy"
    ]);

    //Routes for Party
    Route::any("/party", [
        "as" => "party",
        "uses" => "PartyController@index"
    ]);
    Route::any("/party/create", [
        "as" => "party/create",
        "uses" => "PartyController@create"
    ]);
    Route::any("/party/store", [
        "as" => "party/store",
        "uses" => "PartyController@store"
    ]);
    Route::any("/party/{id}/edit", [
        "as" => "party/edit",
        "uses" => "PartyController@edit"
    ]);
    Route::any("/party/update", [
        "as" => "party/update",
        "uses" => "PartyController@update"
    ]);
    Route::any("/party/{id}/delete", [
        "as" => "party/delete",
        "uses" => "PartyController@destroy"
    ]);


});

Route::any("/request", [
    "as" => "user/request",
    "uses" => "UserController@request"
]);

Route::any("/reset/{token}", [
    "as" => "user/reset",
    "uses" => "UserController@reset"
]);
