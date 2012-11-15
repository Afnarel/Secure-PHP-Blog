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

/**
* Sends an email to this user with the given title and body
*/
function sendMail($title, $body) {
	$mail = new Mail(array(NOREPLY_ADDRESS => NOREPLY_NAME), $title, $body, $body);
	$mail->mailer(SMTP_SERVER, SMTP_PORT, SMTP_LOGIN, SMTP_PASSWORD, SMTP_OVER_SSL);
	$mail->addRecipient($this->mail(), $this->username());
	$failedRecipients = $mail->send();
	return empty($failedRecipients);
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
?>