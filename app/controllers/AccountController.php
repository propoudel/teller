<?php

class AccountController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $sql = 'SELECT *,
                (SELECT party_name FROM party WHERE account.`received_from` = party.`id`) AS received_name,
                (SELECT party_name FROM party WHERE account.`sent_to` = party.`id`) AS sent_name FROM account;

                ';

        $data =  DB::select($sql);

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

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function report()
    {
        $data = array();

        $party = new Party();
        $party_data = $party->all();

        $currency = new Currency();
        $currency_data = $currency->all();

        $account = 'SELECT *,
                      (SELECT id FROM party WHERE account.`received_from` = party.`id`) AS party_id,
                      (SELECT party_name FROM party WHERE account.`received_from` = party.`id`) AS received_name,
                      (SELECT party_name FROM party WHERE account.`sent_to` = party.`id`) AS sent_name FROM account';

        //        if (isset($_GET)) {
//            $where = 'WHERE ';
//        }
//        $getdata = array_filter($_GET);
//
//        foreach ($getdata as $key => $val) {
//            //echo end($_GET); die;
//            if (end($getdata) == $val && !empty($val)) {
//                $where .= $key . "=" . $val;
//             } else if (!empty($val)) {
//                $where .= $key . "=" . $val . " AND ";
//            }
//        }
//
//        echo $where; die;

        $get_data = array_filter($_GET);

        if (!empty($get_data)) {
            $account .= ' WHERE ';
        }

        if (Input::get('received_from')) {
            $account .= ' received_from=' . Input::get('received_from');
        }
        if (Input::get('sent_to')) {
            if (Input::get('received_from')) {
                $account .= ' AND sent_to=' . Input::get('sent_to');
            } else {
                $account .= ' sent_to=' . Input::get('sent_to');
            }

        }
        if (Input::get('currency')) {
            if (Input::get('received_from') || Input::get('sent_to')) {
                $account .= ' AND (sent_currency=' . Input::get('currency') . ' OR received_currency=' . Input::get('currency') . ')';
            } else {
                $account .= ' (sent_currency=' . Input::get('currency') . ' OR received_currency=' . Input::get('currency') . ')';
            }
        }
//        if (Input::get('from')) {
//            $account .= ' AND created_at>date(' . Input::get('from') . ')';
//        }
//        if (Input::get('to')) {
//            $account .= ' AND created_at<date(' . Input::get('to') . ')';
//        }

        $account .= ' ORDER BY received_name';

        //echo $account; die;


        $account_data =  DB::select($account);

        $new = array();
        foreach($account_data as $ad) {
            $new[] = (array) $ad;

        }

        $return_account = array();

        foreach ($new as $key=>$val) {
            $return_account[$val['party_id']][] = $val;
        }

        $users = User::orderBy('created_at','desc')->get();

        return View::make('account/report', compact('party_data', 'currency_data', 'return_account', 'account_data'));
    }

    public function export(){
        Excel::create('Users', function($excel) {

            $excel->sheet('Users', function($sheet) {
                $users = User::orderBy('created_at','desc')->get();
                $sheet->loadView('account/users', ['users' => $users->toArray()]);
            });
        })->download('xls');
    }

}
