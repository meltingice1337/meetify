
<!DOCTYPE html>
<html>
<head>
	<title>Meetify | Profile</title>
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
			<div class="col-md-12" style="margin-top:15px">
				<div class="panel panel-default">
					<div class="panel-heading"><h2 style="text-align:center"> Profile Information</h2></div>
					<div class="panel-body">
						<div class="col-md-6">
							<img src="{{asset($user->image)}}"style="border-radius: 50%; height:175px; margin:0 auto "class="img-responsive" />
							<form enctype="multipart/form-data" action="{{route('api.user.image.post')}}" method="POST">
								<input id="file" name="file" type="file" accept="image/*"/>
								<input type="submit" value="Upload">
							</form>
						</div>

						<div class="col-md-6">
							<p>Name: {{$user->name}}</p>
							<p>Member since: {{$user->created_at}}</p>
							<p>Email: {{$user->email}}</p>
							<p style="word-break:break-all;" id="interest-p">Interests: @if($user->interests)@foreach($user->interests as $key=>$i) <span data-toggle="tooltip" data-placement="top" title="Remove this interest" class="interest">{{$i}}</span>@if($key<count($user->interests)-1), @endif @endforeach @endif</p>
							<input id="interest-input" type="text" class="form-control" id="firm" style="width:180px ;display:inline">
							<btn id="interest-btn" href="" class="btn btn-default enterbutton"	style=" display:inline;width:180px; margin-left:-1px" >Add interest</btn>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Change Password</div>
					<div class="panel-body"><div class="form-group">
						<label for="pwd">Old Password:</label>
						<input type="password" class="form-control" id="pwd">
					</div>
					<div class="form-group">
						<label for="pwd">New Password</label>
						<input type="password" class="form-control" id="pwd">
					</div>
					<div style="text-align:center">
						<a href="" class="btn btn-default enterbutton">Proceed</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Change Email</div>
				<div class="panel-body"><div class="form-group">
					<label for="email">New Email:</label>
					<input type="password" class="form-control" id="pwd">
				</div>
				<div class="form-group">
					<label for="pwd">Password confirmation:</label>
					<input type="password" class="form-control" id="pwd">
				</div>
				<div style="text-align:center">
					<a href="" class="btn btn-default enterbutton">Proceed</a>
				</div>
			</div>
		</div>
	</div>


</div>
</div>
@include('partials.footer')
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();   
	});
	$('#interest-btn').click(function(e){
		e.preventDefault();
		var interest = $('#interest-input').val();
		$.post( "{{route('api.interest.post')}}", { name: interest})
		.done(function( data ) {
			if(data == 'ok')
			{
				location.reload();
				
			}

		});
	});
	$('.interest').click(function(e){
		e.preventDefault();
		var interest = $(this).text();
		$.post( "{{route('api.interest.delete.post')}}", { name: interest})
		.done(function( data ) {
			if(data == 'ok')
			{
				location.reload();
			}

		});
	});
</script>
</body>
</html>
