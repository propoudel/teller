<?php

Route::filter("auth", function() {
  if (Auth::guest()) {
    return Redirect::route("user/login");
  }
});

App::before(function($request)
{
    // Set up global user object for views
    $currency = new Currency();
    $currency_data = $currency->all();
    View::share('currency', compact($currency_data));

    $party = new Party();
    $party_data = $party->all();
    View::share('party', compact($party_data));
});

App::before(function($request)
{
    // Set up global user object for views
    $party = new Party();
    $party_data = $party->all();
    View::share('party', compact($party_data));
});