<table class="table table-bordered">
    <thead>
    <tr style="background-color: #229ab7;">
        <th>Date</th>
        <th>Debtor</th>
        <th>Creditor</th>
        <th>Detail</th>
        <th>Debit_FC</th>
        <th>Credit_FC</th>
        <th>Debit Local</th>
        <th>Credit Local</th>
        {{--<th>Balance</th>--}}
    </tr>
    </thead>

    <tbody>
        @foreach($data['transaction_data'] as $a)
                <td>{{ date("d-m-Y",strtotime($a->created_at)) }}</td>
                <td>{{ $a->debtor }}({{ $a->d_currency }})</td>
                <td>{{ $a->creditor }}({{ $a->c_currency }})</td>
                <td>{{ $a->comment }}</td>
                <td>{{ $a->debit_fc }}</td>
                <td>{{ $a->credit_fc }}</td>
                <td>{{ $a->debit_local }}</td>
                <td>{{ $a->credit_local }}</td>
                {{--<td></td>--}}
            </tr>
        @endforeach
    </tbody>
</table>