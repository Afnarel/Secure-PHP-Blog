<?php
require_once(dirname(__FILE__) . '/includes/setup.php');

// If the user is connected
if(is_connected())
{
	session_destroy();
	session_start();
	new Message('success', 'You have been successfully disconnected :)');
}
header('Location: ./index.php');
?>
