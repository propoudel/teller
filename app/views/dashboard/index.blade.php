@extends("layout")
@section("content")

  <div class="panel panel-default">
          <div class="panel-heading">Transaction Entry</div>
          <div class="panel-body">
              <div class="col-sm-12">
                  <form action="<?php echo URL::to('/transaction/store'); ?>" method="POST" name="transaction" id="transaction">
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="col-sm-4">
                                  <div class="row">
                                      <div class="col-sm-4">
                                          <div class="form-group" style="text-align: center">
                                              <label>Base</label>
                                              <input required type="radio" name="base_type" class="base_type" value="1">
                                          </div>
                                      </div>

                                      <div class="col-sm-4">
                                          <div class="form-group" style="text-align: center">
                                              <label>Multi</label>
                                              <input required type="radio" name="base_type" class="base_type" value="2">

                                          </div>
                                      </div>

                                      <div class="col-sm-4">
                                          <div class="form-group" style="text-align: center">
                                              <label>Divide</label>
                                              <input required type="radio" name="base_type" class="base_type" value="3">

                                          </div>
                                      </div>
                                  </div>
                              </div>


                              <div class="col-sm-4 pull-right">
                                  <div class="form-group">
                                      <div class="input-group pull-right">
                                          <input name="transaction_no" type="number" class="form-control" style="width: 138px;" placeholder="Transaction No">
                                          <button type="button" class="btn btn-success"><i class="fa fa-pie-chart"></i></button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="row">

                          <div class="col-sm-5">
                              <div class="form-group">
                                  <div class="input-group">
                                      <button name="debitBtn" type="button" class="btn btn-success pull-left"><i class="fa fa-user"></i></button>
                                      <input required type="text" name="debit" class="form-control" id="debit" style="width: 200px;" placeholder="Debit">
                                  </div>
                              </div>
                          </div>

                          <div class="col-sm-5">
                              <div class="form-group">
                                  <select required name="d_currency" id="d_currency" class="form-control">
                                      <option value="">Debit Currency</option>
                                  </select>
                              </div>
                          </div>

                      </div>

                      <div class="row">

                          <div class="col-sm-5">
                              <div class="form-group">
                                  <div class="input-group">
                                      <button name="creditBtn" type="button" class="btn btn-success pull-left"><i class="fa fa-user"></i></button>
                                      <input required type="text" name="credit" class="form-control" id="credit" style="width: 200px;" placeholder="Credit">
                                  </div>
                              </div>
                          </div>

                          <div class="col-sm-5">
                              <div class="form-group">
                                  <select required name="c_currency" id="c_currency" class="form-control">
                                      <option value="">Credit Currency</option>
                                  </select>
                              </div>
                          </div>

                      </div>

                      <div class="row">
                          <div class="col-sm-5">
                              <div class="form-group">
                                  <label for="totalamount">Currency to Convert</label>
                                  <select required name="conversion_currency" class="form-control" id="conversion_currency" style="width: 235px;">
                                      <option value="">Currency</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-sm-5">
                              <div class="form-group">
                                  <div class="form-group">
                                      <label for="foreign_rate"><em>DC/CC To CC/DC</em></label>
                                      <input required name="foreign_rate" type="number" value="" class="form-control" id="foreign_rate" placeholder="Foreign Conversion Rate">
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-sm-5">
                              <div class="form-group">
                                  <label for="total_amount">Total Amount To Send</label>
                                  <input required name="total_amount" type="number" value="" class="form-control" id="total_amount" placeholder="Total Amount" style="width: 235px;">
                              </div>
                          </div>

                          <div class="col-sm-5">
                              <div class="form-group">
                                  <label for="local_rate"><em>Local Rate</label>
                                  <input required name="local_rate" type="number" value="" class="form-control" id="local_rate"
                                         placeholder="Total Amount">
                              </div>
                          </div>

                      </div>

                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label for="comment">Comment</label>
                                  <textarea required name="comment" id="comment" class="form-control"></textarea>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-sm-12">
                              <button type="submit" id="store_amount" class="btn btn-primary pull-right">Send Amount
                              </button>
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
               var typevalue = "";
              $("input:radio[name=currency_type]").click(function() {
                  typevalue = $(this).val();
                  $("#rate").val(" ");

              });

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

            $('#rate').bind('keyup',function (){
                    if(typevalue == ""){
                       alert("Please select the type!");
                       $("#rate").val(" ");
                       }

                       if(typevalue == "1"){
                            $('#rate').attr('max', 1);
                       }else{
                       $("#rate").removeAttr("max");
                       }
                       if(typevalue > 1){

                       }
              });
                  $('#amount, #rate').bind('keyup',function (){

                    var amount = $("#amount").val();
                    var rate = $("#rate").val();
                       if(typevalue == "1"){
                            $('#totalamount').val(amount*rate);
                       }else if(typevalue == "2"){
                            $('#totalamount').val(amount*rate);
                       }else{
                            $('#totalamount').val(amount/rate);
                       }

                  });
              });
    </script>
@stop
