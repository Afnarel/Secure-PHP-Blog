<?php
$PAGE_TITLE = 'Password recovery';
require_once(dirname(__FILE__) . '/includes/top.php');

// If the user is connected
// and provided an identifier and a token
if(!is_connected()) {
	if(isset($_POST['submit_recovery']) && csrfCheck()) {
		if(!empty($_POST['password']) && !empty($_POST['confirm_password']) &&
			$_POST['password'] === $_POST['confirm_password']) {
				if(!empty($_POST['identifier']) && !empty($_POST['key'])) {
					$user = validateToken('accountrecovery', $_POST['identifier'], $_POST['key']);

					// If the token is not valid
					if($user === NULL) {
						new Message('error', 'Account recovery failed. The recovery link you used may be outdated.');
					}
					else {
						$user->password = sha1($_POST['password'] . SALT);
						R::store($user);
						new Message('success', 'Your password was properly changed.');
					}
				}
		}
		else {
			new Message('error', 'Passwords don\'t match');
		}
		header('Location: ./index.php');
	}
?>
<form id="recovery_form" name="recovery_form" method="POST" action="#" class="form-horizontal">
	<div class="control-group">
		<label class="control-label" for="password">Password</label>
		<div class="controls">
			<input name="password" id="password" type="password" placeholder="Password">
			<input type="hidden" name="identifier" value="<?php echo $_GET['identifier']; ?>">
			<input type="hidden" name="key" value="<?php echo $_GET['key']; ?>">
			<input type="hidden" name="csrftoken" value="<?php echo csrfToken(); ?>" />
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
			<input class="btn" name="submit_recovery" type="submit" value="Sign up">
		</div>
	</div>
</form>		

<?php
}
else {
	header('Location: ./index.php');
}
?>