<?php
$PAGE_TITLE = isset($_POST['id']) ? 'Edit post' : 'Create post';
require_once(dirname(__FILE__) . '/includes/top.php');

if(!is_connected()) {
	header('Location: ./index.php');
}
else {
	$post = NULL;
	if(!empty($_GET['id'])) {
		$post = R::load('post', $_GET['id']);
		if($post->id == 0) {
			new Message('error', 'This post does not exist');
			header('Location: ./index.php');
			exit(0);
		}
	}
?>


<form method="POST" action="#" class="form-horizontal">

	<div class="control-group">
		<input type="text" name="post_title" placeholder="Post title" style="width: 98.5%" 
			<?php if($post !== NULL) { echo ' value="' . $post->title . '"'; } ?>>
	</div>

	<textarea name="post_content">
		<?php
			if($post !== NULL) {
				echo $post->content;
			}
		?>
	</textarea>
	<script src="<?php echo ROOTPATH ?>js/ckeditor/ckeditor.js"></script>
	<script type="text/javascript">CKEDITOR.replace('post_content')</script>
	<input name="submit_post" class="btn btn-large" style="float: right; margin-top: 10px" type="submit" value="Submit">
</form>

<?php

	if(isset($_POST['submit_post'])) {
		if($post !== NULL) {
			$post->title = $_POST['post_title'];
			$post->content = $_POST['post_content'];
			$post->update_time = toDate(time());
		}
		else {
			$user = R::load('user', $_SESSION['user']);
			$post = R::dispense('post');
			$post->creation_time = toDate(time());
			$post->author = $user->id;
			$post->title = $_POST['post_title'];
			$post->content = $_POST['post_content'];
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
?>

<?php
require_once(dirname(__FILE__) . '/includes/bottom.php');
}
?>
