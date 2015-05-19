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
                                <label for="party_from">Party From</label>

                                <select name="party_from" id="party_from" class="form-control">
                                    <option value="">Select</option>
                                    @foreach($party_data as $list)
                                        <option data-currency="{{ $list->currency_id }}" value="{{ $list->id }}">{{ $list->party_name; }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="party_from">Party To</label>

                                <select name="party_to" id="party_to" class="form-control" >
                                    <option value="">Select</option>
                                    @foreach($party_data as $list)
                                        <option data-currency="{{ $list->currency_id }}" value="{{ $list->id }}">{{ $list->party_name; }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="currency_from">Currency</label>
                                <select name="currency_from" id="currency_from" class="form-control">

                                    <option value="">Select</option>
                                    @foreach($currency_data as $list)
                                        <option data-currency="{{ $list->currency_id }}" value="{{ $list->id }}">{{ $list->currency_code; }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="from">Date From</label>
                                <input class="form-control datepicker" name="from" type="text" placeholder="From Date">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="to">To Date</label>
                                <input type="text" class="form-control datepicker" id="to" placeholder="To Date">
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
                                            <th>Party</th>
                                            <th>Date</th>
                                            <th>Details</th>
                                            <th>Rate</th>
                                            <th>Dr</th>
                                            <th>Cr</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    {{--*/ $sn = 1 /*--}}
                                    @foreach($account_data as $list)
                                        <tr>
                                            <td colspan="7"><b>Prakash</b></td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{ $sn; }}</th>
                                            <td>{{ $list->created_at; }}</td>
                                            <td>{{ $list->created_at; }}</td>
                                            <td>{{ $list->comment; }}</td>
                                            <td>{{ $list->sent_rate; }}</td>
                                            <td>{{ $list->received_amount; }}</td>
                                            <td>{{ $list->total_transferred_money; }}</td>
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
