
<html lang="en">
<head>
  <title>RJI Image Analysis</title>
  <script type="text/javascript" src="{!! URL::asset('js/jquery-3.4.0.min.js') !!}"></script>
  <link rel="stylesheet" href="{!! URL::asset('css/bootstrap.min.css') !!}" />
  <meta name="csrf-token" content="{{ csrf_token() }}"> 
</head> 
<body>

  <div class="container">
    <?php
		use \App\Http\Controllers\DownloadController;
		echo DownloadController::buildPage();
	?>
  </div>   
  
  
</body>
</html>
