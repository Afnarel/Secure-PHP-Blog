<?php
$PAGE_TITLE = 'Index';
require_once(dirname(__FILE__) . '/includes/top.php');
?>

<?php

	echo is_connected() ? 'connecte' : 'pas connecte';
	
?>


<?php
require_once(dirname(__FILE__) . '/includes/bottom.php');
?>