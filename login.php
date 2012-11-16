<?php
	require_once(dirname(__FILE__) . '/includes/setup.php');

	// If the user isn't connected
	if(!is_connected())
	{
		$user = R::findOne('user',' email = :mail AND password = :password ',
			array(
				':mail' => $purifier->purify($_POST['mail']),
				':password' => sha1($purifier->purify($_POST['password']).SALT)
				));
			
		// If the user is allowed
		if($user)
		{
			$_SESSION['user'] = $user->id;
			new Message('success', 'You are now logged in! Have fun!');
		}
		else {
			new Message('error', 'An error occured! <a href="#">Forgot your password?</a>');
		}
	}
	header('Location: ./index.php');
?>
