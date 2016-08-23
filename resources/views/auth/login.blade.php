<!DOCTYPE html>
<html>
<head>
	<title>Meetify | Login</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/main.css')}}">
  <link rel="icon" type="image/png" href="{{asset('favicon.png')}}">
</head>
<body>
	<div class="col-md-12 banner">
		<div class="logo col-md-offset-5 col-md-2">
		<img id="logo"class="img-responsive fixlogoindex animated  bounce"src="{{asset('images/logonoheader.png')}}"/>
		</div>
	</div> 
	<div class="col-md-offset-4 col-md-4 registerinputs">
		<form method="POST" action="{{route('auth.login.post')}}">
			<input name="_token" type="hidden" value="{{csrf_token()}}">
			<div class="form-group">
				<label for="usr">Email:</label>
				<input type="text" class="form-control" id="usr" name="email">
			</div>
			<div class="form-group">
				<label for="pwd">Password:</label>
				<input type="password" class="form-control" id="pwd" name="password">
			</div>
			<div style="text-align:center">
				<button href="" class="btn btn-default enterbutton">Sign in</button>
			</div>
			@if (count($errors) > 0)
			<div class="alert alert-danger" style="margin-top:10px" role="alert"><strong>Incorrect! </strong>Your email & password do not match ! </div>
			@endif
		</form>
	</div>
</body>
</html>
