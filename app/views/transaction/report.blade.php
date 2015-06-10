@extends("layout")
@section("content")

    <div class="panel panel-default">
        <div class="panel-heading">Report</div>
        <div class="panel-body">

            <div class="col-sm-12">
                <?php
                    $debtor_id = isset($_GET['debtor_id']) ? $_GET['debtor_id'] : '';
                    $creditor_id = isset($_GET['creditor_id']) ? $_GET['creditor_id'] : '';
                    $currency = isset($_GET['currency']) ? $_GET['currency'] : '';
                    $from = isset($_GET['from']) ? $_GET['from'] : '';
                    $to = isset($_GET['to']) ? $_GET['to'] : '';

                    $set_condition = 0;
                    if (!empty($debtor_id) || !empty($creditor_id) || !empty($currency)) {
                        $set_condition = 1;
                    }

                ?>
                <form>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="debtor_id">Debtor</label>
                                <select name="debtor_id" id="debtor_id" class="form-control">
                                    <option value="">Select</option>
                                    @foreach($data['party_data'] as $list)
                                        <option <?php if($debtor_id==$list->id) {echo 'selected';} ?> data-currency="{{ $list->currency_id }}" value="{{ $list->id }}">{{ $list->party_name; }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="creditor_id">Creditor</label>
                                <select name="creditor_id" id="creditor_id" class="form-control" >
                                    <option value="">Select</option>
                                    @foreach($data['party_data'] as $list)
                                        <option <?php if($creditor_id==$list->id) {echo 'selected';} ?>  data-currency="{{ $list->currency_id }}" value="{{ $list->id }}">{{ $list->party_name; }}</option>
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
                                        <tr style="background-color: #229ab7;color:white;">
                                            <th>Ref. ID</th>
                                            <th>Party</th>
                                            <th>Detail</th>
                                            <th>Debit_FC</th>
                                            <th>Credit_FC</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php if (empty($data['transaction_data'])) { ?>
                                    <tr>
                                        <td colspan="6">There Is No Any Transaction For Selected One.</td>
                                    </tr>
                                    <?php } ?>
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
                                            <?php $credit += $a->credit_local; ?>
                                            <?php $debit += $a->debit_local; ?>

                                            <?php
                                                    if ($p->id == $a->creditor_id) { ?>
                                                        <?php $credit_fc += $a->credit_fc; ?>
                                                        <?php $credit_per_party += $a->credit_local; ?>

                                                        <tr>
                                                            {{--<td>{{ date("d-m-Y",strtotime($a->created_at)) }}</td>--}}
                                                            <td>{{ $a->reference_id  }}</td>
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
                                                {{--<td>{{ date("d-m-Y",strtotime($a->created_at)) }}</td>--}}
                                                <td>{{ $a->reference_id  }}</td>
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
                                        @endforeach
                                        <?php if ($set_condition == 0) { ?>
                                        <tr  align="right">
                                            <td colspan="3"><b>Balance FC</b></td>
                                            <td colspan="2"><b><?php echo $credit_fc - $debit_fc; ?></b></td>
                                            <td colspan="2"><b>Balance Local</b></td>
                                            <td><b><?php echo $credit_per_party - $debit_per_party; ?></b></td>
                                        </tr>
                                        <?php } ?>
                                    @endforeach
                                    <?php if ($set_condition == 0) { ?>
                                    <tr align="right">
                                        <td align="right" colspan="5"><b>Total Balance</b></td>
                                        <td><?php echo $debit ; ?></td>
                                        <td><?php echo $credit ; ?></td>
                                        <td><?php echo $credit - $debit ; ?></td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <nav class="pull-right">
                        </div>
                    </div>

                </form>
                    <div class="row">
                        <div class="col-sm-12">
                            <button url="<?php echo URL::to('/transaction/export') . '?debtor_id=' . $debtor_id . '&creditor_id='  . $creditor_id .  '&currency=' . $currency . '&from=' . $from . '&to=' . $to; ?>" id="export" class="btn btn-primary pull-right">Export</button>
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
