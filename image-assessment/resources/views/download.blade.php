@extends('layouts.app')


@section('content')



  @if (session('alert'))
    <div style="margin-top: -1.5rem!important;" class="alert alert-warning" role="alert">
        {{ session('alert') }}
    </div>
  @endif
  
  <div class="container">
    <?php
		use \App\Http\Controllers\DownloadController;
		echo DownloadController::buildPage();
	?>
  </div>   
  
@endsection
