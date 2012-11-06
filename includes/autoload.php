<?php
// Autoloading of class (PHP5)
function app_autoloader($class) {
	$path = 'classes/'.$class.'.php';
	if(file_exists($path)) {
		error_log($path);
		require_once($path);
	}
}

spl_autoload_register('app_autoloader');
?>
