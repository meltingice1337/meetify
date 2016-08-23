
<!DOCTYPE html>
<html>
<head>
    <title>Meetify | Events</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/hover-min.css')}}">
    <link rel="stylesheet" href="{{asset('css/simple-sidebar.css')}}">
  <link rel="icon" type="image/png" href="{{asset('favicon.png')}}">
</head>
<body>
    <div class="col-md-12 banner">
        <div class="logo col-md-offset-5 col-md-2">
            <img id="logo"class="img-responsive fixlogoindex "src="{{asset('images/logonoheader.png')}}"/>
        </div>
    </div> 
    <div class="col-md-12">
        @include('partials.menu')
        <div class="col-md-10">
            @foreach($events as $event)
            <div class="col-md-3">
                <div class="thumbnail col-md-12" style="">
                    <img src="{{asset($event->icon)}}" alt="...">
                    <div class="caption ">
                        <h3 style="word-break:break-all">{{$event->title}}</h3>
                        <p style="word-break:break-all">{{$event->description}}</p>
                        <div class="col-md-1" style="padding:0;">
                            <i style="display:inline;" class="fa fa-heart " aria-hidden="true"></i>
                        </div>
                        <div class="col-md-11" style="padding:0;">
                            <p style="display:inline;font-size:15px; word-break:break-all">{{$event->parseInterests()}}</p>
                        </div>

                        <div class="col-md-1" style="padding:0;">
                            <i style="display:inline" class="fa fa-map-marker " aria-hidden="true"></i>
                        </div>
                        <div class="col-md-11" style="padding:0;">
                            <p style="display:inline; font-size:15px; word-break:break-all"> {{$event->location}}</p>

                        </div>

                        <div class="col-md-1" style="padding:0;">
                            <i class="fa fa-calendar" style="display:inline;" aria-hidden="true"></i>
                        </div>
                        <div class="col-md-11" style="padding:0;">
                            <p style="display:inline; font- size:15px; word-break:break-all"> {{$event->date}} </p>

                        </div>

                        <div class="col-md-1" style="padding:0;">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                        </div>
                        <div class="col-md-11" style="padding:0;">
                            <p style="display:inline; font- size:15px; word-break:break-all"> {{$event->start_time}}-{{$event->end_time}} ({{$event->time()}})</p>
                        </div>

                        <div class="col-md-1" style="padding:0;">
                            <i class="fa fa-users" aria-hidden="true"></i>
                        </div>
                        <div class="col-md-11" style="padding:0;">
                            <p style="display:inline; font- size:15px; word-break:break-all"> {{$event->attending()}} </p>
                        </div>
                        <div class="col-md-12" style="padding:0;margin-top:15px;">
                            <p style="text-align:center">
                            <a  href="{{route('user.event.get', $event->id)}}" class="btn btn-primary buttonproceed" role="button">More Info</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @include('partials.footer')
</body>
</html>
