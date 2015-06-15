@extends("layout")
@section("content")

  <div class="panel panel-default">
          <div class="panel-heading">Party</div>
          <div class="panel-body">
              <div class="col-sm-12">
                <div class="form-group">
                  <a href="/party/create" class="btn btn-primary">Add New</a>
                 </div>

                <table id="party" class="display table" cellspacing="0" width="100%">
                				<thead>
                					<tr>
                						<th>SN.</th>
                						<th>Party Name</th>
                						<th>Currency</th>
                						<th>Party Details</th>
                						<th style="width: 120px;">Action</th>

                					</tr>
                				</thead>

                				<tbody>
                				    <?php $i=1 ?>
                                    <?php //print_r(app('party')->first()['party_name']); die; ?>
                                    @foreach($data['party_data'] as $list)
                					<tr>
                						<td>{{ $i }}</td>
                						<td>{{ $list['party_name'] }}</td>
                						<td><?php foreach($data['currency_data'] as $c_list) { if ($c_list['id'] == $list['currency_id']) {?>{{ $c_list['currency_code'] }}<?php }} ?></td>
                						<td>{{ $list['party_details'] }}</td>
                						<td>
                                            <a class="btn btn-small btn-info" href="{{ URL::to('party/' . $list->id . '/edit') }}">Edit</a>
                                             <a class="btn btn-small btn-success" href="{{ URL::to('party/' . $list->id. '/delete') }}" onclick="if(!confirm('Are you sure?')){ return false;}">Delete</a>
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
