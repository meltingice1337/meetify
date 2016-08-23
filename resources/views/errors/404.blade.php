
<!DOCTYPE html>
<html>
<head>
    <title>Meetify | Not Found</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/simple-sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/hover-min.css')}}">
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
            <div class="col-md-6">
                <p style="font-size:11vmax ">Oops!</p>
                <p style="color:#374255; font-size:55px">This is awkward.</p>
                <p style="color:grey; font-size:25px"> You're looking for something that dosent actually exist.</p>
                <p style="color:black; font-size:25px"> Try going back to the dashboard.</p>
            </div>
            <div class="col-md-6"style="margin-top:50px">
            <img src="{{asset('images/error.png')}}" class="img-responsive" style="width:800px" />

            </div>
        </div>
    </div>
    @include('partials.footer')
</body>
</html>
