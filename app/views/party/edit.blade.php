@extends("layout")
@section("content")

  <div class="panel panel-default">
          <div class="panel-heading">Party</div>
          <div class="panel-body">
              <div class="col-sm-12">
                  <form action="<?php echo URL::to('/party/update'); ?>" method="POST" name="addTransfer" id="addTransfer">
                      <div class="row">

                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label>Edit Party</label>
                              </div>
                          </div>

                      </div>

                      <div class="row">

                          <div class="col-sm-6">
                            <div class="form-group">
                                <label for="currency_code">Party Name</label>
                                <input required="required" name="party_name" type="text" value="{{ $data['item']->party_name }}" class="form-control" id="party_name"
                                       placeholder="Party Name">
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                                <label for="currency_code">Currency Code</label>
                                <select name="currency_code"class="form-control">
                                    <?php foreach($data['currency'] as $list) { ?>
                                    <option <?php echo $list->id == $data['item']->currency_id ? "selected" : "" ?> value="{{  $list->id }}}}">{{ $list->currency_code }}</option>
                                    <?php } ?>
                                </select>
                            </div>
                          </div>

                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="party_details">Party Details</label>
                                  <input required="required" name="party_details" type="text" value="{{ $data['item']->party_details }}" class="form-control" id="party_details"
                                         placeholder="Party Details">
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-sm-12">
                          <input type="hidden" name="id" value="{{ $data['item']->id }}">
                          <button type="submit" id="store_currency" class="btn btn-primary pull-right">Update</button>
                          </div>
                        </div>
                  </form>

              </div>

          </div>
      </div>

@stop
