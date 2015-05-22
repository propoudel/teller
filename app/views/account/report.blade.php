@extends("layout")
@section("content")

    <div class="panel panel-default">
        <div class="panel-heading">Report{Under progres}</div>
        <div class="panel-body">

            <div class="col-sm-12">
                <form>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="received_from">Party From</label>

                                <select name="received_from" id="received_from" class="form-control">
                                    <option value="">Select</option>
                                    @foreach($party_data as $list)

                                        <option <?php if(isset($_GET['received_from']) && $_GET['received_from']==$list->id) {echo 'selected';} ?> data-currency="{{ $list->currency_id }}" value="{{ $list->id }}">{{ $list->party_name; }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="sent_to">Party To</label>

                                <select name="sent_to" id="sent_to" class="form-control" >
                                    <option value="">Select</option>
                                    @foreach($party_data as $list)
                                        <option <?php if(isset($_GET['sent_to']) && $_GET['sent_to']==$list->id) {echo 'selected';} ?>  data-currency="{{ $list->currency_id }}" value="{{ $list->id }}">{{ $list->party_name; }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="currency">Currency</label>
                                <select name="currency" id="currency" class="form-control">

                                    <option value="">Select</option>
                                    @foreach($currency_data as $list)
                                        <option <?php if(isset($_GET['currency']) && $_GET['currency']==$list->id) {echo 'selected';} ?>  data-currency="{{ $list->currency_id }}" value="{{ $list->id }}">{{ $list->currency_code; }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="from_date">Date From</label>
                                <input class="form-control datepicker" name="from" type="text" placeholder="From Date">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="to_date">To Date</label>
                                <input type="text" class="form-control datepicker" name="to" id="to" placeholder="To Date">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label> &nbsp; </label>

                                <button class=" form-control btn btn-primary">Search</button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="bs-example" data-example-id="bordered-table">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Date</th>
                                            <th>Party From</th>
                                            <th>Received Amount</th>
                                            <th>Rate</th>
                                            <th>Party To</th>
                                            <th>Total</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    {{--*/ $sn = 1 /*--}}
                                    @foreach($account_data as $list)
                                        {{--<tr>--}}
                                            {{--<td colspan="7"><b>{{ $list->received_name; }}</b></td>--}}
                                        {{--</tr>--}}

                                        <tr>
                                            <th scope="row">{{ $sn }}</th>
                                            <td>{{ date("d-m-Y",strtotime($list->created_at)) }}</td>
                                            <td>{{ $list->received_name }}</td>
                                            <td>{{ $list->received_amount }}</td>
                                            <td>{{ $list->sent_rate }}</td>
                                            <td>{{ $list->sent_name }}</td>
                                            <td>{{ $list->total_transferred_money }}</td>
                                            <td>{{ $list->comment }}</td>
                                        </tr>
                                    {{--*/ $sn++ /*--}}
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <nav class="pull-right">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <button class="btn btn-primary pull-right">Export</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@stop
