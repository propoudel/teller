<?php

class PartyController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$party = new Party();
        $data = $party->all();
        return View::make('party/index', compact('data'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make("party/create");
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store()
    {
        $rules = array(
            'party_name' => 'required',
            'currency_code' => 'required',
            'party_details' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('party/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $party = new Party();
            $party->party_name = Input::get('party_name');
            $party->currency_id = Input::get('currency_code');
            $party->party_details = Input::get('party_details');
            $party->save();

            // redirect
            Session::flash('message', 'Successfully Created Party!');
            return Redirect::to('party');
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
        $item = Party::find($id);
        return View::make('party/edit')
            ->with('item', $item);
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
            'party_name' => 'required',
            'currency_code' => 'required',
            'party_details' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        $id = Input::get('id');

        if ($validator->fails()) {
            return Redirect::to('party/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $party = Party::find($id);
            //$party = new Party();
            $party->party_name = Input::get('party_name');
            $party->currency_id = Input::get('currency_code');
            $party->party_details = Input::get('party_details');
            $party->save();

            // redirect
            Session::flash('message', 'Successfully Updated Party!');
            return Redirect::to('party');
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
        $item = Party::find($id);
        $item->delete();

        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('party');
	}


}
