<html lang="en">
<head>
  <title>RJI Image Analysis</title>
  <script type="text/javascript" src="{!! URL::asset('js/jquery-3.4.0.min.js') !!}"></script>
  <script type="text/javascript" src="{!! URL::asset('js/dropzone.js') !!}"></script>
  <link rel="stylesheet" href="{!! URL::asset('css/bootstrap.min.css') !!}" />
  <link rel="stylesheet" href="{!! URL::asset('css/dropzone.css') !!}" />
  <link rel="stylesheet" href="{!! URL::asset('css/style.css') !!}" />
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script type="text/javascript">
    Dropzone.autoDiscover = false;
  </script>
  <meta name="csrf-token" content="{{ csrf_token() }}"> 
</head> 
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Home
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
      @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
          @foreach ($errors->all() as $error)
              <li>{!! $error !!}</li>
          @endforeach
        </ul>
      </div>
      @endif

        @if(session('success'))
        <div class="alert alert-success">
          {!! session('success') !!}
        </div>
        @endif
      
    <div class="alert alert-primary" role="alert">Attention! You will receive an email with a download link once your submission has been processed.</div>
      
    <h3 class="jumbotron">RJI Image Analysis</h3>
      
    <div id="dropzone">
        <form method="post" action="{!! url('form') !!}" enctype="multipart/form-data" class="dropzone needsclick" id="demo-upload">
        {!! csrf_field() !!}
          <div class="dz-message needsclick">    
            <span class="note needsclick">Drag and Drop Files Here!</span>
          </div>
        </form>
    </div>
      
  </div>
<script type="text/javascript">
    jQuery(document).ready(function() {        
      $(".btn-success").click(function(){
          var html = $(".clone").html();
          $(".increment").after(html);
      });
      $("body").on("click",".btn-danger",function(){
          $(this).parents(".control-group").remove();
      });
    });
</script>      
<script type="text/javascript">
    var dropzone = new Dropzone('#demo-upload', {
      uploadMultiple: true,
      parallelUploads: 100000,
      timeout: 0,
      thumbnailHeight: 120,
      thumbnailWidth: 120,
      filesizeBase: 1000,
      maxFilesize: 1000,
      maxThumbnailFilesize: 30,
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      thumbnail: function(file, dataUrl) {
        if (file.previewElement) {
          file.previewElement.classList.remove("dz-file-preview");
          var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
          for (var i = 0; i < images.length; i++) {
            var thumbnailElement = images[i];
            thumbnailElement.alt = file.name;
            thumbnailElement.src = dataUrl;
          }
          setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
        }
      }
    });    
</script>      
        </main>
    </div>
</body>
</html>