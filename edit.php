<?php
$PAGE_TITLE = isset($_POST['id']) ? 'Edit post' : 'Create post';
require_once(dirname(__FILE__) . '/includes/top.php');
require_once(dirname(__FILE__) . '/recaptcha/recaptchalib.php');

if(!is_connected()) {
	header('Location: ./index.php');
}
else {
	$post = NULL;
	if(!empty($_POST['id'])) {
		$post = R::load('post', $purifier->purify($_POST['id']));
		if($post->id == 0) {
			new Message('error', 'This post does not exist');
			header('Location: ./index.php');
			exit(0);
		}
		else if(empty($_SESSION['user']) || $post->author !== $_SESSION['user']) {
			new Message('error', 'You don\'t have the right to edit this post');
			header('Location: ./index.php');
			exit(0);
		}
	}
?>


<form method="POST" action="#" class="form-horizontal">
	<div class="control-group">
		<input type="text" name="post_title" placeholder="Post title" style="width: 98.5%" 
			<?php
				if(isset($_POST['post_title'])) { echo ' value="' . $_POST['post_title'] . '"'; }
				else if($post !== NULL) { echo ' value="' . $post->title . '"'; }
			?>
	</div>

	<textarea name="post_content">
		<?php
			if(isset($_POST['post_content'])) { echo $_POST['post_content']; }
			else if($post !== NULL) { echo $post->content; }
		?>
	</textarea>
	<!-- CkEditor -->
	<script src="<?php echo ROOTPATH ?>js/ckeditor/ckeditor.js"></script>
	<script type="text/javascript">CKEDITOR.replace('post_content')</script>
	<!-- //CkEditor -->

	<!-- ReCaptcha -->
<?php echo recaptcha_get_html(RECAPTCHA_PUBLICKEY); ?>
<?php
/*
	<div class="control-group pull-left">
		<script type="text/javascript"
			src="http://www.google.com/recaptcha/api/challenge?k=<?php echo RECAPTCHA_PUBLICKEY ?>">
		</script>
		<noscript>
			<iframe src="http://www.google.com/recaptcha/api/noscript?k=<?php echo RECAPTCHA_PUBLICKEY ?>"
				height="300" width="500" frameborder="0"></iframe><br>
				<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
	     		<input type="hidden" name="recaptcha_response_field" value="manual_challenge">
	  	</noscript>
  	</div>
*/
?>
  	<!-- //ReCaptcha -->
  	<div class="control-group pull-right">
		<input name="submit_post" class="btn btn-large" style="float: right; margin-top: 10px" type="submit" value="Submit">
		<input type="hidden" name="csrftoken" value="<?php echo csrfToken(); ?>" />
	</div>
</form>

<?php

	if(isset($_POST['submit_post']) && csrfCheck()) {
		$resp = recaptcha_check_answer (RECAPTCHA_PRIVATEKEY,
			$_SERVER["REMOTE_ADDR"],
			$_POST["recaptcha_challenge_field"],
			$_POST["recaptcha_response_field"]);
		if ($resp->is_valid) {
			if($post !== NULL) {
				$post->title = $purifier->purify($_POST['post_title']);
				$post->content = $purifier->purify($_POST['post_content']);
				$post->update_time = toDate(time());
			}
			else {
				$user = R::load('user', $_SESSION['user']);
				$post = R::dispense('post');
				$post->creation_time = toDate(time());
				$post->author = $user->id;
				$post->title = $purifier->purify($_POST['post_title']);
				$post->content = $purifier->purify($_POST['post_content']);
				$post->update_time = NULL;
			}
			$id = R::store($post);
			if($id) {
				new Message('success', 'Post successfully saved.');
				header('Location: ./detail.php?id=' . $id);
			}
			else {
				new Message('error', 'An error occured: the post couldn\'t be saved');
			}
		}
		else {
			new Message('error', 'Wrong captcha!');
		}
	}
?>

<?php
require_once(dirname(__FILE__) . '/includes/bottom.php');
}
?>
