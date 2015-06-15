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
                <form action="<?php echo URL::to('/transaction/store'); ?>" method="POST" name="transaction" id="transaction" novalidate>
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
                                    {{--<?php foreach($data['currency_data'] as $list) { ?>--}}
                                    {{--<option style="display: none;" value="{{  $list->id }}">{{ $list->currency_code }}</option>--}}
                                    {{--<?php } ?>--}}
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
                        $rel_data[] = strtolower($list->party_name) . $list->currency_id;
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
        $("#foreign_rate, #total_amount, #local_rate").keydown(function (e) {
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

        var forms = document.getElementsByTagName('form');
        for (var i = 0; i < forms.length; i++) {
            forms[i].noValidate = true;

            forms[i].addEventListener('submit', function(event) {
                //Prevent submission if checkValidity on the form returns false.
                if (!event.target.checkValidity()) {
                    event.preventDefault();
                    alert('Please Input All The Field. All Fields Are Mandatory!!');
                    //Implement you own means of displaying error messages to the user here.
                }
            }, false);
        }

        $("#debit, #credit, #d_currency, #c_currency").blur(function() {
            var rel_data = <?php echo json_encode($rel_data); ?>;

            var d_n = '';
            var d_n = $("#debit").val().toLowerCase();
            var d_c = '';
            var d_c = $("#d_currency option:selected").val();
            var c_n = '';
            var c_n = $("#credit").val().toLowerCase();
            var c_c = '';
            var c_c = $("#c_currency option:selected").val();

            var d_name = d_n + d_c;
            var c_name = c_n + c_c;

            var status_d = 0;
            var status_c = 0;

            if ($(this).attr("id") == "debit" || $(this).attr("id") == "d_currency") {
                if (d_name && $.inArray(d_name, rel_data) == -1) {
                    status_d = 1;
                }
            }

            if ($(this).attr("id") == "credit" || $(this).attr("id") == "c_currency") {
                if (c_name && $.inArray(c_name, rel_data) == -1) {
                    status_c = 1;
                }
            }

            if(status_d ==  1 || status_c ==  1) {
                if ((status_d ==  1 && $("#d_yes").val() == 1) || (status_c ==  1 && $("#c_yes").val() == 1)) {
                    status = true;
                } else {
                    var status = confirm(" Party Entered is not For selected Currency. Do you want to Create?");
                }

                if (status == true) {
                    $("#new_party").val("1");
                    if ($(this).attr("name")== "debit" || $(this).attr("name")== "d_currency") {
                        var set_d_new = 1;
                        var set_c_new = 0;
                        $("#d_yes").val("1"); // For Debit
                        $('#conversion_currency')
                                .find('option')
                                .remove()
                                .end()
                                .append('<option>Currency</option><option value=' + d_c + '>' + $("#d_currency").find("option:selected").html() + '</option>');

                        if ($("#c_currency").find("option:selected").val()) {
                            $('#conversion_currency')
                                    .append('<option value=' + $("#c_currency").find("option:selected").val() + '>' + $("#c_currency").find("option:selected").html() + '</option>');
                        }
                    } else if ($(this).attr("name")== "credit" || $(this).attr("name")== "c_currency") {
                        var set_d_new = 0;
                        var set_c_new = 1;
                        $("#c_yes").val("1"); // For Debit
                        $('#conversion_currency')
                                .find('option')
                                .remove()
                                .end()
                                .append('<option>Currency</option><option value=' + c_c + '>' + $("#c_currency").find("option:selected").html() + '</option>');

                        if ($("#d_currency").find("option:selected").val()) {
                            $('#conversion_currency')
                                    .append('<option value=' + $("#d_currency").find("option:selected").val() + '>' + $("#d_currency").find("option:selected").html() + '</option>');
                        }
                    }

                    return true;
                } else {
                    //location.reload();
                    $("#transaction")[0].reset();
                    $("#new_party").val();
                    return false;
                }
                return false;
            } else {
                $("#new_party").val("");
                $("#d_yes").val("");
                $("#c_yes").val("");
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
                    $(this).removeAttr("selected");
                });

                $("#d_currency option[value='"+ currency_id +"']").prop("selected", "selected");
                $("#conversion_currency").find('option[value="'+currency_id+'"]').show();
                $('.view-modal-party').modal('hide');

                $('#conversion_currency')
                        .find('option')
                        .remove()
                        .end()
                        .append('<option>Currency</option><option value=' + currency_id + '>' + $("#d_currency").find("option:selected").html() + '</option>');

                if ($("#c_currency").find("option:selected").val()) {
                    $('#conversion_currency')
                            .append('<option value=' + $("#c_currency").find("option:selected").val() + '>' + $("#c_currency").find("option:selected").html() + '</option>');
                }

            } else if (partyType == "creditBtn") {
                $('#c_currency').prop('selectedIndex',0);
                $("#credit").val(party_name);
                $("#creditor_id").val(party_id);
                $("#c_currency option").each(function(){$(this).removeAttr("selected")});
                $("#c_currency option[value='"+ currency_id +"']").prop("selected", "selected");
                $("#conversion_currency").find('option[value="'+currency_id+'"]').show();
                $('.view-modal-party').modal('hide');

                $('#conversion_currency')
                        .find('option')
                        .remove()
                        .end()
                        .append('<option>Currency</option><option value=' + currency_id + '>' + $("#c_currency").find("option:selected").html() + '</option>');

                if ($("#d_currency").find("option:selected").val()) {
                    $('#conversion_currency')
                            .append('<option value=' + $("#d_currency").find("option:selected").val() + '>' + $("#d_currency").find("option:selected").html() + '</option>');
                }
            }
            $("#partyType").val("");
            $(".modal").hide();
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
    </script>
@stop
