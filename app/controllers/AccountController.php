<?php

class AccountController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $data = array();
		return View::make('account/index', compact('data'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $rules = array(
            'party_from' => 'required',
            'currency_from' => 'required',
            'amount' => 'required',
            'party_to' => 'required',
            'send_currency' => 'required',
            'rate' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('/dashboard')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $account = new Account_model();
            $account->received_from = Input::get('party_from');
            $account->received_amount = Input::get('amount');
            $account->received_currency = Input::get('currency_from');
            $account->sent_to = Input::get('party_to');
            $account->sent_currency = Input::get('send_currency');
            $account->sent_rate = Input::get('rate');
            $account->total_transferred_money = Input::get('totalamount');
            $account->comment = Input::get('details');
            $account->save();

            // redirect
            Session::flash('message', 'Successfully stored amount!');
            return Redirect::to('dashboard');
        }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
