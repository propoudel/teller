<!DOCTYPE html>
<html lang=”en”>
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
        <link href="{{{ asset('/css/custom.css') }}}" type="text/css" rel="stylesheet"/>	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="{{{ asset('/js/bootstrap.min.js') }}}"></script>	
		<script src="{{{ asset('/js/bootstrap-datepicker.js') }}}"></script>
		
    <title>Login</title>
  </head>
<body class="login-page">	
<div class="container">
<div class="row">
        <div class="col-sm-12">
            <div class="row">			
                 @yield("content")
            </div>
        </div>

    </div>
</div>    
      
  </body>
</html>
