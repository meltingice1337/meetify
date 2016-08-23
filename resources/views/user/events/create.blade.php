
<!DOCTYPE html>
<html>
<head>
  <title>Meetify | Create Event</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/main.css')}}">
  <link rel="stylesheet" href="{{asset('css/simple-sidebar.css')}}">
  <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/hover-min.css')}}">
  <link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/clockpicker.css')}}">
  <link rel="icon" type="image/png" href="{{asset('favicon.png')}}">
</head>
<body>
  <div class="col-md-12 banner">
    <div class="logo col-md-offset-5 col-md-2">
      <img id="logo"class="img-responsive fixlogoindex animated  bounce"src="{{asset('images/logonoheader.png')}}"/>
    </div>
  </div> 
  <div class="col-md-12">
    @include('partials.menu')
    <div class="col-md-10">
      <div class="col-md-12" style="margin-top:15px">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 style="text-align:center"> Create event</h2>
          </div>
          <div class="panel-body">
           <div class="col-md-12" style="margin-bottom:20px;">
             <label for="eventtitle">Event icon</label>
             <div class="activityselector">
              <div class="col-md-2">
                <div class="activitydiv" style="background-color:transparent;border:none">
                  <img class="img-responsive" data-icon="food"  src="{{asset('images/food.png')}}">
                </div>
              </div>
              <div class="col-md-2">
                <div class="activitydiv"style="background-color:transparent;border:none">
                  <img class="img-responsive" data-icon="drink" src="{{asset('images/drink.png')}}">
                </div>
              </div>
              <div class="col-md-2">
                <div class="activitydiv"style="background-color:transparent;border:none">
                  <img class="img-responsive" data-icon="movie" src="{{asset('images/movie.png')}}">
                </div>

              </div>
              <div class="col-md-2">
                <div class="activitydiv"style="background-color:transparent;border:none">
                  <img class="img-responsive" data-icon="walk" src="{{asset('images/walk.png')}}">
                </div>

              </div>
              <div class="col-md-2">
                <div class="activitydiv"style="background-color:transparent;border:none">
                  <img class="img-responsive" data-icon="games" src="{{asset('images/games.png')}}">
                </div>

              </div>
              <div class="col-md-2">
                <div class="activitydiv"style="background-color:transparent;border:none">
                  <img class="img-responsive" data-icon="unknown" src="{{asset('images/unknown.png')}}">
                </div>

              </div>
            </div>
          </div>
          <div class="col-md-12">
            <form action="{{route('user.event.create.post')}}" method="post">
              <input name="_token" type="hidden" value="{{csrf_token()}}">
              <input name="icon" type="hidden" value="unknown">
              @if(count($errors) > 0)
              <div class="alert alert-danger" style="margin-top:10px" role="alert">
                @foreach($errors->all() as $error)
                <p>{{$error}}</p>
                @endforeach
              </div>
              @endif
              <div class="form-group "style="">
                <label for="eventtitle">Event Title</label>
                <input class="form-control" style="width:100%; border-radius:2px "type="text" name="title" value="{{old('title')}}" />
              </div>
              <div class="form-group">
                <label for="eventtitle">Event Description</label>
                <input class="form-control" style="width:100%; border-radius:2px"type="text" name="description" value="{{old('description')}}"/>
              </div>
              <div class="form-group">
                <label for="eventtitle">Interests <i>(separated by comma eg: dota2, c#, food)</i></label>
                <input class="form-control"style="width:100%; border-radius:2px"type="text" name="interests" value="{{old('interests')}}"/>
              </div>
              <div class="form-group">
                <label for="eventtitle">Location</label>
                <input class="form-control"style="width:100%; border-radius:2px"type="text" name="location" value="{{old('location')}}"/>
              </div>
              <div id="start_time" class="input-append"style="margin-bottom:15px">
                <p>
                  <label for="eventtitle">Start time </label>
                </p>
                <span class="add-on">
                <input class="form-control clockpicker" data-format="hh:mm" style="width:100%; border-radius:2px"type="text" name="start_time"/>
                </span>
              </div>
              <div id="end_time" style="margin-bottom:15px"class="input-append">
                <p><label for="eventtitle">End time </label></p>

                <span class="add-on">
                  <input class="form-control clockpicker" data-format="hh:mm" style="width:100%; border-radius:2px"type="text" name="end_time"/>
                </span>
              </div>
              <div id="datepicker" class="input-append" style="margin-bottom:15px;">
                <p>
                  <label for="eventtitle">Date </label>
                </p>
                <span class="add-on">
                  <input class="form-control" style="width:100%; border-radius:2px"data-format="yyyy-MM-dd" type="text" name="date"/>
                </span>
              </div>
              <p style="display:inline">
                <button class="postcommentbutton btn btn-primary " role="button">Create</button>
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@include('partials.footer')
<script type="text/javascript" src="{{asset('js/clockpicker.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-datetimepicker.min.js')}}"></script>
<script type="text/javascript">
  $('#datepicker').datetimepicker({
    pickTime: false
  })
  $('.activitydiv').click(function(){
    var main = $(this);
    $('.activitydiv').each(function(){
      if($(this) != main)
        $(this).find('img:first').removeClass('image-selected');
    });
    $('input[name=icon]').val($(this).find('img:first').attr('data-icon'));
    $(this).find('img:first').addClass('image-selected');
  });
  $('.clockpicker').clockpicker({
    placement: 'top',
    align: 'left',
    donetext: 'Done'
  });

</script>
</body>
</html>
