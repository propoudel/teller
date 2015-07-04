<?php

class ExpenseController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $party = new Party();
        $party_data = $party->all();

        $currency = new Currency();
        $currency_data = $currency->all();

        $expense = new Expense();
        $expense_data = $expense->all();

        $data['party_data'] = $party_data;
        $data['currency_data'] = $currency_data;
        $data['expense_data'] = $expense_data;

        return View::make('expense/index', compact('data'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $party = new Party();
        $party_data = $party->all();

        $currency = new Currency();
        $currency_data = $currency->all();

        $data['party_data'] = $party_data;
        $data['currency_data'] = $currency_data;

        return View::make("expense/create", compact('data'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store()
    {
        $rules = array(
            'expense_name' => 'required',
            'expense_amount' => 'required',
            'expense_details' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('expense/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $expense = new Expense();
            $expense->name = Input::get('expense_name');
            $expense->amount = Input::get('expense_amount');
            $expense->details = Input::get('expense_details');

            if ($expense->save()) {
                Session::flash('message', 'Successfully Created Expense!');
            } else {
                Session::flash('message', 'Expense Not Created!');
            }

            $expense->save();

            return Redirect::to('expense');
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
        $party = new Party();
        $party_data = $party->all();

        $currency = new Currency();
        $currency_data = $currency->all();

        $data['party_data'] = $party_data;
        $data['currency_data'] = $currency_data;

        $data['expense_data_edit'] = Expense::find($id);

        return View::make('expense/edit', compact('data'));
    }


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update()
    {
        $rules = array(
            'expense_name' => 'required',
            'expense_amount' => 'required',
            'expense_details' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        $id = Input::get('id');

        if ($validator->fails()) {
            return Redirect::to('expense/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $expense = Expense::find($id);
            $expense->name = Input::get('expense_name');
            $expense->amount = Input::get('expense_amount');
            $expense->details = Input::get('expense_details');

            if ($expense->save()) {
                Session::flash('message', 'Successfully Updated Expense!');
            } else {
                Session::flash('message', 'Updating Expense Error!');
            }

            return Redirect::to('expense');
        }
    }


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        // delete
        $item = Expense::find($id);
        $item->delete();

        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('expense');
	}


}
