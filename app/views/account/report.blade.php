@extends("layout")
@section("content")

    <div class="panel panel-default">
        <div class="panel-heading">Report{Under progres}</div>
        <div class="panel-body">

            <div class="col-sm-12">
                <?php
                    $received_from = isset($_GET['received_from']) ? $_GET['received_from'] : '';
                    $sent_to = isset($_GET['sent_to']) ? $_GET['sent_to'] : '';
                    $currency = isset($_GET['currency']) ? $_GET['currency'] : '';
                    $from = isset($_GET['from']) ? $_GET['from'] : '';
                    $to = isset($_GET['to']) ? $_GET['to'] : '';
                ?>
                <form>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="received_from">Party From</label>

                                <select name="received_from" id="received_from" class="form-control">
                                    <option value="">Select</option>
                                    @foreach($party_data as $list)

                                        <option <?php if($received_from==$list->id) {echo 'selected';} ?> data-currency="{{ $list->currency_id }}" value="{{ $list->id }}">{{ $list->party_name; }}</option>
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
                                        <option <?php if($sent_to==$list->id) {echo 'selected';} ?>  data-currency="{{ $list->currency_id }}" value="{{ $list->id }}">{{ $list->party_name; }}</option>
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
                                        <option <?php if($currency==$list->id) {echo 'selected';} ?>  data-currency="{{ $list->currency_id }}" value="{{ $list->id }}">{{ $list->currency_code; }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                    </div>
<!--
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="from_date">Date From</label>
                                <input class="form-control datepicker" value="<?php echo $from; ?>" name="from" type="text" placeholder="From Date">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="to_date">To Date</label>
                                <input type="text" class="form-control datepicker" value="<?php echo $to; ?>" name="to" id="to" placeholder="To Date">
                            </div>
                        </div>
-->
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

                                        <?php
                                            $debit = 0;
                                            $credit = 0;
                                        ?>

                                        @foreach($account_data as $a)
                                            {{--//<?php--}}
{{--                                                if ($a->calculatetype == 1) {--}}
{{--                                                    $ttm = $a->total_transferred_money;--}}
{{--                                                } else if ($a->calculatetype == 2) {--}}
{{--                                                    $ttm = $a->total_transferred_money * $a->sent_rate;--}}
{{--                                                } else if ($a->calculatetype == 3) {--}}
{{--                                                    $ttm = $a->total_transferred_money /  $a->sent_rate;--}}
{{--                                                }--}}
                                            {{--?>--}}

                                            <?php $credit += $a->total_transferred_money; ?>
                                            <?php $debit += $a->received_amount; ?>

                                            <?php
                                                    if ($p->id == $a->sent_to) { ?>
                                                        <tr>
                                                            <th scope="row"><?php //echo $sn; ?></th>
                                                            <td>{{ date("d-m-Y",strtotime($a->created_at)) }}</td>
                                                            <td>{{ $a->comment }}</td>
                                                            <td>{{ $a->received_name }}</td>
                                                            <td></td>
                                                            <td>{{ $a->total_transferred_money }}</td>
                                                            <td></td>
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
                                                <td></td>
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
                                    <tr>
                                        <td align="right" colspan="4"><b>Total</b></td>
                                        <td><?php echo $debit ; ?></td>
                                        <td><?php echo $credit ; ?></td>
                                        <td><?php echo $credit - $debit ; ?></td>
                                    </tr>
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


                </form>
                    <div class="row">
                        <div class="col-sm-12">
                            <button url="<?php echo URL::to('/account/export') . '?received_from=' . $received_from . '&sent_to='  . $sent_to .  '&currency=' . $currency . '&from=' . $from . '&to=' . $to; ?>" id="export" class="btn btn-primary pull-right">Export</button>
                        </div>
                    </div>

            </div>
        </div>
    </div>

    <script>
        $( ".datepicker" ).datepicker({
            dateFormat: "yy-mm-dd"
        });

        $("#export").click(function () {
            var url = $(this).attr('url');
            window.location.href = url;
            return false;
        });
    </script>

@stop
