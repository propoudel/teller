@extends("layout")
@section("content")

  <div class="panel panel-default">
          <div class="panel-heading">Currency</div>
          <div class="panel-body">
              <div class="col-sm-12">
                  <form action="<?php echo URL::to('/party/store'); ?>" method="POST" name="addTransfer" id="addTransfer">
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
                                  <label>Add New Party</label>
                              </div>
                          </div>

                      </div>
                      <div class="row">

                          <div class="col-sm-6">
                            <div class="form-group">
                                <label for="currency_code">Party Name</label>
                                <input required="required" name="party_name" type="text" class="form-control" id="party_name"
                                       placeholder="Party Name">
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                                <label for="currency_code">Currency Code</label>
                                <input required="required" name="currency_code" type="text" class="form-control" id="currency_code"
                                       placeholder="Currency Code">
                            </div>
                          </div>

                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="currency_code">Currency Code</label>
                                  <select name="currency_code"class="form-control">
                                    <option value="volvo">Volvo</option>
                                    <option value="saab">Saab</option>
                                    <option value="mercedes">Mercedes</option>
                                    <option value="audi">Audi</option>
                                  </select>
                              </div>
                            </div>

                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="party_details">Party Details</label>
                                  <input required="required" name="party_details" type="text" class="form-control" id="party_details"
                                         placeholder="Party Details">
                              </div>
                          </div>
                      </div>

                      <div class="row">
                                                <div class="col-sm-12">
                                                    <button type="submit" id="store_currency"  class="btn btn-primary pull-right">Save</button>
                                                </div>
                                            </div>
              </form>

              </div>

          </div>
      </div>

@stop
