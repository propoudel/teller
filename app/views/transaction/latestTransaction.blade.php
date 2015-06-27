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
        <th>Remaining Balance Local</th>
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
                if ($a->debtor_id == $data['party_id'] ) {
                    $total_dfc += $a->debit_fc ;
                    $total_dl += $a->debit_local;
                }
                if ($a->creditor_id == $data['party_id'] ) {
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
            <td><?php echo $total_cl - $total_dl; ?></td>
        </tr>
    </tbody>
</table>