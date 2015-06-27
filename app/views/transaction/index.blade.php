@extends("layout")
@section("content")

    <div class="panel panel-default">
        <div class="panel-heading">Teller</div>
        <div class="panel-body">
            <div class="col-sm-12">
                <table id="party" class="display table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Reference Id</th>
                        <th>Debtor</th>
                        <th>Creditor</th>
                        <th>Created At</th>
                        <th style="width: 120px;">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php $i=1 ?>
                    @foreach($data['trans'] as $list)
                        <tr>
                            <td>{{ $list->reference_id }}</td>
                            <td>{{ $list->debtor }}</td>
                            <td>{{ $list->creditor }}</td>
                            <td>{{ $list->created_at }}</td>
                            <td>
                                <a class="btn btn-small btn-info" href="{{ URL::to('transaction/' . $list->id . '/edit') }}">Edit</a>
                                <a class="btn btn-small btn-success" href="{{ URL::to('transaction/' . $list->id. '/delete') }}" onclick="if(!confirm('Are you sure?')){ return false;}">Delete</a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                    @endforeach

                    </tbody>
                </table>


            </div>

        </div>
    </div>

@stop
