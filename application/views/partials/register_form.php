<h1 class="text-center">skateSpots</h1>
<form id="register_form" action="/Users/create" method="post">
	<div class="form-group">
		<label for="first_name">First Name</label>
		<input id="first_name" type="text" name="first_name" class="form-control">
		<?= $this->session->flashdata('first_name') ?>
	</div>
	<div class="form-group">
		<label for="last_name">Last Name</label>
		<input id="last_name" type="text" name="last_name" class="form-control">
		<?= $this->session->flashdata('last_name') ?>
	</div>
	<div class="form-group">
		<label for="username">Username</label>
		<input id="username" type="text" name="username" class="form-control">
		<?= $this->session->flashdata('username') ?>
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input id="email" type="text" name="email" class="form-control">
		<?= $this->session->flashdata('email') ?>
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input id="password" type="password" name="password" class="form-control">
		<?= $this->session->flashdata('password') ?>
	</div>
	<div class="form-group">
		<label for="password_conf">Confirm Password</label>
		<input id="password_conf" type="password" name="password_conf" class="form-control">
		<?= $this->session->flashdata('password_conf') ?>
	</div>
	<button type="submit" class="btn btn-default">Regiser</button>
</form>
<form id="back_to_login" action="/Users/login_html">
	<button type="submit" class="btn btn-link"><-Back to Log In</button>
</form>