
<!DOCTYPE html>
<html>
<head>
    <title>Meetify | {{$event->title}}</title>
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
            <img id="logo"class="img-responsive fixlogoindex"src="{{asset('images/logonoheader.png')}}"/>
        </div>
    </div> 
    <div class="col-md-12">
        @include('partials.menu')
        <div class="col-md-10">
            <div class="col-md-8">
                <div class="thumbnail2 col-md-12">
                    <div class="col-md-4">
                        <img class="img-responsive"style="width:150px float:left"src="{{asset($event->icon)}}" alt="...">
                    </div>
                    <div class=""style="padding-top:15px">
                        <div class="col-md-8">
                            <h2 style="display:inline ;margin-left:10px;    word-break: break-all; ">{{$event->title}}</h2>
                        </div>
                        <div class="col-md-4"style="margin-top:5px">
                            <p style="    word-break: break-all;">{{$event->description}}</p>
                            <div class="interests">
                                <strong><p>Interests:</p></strong>
                                <p style="display:inline">{{$event->parseInterests()}}</p>

                            </div>
                        </div>
                        <div class="col-md-4"style="margin-top:5px">
                            <ul style="list-style-type: none;margin-left:-30px">
                                <li>
                                    <i style="display:inline" class="fa fa-map-marker " aria-hidden="true"></i><p style="display:inline; font-size:15px; word-break:keep-all"> {{$event->location}}</p>
                                </li>
                                <li>
                                    <i class="fa fa-calendar" aria-hidden="true"></i><p style="display:inline; font- size:15px; word-break:keep-all"> {{$event->date}} </p>
                                </li>
                                <li>
                                    <i class="fa fa-clock-o" aria-hidden="true"></i><p style="display:inline; font- size:15px; word-break:keep-all"> {{$event->start_time}} - {{$event->end_time}} ({{$event->time()}}) </p>
                                </li>
                                <li>
                                    <i style="display:"class="fa fa-users" aria-hidden="true"></i><p style="display:inline; font- size:15px; word-break:keep-all"> {{$event->attending() }}</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="thumbnail2 col-md-12">
                    <h2 style="text-align:center">Comments</h2>
                    <form method="POST" action="{{route('api.comment.post', $event->id)}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="addcomment">
                            <div class="form-group">
                                <label for="comment">Add comment:</label>
                                <textarea class="form-control" rows="3" id="comment" name="message"></textarea>
                            </div>
                            <p style="display:inline">
                                <button href="#" class="btn-responsive postcommentbutton btn btn-primary " role="button" id="post">Post</button>
                            </p>
                            <div class="captcha-container">
                                {!! app('captcha')->display(); !!}
                            </div>
                        </div>
                    </form>
                    @foreach($comments as $comment)
                    <div class="comment">
                        <p style="display:inline">
                            <h5>
                                <i><strong>{{$comment->user->name}}</strong></i>
                            </h5>
                            <img src="{{asset($comment->user->image)}}" style="margin:4px;border-radius: 50%; height:60px; display:inline"class="img-responsive"/>
                            <h3 style="text-align:center;display:inline; font-size:15px">{{$comment->text}}</h3>
                            <h3 style="text-align:right;color:grey; font-size:15px">Posted at {{$comment->created_at}}</h3>

                        </p>
                    </div>
                    @endforeach
                    {!! $comments->render() !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="thumbnail2 col-md-12">
                    <h2 style="text-align:center" id="comments">{{$event->attending()}}</h2>
                    @foreach($event->users as $user)
                    <p class="personsgoing">
                        <img src="{{asset($user->image)}}" style="border-radius: 50%; height:80px; margin:0 auto "class="img-responsive"/>
                        <p style="text-align:center; font-size:15px">{{$user->name}}</p>
                    </p>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    @include('partials.footer')
</body>
</html>
