<?php

class CurrencyController extends Controller
{

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

        $data['party_data'] = $party_data;
        $data['currency_data'] = $currency_data;

        return View::make("currency/index", compact('data'));
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

        return View::make("currency/create", compact('data'));
    }


    public function find(){
        $currency =  Currency::find($_POST['id']);
        $data = array(
            'id' => $currency->id,
            'currency_code' => $currency->currency_code,
            'currency_rate' => $currency->currency_rate
        );
        echo (json_encode($data));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $rules = array(
            'currency_code' => 'required',
            'currency_rate' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('currency/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $currency = new Currency();
            $currency->currency_code = Input::get('currency_code');
            $currency->currency_rate = Input::get('currency_rate');
            $currency->save();

            // redirect
            Session::flash('message', 'Successfully created currency!');
            return Redirect::to('currency');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $party = new Party();
        $data['party_data'] = $party->all();

        $data['currency_data'] = Currency::find($id);

        return View::make("currency/edit", compact('data'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update()
    {
        $rules = array(
            'currency_code' => 'required',
            'currency_rate' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        $id = Input::get('id');

        if ($validator->fails()) {
            return Redirect::to('currency/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $currency = Currency::find($id);
            //$currency = new Currency();
            $currency->currency_code = Input::get('currency_code');
            $currency->currency_rate = Input::get('currency_rate');
            $currency->save();

            // redirect
            Session::flash('message', 'Successfully updated currency!');
            return Redirect::to('currency');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        // delete
        $item = Currency::find($id);
        $item->delete();

        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('currency');
    }


}
