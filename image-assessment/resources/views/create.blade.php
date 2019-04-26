<html lang="en">
<head>
  <title>RJI Image Analysis</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script type="text/javascript" src="{!! URL::asset('js/dropzone.js') !!}"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="{!! URL::asset('css/dropzone.css') !!}" />
  <link rel="stylesheet" href="{!! URL::asset('css/style.css') !!}" />
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

    <form method="post" action="{!! url('form') !!}" enctype="multipart/form-data">
  	{!! csrf_field() !!}

        <div class="input-group control-group increment">
          <input type="file" name="file[]" class="form-control" multiple="multiple">
          <div class="input-group-btn">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>

    </form>
      
    <div id="dropzone">
        <form method="post" action="{!! url('form') !!}" enctype="multipart/form-data" class="dropzone needsclick" id="demo-upload">
        {!! csrf_field() !!}
          <div class="dz-message needsclick">    
            <span class="note needsclick">This is a DROPZONE!!!</span>
          </div>
        </form>
    </div>
      
      
  </div>

      
<script type="text/javascript">
var dropzone = new Dropzone('#demo-upload', {
  uploadMultiple: true,
  parallelUploads: 2,
  thumbnailHeight: 120,
  thumbnailWidth: 120,
  maxFilesize: 30,
  filesizeBase: 1000,
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

<script type="text/javascript">
    $(document).ready(function() {
      Dropzone.autoDiscover = false;
        
      $(".btn-success").click(function(){
          var html = $(".clone").html();
          $(".increment").after(html);
      });
      $("body").on("click",".btn-danger",function(){
          $(this).parents(".control-group").remove();
      });
    });
</script>
</body>
</html>
