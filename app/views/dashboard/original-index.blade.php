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
                            {{--<button type="button" class="btn btn-success btnTransactionNo"><i class="fa fa-pie-chart"></i></button>--}}
                            <button data-toggle="modal" data-target=".modal-limit-transaction" type="button" class="btn btn-success btnTransactionNo"><i class="fa fa-pie-chart"></i></button>
                        </div>
                    </div>
                </div>
                <form action="<?php echo URL::to('/transaction/store'); ?>" method="POST" name="transaction" id="transaction">
                    <input type="hidden" name="new_party" id="new_party" value="">
                    <input type="hidden" name="d_yes" id="d_yes" value="">
                    <input type="hidden" name="c_yes" id="c_yes" value="">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-4" style="margin-top: -40px;">
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
                                    <option>Currency</option>
                                    <?php foreach($data['currency_data'] as $list) { ?>
                                    <option style="display: none;" value="{{  $list->id }}">{{ $list->currency_code }}</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div id="foreign_val" class="col-sm-5">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="foreign_rate"><em><span class="dc">DC</span>  To <span class="cc">CC</span> </em></label>
                                    <input required name="foreign_rate" type="number" step="0.01" min="0" value="" class="form-control" id="foreign_rate" placeholder="Foreign Conversion Rate">
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
                                <input required name="local_rate" type="number" step="0.01" min="0" value="" class="form-control" id="local_rate"
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
                        <?php
                                $rel_data[] = $list->party_name . $list->currency_id;
                        ?>
                        <tr>
                            <td><?php echo $list->party_name; ?></td>
                            <td><?php echo $list->currency_code; ?></td>
                            <td><button currency_id="<?php echo $list->currency_id; ?>" currency_name="<?php echo $list->currency_code; ?>" party_id="<?php echo $list->id; ?>" party_name="<?php echo $list->party_name; ?>" type="button" class="btn btn-info select_party">Choose</button></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <!-- End Party Pop Up -->

    <!-- Start Limit Transaction -->
    <div class="modal fade modal-limit-transaction" tabindex="-1" role="dialog" aria-labelledby="viewSmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="viewModalLabel">Transaction</h4>
                </div>
                <div class="modal-body limitTransaction" name="limitTransaction">

                </div>
            </div>

        </div>
    </div>
    <!-- End Limit Transaction -->


    <script type="text/javascript">
        $("#debit, #credit, #d_currency, #c_currency").blur(function() {
            var rel_data = <?php echo json_encode($rel_data); ?>;

            var d_n = $("#debit").val();
            var d_c = $("#d_currency option:selected").val();
            var c_n = $("#credit").val();
            var c_c = $("#c_currency option:selected").val();

            var d_name = d_n + d_c;
            var c_name = c_n + c_c;

            if(($.inArray(d_name, rel_data) == -1) || ($.inArray(c_name, rel_data) == -1)) {
            // Do task here
                var status = confirm("Party Entered is not For selected Currency. Do you want to Create?");
                if (status == true) {
                    $("#new_party").val("1");
                    if ($(this).attr("name")== "debit") {
                        $("#d_yes").val("1"); // For Debit
                    } else if ($(this).attr("name")== "credit") {
                        $("#c_yes").val("1"); // For Credit
                    }
                } else {
                    //location.reload();
                    $("#transaction")[0].reset();
                }
                return false;
            } else {
                $("#new_party").val("0");
            }
        });

        $( "button.btnTransactionNo").click(function() {
            var total_trans_no = $("input[name='transaction_no']").val();
            if (total_trans_no == '') {
                alert('Please Enter Greater Than 0!');
                return false;
            }
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo URL::to('/transaction/latestTransaction'); ?>",
                data: {total_trans_no: total_trans_no, type: 'trans'},
                cache: false,
                success: function(html) {
                    $(".limitTransaction").html(html);
                },
                error: function(error){
                    console.log(error);
                }
            });
        });

        $("input.base_type").click(function(){
            var foreign_val = $(this).val();
            if (foreign_val == 1) {
                $("#foreign_rate").val('');
                $("#foreign_rate").removeAttr('required');
                $("#foreign_val").hide();
            } else {
                $("#foreign_val").show();
                $("#foreign_rate").attr('required', true);
            }
        });

        $("button[name='debitBtn']").click(function() {
            $("#partyType").val('debitBtn');
        });

        $("button[name='creditBtn']").click(function() {
            $("#partyType").val('creditBtn');
        });

        $( ".select_party").click(function() {
            $("#d_yes").val(""); // hidden id reset of debit
            $("#c_yes").val(""); // hidden id reset of credit
            partyType = $("#partyType").val();
            currency_id = $(this).attr('currency_id');
            currency_name = $(this).attr('currency_name');
            party_name = $(this).attr('party_name');
            party_id = $(this).attr('party_id');

            if (partyType == "debitBtn") {
                $('#d_currency').prop('selectedIndex',0);
                $("#debit").val(party_name);
                $("#debtor_id").val(party_id);
                $("#d_currency option").each(function(){
                    $(this).removeAttr("selected")
                });
                $("#d_currency option[value='"+ currency_id +"']").attr("selected", "selected");
                $("#conversion_currency").find('option[value="'+currency_id+'"]').show();
                $('.view-modal-party').modal('hide');
                $('#conversion_currency')
                        .find('option').hide().end();
                var DoptionSelected = $("#d_currency").find("option:selected");
                var DvalueSelected  = DoptionSelected.val();

                var CoptionSelected = $("#c_currency").find("option:selected");
                var CvalueSelected  = CoptionSelected.val();

                $("#conversion_currency").find('option[value="'+DvalueSelected+'"]').show();
                $("#conversion_currency").find('option[value="'+CvalueSelected+'"]').show();
            } else if (partyType == "creditBtn") {
                $('#c_currency').prop('selectedIndex',0);
                $("#credit").val(party_name);
                $("#creditor_id").val(party_id);
                $("#c_currency option").each(function(){$(this).removeAttr("selected")});
                $("#c_currency option[value='"+ currency_id +"']").attr("selected", "selected");
                $("#conversion_currency").find('option[value="'+currency_id+'"]').show();
                $('.view-modal-party').modal('hide');
                $('#conversion_currency')
                        .find('option').hide().end();
                var DoptionSelected = $("#d_currency").find("option:selected");
                var DvalueSelected  = DoptionSelected.val();

                var CoptionSelected = $("#c_currency").find("option:selected");
                var CvalueSelected  = CoptionSelected.val();

                $("#conversion_currency").find('option[value="'+DvalueSelected+'"]').show();
                $("#conversion_currency").find('option[value="'+CvalueSelected+'"]').show();

            }
            $("#partyType").val("");
            $(".modal").hide();
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
                }
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


            $('#d_currency, #c_currency').on('change', function() {
                $('#conversion_currency')
                        .find('option').hide().end();

                $(".dc").html(' ');
                $(".cc").html(' ');

                var DoptionSelected = $("#d_currency").find("option:selected");
                var DvalueSelected  = DoptionSelected.val();

                var CoptionSelected = $("#c_currency").find("option:selected");
                var CvalueSelected  = CoptionSelected.val();

                $("#conversion_currency").find('option[value="'+DvalueSelected+'"]').show();
                $("#conversion_currency").find('option[value="'+CvalueSelected+'"]').show();
                $("#conversion_currency option[value="+CvalueSelected+"]").prop("selected", "selected");

                var v =  $("#conversion_currency").find("option:selected").text();

                var DS  = $("#d_currency").find("option:selected").text();
                var CS  = $("#c_currency").find("option:selected").text();


                if(v == DS){
                    $(".dc").html(v);
                    $(".cc").html($("#c_currency option:selected").text());
                }else{
                    $(".dc").html(CS);
                    $(".cc").html(DS);
                }
            });

            $('#conversion_currency').on('change', function() {
                var v =  $(this).find("option:selected").text();
                var DS  = $("#d_currency").find("option:selected").text();
                var CS  = $("#c_currency").find("option:selected").text();
                if(v == DS){
                    $(".dc").html(v);
                    $(".cc").html($("#c_currency option:selected").text());
                }else{
                    $(".dc").html(CS);
                    $(".cc").html(DS);
                }
            })
        });
    </script>
@stop
