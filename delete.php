<?php
	require_once(dirname(__FILE__) . '/includes/setup.php');
	if(empty($_GET['id'])) { // is_numeric
		new Message('error', 'The post could not be deleted.');
	}
	else {
		$post = R::load('post', $_GET['id']);
		if($_SESSION['user'] == $post->author) {
			R::trash($post);
			new Message('success', 'The post was successfully deleted.');
		}
	}
	header('Location: ./index.php');
?>