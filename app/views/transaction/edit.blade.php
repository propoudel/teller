@extends("layout")
@section("content")

  <div class="panel panel-default">
          <div class="panel-heading">Transaction</div>
          <div class="panel-body">
              <div class="col-sm-12">
                  <form action="<?php echo URL::to('/transaction/update'); ?>" method="POST" name="transaction" id="transaction">
                      <div class="row">
                          <div class="col-sm-12">
                                @if($errors->has())
                                  @foreach($errors->all() as $message)
                              		<div class="alert alert-info">
                              		  <button type="button" class="close" data-dismiss="alert">&times;</button>
                              		  {{ $message }}
                              		</div>
                                  @endforeach
                              	@endif
                              <div class="form-group">
                                  <label>Edit Transaction</label>
                              </div>
                          </div>

                      </div>
                      <div class="row">
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="created_at">Created Date</label>
                                  <input required="required" type="text" name="created_at" class="form-control datepicker" id="created_at"
                                         placeholder="Created At" value="{{ date('m/d/Y' , strtotime($data['transaction']->created_at)) }}">

                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-sm-12">
                               <input type="hidden" name="id" value="{{ $data['transaction']->id }}">
                              <button type="submit" id="store_currency"  class="btn btn-primary pull-right">Update</button>
                          </div>
                      </div>
                  </form>

              </div>

          </div>
      </div>
<script>
    $('.datepicker').datepicker();
</script>
@stop
