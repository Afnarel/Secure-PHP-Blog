<?php
$PAGE_TITLE = 'Sign up';
require_once(dirname(__FILE__) . '/includes/top.php');
?>

<form id="signup_form" name="signup_form" method="POST" action="#" class="form-horizontal">
	<div class="control-group">
		<label class="control-label" for="username">Username</label>
		<div class="controls">
			<input name="username" id="username" type="text" placeholder="Username">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="mail">Email</label>
		<div class="controls">
			<input name="mail" id="mail" type="email" placeholder="Email">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="password">Password</label>
		<div class="controls">
			<input name="password" id="password" type="password" placeholder="Password">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="confirm_password">Confirm password</label>
		<div class="controls">
			<input name="confirm_password" id="confirm_password" type="password" placeholder="Confirm password">
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<input class="btn" name="submit_signup" type="submit" value="Sign up">
		</div>
	</div>
</form>

<?php
	if(isset($_POST['submit_signup'])) {
		// If the passwords don't match => fail
		if($_POST['password'] !== $_POST['confirm_password']) {
			new Message('error', "Passwords don't match!");
		}
		else {
			// If a user with the given email address already exists in the DB => fail
			if(R::findOne('user',' email = :mail ',
				array(':mail' => $_POST['mail']))) {
				new Message('error', 'A user with this email address already exists.');
			}
			else {
				$user = R::dispense('user');
				$user->email = $_POST['mail'];
				$user->username = $_POST['username'];
				$user->password = $_POST['password'];
				if(R::store($user)) {
					new Message('success', 'Registration successful!');
				}
				else {
					new Message('error', 'An error occured during the registration process.');
				}
			}
		}
	}
?>

<?php
require_once(dirname(__FILE__) . '/includes/bottom.php');
?>