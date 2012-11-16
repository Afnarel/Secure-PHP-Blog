<?php
	require_once(dirname(__FILE__) . '/includes/setup.php');

	// If the user isn't connected
	if(!is_connected())
	{
		$user = R::findOne('user',' email = :mail AND password = :password AND validated IS NOT NULL ',
			array(
				':mail' => $purifier->purify($_POST['mail']),
				':password' => sha1($purifier->purify($_POST['password']).SALT)
				));
			
		// If the user is allowed
		if($user)
		{
			$_SESSION['user'] = $user->id;
			if(isset($_POST['rememberme'])) {
				$identifier = md5($_POST['mail']);
				$token = uniqueToken();

				// Issue a cookie to the client
				// bool setcookie ( string $name [, string $value [, int $expire = 0 [, string $path [, string $domain [, bool $secure = false [, bool $httponly = false ]]]]]] )
				// secure = send only over HTTPS
				echo '====' . daysFromNow(SESSION_DURATION, true) . '====';
				setcookie('auth', "$identifier:$token", daysFromNow(SESSION_DURATION, true), '/', '' , HTTPS_ONLY, true);

				// Store the informations in the database
				storeToken('persistentlogin', $user->id, $identifier, $token, daysFromNow(SESSION_DURATION), false);
			}
			new Message('success', 'You are now logged in! Have fun!');
		}
		else {
			new Message('error', 'An error occured! <a href="recover.php">Forgot your password?</a>');
		}
	}
	header('Location: ./index.php');
?>
