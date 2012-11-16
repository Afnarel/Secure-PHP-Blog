<?php
	require_once(dirname(__FILE__) . '/includes/setup.php');

	// If the user isn't connected
	if(!is_connected())
	{
		$user = R::findOne('user',' email = :mail AND password = :password AND validated IS NOT NULL ',
			array(
				':mail' => $purifier->purify($_POST['mail']),
				':password' => $purifier->purify($_POST['password'])
				));
			
		// If the user is allowed
		if($user)
		{
			$_SESSION['user'] = $user->id;
			new Message('success', 'You are now logged in! Have fun!');
		}
		else {
			new Message('error', 'An error occured! <a href="recover.php">Forgot your password?</a>');
		}
	}
	header('Location: ./index.php');
?>
