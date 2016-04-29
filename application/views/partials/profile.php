
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Update Profile</h3>
				</div>
				<div class="panel-body">
					<form id="update_profile" class="form-horizontal update" action="/Users/update_profile" method="post">
						<div class="form-group">
							<label for="first_name" class="col-sm-3 control-label">First Name</label>
							<div class="col-sm-9">
								<input id="first_name" type="text" name="first_name" class="form-control" value="<?= $users['first_name'] ?>">
								<?= $this->session->flashdata('first_name') ?>
							</div>
						</div>
						<div class="form-group">
							<label for="last_name" class="col-sm-3 control-label">Last Name</label>
							<div class="col-sm-9">
								<input id="last_name" type="text" name="last_name" class="form-control" value="<?= $users['last_name'] ?>">
								<?= $this->session->flashdata('last_name') ?>
							</div>
						</div>
						<div class="form-group">
							<label for="username" class="col-sm-3 control-label">Username</label>
							<div class="col-sm-9">
								<input id="username" type="text" name="username" class="form-control" value="<?= $users['username'] ?>">
								<?=$this->session->flashdata('username')?>
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="col-sm-3 control-label">Email</label>
							<div class="col-sm-9">
								<input id="email" type="email" name="email" class="form-control" value="<?= $users['email'] ?>">
								<?= $this->session->flashdata('email') ?>
							</div>
						</div>
						<button style="float: right;" id="update_profile_btn" class="btn btn-primary" type="submit">Update</button>
						<div style="clear: both;"></div>
					</form>
				</div><!-- end of panel-body -->
			</div><!-- end of panel -->
			
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Change Password</h3>
					</div>
					<div class="panel-body">
						<form id="update_password" class="form-horizontal update" action="/Users/update_password" method="post">
							<div class="form-group">
								<label for="password" class="col-sm-3 control-label">New Password</label>
								<div class="col-sm-9">
									<input id="password" type="password" name="password" class="form-control">
									<?= $this->session->flashdata('password') ?>
								</div>
							</div>
							<div class="form-group">
								<label for="password_conf" class="col-sm-3 control-label">Confirm New Password</label>
								<div class="col-sm-9">
									<input id="password_conf" type="password" name="password_conf" class="form-control">
									<?= $this->session->flashdata('password_conf') ?>
								</div>
							</div>
							<button style="float: right;" id="update_profile_btn" class="btn btn-primary" type="submit">Change Password</button>
							<div style="clear: both;"></div>
						</form>
					</div><!-- end of panel-body -->
				</div><!-- end of panel -->
				<form action="/Users/close_profile" method="post" class="update">
					<button type="submit" class="btn btn-link">Close Profile</button>
				</form>
		</div>