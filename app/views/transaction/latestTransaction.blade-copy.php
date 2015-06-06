<table class="table table-bordered">
    <thead>
    <tr style="background-color: #229ab7;">
        <th>Date</th>
        <th>Party</th>
        <th>Detail</th>
        <th>Debit_FC</th>
        <th>Credit_FC</th>
        <th>Debit</th>
        <th>Credit</th>
        {{--<th>Balance</th>--}}
    </tr>
    </thead>

    <tbody>
    @foreach($data['party_join_curr'] as $p)
        <tr style="background-color: #C0C0C0;">
            <td colspan="8"><b>{{ $p->party_name; }}({{ $p->currency_code; }})</b></td>
        </tr>
        @foreach($data['transaction_data'] as $a)
            <?php
            if ($p->id == $a->creditor_id) { ?>
            <tr>
                <td>{{ date("d-m-Y",strtotime($a->created_at)) }}</td>
                <td>{{ $a->debtor }}({{ $a->d_currency }})</td>
                <td>{{ $a->comment }}</td>
                <td></td>
                <td>{{ $a->credit_fc }}</td>
                <td></td>
                <td>{{ $a->credit_local }}</td>
                {{--<td></td>--}}
            </tr>
            <?php
            }
            ?>
            <?php
            if ($p->id == $a->debtor_id) { ?>
            <tr>
                <td>{{ date("d-m-Y",strtotime($a->created_at)) }}</td>
                <td>{{ $a->creditor }}({{ $a->c_currency }})</td>
                <td>{{ $a->comment }}</td>
                <td>{{ $a->debit_fc }}</td>
                <td></td>
                <td>{{ $a->debit_local }}</td>
                <td></td>
                {{--<td></td>--}}
            </tr>
            <?php
            }
            ?>
        @endforeach
    @endforeach
    </tbody>
</table>