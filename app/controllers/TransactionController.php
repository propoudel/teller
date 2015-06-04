<?php

class TransactionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $transaction = new Transaction();
        print_r($transaction->all());
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
//        echo '<pre>';
//        print_r($_POST);
//		die('This comes here!');

        $transaction = new Transaction();
        $transaction->base_type = Input::get('base_type');
        $transaction->reference_id = Input::get('reference_id');
        $transaction->debtor_id = Input::get('debtor_id');
        $transaction->d_currency = Input::get('d_currency');
        $transaction->creditor_id = Input::get('creditor_id');
        $transaction->c_currency = Input::get('c_currency');
        $transaction->conversion_currency = Input::get('conversion_currency');
        $transaction->foreign_rate = Input::get('foreign_rate');

        $transaction->debit_fc = Input::get('debit_fc');
        $transaction->credit_fc = Input::get('credit_fc');

        //Need to calculate
        //$transaction->total_amount = Input::get('total_amount');
        $transaction->local_rate = Input::get('local_rate');
        $transaction->comment = Input::get('comment');
        //$transaction->c_currency = Input::get('c_currency');
        $transaction->save();

        // redirect
        Session::flash('message', 'Transaction is Successful!');
        return Redirect::to('dashboard');
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
