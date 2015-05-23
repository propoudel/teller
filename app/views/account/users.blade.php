<table>
    <tbody>
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
    </tbody>
</table>