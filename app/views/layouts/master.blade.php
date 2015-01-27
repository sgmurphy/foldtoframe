<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Fold to Frame - Print Online</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="{{ URL::asset('css/public.css') }}">
	</head>
	<body>
		<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="{{ URL::to('/') }}">Fold to Frame - Print Online</a>
				</div>

				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
					</ul>
				</div>
			</div>
		</div><!-- /.navbar -->

		<div class="container">
			@if ($errors->has())
				@foreach ($errors->all() as $error)
					<div class='bg-danger alert'>{{ $error }}</div>
				@endforeach
			@endif

			@if (Session::get('success'))
				<div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
			@endif

			@yield('content')
		</div><!-- /.container -->

		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	</body>
</html>