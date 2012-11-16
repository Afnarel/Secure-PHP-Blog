<?php
$PAGE_TITLE = 'Password recovery';
require_once(dirname(__FILE__) . '/includes/top.php');

if(isset($_POST['recovery_submit'])) {
// If the user isn't connected
	if(!is_connected())
	{
		$user = R::findOne('user',' email = :mail AND validated IS NOT NULL ',
			array(
				':mail' => $_POST['mail']
				));

		if($user !== NULL) {
			$identifier = md5($_POST['mail']);
			$token = uniqueToken();
			$recoveryLink = DOMAIN . ROOTPATH . "doRecovery.php?identifier=$identifier&key=$token";
			$mailSubject = 'Your password recovery link for ' . PROJECT_NAME;
			$mailContent = 'Follow this link to chose your new password: ' . $recoveryLink;
			// Send the email containing the password recovery link to the user
			// Token is sent unhashed ==> SSL REQUIRED
			
			if(sendMail($mailSubject, $mailContent, $user->email, $user->username)) {
				// Store the unique account validation token hashed into the database
				storeUniqueToken('accountrecovery', $user->id, $identifier, $token, hoursFromNow(LINK_VALIDITY));
				new Message('success', 'An email has been sent to your email account along with a link to 
					reset your password. This link will remain valid for 1 hour.');
			}
			else {
				new Message('error', 'Registration failed: recovery mail could not be sent.');
			}
		}
		else {
			new Message('error', 'No account is associated with this email address');
		}
	}
	header('Location: ./index.php');
}
else {
?>

<form id="recovery_form" name="recovery_form" method="POST" action="#" class="form-horizontal">
	<input type="hidden" name="csrftoken" value="<?php echo csrfToken(); ?>" />
	<div class="control-group">
		<label class="control-label" for="recovery_mail">Email</label>
		<div class="controls">
			<input name="mail" id="mail" type="text" placeholder="Email" data-content="Your email address" data-original-title="Email">
			<button name="recovery_submit" id="recovery_submit" type="submit" class="btn">Recover</button>
		</div>
	</div>
</form>

<?php
require_once(dirname(__FILE__) . '/includes/bottom.php');
}
?>
