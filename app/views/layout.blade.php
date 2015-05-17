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
                        <div class="panel-heading"><i class="glyphicon glyphicon-th-list"></i> Teller Menu</div>
                        <div class="panel-body">
                            <ul class="nav nav-stacked">
                                <li><a href="/dashboard"><i class="fa fa-plus-square"></i> Teller</a></li>
                                <li><a href="/party"><i class="fa fa-plus-square"></i> Party</a></li>
                                <li><a href="/report"><i class="glyphicon glyphicon-list-alt"></i> Reports</a></li>
                                <li><a href="/currency"><i class="fa fa-cog"></i> Currency Setting</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-sm-9">
                   @yield("content")
                </div>
            </div>
        </div>

    </div>
</div>
   
	@include('footer')
  </body>
</html>
