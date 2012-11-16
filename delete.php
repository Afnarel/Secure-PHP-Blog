<?php
	require_once(dirname(__FILE__) . '/includes/setup.php');

	if(is_connected() && csrfCheck()) {

		if(empty($_POST['id'])) { // is_numeric
			new Message('error', 'The post could not be deleted.');
		}

		else {
			$post = R::load('post', $purifier->purify($_POST['id']));
			if($post->id == 0) {
				new Message('error', 'This post does not exist');
			}
			else if(empty($_SESSION['user']) || $post->author !== $_SESSION['user']) {
				new Message('error', 'You don\'t have the right to delete this post');
			}
			else {
				R::trash($post);
				new Message('success', 'The post was successfully deleted.');
			}
		}

	}
	header('Location: ./index.php');
?>
