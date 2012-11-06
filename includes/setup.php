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

//require_once(dirname(__FILE__).'/../classes/Message.php');
require_once(dirname(__FILE__) . '/autoload.php');

// Set up the database connection
$HOST = 'localhost';
$DB_NAME = 'wasp';
$USER = 'root';
$PASSWORD = '';

define('DB_DSN_PDO', 'mysql:host='.$HOST.';dbname='.$DB_NAME);
define('DB_USER', 'root');
define('DB_PASSWORD', '');

R::setup(DB_DSN_PDO, DB_USER, DB_PASSWORD);

/*
// DISPLAY ERRORS
ini_set('display_errors', 1);
error_reporting(E_ALL);
*/

// So that the dates of the posts are the right ones
ini_set('date.timezone', "Europe/Paris");

define('TITLE', 'The WASP blog', true);
define('ROOTPATH', '/wasp/', true);

$SCRIPTS = array(
	'bootstrap.min.js'
);

$STYLESHEETS = array(
	'app.css',
	'bootstrap.min.css'
);

header("Cache-Control: no-cache, must-revalidate");
session_start();
?>