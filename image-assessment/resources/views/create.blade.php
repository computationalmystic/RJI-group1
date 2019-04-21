<html lang="en">
<head>
  <title>RJI Image Analysis</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
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
          <input type="file" name="filename[]" class="form-control" multiple="multiple">
          <div class="input-group-btn">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>

    </form>
  </div>


<script type="text/javascript">


    $(document).ready(function() {

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
