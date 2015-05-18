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
                                  <label></label>
                              </div>
                          </div>

                      </div>
                      <div class="row">

                      <div class="col-sm-3">
                          <div class="form-group">
                              <label for="party_from">Party From</label>

                             <select name="party_from" id="party_from" class="form-control" onChange="getFromCurrency()">
                             @foreach($data['party_data'] as $list)
                             <option data-currency="{{ $list->currency_id }}" value="{{ $list->id }}">{{ $list->party_name; }}</option>
                              @endforeach
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
                               @foreach($data['party_data'] as $list)
                               <option data-currency="{{ $list->currency_id }}" value="{{ $list->id }}">{{ $list->party_name; }}</option>
                                @endforeach
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
<script type="text/javascript">
       function getFromCurrency(){
        var id = $("#party_from").find(':selected').data('currency');

           $.ajax({
           type: "POST",
           dataType: "json",
           url: "<?php echo URL::to('/currency/find'); ?>",
           data: {id:id},
           cache: false,
            success: function(server_response){
                    //currency_from
                        $('#currency_from').find('option').remove();
                       // $('#currency_from').prop("disabled", false);
                        $('#currency_from').append($('<option>').text(server_response.currency_code).attr('value', server_response.id));

                },
            error: function(error){
                    console.log(error);
                  },
         });
       }

       function getToCurrency(){
               var id = $("#party_to").find(':selected').data('currency');

                  $.ajax({
                  type: "POST",
                  dataType: "json",
                  url: "<?php echo URL::to('/currency/find'); ?>",
                  data: {id:id},
                  cache: false,
                   success: function(server_response){
                           //currency_from
                               $('#send_currency').find('option').remove();
                              //$('#send_currency').prop("disabled", false);
                               $('#send_currency').append($('<option>').text(server_response.currency_code).attr('value', server_response.id));

                       },
                   error: function(error){
                           console.log(error);
                         },
                });
              }

              $(document).ready(function() {
                  $("#amount, #rate").keydown(function (e) {
                      // Allow: backspace, delete, tab, escape, enter and .
                      if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                           // Allow: Ctrl+A, Command+A
                          (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) ||
                           // Allow: home, end, left, right, down, up
                          (e.keyCode >= 35 && e.keyCode <= 40)) {
                               // let it happen, don't do anything
                               return;
                      }
                      // Ensure that it is a number and stop the keypress
                      if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                          e.preventDefault();
                      }


                  });

                  $('#amount, #rate').bind('keyup',function (){

                    var amount = $("#amount").val();
                    var rate = $("#rate").val();
                      $('#totalamount').val(amount*rate);
                  });
              });
    </script>
@stop
