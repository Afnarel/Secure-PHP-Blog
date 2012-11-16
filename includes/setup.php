<?php
function is_connected() {
	return isset($_SESSION['user']);
}

/**
* Stores the user mail
*/
function connect($user) {
	$_SESSION['user'] = $user;
}

function toDate($unix) {
	return date('Y-m-d H:i:s', $unix);
}

function toTime($date) {
	return strtotime($date);
}

function now() {
	return toDate(time());
}

function hoursFromNow($nb) {
	return toDate(time()+60*60*$nb);
}

function daysFromNow($nb, $asUnix = false) {
	if($asUnix) return time()+60*60*24*$nb;
	return toDate(time()+60*60*24*$nb);
}

/**
* Sends an email to this user with the given title and body
*/
function sendMail($title, $body, $to_mail, $to_username) {
	$mail = new Mail(array(NOREPLY_ADDRESS => NOREPLY_NAME), $title, $body, $body);
	$mail->mailer(SMTP_SERVER, SMTP_PORT, SMTP_LOGIN, SMTP_PASSWORD, SMTP_OVER_SSL);
	$mail->addRecipient($to_mail, $to_username);
	$failedRecipients = $mail->send();
	return empty($failedRecipients);
}

/**
* Stores a token that will be used, for instance, in persistent login requests (in a cookie)
*/
function storeToken($table, $id, $identifier, $token, $expiration_date) {
	$stored_token = R::dispense($table);
	$stored_token->user_id = $id;
	$stored_token->identifier = $identifier;
	$stored_token->token = sha1($token);
	$stored_token->expiration_date = $expiration_date;
	R::store($stored_token);
	return $stored_token;
}

/**
* Stores a token that will be used, for instance, in password recovery
* and account validation links
* The difference between the TheUser::storeToken function and this one is that
* if a token already exists for the user of id $id, this function will replace
* its values ($identifier, $token and $expiration_date) instead of creating a new one
*/
function storeUniqueToken($table, $id, $identifier, $token, $expiration_date) {
	$stored_token = R::findOne($table, ' user_id = ? ', array($id));
	if($stored_token == NULL) {
		$stored_token = R::dispense($table);
		$stored_token->user_id = $id;
	}
	$stored_token->identifier = $identifier;
	$stored_token->token = sha1($token);
	$stored_token->expiration_date = $expiration_date;
	R::store($stored_token);
}

function validateToken($table, $identifier, $token) {
	// Checks if the access token exists

	$bean = R::findOne($table,' identifier = ? AND token = ? ', array($identifier, sha1($token)));

	if($bean !== NULL) {
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


/* *************************** *
 * ***** CSRF PROTECTION ***** *
 * *************************** */
	/**
	* Returns a 32 bytes unique token that can be used for password
	* recovery, account confirmation, persistent login (remember me)
	* or other purposes
	* Warning: this token must be hashed before you store it in the
	* database if it is "password equivalent" (meaning if someone gets
	* hold of it he can log into the website, or do stuff as if he were
	* another user)
	*/
	function uniqueToken() {
		return md5(uniqid(mt_rand(), true));
	}

	/**
	* if $val is true, activates the CSRF protection
	* by setting the $_SESSION['csrf_token'] variable
	* Otherwise, unset the $_SESSION['csrf_token'] to
	* stop CSRF protection
	*/
	function csrfProtect($val = true) {
		if($val) {
			if(!csrfProtectionIsActive()) {
				csrfRenew();
			}
		} else {
			unset($_SESSION['csrf_token']);
		}
	}

	function csrfProtectionIsActive() {
		return !empty($_SESSION['csrf_token']);
	}

	/**
	* If $renew == true : Nonce (one time only token)
	* If $renew == false : Per session token: the CSRF token
	* will be generated once at the start of the session and will stay
	* the same until the user logs out => avoids multiple browser windows problems
	* 
	* Checks whether the CSRF $token provided by a user is valid (boolean)
	* /!\ Warning: unless $renew is set to false, this function has a 
	* side-effect of replacing the CSRF challenge with a new one
	* (the previous one is invalidated)
	*/
	function csrfCheck($token = NULL, $renew = false) {
		// Compare the challenge with the token provided by the user
		$challenge =  csrfToken();

		// If they don't match, return false. Otherwise, return true.
		// If $renew is set to true, replace 
		// the CSRF token : "one time only token"
		if($renew) {
			csrfRenew();
		}

		if($token == NULL && !empty($_POST['csrftoken'])) {
			$token = $_POST['csrftoken'];
		}

		if($challenge != $token) {
			new Message('error', 'CSRF error!');
			return false;
		}
		return true;
	}

	/**
	* Renews the CSRF challenge used
	*/
	function csrfRenew() {
		$_SESSION['csrf_token'] = uniqueToken();
	}

	/**
	* Returns the CSRF challenge token used
	*/
	function csrfToken() {
		return $_SESSION['csrf_token'];
	}

	function csrfLink($name, $text, $url, $params = array()) {
	$token = csrfToken();
	$paramsString = "";
	foreach ($params as $key => $value) {
		$paramsString .= "\t<input type=\"hidden\" name=\"$key\" value=\"$value\" />\n";
	}
	$link=<<<END
<a href="#" onclick="$name.submit()">$text</a>
<form name="$name" method="POST" action="$url" style="display: none">
	<input type="hidden" name="csrftoken" value="$token" />
$paramsString
</form>
END;

		return $link;
	}
/* ********************************** *
 * ***** END OF CSRF PROTECTION ***** *
 * ********************************** */


//require_once(dirname(__FILE__).'/../classes/Message.php');
require_once(dirname(__FILE__) . '/autoload.php');

// Mail
// -- SMTP
define('SMTP_SERVER', 'smtp.gmail.com');
define('SMTP_OVER_SSL', true);
define('SMTP_PORT', 465);
define('SMTP_LOGIN', 'waspblog2@gmail.com');
define('SMTP_PASSWORD', 's0m3password');
define('NOREPLY_ADDRESS', 'admin@localhost.org');
define('NOREPLY_NAME', 'Website Admin');

// Set up the database connection
define('DB_HOST', 'localhost');
define('DB_NAME', 'wasp');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_DSN_PDO', 'mysql:host='.DB_HOST.';dbname='.DB_NAME);

define('LINK_VALIDITY', 1);

define('RECAPTCHA_PUBLICKEY', '6Ld7J9kSAAAAAAVgf3HY-kX54TiG8eWohF3TPHI1');
define('RECAPTCHA_PRIVATEKEY', '6Ld7J9kSAAAAAOCwpZa_Gr9iZSVETHHGc4PzleLH');

// Used for persistent cookie (both clien-side and server-side) for instance
define('SESSION_DURATION', 7); // In days
define('HTTPS_ONLY', false);
$_SERVER['HTTPS'] = HTTPS_ONLY;

/*
// DISPLAY ERRORS
ini_set('display_errors', 1);
error_reporting(E_ALL);
*/

// So that the dates of the posts are the right ones
ini_set('date.timezone', "Europe/Paris");

define('DOMAIN', 'http://localhost');
define('PROJECT_NAME', 'The WASP blog');

define('TITLE', 'The WASP blog', true);
define('ROOTPATH', '/WASP-blog/', true);

$SCRIPTS = array(
	'bootstrap.min.js'
);

$STYLESHEETS = array(
	'app.css',
	'bootstrap.min.css'
);

header("Cache-Control: no-cache, must-revalidate");
session_start();

csrfProtect();

try {
	R::setup(DB_DSN_PDO, DB_USER, DB_PASSWORD);
}
catch(PDOException $e) {
	new Message('error', 'Failed to connect to the database.');
}

if(!is_connected()) {
	// If the user provides a valid persistent login
	// cookie, he is logged in
	if(isset($_COOKIE['auth'])) {
		// If the token is valid (found in the database and not outdated), return the corresponding user
		// If the token is invalid, return NULL.
		list($identifier, $token) = explode(':', $_COOKIE['auth']);
		$user = validateToken('persistentlogin', $identifier, $token);

		if($user !== NULL) {
			$user->last_connection_date = now();
			R::store($user);
			$_SESSION['user'] = $user->id;
			if(isset($_POST['rememberme'])) {
				$identifier = md5($_POST['mail']);
				$token = uniqueToken();

				// Issue a cookie to the client
				// bool setcookie ( string $name [, string $value [, int $expire = 0 [, string $path [, string $domain [, bool $secure = false [, bool $httponly = false ]]]]]] )
				// secure = send only over HTTPS
				setcookie('auth', "$identifier:$token", daysFromNow(SESSION_DURATION, true), '/', '' , HTTPS_ONLY, true);

				// Store the informations in the database
				storeToken('persistentlogin', $user->id, $identifier, $token, daysFromNow(SESSION_DURATION), false);
			}
			new Message('success', 'You are now logged in! Have fun!');
		}
	}
}

/*********** htmlpurifier ***********************************/
require_once 'htmlpurifier/HTMLPurifier.auto.php';

$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);
/************************************************************/

?>
