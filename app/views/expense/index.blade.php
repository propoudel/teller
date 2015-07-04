@extends("layout")
@section("content")

  <div class="panel panel-default">
          <div class="panel-heading">Expense</div>
          <div class="panel-body">
              <div class="col-sm-12">
                <div class="form-group">
                  <a href="/expense/create" class="btn btn-primary">Add New</a>
                 </div>

                <table id="party" class="display table" cellspacing="0" width="100%">
                				<thead>
                					<tr>
                						<th>SN.</th>
                						<th>Name</th>
                						<th>Amount</th>
                						<th>Details</th>
                						<th style="width: 120px;">Action</th>
                					</tr>
                				</thead>

                				<tbody>
                				    <?php $i=1 ?>
                                    <?php //print_r(app('party')->first()['party_name']); die; ?>
                                    @foreach($data['expense_data'] as $list)
                					<tr>
                						<td>{{ $i }}</td>
                						<td>{{ $list['name'] }}</td>
                						<td>{{ $list['amount'] }}</td>
                						<td>{{ $list['details'] }}</td>
                						<td>
                                            <a class="btn btn-small btn-info" href="{{ URL::to('expense/' . $list->id . '/edit') }}">Edit</a>
                                             <a class="btn btn-small btn-success" href="{{ URL::to('expense/' . $list->id. '/delete') }}" onclick="if(!confirm('Are you sure?')){ return false;}">Delete</a>
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
