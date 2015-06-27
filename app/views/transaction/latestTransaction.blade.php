<?php
$pid = $data['party_id'];
$cid = $data['currency_code'];
?>
<table class="table table-bordered">
    <thead>
    <tr style="background-color: #229ab7;color:white;">
        {{--<th>Date</th>--}}
        {{--<th>Debtor</th>--}}
        {{--<th>Creditor</th>--}}
        {{--<th>Detail</th>--}}
        {{--<th>Debit_FC</th>--}}
        {{--<th>Credit_FC</th>--}}
        {{--<th>Debit Local</th>--}}
        {{--<th>Credit Local</th>--}}
        <th>Remaining Balance FC</th>
        <?php if (!$cid){ ?><th>Remaining Balance Local; </th><?php } ?>
    </tr>
    </thead>

    <tbody>
        <?php
            $total_dfc = 0; $total_cfc = 0; $total_dl = 0; $total_cl = 0;
        ?>
        <?php if (empty($data['transaction_data'])) { ?>
            {{--<tr>--}}
                {{--<td colspan="6">There Is No Any Transaction For Selected One.</td>--}}
            {{--</tr>--}}
        <?php } ?>
        @foreach($data['transaction_data'] as $a)
            <?php
                    //print_r($a); die;

                if ($pid && $a->debtor_id == $pid) {
                    $total_dfc += $a->debit_fc ;
                    $total_dl += $a->debit_local;
                }
                if ($pid && $a->creditor_id == $pid) {
                    $total_cfc += $a->credit_fc;
                    $total_cl += $a->credit_local;
                }
                if ($cid && $a->dc == $cid) {
                    $total_dfc += $a->debit_fc ;
                    $total_dl += $a->debit_local;
                }
                if ($cid && $a->cc == $cid) {
                    $total_cfc += $a->credit_fc;
                    $total_cl += $a->credit_local;
                }
                ?>
            <tr>
                {{--<td>{{ date("d-m-Y",strtotime($a->created_at)) }}</td>--}}
                {{--<td>{{ $a->debtor }}({{ $a->d_currency }})</td>--}}
                {{--<td>{{ $a->creditor }}({{ $a->c_currency }})</td>--}}
                {{--<td>{{ $a->comment }}</td>--}}
                {{--<td>{{ $a->debit_fc }}</td>--}}
                {{--<td>{{ $a->credit_fc }}</td>--}}
                {{--<td>{{ $a->debit_local }}</td>--}}
                {{--<td>{{ $a->credit_local }}</td>--}}
                {{--<td></td>--}}
            </tr>

        @endforeach
        <tr>
            <td><?php echo $total_cfc - $total_dfc; ?></td>
            <?php if (!$cid) { ?><td> <?php echo $total_cl - $total_dl; ?></td><?php } ?>
        </tr>
    </tbody>
</table>