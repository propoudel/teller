<?php

class UserController
    extends Controller
{
    public function login()
    {
        if ($this->isPostRequest()) {
            $validator = $this->getLoginValidator();

            if ($validator->passes()) {
                $credentials = $this->getLoginCredentials();

                if (Auth::attempt($credentials)) {
                    return Redirect::route("user/dashboard");
                }

                return Redirect::back()->withErrors([
                    "password" => ["Credentials invalid."]
                ]);

            } else {
                return Redirect::back()
                    ->withInput()
                    ->withErrors($validator);
            }
        }

        return View::make("user/login");
    }

    protected function isPostRequest()
    {
        return Input::server("REQUEST_METHOD") == "POST";
    }

    protected function getLoginValidator()
    {
        return Validator::make(Input::all(), [
            "username" => "required",
            "password" => "required"
        ]);
    }

    protected function getLoginCredentials()
    {
        return [
            "username" => Input::get("username"),
            "password" => Input::get("password")
        ];
    }

    public function profile()
    {
        $party = new Party();
        $party_data = $party->all();

        $currency = new Currency();
        $currency_data = $currency->all();

        $data['party_data'] = $party_data;
        $data['currency_data'] = $currency_data;

        return View::make("user/profile", compact('data'));
    }

    public function request()
    {
        if ($this->isPostRequest()) {
            $response = $this->getPasswordRemindResponse();

            if ($this->isInvalidUser($response)) {
                return Redirect::back()
                    ->withInput()
                    ->with("error", Lang::get($response));
            }

            return Redirect::back()
                ->with("status", Lang::get($response));
        }

        return View::make("user/request");
    }

    protected function getPasswordRemindResponse()
    {
        return Password::remind(Input::only("email"));
    }

    protected function isInvalidUser($response)
    {
        return $response === Password::INVALID_USER;
    }

    public function reset($token)
    {
        if ($this->isPostRequest()) {
            $credentials = Input::only(
                    "email",
                    "password",
                    "password_confirmation"
                ) + compact("token");

            $response = $this->resetPassword($credentials);

            if ($response === Password::PASSWORD_RESET) {
                return Redirect::route("user/profile");
            }

            return Redirect::back()
                ->withInput()
                ->with("error", Lang::get($response));
        }

        return View::make("user/reset", compact("token"));
    }

    protected function resetPassword($credentials)
    {
        return Password::reset($credentials, function ($user, $pass) {
            $user->password = Hash::make($pass);
            $user->save();
        });
    }

    protected function update()
    {
        // store
        $user = User::find(1);
//        if ($user->password != Hash::make(Input::get('old_password'))) {
//            Session::flash('message', 'Old Password Is Not Matched!! Try Again?');
//            return Redirect::to('profile');
//        }
        $user->username = Input::get('username');
        $user->password = Hash::make(Input::get('new_password'));
        $user->save();

        // redirect
        Auth::logout();

        return Redirect::route("user/login");
    }

    public function dashboard()
    {
        $data = array();

        $party = new Party();
        $party_data = $party->all();

        $currency = new Currency();
        $currency_data = $currency->all();

        $party_join_curr = DB::table('party')
            ->Join('currency', 'currency.id', '=', 'party.currency_id')
            ->select('party.*', 'currency.id as currency_id', 'currency.currency_code')
            ->get();

        $data['party_data'] = $party_data;
        $data['currency_data'] = $currency_data;
        $data['party_join_curr'] = $party_join_curr;

        return View::make("dashboard/index", compact('data'));
    }

    public function logout()
    {
        Auth::logout();

        return Redirect::route("user/login");
    }
}
