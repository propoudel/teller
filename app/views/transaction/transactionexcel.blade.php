<?php
$set_condition = 0;
if (!empty($_GET['debtor_id']) || !empty($_GET['creditor_id']) || !empty($_GET['currency'])) {
    $set_condition = 1;
}
?>
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
        <th>Balance</th>
    </tr>
    </thead>

    <tbody>
    @foreach($party_join_curr as $p)
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

        @foreach($transaction_data as $a)
            <?php $credit += $a['credit_local']; ?>
            <?php $debit += $a['debit_local']; ?>

            <?php
            if ($p->id == $a['creditor_id']) { ?>
            <?php $credit_fc += $a['credit_fc']; ?>
            <?php $credit_per_party += $a['credit_local']; ?>

            <tr>
                <td>{{ date("d-m-Y",strtotime($a['created_at'])) }}</td>
                <td>{{ $a['debtor'] }}({{ $a['d_currency'] }})</td>
                <td>{{ $a['comment'] }}</td>
                <td></td>
                <td>{{ $a['credit_fc'] }}</td>
                <td></td>
                <td>{{ $a['credit_local'] }}</td>
                <td></td>
            </tr>
            <?php
            }
            ?>
            <?php
            if ($p->id == $a['debtor_id']) { ?>
            <?php $debit_fc += $a['debit_fc']; ?>
            <?php $debit_per_party += $a['debit_local']; ?>
            <tr>
                <td>{{ date("d-m-Y",strtotime($a['created_at'])) }}</td>
                <td>{{ $a['creditor'] }}({{ $a['c_currency'] }})</td>
                <td>{{ $a['comment'] }}</td>
                <td>{{ $a['debit_fc'] }}</td>
                <td></td>
                <td>{{ $a['debit_local'] }}</td>
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