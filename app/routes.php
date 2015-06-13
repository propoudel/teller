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
    Route::any("/profile/update", [
        "as" => "profile/update",
        "uses" => "UserController@update"
    ]);

    Route::any("/logout", [
        "as" => "user/logout",
        "uses" => "UserController@logout"
    ]);

    //Routes for Accounting
    Route::any("/account", [
        "as" => "account/index",
        "uses" => "AccountController@index"
    ]);

    Route::any("/account/{id}/edit", [
        "as" => "account/edit",
        "uses" => "AccountController@edit"
    ]);

    Route::any("/account/create", [
        "as" => "account/create",
        "uses" => "AccountController@create"
    ]);

    Route::any("/account/store", [
        "as" => "account/store",
        "uses" => "AccountController@store"
    ]);
    Route::any("/account/report", [
        "as" => "account/report",
        "uses" => "AccountController@report"
    ]);
    Route::any("/account/export", [
        "as" => "account/export",
        "uses" => "AccountController@export"
    ]);
    Route::any("/account/{id}/delete", [
        "as" => "account/delete",
        "uses" => "AccountController@destroy"
    ]);
    Route::any("/account/{id}/edit", [
        "as" => "account/edit",
        "uses" => "AccountController@edit"
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

    Route::any("/currency/find", [
        "as" => "currency/find",
        "uses" => "CurrencyController@find"
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
    Route::any("/transaction", [
        "as" => "transaction",
        "uses" => "TransactionController@index"
    ]);
    Route::any("/transaction/store", [
        "as" => "transaction/store",
        "uses" => "TransactionController@store"
    ]);
    Route::any("/transaction", [
        "as" => "transaction",
        "uses" => "TransactionController@index"
    ]);
    Route::any("/transaction/report", [
        "as" => "transaction/report",
        "uses" => "TransactionController@report"
    ]);
    Route::any("/transaction/export", [
        "as" => "transaction/export",
        "uses" => "TransactionController@export"
    ]);
    Route::any("/transaction/latestTransaction", [
        "as" => "/transaction/latestTransaction",
        "uses" => "TransactionController@latestTransaction"
    ]);
    Route::any("/transaction/{id}/edit", [
        "as" => "/transaction/edit",
        "uses" => "TransactionController@edit"
    ]);
    Route::any("/transaction/update", [
        "as" => "/transaction/update",
        "uses" => "TransactionController@update"
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
