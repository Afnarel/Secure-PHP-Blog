<?php
$PAGE_TITLE = isset($_POST['id']) ? 'Edit post' : 'Create post';
require_once(dirname(__FILE__) . '/includes/top.php');

if(!is_connected()) {
	header('Location: ./index.php');
}
else {
?>


<form method="POST" action="#" class="form-horizontal">

	<div class="control-group">
		<input type="text" id="post_title" placeholder="Post title" style="width: 100%;"> <!-- padding (left/right: 0) -->
	</div>

	<textarea id="post_content" name="post_area"></textarea>
	<script src="<?php echo ROOTPATH ?>js/ckeditor/ckeditor.js"></script>
	<script type="text/javascript">CKEDITOR.replace('post_content')</script>
	<input name="submit_post" class="btn btn-large" style="float: right; margin-top: 10px" type="submit" value="Submit">
</form>

<?php
	if(isset($_POST['submit_post'])) {
		$post = R::dispense('post');
		$post->creation_time = toDate(time());
		$post->author = $_SESSION['user']->id;
		$post->title = $_POST['post_title'];
		$post->content = $_POST['post_content'];
		$post->update_time = NULL;
		R::store($post);
	}
?>

<?php
require_once(dirname(__FILE__) . '/includes/bottom.php');
}
?>