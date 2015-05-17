@extends("layout")
@section("content")

  <div class="panel panel-default">
          <div class="panel-heading">Transaction</div>
          <div class="panel-body">
              <div class="col-sm-12">
                  <form action="<?php echo URL::to('/account/store'); ?>" method="POST" name="addTransfer" id="addTransfer">
                      <div class="row">

                          <div class="col-sm-12">

                              <div class="form-group">
                                  <label>Received</label>
                              </div>
                          </div>

                      </div>
                      <div class="row">

                      <div class="col-sm-3">
                          <div class="form-group">
                              <label for="party_from">Party From</label>
                              <input required="required" type="text" name="party_from" class="form-control" id="party_from"
                                     placeholder="ABC Group">
                          </div>
                      </div>

                      <div class="col-sm-3">
                            <div class="form-group">
                                <label for="currency_from">Currency</label>
                                <input required="required" type="text" name="currency_from" class="form-control" id="currency_from"
                                       placeholder="$">
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
                                  <label>Send</label>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                      <div class="col-sm-3">
                          <div class="form-group">
                              <label for="party_to">Party TO</label>
                              <input required="required" type="text" name="party_to" class="form-control" id="party_to"
                                     placeholder="XYZ Co.">
                          </div>
                      </div>

                          <div class="col-sm-3">
                              <div class="form-group">
                                  <label for="send_currency">Currency</label>
                                  <input required="required" name="send_currency" type="text" class="form-control" id="send_currency"
                                         placeholder="Currency">
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
                                  <input  name="totalamount" type="number" class="form-control" id="totalamount"
                                         placeholder="Total Amount">
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
<script type="text/javascript">
       function storeAmount(){
        var btn = jQuery("#store_amount")
           $.ajax({
           type: "POST",
           url: "<?php echo URL::to('/account/store'); ?>",
           data: jQuery("#addTransfer").serialize(),
           cache: false,
           beforeSend: function(){
                btn.button('loading')
               },

            success: function(server_response){
               setTimeout(function () {
                           btn.button('reset')
                       }, 3000)
                },

            error: function(){
                  },

         });

       }
    </script>
@stop
