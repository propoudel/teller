@extends("layout")
@section("content")

    <div class="panel panel-default">
        <div class="panel-heading">Report{Under progres}</div>
        <div class="panel-body">

            <div class="col-sm-12">
                <form>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="party_from">Party From</label>

                                <select name="party_from" id="party_from" class="form-control" onChange="getFromCurrency()">
                                    <option value="">Select</option>
                                    @foreach($party_data as $list)
                                        <option data-currency="{{ $list->currency_id }}" value="{{ $list->id }}">{{ $list->party_name; }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="currency_from">Currency</label>
                                <select name="currency_from" id="currency_from" class="form-control">

                                    <option value="">Select</option>
                                    @foreach($currency_data as $list)
                                        <option data-currency="{{ $list->currency_id }}" value="{{ $list->id }}">{{ $list->currency_code; }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="from">Date From</label>
                                <input class="form-control datepicker" name="from" type="text" placeholder="From Date">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="to">To Date</label>
                                <input type="text" class="form-control datepicker" id="to" placeholder="To Date">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label> &nbsp; </label>

                                <button class=" form-control btn btn-primary">Search</button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="bs-example" data-example-id="bordered-table">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Date</th>
                                            <th>Details</th>
                                            <th>Rate</th>
                                            <th>Dr</th>
                                            <th>Cr</th>
                                            <th>Party</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    {{--*/ $sn = 1 /*--}}
                                    @foreach($account_data as $list)
                                        <tr>
                                            <th scope="row">{{ $sn; }}</th>
                                            <td>{{ $list->created_at; }}</td>
                                            <td>3</td>
                                            <td>9</td>
                                            <td>Coming soon. orm</td>
                                            <td>Coming soon. orm</td>
                                            <td>Coming soon. orm</td>
                                        </tr>
                                    {{--*/ $sn++ /*--}}
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <nav class="pull-right">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <button class="btn btn-primary pull-right">Export</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script type="text/javascript">

        $(document).ready(function() {
            $('.datepicker').datepicker()
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
    </script>
@stop
