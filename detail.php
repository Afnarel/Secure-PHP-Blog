<?php
$PAGE_TITLE = 'Post detail';
require_once(dirname(__FILE__) . '/includes/top.php');

$LIMIT_TEXT = false;
$post = R::load('post', $_GET['id']);
include('post.php');

/*
	<!-- Script affichant les commentaires DISQUS -->
	<iframe seamless="seamless" sandbox="" style="display: hidden">
		<div id="disqus_thread"></div>
		<script type="text/javascript">
			// CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE
			var disqus_shortname = 'blogscu'; // required: replace example with your forum shortname
			var disqus_title = 'WASP Blog';
			var disqus_identifier = '<?php echo "post-$post->id"; ?>';
			var disqus_developer = 1;
*/

	echo '<iframe sandbox="" seamless="seamless" src="comments.php?id='."post-$post->id".'" frameborder="0" height="600" width="100%"></iframe>';


require_once(dirname(__FILE__) . '/includes/bottom.php');
?>
