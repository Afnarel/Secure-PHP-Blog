<!DOCTYPE html>
<html>
	<head>
<?php
	if(isset($PAGE_TITLE) && trim($PAGE_TITLE) != '')
		$page_titlebar = $PAGE_TITLE . ' - ' . TITLE;
	else
		$page_titlebar = TITLE;
?>
        <title><?php echo $page_titlebar; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<?php
	// Stylesheets
	foreach ($STYLESHEETS as $css) {
		echo "\t\t<link href=\"" . ROOTPATH . 'css/' . $css . "\" rel=\"stylesheet\" media=\"screen\">\n";
	}

?>
	</head>
	<body>

<?php require_once('menu.php'); ?>

		<div class="container" id="mainContent">
			<div class="content">
				<div class="page-header">
				    <h1><?php echo $PAGE_TITLE ?></h1>
                </div>

<?php
// The output is in a buffer
ob_start();
?>
