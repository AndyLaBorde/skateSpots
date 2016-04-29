<!DOCTYPE html>
<html>
<head>
	<title>skateSpots</title>
	<script src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="/assets/css/style.css">
	<script src="/assets/js/jquery.fittext.js"></script>
	<script>
		$(document).ready(function(){
			$(".jumbotron h1").fitText();
			$("#register_link").submit(function(){
				$.post($(this).attr('action'), $(this).serialize(), function(res){
					$(".jumbotron").html(res);
					$(".jumbotron h1").fitText();
				});
				return false;
			});
		});
		$(document).on("submit", "#back_to_login", function(){
			$.post($(this).attr('action'), $(this).serialize(), function(res){
				$(".jumbotron").html(res);
				$(".jumbotron h1").fitText();
			});
			return false;
		});
		$(document).on("submit", "#register_link", function(){
			$.post($(this).attr('action'), $(this).serialize(), function(res){
				$(".jumbotron").html(res);
				$(".jumbotron h1").fitText();
			});
			return false;
		});
		$(document).on("submit", "#register_form", function(){
			$.post($(this).attr('action'), $(this).serialize(), function(res){
				$(".jumbotron").html(res);
				$(".jumbotron h1").fitText();
			});
			return false;
		});
	</script>
</head>
<body>
<?php 
	require_once 'vendor/autoload.php';
	$fb = new Facebook\Facebook ([
		'app_id' => '262275047452139',
		'app_secret' => 'c26ad5790b9ee6a601e990fa9ff8c13a',
		'default_graph_version' => 'v2.5',
		]);
?>
	<script>
</script>
	<div class="container">
		<div class="jumbotron">
			<h1 class="text-center">skateSpots</h1>
			<h2 class="text-center">The local skate spot finder</h2>
			<!-- <div class="col-sm-6"> -->
				<form id="login_form" action="/Sessions/create" method="post">
					<div class="form-group">
						<?= $this->session->flashdata('error') ?>
						<label for="email">Email</label>
						<input type="text" id="email" name="email" class="form-control">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" id="password" name="password" class="form-control">
						<button class="btn btn-default btn-sm">Log In</button>
						<h6>through skateSpots or</h6>
					</div>
				</form>
				<form id="register_link" action="/Users/index_html" method="post">
					<div class="form-group">
						<button type="submit" class="btn btn-link">Don't have an account?  Click here to register!</button>
					</div>
				</form>
			<!-- </div> end of col-sm-6 -->
		</div><!-- end of jumbotron -->
	</div><!-- end of container
</body>
</html>