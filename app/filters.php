<?php

Route::filter("auth", function() {
  if (Auth::guest()) {
    return Redirect::route("user/login");
  }
});

App::before(function($request)
{
    // Set up global user object for views
    View::share('currency', Currency::all());
});

App::before(function($request)
{
    // Set up global user object for views
    View::share('party', Party::all());
});