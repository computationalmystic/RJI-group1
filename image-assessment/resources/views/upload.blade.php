<html lang="en">
<head>
  <title>RJI Image Analysis</title>
  <script type="text/javascript" src="{!! URL::asset('js/jquery-3.4.0.min.js') !!}"></script>
  <script type="text/javascript" src="{!! URL::asset('js/dropzone.js') !!}"></script>
  <link rel="stylesheet" href="{!! URL::asset('css/bootstrap.min.css') !!}" />
  <link rel="stylesheet" href="{!! URL::asset('css/dropzone.css') !!}" />
  <link rel="stylesheet" href="{!! URL::asset('css/style.css') !!}" />
  <script type="text/javascript">
    Dropzone.autoDiscover = false;
  </script>
  <meta name="csrf-token" content="{{ csrf_token() }}"> 
</head> 
<body>
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
      maxFilesize: 30,
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
</body>
</html>