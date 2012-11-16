		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<nav class="container-fluid"><a class="brand" href="<?php echo ROOTPATH ?>"><?php echo PROJECT_NAME ?></a>
					<div class="nav-collapse">
						<ul class="nav">
							<?php if(is_connected()) { ?>
								<li><a href="edit.php">Create post</a></li>
							<?php } ?>
						</ul>
					</div>
					<div class="nav-collapse pull-right">
						<ul class="nav">
							<li class="divider-vertical"></li>
							<?php if(is_connected()) { ?>
								<li><?php echo csrfLink('logout_link', 'Log out', 'logout.php') ?></li>
							<?php } else { ?>
								<li><a href="signup.php">Sign up</a></li>
							<?php } ?>
							
						</ul>
					</div>
				<?php if(!is_connected()) { ?>
					<form method="POST" action="login.php" class="navbar-form pull-right form-inline">
						<input type="email" name="mail" class="input-small" placeholder="Email">
						<input type="password" name="password" class="input-small" placeholder="Password">
						<label class="checkbox">
							<input type="checkbox" name="rememberme"> Remember me
						</label>
						<button type="submit" class="btn">Log in</button>
					</form>
				<?php } ?>
				</nav>
			</div>
		</div>