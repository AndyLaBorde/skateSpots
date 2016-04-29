
		<div class="col-sm-8">
			<h3 class="spot_title"><?=$spot['title']?></h3>
			<form style="float: right;"action="/Users/close_profile" method="post" class="update">
					<button type="submit" class="btn btn-link">Close Spot Info</button>
			</form>
			<hr>
			<h5>Submitted by <?=$spot['username']?> on <?= date("M d, Y", strtotime($spot['created_at']))?></h5>
			<h5 class="spot_info">Description: </h5>
			<p class="spot_info"><?=$spot['description']?></p>
			<p class="spot_info">Rating: <?=round($review_avg['avg'],1)?></p>
			<?php
				if($review_avg['user_id'] != $this->session->userdata('user_id'))
				{  ?>

			<form action="/Reviews/create/<?=$spot['map_id']?>" method="post" class="form-horizontal update">
				<div class="form-group">
					<input type="hidden" name="spot_id" value="<?=$spot['spot_id']?>">
					<!-- <label for="rating" class="col-sm-1 control-label">Rating</label> -->
					<div class="col-sm-1">
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
					</div>
					<div class="col-sm-2">
						<button type="submit" class="btn btn-primary">Rate This Spot</button>
					</div>
				</div>	
			</form>
			<?php
				}  ?>
			<form class="update" action="/Comments/create/<?=$spot['map_id']?>" method="post">
			<input type=hidden name="spot_id" value="<?=$spot['spot_id']?>">
				<div class="form-group">
					<label for="comment">Post a Comment</label>
					<textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
					<button id="comment_btn" type="submit" class="btn btn-success btn-sm">Post Comment</button>
					<div style="clear: both;"></div>
				</div>
			</form>
			<?php
				if(isset($comments))
				{
					foreach ($comments as $comment) 
					{ ?>
						<h5><?=$comment['username']?> wrote:</h5>
						<!-- <h5 class="comment_date"> -->
						<p class="comment"><?=$comment['content']?></p>
				<?php
					}
				} ?>
		</div>
		<?php
		if(count($images) > 0)
		{ ?>
		<div class="col-sm-4">
			<div id="carousel" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
				<?php
					$count = 0;
					foreach($images as $image)
					{  ?>
						<li data-target="#carousel" data-slide-to="<?= $count ?>"<?php if($count == 0){ echo "class='active'";}?>></li>
				<?php
						$count++;
					}  ?>
					
				</ol>
				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
						<?php
							$count = 0;
							foreach ($images as $image) 
							{  
								if($count == 0)
								{  ?>
									<div class="item active">
							<?php
								}  
								else
								{  ?>
									<div class="item">
							<?php
								}  ?>
								<img src="<?=$image['file_path']?>" alt="error.png">
								</div>
						<?php
								$count++;
							}  ?>
				</div>
			<!-- Controls -->
				<a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#carousel" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
	<?php
		}  ?>
			<form id="upload" action="/Images/do_upload/<?=$spot['map_id']?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="spot_id" value="<?=$spot['spot_id']?>">
				<div class="form-group">
					<?= $this->session->flashdata('image') ?>
					<label for="userfile">Upload Image</label>
					<input type="file" name="userfile" size="20">
					<p class="help-block">Only .jpg, .png, and .gif are supported.  Max image size is 4 MB.  If you're image doesn't upload it may be because it is too large.  Try <a href="https://tinypng.com">tinypng.com</a> to make it smaller.</p>
				</div>
				<button id="upload_btn" type="submit" class="btn btn-default btn-xs">Upload</button>
			</form>
		</div>