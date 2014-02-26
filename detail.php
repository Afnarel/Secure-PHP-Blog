<?php
$PAGE_TITLE = 'Post detail';
require_once(dirname(__FILE__) . '/includes/top.php');

$LIMIT_TEXT = false;
$post = R::load('post', $_GET['id']);
include('post.php');

echo '<iframe sandbox="" seamless="seamless" src="comments.php?id='."post-$post->id".'" frameborder="0" height="600" width="100%"></iframe>';

require_once(dirname(__FILE__) . '/includes/bottom.php');
?>
