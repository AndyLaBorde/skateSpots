<!DOCTYPE html>
<html lang="en">
<head>
	<title>Skate Spots</title>
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
			$.get('/Spots/show_map', function(res){
				$("#map").html(res);
			});
			$('#search').submit(function(){
				return false;
			});
			$("#profile").click(function(){
				$.post($("#spots_hidden").attr('action'), $("#spots_hidden").serialize(), function(res){
					$("#ajax").html(res);
					$("#ajax").show();
				});
			});
		});
		$(document).on("submit", ".update", function(){
			$.post($(this).attr('action'), $(this).serialize(), function(res){
				$("#ajax").html(res);
			});
			return false;
		});
		$(document).on("submit", "#spots", function(){
			$.post($(this).attr('action'), $(this).serialize(), function(){
				$.get('/Spots/show_map', function(res){
					$("#map").html(res);
				});
			});
			$(this).hide();
			return false;
		});
		$(document).on("submit", "#upload", function(e){
			var formdata = new FormData($(this)[0]);
			$.ajax({
				url: $(this).attr('action'),
				type: 'POST',
				data: formdata,
				async: false,
				success: function (res){
						$("#ajax").html(res);
				},
				cache: false,
				contentType: false,
				processData: false,
			});
			return false;
		});
	</script>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-3 col-xs-offset-1 header_links">
				<a id="profile" href="#">Profile</a>
			</div>
			<div class="col-xs-4">
				<h1 id="banner" class="text-center">skateSpots</h1>
			</div>
			<div class="col-xs-3 header_links">
				<a id="log_off" href="/Sessions/destroy">Log off</a>
			</div>
		</div>
		<div class="row">
			<div id="search_div" class="col-md-10 col-md-offset-1">
				<form id="search" action="/Spots/search" method="post">
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></div>
								<input type="text" name="search" class="form-control">
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row map_row">
			<div class="col-md-10 col-md-offset-1 map_div">
				<div id="map" class="text-center">
				<!-- insert map with AJAX here -->
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<form id="spots" class="form-horizontal" action="/Spots/create" method="post">
					<input id="lng" type="hidden" name="lng" value="">
					<input id="lat" type="hidden" name="lat" value="">
					<div class="form-group">
						<label for="title" class="col-sm-2 control-label">Title</label>
						<div class="col-sm-10">
							<input type="text" id="title" name="title" class="form-control">	
						</div>
					</div>
					<div class="form-group">
						<label for="description" class="col-sm-2 control-label">Description</label>
						<div class="col-sm-10">
							<input type="text" id="description" name="description" class="form-control">	
						</div>
					</div>
					<div class="form-group">
						<label for="rating" class="col-sm-2 control-label">Rating</label>
						<div class="col-sm-10">
							<select class="form-control" name="rating">
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
								<option>6</option>
								<option>7</option>
								<option>8</option>
								<option>9</option>
								<option>10</option>
							</select>
							<button id="add_spot_btn" type="submit" class="btn btn-primary">Add Your Spot</button>
						</div>
					</div>
				</form>
				<form id="spots_hidden" action="/Users/update_html" method="post">
					<input type="hidden" name="profile" value="<?=$this->session->userdata('user_id')?>">
				</form>
			</div>
		</div><!-- end of row-->
		<div class="row">
			<div id="ajax" class="col-md-10 col-md-offset-1">
				
			</div>
		</div>
	</div><!--end of container -->
</body>
</html>