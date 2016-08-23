<!DOCTYPE html>
<html>
<head>
	<title>Meetify | Register</title>
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
	<form method="post" accept="{{route('auth.register.post')}}">
		<input name="_token" type="hidden" value="{{csrf_token()}}">
		<div class="col-md-offset-4 col-md-4 registerinputs">
			<div class="form-group">
				<label for="usr">Name:</label>
				<input type="text" name="name" class="form-control" id="usr">
			</div>
			<div class="form-group">
				<label for="usr">Email:</label>
				<input type="text" name="email" class="form-control" id="usr">
			</div>
			<div class="form-group">
				<label for="pwd">Password:</label>
				<input type="password" name="password" class="form-control" id="pwd">
			</div>
			<div class="form-group">
				<label for="pwd">Password confirmation:</label>
				<input type="password" name="password_confirmation" class="form-control" id="pwd">
			</div>
			<div style="text-align:center">
				<button href="" class="btn btn-default enterbutton">Register</button>
			</div>
			@if (count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
		</div>
	</form>
</body>
</html>
