<?php

class TransactionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $data = array();

        $party = new Party();
        $party_data = $party->all();

        $currency = new Currency();
        $currency_data = $currency->all();

        $sql = 'SELECT *,
                (SELECT party_name FROM party WHERE transaction.`debtor_id` = party.`id`) AS debtor,
                (SELECT party_name FROM party WHERE transaction.`creditor_id` = party.`id`) AS creditor FROM transaction;
                ';

        $data['party_data'] = $party_data;
        $data['currency_data'] = $currency_data;
        $data['trans'] =  DB::select($sql);

        return View::make('transaction/index', compact('data'));
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
        $transaction = new Transaction();
        //Hidden Ids
        $new_party = Input::get('new_party');
        $d_yes = Input::get('d_yes');
        $c_yes = Input::get('c_yes');
        if ($new_party) {
            if($d_yes) {
                $d_party = new Party();
                $d_party->party_details = 'Added Directly From dashboard on Entry!You can Edit Here!';
                $d_party->party_name = Input::get('debit');
                $d_party->currency_id = Input::get('d_currency');
                $d_party->save();
                $n_debtor_id =  $d_party->id;
            }
            if($c_yes) {
                $c_party = new Party();
                $c_party->party_details = 'Added Directly From dashboard on Entry!You can Edit Here!';
                $c_party->party_name = Input::get('credit');
                $c_party->currency_id = Input::get('c_currency');
                $c_party->save();
                $n_creditor_id =  $c_party->id;
            }
        }
        // End Hidden Ids
        $transaction->base_type = Input::get('base_type');
        //$transaction->reference_id = Input::get('reference_id');
        $transaction->debtor_id = isset($n_debtor_id) ? $n_debtor_id : Input::get('debtor_id');
        $transaction->d_currency = Input::get('d_currency');
        $transaction->creditor_id = isset($n_creditor_id) ? $n_creditor_id : Input::get('creditor_id');
        $transaction->c_currency = Input::get('c_currency');
        $transaction->conversion_currency = Input::get('conversion_currency');
        $transaction->foreign_rate = Input::get('foreign_rate');

        //$transaction->total_amount = Input::get('total_amount');
        if ($transaction->d_currency == $transaction->conversion_currency) {
            $transaction->debit_fc = Input::get('total_amount');

            if ($transaction->base_type == 1) {
                $transaction->credit_fc = Input::get('total_amount');
            } else if ($transaction->base_type == 2) {
                $transaction->credit_fc = Input::get('total_amount')  * $transaction->foreign_rate;
            } else if($transaction->base_type == 3) {
                $transaction->credit_fc = Input::get('total_amount') / $transaction->foreign_rate;
            } else {
                die('There is some error!Please Select any conversion base type');
            }
        }

        if ($transaction->c_currency == $transaction->conversion_currency) {
            $transaction->credit_fc = Input::get('total_amount'); ;

            if ($transaction->base_type == 1) {
                $transaction->debit_fc = Input::get('total_amount') ;
            } else if ($transaction->base_type == 2) {
                $transaction->debit_fc = Input::get('total_amount')  * $transaction->foreign_rate;
            } else if($transaction->base_type == 3) {
                $transaction->debit_fc = Input::get('total_amount') / $transaction->foreign_rate;
            } else {
                die('There is some error!Please Select any conversion base type');
            }
        }

        //Need to calculate
        //$transaction->total_amount = Input::get('total_amount');
        $transaction->local_rate = Input::get('local_rate');
        $transaction->debit_local = Input::get('total_amount') *  Input::get('local_rate');
        $transaction->credit_local = Input::get('total_amount') * Input::get('local_rate');
        $transaction->comment = Input::get('comment');
        //$transaction->c_currency = Input::get('c_currency');
        $transaction->reference_id = date('YmdHi') . rand(10, 99);

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
        $party = new Party();
        $party_data = $party->all();

        $currency = new Currency();
        $currency_data = $currency->all();

        $data['party_data'] = $party_data;
        $data['currency_data'] = $currency_data;
        $data['transaction'] = Transaction::find($id);

        return View::make('transaction/edit', compact('data'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
        $id = Input::get('id');
        $trans = Transaction::find($id);
        $date = date('Y-m-d', strtotime(Input::get('created_at'))) . ' ' . date('H:i:s');
        $trans->created_at = $date;

        $trans->save();
        // redirect
        Session::flash('message', 'Successfully Updated Transaction Date!');
        return Redirect::to('transaction');
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
        $item = Transaction::find($id);
        $item->delete();

        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('transaction');
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

        $party_join_curr = DB::table('party')
            ->Join('currency', 'currency.id', '=', 'party.currency_id')
            ->select('party.*', 'currency.id as currency_id', 'currency.currency_code')
            ->get();

        $transaction = 'SELECT *,
                      (SELECT id FROM party WHERE transaction.`debtor_id` = party.`id`) AS party_id,
                      (SELECT party_name FROM party WHERE transaction.`debtor_id` = party.`id`) AS debtor,
                      (SELECT currency_code FROM currency WHERE transaction.`d_currency` = currency.`id`) AS d_currency,
                      (SELECT currency_code FROM currency WHERE transaction.`c_currency` = currency.`id`) AS c_currency,
                      (SELECT party_name FROM party WHERE transaction.`creditor_id` = party.`id`) AS creditor FROM transaction';

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
            $transaction .= ' WHERE ';
        }
		
		if (Input::get('reference_id')) {
            $transaction .= ' reference_id="' . Input::get('reference_id').'"';
        }

        if (Input::get('debtor_id')) {
			if (Input::get('reference_id')) {
				$transaction .= ' AND debtor_id=' . Input::get('debtor_id');
			} else {
				$transaction .= ' debtor_id=' . Input::get('debtor_id');
			}
        }
        if (Input::get('creditor_id')) {
            if (Input::get('debtor_id') || Input::get('reference_id')) {
                $transaction .= ' AND creditor_id=' . Input::get('creditor_id');
            } else {
                $transaction .= ' creditor_id=' . Input::get('creditor_id');
            }

        }
        if (Input::get('currency')) {
            if (Input::get('debtor_id') || Input::get('creditor_id') || Input::get('reference_id')) {
                $transaction .= ' AND (d_currency=' . Input::get('currency') . ' OR c_currency=' . Input::get('currency') . ')';
            } else {
                $transaction .= ' (d_currency=' . Input::get('currency') . ' OR c_currency=' . Input::get('currency') . ')';
            }
        }
        /*
        if (Input::get('from')) {
            if (Input::get('received_from') || Input::get('sent_to') || Input::get('currency')) {
                $account .= ' AND created_at>date(' . Input::get('from') . ')';
            } else {
                $account .= ' created_at>date(' . Input::get('from') . ')';
            }

        }
        if (Input::get('to')) {
            if (Input::get('received_from') || Input::get('sent_to') || Input::get('currency') || Input::get('from')) {
                $account .= ' AND created_at<date(' . Input::get('to') . ')';
            } else {
                $account .= ' created_at<date(' . Input::get('to') . ')';
            }

        }*/
        $from = '';
        $to = '';
        if (Input::get('from')) {
            $from = date('Y-m-d H:i:s', strtotime(Input::get('from')));
        }
        if (Input::get('to')) {
            $to = date('Y-m-d H:i:s', strtotime(Input::get('to')));
        }

        if ($from || $to) {
            if (Input::get('debtor_id') || Input::get('creditor_id') || Input::get('currency') || Input::get('reference_id')) {
                if ($to && $from) {
                    $transaction .= ' AND (created_at BETWEEN "' .  $from . '" AND "' . $to . '")';
                } else if ($from){
                    $transaction .= ' AND created_at>"' . $from . '"';
                } else if ($to){
                    $transaction .= ' AND created_at<"' . $to . '"';
                }
            } else {
                if ($to && $from) {
                    $transaction .= ' (created_at BETWEEN "' .  $from . '" AND "' . $to . '")';
                } else if ($from) {
                    $transaction .= ' created_at>"' . $from . '"';
                } else if ($to) {
                    $transaction .= ' created_at<"' . $to . '"';
                }

            }
        }

//        if (Input::get('to')) {
//            if (Input::get('debtor_id') || Input::get('creditor_id') || Input::get('currency') || Input::get('from')) {
//                //$transaction .= ' AND created_at<date(' . Input::get('to') . ')';
//                $transaction .= ' AND created_at<date(' . Input::get('to') . ')';
//            } else {
//                $transaction .= ' created_at<date(' . Input::get('to') . ')';
//            }
//        }

        $transaction .= ' ORDER BY debtor';
        //echo $transaction; die;


        $transaction_data =  DB::select($transaction);

        $new = array();
        foreach($transaction_data as $ad) {
            $new[] = (array) $ad;

        }

        $return_transaction = array();

        foreach ($new as $key=>$val) {
            $return_transaction[$val['party_id']][] = $val;
        }

        $data['party_data'] = $party_data;
        $data['currency_data'] = $currency_data;
        $data['transaction_data'] =  $transaction_data;
        $data['return_transaction'] =  $return_transaction;
        $data['party_join_curr'] = $party_join_curr;

        return View::make('transaction/report', compact('data'));
    }

    public function export() {
        Excel::create('ExcelReport' . date('Ymdhms'), function($excel) {

            $excel->sheet('ExcelReport' . date('Ymdhms'), function($sheet) {
                $users = User::orderBy('created_at','desc')->get();

                $party = new Party();
                $party_data = $party->all();

                $currency = new Currency();
                $currency_data = $currency->all();

                $party_join_curr = DB::table('party')
                    ->Join('currency', 'currency.id', '=', 'party.currency_id')
                    ->select('party.*', 'currency.id as currency_id', 'currency.currency_code')
                    ->get();

                $transaction = 'SELECT *,
                      (SELECT id FROM party WHERE transaction.`debtor_id` = party.`id`) AS party_id,
                      (SELECT party_name FROM party WHERE transaction.`debtor_id` = party.`id`) AS debtor,
                      (SELECT currency_code FROM currency WHERE transaction.`d_currency` = currency.`id`) AS d_currency,
                      (SELECT currency_code FROM currency WHERE transaction.`c_currency` = currency.`id`) AS c_currency,
                      (SELECT party_name FROM party WHERE transaction.`creditor_id` = party.`id`) AS creditor FROM transaction';

                $get_data = array_filter($_GET);

                if (!empty($get_data)) {
                    $transaction .= ' WHERE ';
                }

                if (Input::get('debtor_id')) {
                    $transaction .= ' debtor_id=' . Input::get('debtor_id');
                }
                if (Input::get('creditor_id')) {
                    if (Input::get('debtor_id')) {
                        $transaction .= ' AND creditor_id=' . Input::get('creditor_id');
                    } else {
                        $transaction .= ' creditor_id=' . Input::get('creditor_id');
                    }

                }
                if (Input::get('currency')) {
                    if (Input::get('debtor_id') || Input::get('creditor_id')) {
                        $transaction .= ' AND (d_currency=' . Input::get('currency') . ' OR c_currency=' . Input::get('currency') . ')';
                    } else {
                        $transaction .= ' (d_currency=' . Input::get('currency') . ' OR c_currency=' . Input::get('currency') . ')';
                    }
                }

                $transaction .= ' ORDER BY debtor';
                $trans_data =  DB::select($transaction);

                $transaction_data = array();


                foreach ($trans_data as $ad) {
                    $transaction_data[] = (array) $ad;
                }

                if (empty($transaction_data)) {
                    echo 'No data to Be Export';
                    die;
                }

                $data['party_data'] = $party_data;
                $data['currency_data'] = $currency_data;
                $data['transaction_data'] =  $transaction_data;
                //$data['return_transaction'] =  $return_transaction;
                $data['party_join_curr'] = $party_join_curr;

                //return View::make('transaction/report', compact('data'));


                $sheet->loadView('transaction/transactionexcel', $data);
            });
        })->download('xls');
    }

    public function reportsearch()
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

        $transaction = 'SELECT *,
                      (SELECT id FROM party WHERE transaction.`debtor_id` = party.`id`) AS party_id,
                      (SELECT party_name FROM party WHERE transaction.`debtor_id` = party.`id`) AS debtor,
                      (SELECT currency_code FROM currency WHERE transaction.`d_currency` = currency.`id`) AS d_currency,
                      (SELECT currency_code FROM currency WHERE transaction.`c_currency` = currency.`id`) AS c_currency,
                      (SELECT party_name FROM party WHERE transaction.`creditor_id` = party.`id`) AS creditor FROM transaction';

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
            $transaction .= ' WHERE ';
        }

        if (Input::get('reference_id')) {
            $transaction .= ' reference_id="' . Input::get('reference_id').'"';
        }

        if (Input::get('debtor_id')) {
            if (Input::get('reference_id')) {
                $transaction .= ' AND debtor_id=' . Input::get('debtor_id');
            } else {
                $transaction .= ' debtor_id=' . Input::get('debtor_id');
            }
        }
        if (Input::get('creditor_id')) {
            if (Input::get('debtor_id') || Input::get('reference_id')) {
                $transaction .= ' AND creditor_id=' . Input::get('creditor_id');
            } else {
                $transaction .= ' creditor_id=' . Input::get('creditor_id');
            }

        }
        if (Input::get('currency')) {
            if (Input::get('debtor_id') || Input::get('creditor_id') || Input::get('reference_id')) {
                $transaction .= ' AND (d_currency=' . Input::get('currency') . ' OR c_currency=' . Input::get('currency') . ')';
            } else {
                $transaction .= ' (d_currency=' . Input::get('currency') . ' OR c_currency=' . Input::get('currency') . ')';
            }
        }
        /*
        if (Input::get('from')) {
            if (Input::get('received_from') || Input::get('sent_to') || Input::get('currency')) {
                $account .= ' AND created_at>date(' . Input::get('from') . ')';
            } else {
                $account .= ' created_at>date(' . Input::get('from') . ')';
            }

        }
        if (Input::get('to')) {
            if (Input::get('received_from') || Input::get('sent_to') || Input::get('currency') || Input::get('from')) {
                $account .= ' AND created_at<date(' . Input::get('to') . ')';
            } else {
                $account .= ' created_at<date(' . Input::get('to') . ')';
            }

        }*/
        $from = '';
        $to = '';
        if (Input::get('from')) {
            $from = date('Y-m-d H:i:s', strtotime(Input::get('from')));
        }
        if (Input::get('to')) {
            $to = date('Y-m-d H:i:s', strtotime(Input::get('to')));
        }

        if ($from || $to) {
            if (Input::get('debtor_id') || Input::get('creditor_id') || Input::get('currency') || Input::get('reference_id')) {
                if ($to && $from) {
                    $transaction .= ' AND (created_at BETWEEN "' .  $from . '" AND "' . $to . '")';
                } else if ($from){
                    $transaction .= ' AND created_at>"' . $from . '"';
                } else if ($to){
                    $transaction .= ' AND created_at<"' . $to . '"';
                }
            } else {
                if ($to && $from) {
                    $transaction .= ' (created_at BETWEEN "' .  $from . '" AND "' . $to . '")';
                } else if ($from) {
                    $transaction .= ' created_at>"' . $from . '"';
                } else if ($to) {
                    $transaction .= ' created_at<"' . $to . '"';
                }

            }
        }

//        if (Input::get('to')) {
//            if (Input::get('debtor_id') || Input::get('creditor_id') || Input::get('currency') || Input::get('from')) {
//                //$transaction .= ' AND created_at<date(' . Input::get('to') . ')';
//                $transaction .= ' AND created_at<date(' . Input::get('to') . ')';
//            } else {
//                $transaction .= ' created_at<date(' . Input::get('to') . ')';
//            }
//        }

        $transaction .= ' ORDER BY debtor';
        //echo $transaction; die;


        $transaction_data =  DB::select($transaction);

        $new = array();
        foreach($transaction_data as $ad) {
            $new[] = (array) $ad;

        }

        $return_transaction = array();

        foreach ($new as $key=>$val) {
            $return_transaction[$val['party_id']][] = $val;
        }

        $data['party_data'] = $party_data;
        $data['currency_data'] = $currency_data;
        $data['transaction_data'] =  $transaction_data;
        $data['return_transaction'] =  $return_transaction;
        $data['party_join_curr'] = $party_join_curr;

        return View::make('transaction/reportsearch', compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $number
     * @return Response
     */
    public function latestTransaction()
    {
        $data = array();
        $transaction = 'SELECT *,d_currency as dc,c_currency as cc,
                      (SELECT id FROM party WHERE transaction.`debtor_id` = party.`id`) AS party_id,
                      (SELECT party_name FROM party WHERE transaction.`debtor_id` = party.`id`) AS debtor,
                      (SELECT currency_code FROM currency WHERE transaction.`d_currency` = currency.`id`) AS d_currency,
                      (SELECT currency_code FROM currency WHERE transaction.`c_currency` = currency.`id`) AS c_currency,
                      (SELECT party_name FROM party WHERE transaction.`creditor_id` = party.`id`) AS creditor FROM transaction';

        if ($_POST['type'] == 'trans') {
           $transaction .= ' ORDER BY created_at DESC LIMIT ' . $_POST['total_trans_no'];
        }

        $data['party_id'] = 0;
        if ($_POST['type'] == 'party') {
            $data['party_id'] = $_POST['party_name'];
            $transaction .= ' WHERE debtor_id=' . $_POST['party_name'] .' OR ' . 'creditor_id=' . $_POST['party_name'] .' ORDER BY created_at DESC';
        }

        $data['currency_code'] = 0;
        if ($_POST['type'] == 'currency') {
            $data['currency_code'] = $_POST['currency_code'];
            $transaction .= ' WHERE d_currency=' . $_POST['currency_code'] .' OR ' . 'c_currency=' . $_POST['currency_code'] .' ORDER BY created_at DESC';
        }

        $transaction_data =  DB::select($transaction);

        $party_join_curr = DB::table('party')
            ->Join('currency', 'currency.id', '=', 'party.currency_id')
            ->select('party.*', 'currency.id as currency_id', 'currency.currency_code')
            ->get();


        $data['transaction_data'] =  $transaction_data;
        $data['party_join_curr'] = $party_join_curr;

        $html = View::make('transaction/latestTransaction', compact('data'))->render();
        echo $html;
    }
}
