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

                                        <option <?php if($_GET['received_from']==$list->id) {echo 'selected';} ?> data-currency="{{ $list->currency_id }}" value="{{ $list->id }}">{{ $list->party_name; }}</option>
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
                                        <option <?php if($_GET['sent_to']==$list->id) {echo 'selected';} ?>  data-currency="{{ $list->currency_id }}" value="{{ $list->id }}">{{ $list->party_name; }}</option>
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
                                        <option <?php if($_GET['currency']==$list->id) {echo 'selected';} ?>  data-currency="{{ $list->currency_id }}" value="{{ $list->id }}">{{ $list->currency_code; }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="from_date">Date From</label>
                                <input class="form-control datepicker" value="<?php echo $_GET['from'] ?>" name="from" type="text" placeholder="From Date">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="to_date">To Date</label>
                                <input type="text" class="form-control datepicker" value="<?php echo $_GET['to'] ?>" name="to" id="to" placeholder="To Date">
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
                                            <th>Detail</th>
                                            <th>Party</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>




                                    <tbody>
                                    @foreach($party_data as $p)

                                        <tr>
                                            <td colspan="7"><b>{{ $p->party_name; }}</b></td>
                                        </tr>

                                        @foreach($account_data as $a)

                                            <?php
                                                    if ($p->id == $a->sent_to) { ?>
                                                        <tr>
                                                            <th scope="row"><?php //echo $sn; ?></th>
                                                            <td>{{ date("d-m-Y",strtotime($a->created_at)) }}</td>
                                                            <td>{{ $a->comment }}</td>
                                                            <td>{{ $a->received_name }}</td>
                                                            <td></td>
                                                            <td>{{ $a->total_transferred_money }}</td>
                                                            <td>Balance</td>
                                                        </tr>
                                            <?php
                                                    }
                                            ?>
                                            <?php
                                            if ($p->id == $a->received_from) { ?>
                                            <tr>
                                                <th scope="row"><?php //echo $sn; ?></th>
                                                <td>{{ date("d-m-Y",strtotime($a->created_at)) }}</td>
                                                <td>{{ $a->comment }}</td>
                                                <td>{{ $a->sent_name }}</td>
                                                <td>{{ $a->received_amount }}</td>
                                                <td></td>
                                                <td>Balance</td>
                                            </tr>
                                            <?php
                                            }
                                            ?>

                                        {{--<?php $sn = 1; ?>--}}
                                        {{--@foreach($list_first as $list)--}}
                                            {{--<tr>--}}
                                                {{--<th scope="row"><?php echo $sn; ?></th>--}}
                                                {{--<td>{{ date("d-m-Y",strtotime($list['created_at'])) }}</td>--}}
                                                {{--<td>{{ $list['comment'] }}</td>--}}
                                                {{--<td>{{ $list['sent_name'] }}</td>--}}
                                                {{--<td>{{ $list['received_amount'] }}</td>--}}
                                                {{--<td>{{ $list['total_transferred_money'] }}</td>--}}
                                                {{--<td></td>--}}
                                                {{--<td>Balance</td>--}}

                                            {{--</tr>--}}
                                            {{--<?php $sn++; ?>--}}
                                        @endforeach
                                    @endforeach
                                    </tbody>





                                    {{--<tbody>--}}

                                    {{--@foreach($return_account as $list_first)--}}
                                        {{--<tr>--}}
                                            {{--<td colspan="7"><b>{{ $list_first[0]['received_name']; }}</b></td>--}}
                                        {{--</tr>--}}

                                            {{--<?php $sn = 1; ?>--}}
                                        {{--@foreach($list_first as $list)--}}
                                            {{--<tr>--}}
                                                {{--<th scope="row"><?php echo $sn; ?></th>--}}
                                                {{--<td>{{ date("d-m-Y",strtotime($list['created_at'])) }}</td>--}}
                                                {{--<td>{{ $list['comment'] }}</td>--}}
                                                {{--<td>{{ $list['sent_name'] }}</td>--}}
                                                {{--<td>{{ $list['received_amount'] }}</td>--}}
                                                {{--<td>{{ $list['total_transferred_money'] }}</td>--}}
                                                {{--<td></td>--}}
                                                {{--<td>Balance</td>--}}

                                            {{--</tr>--}}
                                            {{--<?php $sn++; ?>--}}
                                        {{--@endforeach--}}
                                    {{--@endforeach--}}
                                    {{--</tbody>--}}
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

    <script>
        $( '.datepicker').datepicker();
    </script>

@stop
