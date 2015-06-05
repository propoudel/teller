@extends("layout")
@section("content")

    <div class="panel panel-default">
        <div class="panel-heading">Teller</div>
        <div class="panel-body">
            <div class="col-sm-12">
                <table id="party" class="display table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>SN.</th>
                        <th>Debtor</th>
                        <th>Creditor</th>
                        <!--<th style="width: 120px;">Action</th>-->
                    </tr>
                    </thead>

                    <tbody>
                    <?php $i=1 ?>
                    @foreach($data['trans'] as $list)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $list->debtor }}</td>
                            <td>{{ $list->creditor }}</td>

                            <!--<td>
                                <a class="btn btn-small btn-info" href="{{ URL::to('account/' . $list->id . '/edit') }}">Edit</a>
                                <a class="btn btn-small btn-success" href="{{ URL::to('account/' . $list->id. '/delete') }}" onclick="if(!confirm('Are you sure?')){ return false;}">Delete</a>
                            </td>-->

                        </tr>
                        <?php $i++ ?>
                    @endforeach

                    </tbody>
                </table>


            </div>

        </div>
    </div>

@stop
