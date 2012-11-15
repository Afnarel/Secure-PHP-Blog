<?php
require_once(dirname(__FILE__) . '/includes/setup.php');

function validateToken($table, $identifier, $token) {
	// Checks if the access token exists
	$bean = R::findOne($table,' identifier = :identifier AND token = :token ',
		array(
			':identifier' => $identifier,
			':token' => sha1($token)
		)
	);

	if($bean != NULL) {
		// Keep the user_id and the expiration_date, then trash the bean:
		// it's a "one time only" token and if it has been found, it means
		// that this is the user it's associated to who issued the request
		// (since he knew the $identifier and, most importantly, $token)
		// If it is then rejected, it can only be that it's oudated in which
		// case we should trash it anyway
		$expiration_date = $bean->expiration_date;
		$user_id = $bean->user_id;
		R::trash($bean);

		// If the user tries to get an outdated access token
		// refuse to give him => NULL
		$expiration_time = toTime($expiration_date);
		if($expiration_time <= time()) {
			return NULL;
		}

		// If the user does not exist (has been deleted since) => NULL
		$user = R::findOne('user', ' id = ? ', array($user_id));
		return $user;
	}

	// If the token was not found in the database (invalid), return NULL
	return NULL;
}

// If the user is connected
// and provided an identifier and a token
if(!is_connected() && !empty($_GET['identifier']) && !empty($_GET['key'])) {

	$user = validateToken('accountvalidation', $_GET['identifier'], $_GET['key']);

	// If the token is not valid
	if($user === NULL) {
		new Message('error', 'Account validation failed. The recovery link you used may be outdated.');
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