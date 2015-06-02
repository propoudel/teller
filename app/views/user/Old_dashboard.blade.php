@extends("layout")
@section("content")

  <div class="panel panel-default">
          <div class="panel-heading">Data Entry</div>
          <div class="panel-body">
              <div class="col-sm-12">
                  <form action="<?php echo URL::to('/account/store'); ?>" method="POST" name="addTransfer" id="addTransfer">
                      <div class="row">

                          <div class="col-sm-12">


                             <div class="col-sm-4">
                             <div class="row">
                              <div class="col-sm-4">
                             <div class="form-group" style="text-align: center">
                             <label>Base</label>
                                   <input type="radio" name="currency_type" id="currency_type_1" value="1">

                             </div>
                              </div>

                                <div class="col-sm-4">
                              <div class="form-group" style="text-align: center">
                              <label>Multi</label>
                                    <input type="radio" name="currency_type" id="currency_type_2" value="2">

                              </div>
                               </div>

                               <div class="col-sm-4">
                                    <div class="form-group" style="text-align: center">
                                    <label>Divide</label>
                                          <input type="radio" name="currency_type" id="currency_type_3" value="3">

                                    </div>
                                     </div>
                              </div>
                             </div>


                              <div class="col-sm-4 pull-right">
                              <div class="form-group">

                                  <div class="input-group pull-right">

                                    <input type="number" class="form-control" style="width: 100px;" placeholder="Amount">
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
                               <button type="button" class="btn btn-success pull-left"><i class="fa fa-user"></i></button>
                              <input type="number" class="form-control" name="party_from" id="party_from" style="width: 200px;" placeholder="DR.">

                            </div>
                          </div>

                      </div>

                      <div class="col-sm-5">
                            <div class="form-group">

                                <select name="currency_from" id="currency_from" class="form-control">

                                        <option value="">Currency</option>

                                </select>

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
                      <div class="col-sm-5">
                      <div class="form-group">

                          <div class="input-group">
                             <button type="button" class="btn btn-success pull-left"><i class="fa fa-user"></i></button>
                            <input type="number" class="form-control" name="party_to" id="party_to" style="width: 200px;" placeholder="CR.">

                          </div>
                        </div>


                      </div>

                          <div class="col-sm-5">
                              <div class="form-group">

                                     <select name="send_currency" class="form-control" id="send_currency">

                                             <option value="">Currency</option>

                                     </select>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                      <div class="col-sm-5">
                      <div class="form-group">
                        <label for="totalamount">Currency to convert</label>
                           <select name="send_currency" class="form-control" id="send_currency" style="width: 235px;">

                                   <option value="">Currency</option>

                           </select>
                    </div>
                      </div>
                          <div class="col-sm-5">
                              <div class="form-group">
                                <div class="form-group">
                                    <label for="totalamount"><em>RMD To EUR</em></label>
                                    <input  name="totalamount" type="number" value="" class="form-control" id="totalamount"
                                           placeholder="Total Amount">
                                </div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                      <div class="col-sm-5">
                            <div class="form-group">
                                <label for="totalamount">Total Amount To Send</label>
                                <input  name="totalamount" type="number" value="" class="form-control" id="totalamount"
                                       placeholder="Total Amount" style="width: 235px;">
                            </div>
                        </div>

                        <div class="col-sm-5">
                        <div class="form-group">
                            <label for="totalamount"><em>EUR to Local</label>
                            <input  name="totalamount" type="number" value="" class="form-control" id="totalamount"
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
