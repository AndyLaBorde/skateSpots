				<h1 class="text-center">skateSpots</h1>
				<h2 class="text-center">The local skate spot finder</h2>
				<form action="/Sessions/create" method="post">
					<div class="form-group">
						<?= $this->session->flashdata('registration_confirmed') ?>
						<label for="email">Email</label>
						<input type="text" id="email" name="email" class="form-control">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" id="password" name="password" class="form-control">
						<button class="btn btn-default btn-sm">Log In</button>
						<h6>through skateSpots or</h6>
						<?php 
							require_once 'vendor/autoload.php';
							$fb = new Facebook\Facebook ([
								'app_id' => '262275047452139',
								'app_secret' => 'c26ad5790b9ee6a601e990fa9ff8c13a',
								'default_graph_version' => 'v2.5',
								]);
							$helper = $fb->getRedirectLoginHelper();
							$permissions = ['email', 'user_likes'];
							$loginUrl = $helper->getLoginUrl('http://localhost8888/Sessions/face', $permissions);
							echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
						?>
					</div>
				</form>
				<form id="register_link" action="/Users/index_html" method="post">
					<div class="form-group">
						<button type="submit" class="btn btn-link">Don't have an account?  Click here to register!</button>
					</div>
				</form>