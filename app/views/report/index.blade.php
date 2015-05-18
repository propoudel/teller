@extends("layout")
@section("content")

  <div class="panel panel-default">
          <div class="panel-heading">Currency</div>
          <div class="panel-body">
              <div class="col-sm-12">
                <div class="form-group">
                  <a href="/currency/create" class="btn btn-primary">Add New</a>
                 </div>

                 @if($errors->has())
                     @foreach($errors->all() as $message)
                      <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ $message }}
                      </div>
                     @endforeach
                  @endif

                 @if(Session::has('message'))
                     <div class="alert alert-info">
                     <button type="button" class="close" data-dismiss="alert">&times;</button>
                     {{ Session::get('message') }}
                   </div>
                 @endif



                <table id="currency" class="display table" cellspacing="0" width="100%">
                				<thead>
                					<tr>
                						<th>SN.</th>
                						<th>Currency Code</th>
                						<th>Rate</th>
                						<th style="width: 120px;">Action</th>

                					</tr>
                				</thead>

                				<tbody>
                				    <?php $i=1 ?>
                                    @foreach($data as $list)
                					<tr>
                						<td>{{ $i }}</td>
                						<td>{{ $list->currency_code }}</td>
                						<td>{{ $list->currency_rate }}</td>
                						<td>
                                            <a class="btn btn-small btn-info" href="{{ URL::to('currency/' . $list->id . '/edit') }}">Edit</a>
                                             <a class="btn btn-small btn-success" href="{{ URL::to('currency/' . $list->id. '/delete') }}" onclick="if(!confirm('Are you sure?')){ return false;}">Delete</a>
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
