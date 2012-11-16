<?php
require_once(dirname(__FILE__) . '/includes/setup.php');

// If the user is connected
// and provided an identifier and a token
if(!is_connected() && !empty($_GET['identifier']) && !empty($_GET['key'])) {

	$user = validateToken('accountvalidation', $_GET['identifier'], $_GET['key']);

	// If the token is not valid
	if($user === NULL) {
		new Message('error', 'Account validation failed. The validation link you used may be outdated.');
	}
	else {
		// Otherwise, mark the account as validated and return true
		$user->validated = now();
		R::store($user);

		new Message('success', 'Your account is now activated. You can now log in using your email and password.');
	}
}
header('Location: ./index.php');
?>