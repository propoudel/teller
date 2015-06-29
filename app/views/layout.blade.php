<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />	
	    <link href="{{{ asset('/css/bootstrap.min.css') }}}" type="text/css" rel="stylesheet"/>
		<link href="{{{ asset('/css/bootstrap-responsive.css') }}}" rel="stylesheet">		
        <link href="{{{ asset('/font-awesome/css/font-awesome.min.css') }}}" rel="stylesheet" type="text/css">
        <link href="{{{ asset('/css/datepicker.css') }}}" type="text/css" rel="stylesheet"/>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="{{{ asset('/css/jquery.dataTables.css') }}}">
        <link href="{{{ asset('/css/custom.css') }}}" type="text/css" rel="stylesheet"/>	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="{{{ asset('/js/bootstrap.min.js') }}}"></script>	
		<script src="{{{ asset('/js/bootstrap-datepicker.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('/js/jquery.dataTables.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('/js/custom.js') }}}"></script>
    <title>Dashboard</title>
  </head>
  <body class="app">
  <header>
	@include('header')  
 </header>
 <div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-3">
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="glyphicon glyphicon-th-list"></i> Menu</div>
                        <div class="panel-body">
                            <ul class="nav nav-stacked">
                                <li><a href="/dashboard"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                                <li><a href="/transaction"><i class="fa fa-university"></i> Ammendments</a></li>
                                <li><a href="/party"><i class="fa fa-users"></i> Party</a></li>
                                <li><a href="/transaction/reportsearch"><i class="glyphicon glyphicon-list-alt"></i> Search Report</a></li>
                                <li><a href="/transaction/report"><i class="glyphicon glyphicon-list-alt"></i> Trial Balance</a></li>
                                <li><a href="/currency"><i class="fa fa-money"></i> Currency Setting</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="glyphicon glyphicon-th-list"></i> View</div>
                        <div class="panel-body">
                            <div class="checkbox">
                                <?php echo 'Party Name'; ?><br/>
                                <?php foreach($data['party_data'] as $list): ?>
                                <label>
                                  <input type="radio" class="party_name" name="party_name" value="<?php echo $list['id']; ?>" data-toggle="modal" data-target=".modal-limit-party-trans"> <?php echo $list['party_name']; ?>
                                </label>
                                <?php endforeach; ?>
                            </div>

                            <div class="checkbox">
                                <?php echo 'Currency Code'; ?><br/>
                                <?php foreach($data['currency_data'] as $list): ?>
                                <label>
                                    <input type="radio" class="currency_code" name="currency_code" value="<?php echo $list['id']; ?>" data-toggle="modal" data-target=".modal-limit-currency-trans"> <?php echo $list['currency_code']; ?>
                                </label>
                                <?php endforeach; ?>
                            </div>
                            <div class="modal fade view-modal-lg modal-limit-party-trans" tabindex="-1" role="dialog" aria-labelledby="viewSmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                   <div class="modal-header">
                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                         <h4 class="modal-title" id="viewModalLabel">Transaction</h4>
                                       </div>
                                       <div class="modal-body partyTransaction">
                                       </div>
                                  </div>
                                </div>
                            </div>

                            <div class="modal fade view-modal-lg modal-limit-currency-trans" tabindex="-1" role="dialog" aria-labelledby="viewSmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="viewModalLabel">Transaction</h4>
                                        </div>
                                        <div class="modal-body currencyTransaction">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-9">
                            @if($errors->has())
                                  @foreach($errors->all() as $message)
                              		<div class="alert alert-info">
                              		  <button type="button" class="close" data-dismiss="alert">&times;</button>
                              		  {{ $message }}
                              		</div>
                                  @endforeach
                              	@endif

                              	@if(Session::has('message'))
                                    <div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        {{ Session::get('message') }}
                                    </div>
                                @endif
                   @yield("content")
                </div>
            </div>
        </div>

    </div>
</div>
   
	@include('footer')
  <script>
      $( ".party_name").click(function() {
          var party_name = $(this).val();
          $.ajax({
              type: "POST",
              dataType: "html",
              url: "<?php echo URL::to('/transaction/latestTransaction'); ?>",
              data: {party_name: party_name, type: 'party'},
              cache: false,
              success: function(html) {
                  $(".partyTransaction").html(html);
              },
              error: function(error){
                  console.log(error);
              }
          });
      });

      $( ".currency_code").click(function() {
          var currency_code = $(this).val();
          $.ajax({
              type: "POST",
              dataType: "html",
              url: "<?php echo URL::to('/transaction/latestTransaction'); ?>",
              data: {currency_code: currency_code, type: 'currency'},
              cache: false,
              success: function(html) {
                  $(".currencyTransaction").html(html);
              },
              error: function(error){
                  console.log(error);
              }
          });
      });
  </script>


  </body>
</html>
