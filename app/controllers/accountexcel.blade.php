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
            <td colspan="7"><b>{{ $p['party_name'] }}</b></td>
        </tr>

        <?php
            $debit = 0;
            $credit = 0;
        ?>

        @foreach($account_data as $a)
            <?php $credit += $a['total_transferred_money']; ?>
            <?php $debit += $a['received_amount']; ?>

            <?php
            if ($p['id'] == $a['sent_to']) { ?>
            <tr>
                <th scope="row"><?php //echo $sn; ?></th>
                <td>{{ date("d-m-Y",strtotime($a['created_at'])) }}</td>
                <td>{{ $a['comment'] }}</td>
                <td>{{ $a['received_name'] }}</td>
                <td></td>
                <td>{{ $a['total_transferred_money'] }}</td>
                <td></td>
            </tr>
            <?php
            }
            ?>
            <?php
            if ($p['id'] == $a['received_from']) { ?>
            <tr>
                <th scope="row"><?php //echo $sn; ?></th>
                <td>{{ date("d-m-Y",strtotime($a['created_at'])) }}</td>
                <td>{{ $a['comment'] }}</td>
                <td>{{ $a['sent_name'] }}</td>
                <td>{{ $a['received_amount'] }}</td>
                <td></td>
                <td></td>
            </tr>
            <?php
            }
            ?>
        @endforeach
    @endforeach
    <tr>
        <td align="right" colspan="4"><b>Total</b></td>
        <td><?php echo $debit ; ?></td>
        <td><?php echo $credit ; ?></td>
        <td><?php echo $credit - $debit ; ?></td>
    </tr>
    </tbody>
</table>