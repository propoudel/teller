@extends("layout")
@section("content")

  <div class="panel panel-default">
          <div class="panel-heading">Report</div>
          <div class="panel-body">
              <div class="col-sm-12">
                  <form action="<?php echo URL::to('/report/create'); ?>" method="POST">

                      <div class="row">

                      <div class="col-sm-3">
                          <div class="form-group">
                              <label for="party_from">Party From</label>

                             <select name="party_from" id="party_from" class="form-control" onChange="getFromCurrency()">
                             <option value="">-Select-</option>

                             </select>

                          </div>
                      </div>

                      <div class="col-sm-3">
                            <div class="form-group">
                                <label for="currency_from">Currency</label>
                                <select name="currency_from" id="currency_from" class="form-control">

                                        <option value="">Select</option>

                                </select>

                            </div>
                        </div>

                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="amount">Total Amount</label>
                                  <input required="required" name="amount" type="number" class="form-control" id="amount"
                                         placeholder="Amount">
                              </div>
                          </div>


                      </div>

                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label></label>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                      <div class="col-sm-3">
                          <div class="form-group">
                              <label for="party_to">Party TO</label>
                              <select name="party_to" id="party_to" class="form-control" onChange="getToCurrency()">
                              <option value="">-Select-</option>

                               </select>
                          </div>
                      </div>

                          <div class="col-sm-3">
                              <div class="form-group">
                                  <label for="send_currency">Currency</label>
                                     <select name="send_currency" class="form-control" id="send_currency">

                                             <option value="">Select</option>

                                     </select>
                              </div>
                          </div>

                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="rate">Rate</label>
                                  <input required="required" name="rate" type="number" class="form-control" id="rate"
                                         placeholder="Rate">
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label for="totalamount">Total Amount To Send</label>
                                  <input  name="totalamount" type="number" value="" class="form-control" id="totalamount"
                                         placeholder="Total Amount" readonly>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label for="detail">Detail</label>
                                  <textarea  name="details" id="detail" class="form-control"></textarea>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-sm-12">
                              <button type="submit" id="store_amount"  class="btn btn-primary pull-right">Send Amount</button>
                          </div>
                      </div>
                  </form>

              </div>

          </div>
      </div>

@stop
