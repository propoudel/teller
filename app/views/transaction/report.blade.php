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
                                <label for="debtor">Debtor</label>
                                <select name="debtor" id="debtor" class="form-control">
                                    <option value="">Select</option>
                                    @foreach($data['party_data'] as $list)
                                        <option <?php if($received_from==$list->id) {echo 'selected';} ?> data-currency="{{ $list->currency_id }}" value="{{ $list->id }}">{{ $list->party_name; }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="sent_to">Creditor</label>
                                <select name="creditor" id="creditor" class="form-control" >
                                    <option value="">Select</option>
                                    @foreach($data['party_data'] as $list)
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
                                    @foreach($data['currency_data'] as $list)
                                        <option <?php if($currency==$list->id) {echo 'selected';} ?>  data-currency="{{ $list->currency_id }}" value="{{ $list->id }}">{{ $list->currency_code; }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!--                        <div class="col-sm-4">
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
                                        <tr style="background-color: #229ab7;">
                                            {{--<th>SN</th>--}}
                                            <th>Date</th>
                                            <th>Party</th>
                                            <th>Detail</th>
                                            <th>Debit_FC</th>
                                            <th>Credit_FC</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            {{--<th>Balance FC</th>--}}
                                            <th>Balance</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($data['party_join_curr'] as $p)
                                        <tr style="background-color: #C0C0C0;">
                                            <td colspan="8"><b>{{ $p->party_name; }}({{ $p->currency_code; }})</b></td>
                                        </tr>

                                        <?php
                                            $debit = 0;
                                            $credit = 0;
                                            $debit_per_party = 0;
                                            $credit_per_party = 0;
                                            $debit_fc = 0;
                                            $credit_fc = 0;
                                        ?>

                                        @foreach($data['transaction_data'] as $a)
                                            {{--//<?php--}}
{{--                                                if ($a->calculatetype == 1) {--}}
{{--                                                    $ttm = $a->total_transferred_money;--}}
{{--                                                } else if ($a->calculatetype == 2) {--}}
{{--                                                    $ttm = $a->total_transferred_money * $a->sent_rate;--}}
{{--                                                } else if ($a->calculatetype == 3) {--}}
{{--                                                    $ttm = $a->total_transferred_money /  $a->sent_rate;--}}
{{--                                                }--}}
                                            {{--?>--}}

                                            <?php $credit += $a->credit_local; ?>
                                            <?php $debit += $a->debit_local; ?>

                                            <?php
                                                    if ($p->id == $a->creditor_id) { ?>
                                                        <?php $credit_fc += $a->credit_fc; ?>
                                                        <?php $credit_per_party += $a->credit_local; ?>

                                                        <tr>
                                                            {{--<th scope="row"><?php //echo $sn; ?></th>--}}
                                                            <td>{{ date("d-m-Y",strtotime($a->created_at)) }}</td>
                                                            <td>{{ $a->debtor }}({{ $a->d_currency }})</td>
                                                            <td>{{ $a->comment }}</td>
                                                            <td></td>
                                                            <td>{{ $a->credit_fc }}</td>
                                                            <td></td>
                                                            <td>{{ $a->credit_local }}</td>
                                                            <td></td>
                                                        </tr>
                                            <?php
                                                    }
                                            ?>
                                            <?php
                                                    if ($p->id == $a->debtor_id) { ?>
                                                    <?php $debit_fc += $a->debit_fc; ?>
                                                    <?php $debit_per_party += $a->debit_local; ?>
                                            <tr>
                                                {{--<th scope="row"><?php //echo $sn; ?></th>--}}
                                                <td>{{ date("d-m-Y",strtotime($a->created_at)) }}</td>
                                                <td>{{ $a->creditor }}({{ $a->c_currency }})</td>
                                                <td>{{ $a->comment }}</td>
                                                <td>{{ $a->debit_fc }}</td>
                                                <td></td>
                                                <td>{{ $a->debit_local }}</td>
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
                                        <tr  align="right">
                                            <td colspan="3"><b>Balance FC</b></td>
                                            <td colspan="2"><b><?php echo $credit_fc - $debit_fc; ?></b></td>
                                            <td colspan="2"><b>Balance Local</b></td>
                                            <td><b><?php echo $credit_per_party - $debit_per_party; ?></b></td>
                                        </tr>
                                    @endforeach
                                    <tr align="right">
                                        <td align="right" colspan="5"><b>Total Balance</b></td>
                                        <td><?php echo $debit ; ?></td>
                                        <td><?php echo $credit ; ?></td>
                                        <td><?php echo $credit - $debit ; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <nav class="pull-right">
                        </div>
                    </div>

                </form>
                    <div class="row">
                        <div class="col-sm-12">
                            <button url="<?php echo URL::to('/transaction/export') . '?received_from=' . $received_from . '&sent_to='  . $sent_to .  '&currency=' . $currency . '&from=' . $from . '&to=' . $to; ?>" id="export" class="btn btn-primary pull-right">Export</button>
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
