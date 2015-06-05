@extends("layout")
@section("content")

  <div class="panel panel-default">
          <div class="panel-heading">Transaction Entry</div>
          <div class="panel-body">
              <div class="col-sm-12">
                  <div class="col-sm-4 pull-right">
                      <div class="form-group">
                          <div class="input-group pull-right">
                              <input name="transaction_no" type="number" class="form-control" style="width: 138px;" placeholder="Transaction No">
                              <button type="button" class="btn btn-success btnTransactionNo"><i class="fa fa-pie-chart"></i></button>
                          </div>
                      </div>
                  </div>
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



                          </div>
                      </div>

                      <div class="row">

                          <div class="col-sm-5">
                              <div class="form-group">
                                  <div class="input-group">
                                      <button name="debitBtn" type="button" data-toggle="modal" data-target=".view-modal-party" class="btn btn-success pull-left"><i class="fa fa-user"></i></button>
                                      <input required type="text" name="debit" class="form-control" id="debit" style="width: 200px;" placeholder="Debit">
                                      <input required type="hidden" name="debtor_id" id="debtor_id">
                                  </div>
                              </div>
                          </div>

                          <div class="col-sm-5">
                              <div class="form-group">
                                  <select required name="d_currency" id="d_currency" class="form-control">
                                      <option value="">Debit Currency</option>
                                      <?php foreach($data['currency_data'] as $list) { ?>
                                        <option value="{{  $list->id }}">{{ $list->currency_code }}</option>
                                      <?php } ?>
                                  </select>
                              </div>
                          </div>

                      </div>

                      <div class="row">

                          <div class="col-sm-5">
                              <div class="form-group">
                                  <div class="input-group">
                                      <button name="creditBtn" type="button" data-toggle="modal" data-target=".view-modal-party" class="btn btn-success pull-left"><i class="fa fa-user"></i></button>
                                      <input required type="text" name="credit" class="form-control" id="credit" style="width: 200px;" placeholder="Credit">
                                      <input required type="hidden" name="creditor_id" id="creditor_id">
                                  </div>
                              </div>
                          </div>

                          <div class="col-sm-5">
                              <div class="form-group">
                                  <select required name="c_currency" id="c_currency" class="form-control">
                                      <option value="">Credit Currency</option>
                                      <?php foreach($data['currency_data'] as $list) { ?>
                                        <option value="{{  $list->id }}">{{ $list->currency_code }}</option>
                                      <?php } ?>
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
                                      <?php foreach($data['currency_data'] as $list) { ?>
                                        <option value="{{  $list->id }}">{{ $list->currency_code }}</option>
                                      <?php } ?>
                                  </select>
                              </div>
                          </div>
                          <div id="foreign_val" class="col-sm-5">
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


  <!-- Start Party Pop Up -->
  <div class="modal fade view-modal-party" tabindex="-1" role="dialog" aria-labelledby="viewSmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="viewModalLabel">Choose Party</h4>
                  <input type="hidden" id="partyType" name="partyType" value="" />
              </div>
              <div class="modal-body" name="partyModal">
                  <table class="table table-condensed">
                      <thead>
                      <th>Name</th>
                      <th>Currency</th>
                      </thead>
                      <tbody class="table">
                      <?php foreach($data['party_join_curr'] as $list): ?>
                      <tr>
                          <td><?php echo $list->party_name; ?></td>
                          <td><?php echo $list->currency_code; ?></td>
                          <td><button currency_id="<?php echo $list->currency_id; ?>" currency_name="<?php echo $list->currency_code; ?>" party_id="<?php echo $list->id; ?>" party_name="<?php echo $list->party_name; ?>" type="button" class="btn-primary select_party">Choose</button></td>
                      </tr>
                      <?php endforeach; ?>
                      </tbody>
                  </table>
              </div>
          </div>

      </div>
  </div>
  <!-- End Party Pop Up -->

  <script type="text/javascript">
      $("input.base_type").click(function(){
          var foreign_val = $(this).val();
          if (foreign_val == 1) {
              $("#foreign_rate").val('');
              $("#foreign_val").hide();
          } else {
              $("#foreign_val").show();
          }
      });

      $("button[name='debitBtn']").click(function() {
          $("#partyType").val('debitBtn');
      });

      $("button[name='creditBtn']").click(function() {
          $("#partyType").val('creditBtn');
      });

      $( ".select_party").click(function() {
          partyType = $("#partyType").val();
          currency_id = $(this).attr('currency_id');
          currency_name = $(this).attr('currency_name');
          party_name = $(this).attr('party_name');
          party_id = $(this).attr('party_id');

          if (partyType == "debitBtn") {
              $("#debit").val(party_name);
              $("#debtor_id").val(party_id);
              $("#d_currency option").each(function(){$(this).removeAttr("selected")});
              $("#d_currency option[value='"+ currency_id +"']").attr("selected", "selected");
          } else if (partyType == "creditBtn") {
              $("#credit").val(party_name);
              $("#creditor_id").val(party_id);
              $("#c_currency option").each(function(){$(this).removeAttr("selected")});
              $("#c_currency option[value='"+ currency_id +"']").attr("selected", "selected");
          }

          $("#partyType").val("");
          $(".modal").hide();
          //console.log($("#d_currency option[value='2']").attr("selected", "selected"));
      });

      $( "button.btnTransactionNo").click(function() {
          alert('bass');
          $.ajax({
              type: "POST",
              dataType: "json",
              url: "<?php echo URL::to('/party/find'); ?>",
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
      });

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
