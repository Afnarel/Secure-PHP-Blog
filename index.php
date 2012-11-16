<?php
$PAGE_TITLE = 'Index';
require_once(dirname(__FILE__) . '/includes/top.php');
?>

<?php
$NB_POSTS_PER_PAGE = 5;
$NB_POSTS = R::count('post');
$page = empty($_GET['p']) ? 0 : $purifier->purify($_GET['p']);
$first = $page * $NB_POSTS_PER_PAGE;
$last_page = floor(($NB_POSTS-1) / 5);
$LIMIT_TEXT = true;

foreach(R::findAll('post', " ORDER BY id DESC LIMIT $first, $NB_POSTS_PER_PAGE ") as $post){
	include('post.php');
?>
	
    <p>
    	<a href="detail.php?id=<?php echo $post->id; ?>#disqus_thread" data-disqus-identifier="post-<?php echo $post->id; ?>"></a>
    </p>
<?php
}
?>

<?php if($NB_POSTS > $NB_POSTS_PER_PAGE) { ?>
<div class="pagination pagination-large pagination-centered">
    <ul>
        <?php
            if($page == 0) {
                echo '<li class="disabled"><span>«</span></li>';
            }
            else {
                echo '<li><a href="index.php?p=' . ($page-1) . '">«</a></li>';
            }
            for($i=1; $i<($NB_POSTS/$NB_POSTS_PER_PAGE) + 1; $i++) {
                // If the page is the one on which we are
                if($page == $i-1) {
                    echo '<li class="active"><span>' . $i . '</span></li>';
                }
                else {
                    echo '<li><a href="index.php?p=' . ($i-1) . '">' . $i . '</a></li>';
                }
            }
            if($page == $last_page) {
                echo '<li class="disabled"><span>»</span></li>';
            }
            else {
                echo '<li><a href="index.php?p=' . ($page + 1) . '">»</a></li>';
            }
        ?>
    </ul>
</div>
<?php } ?>

<!-- Script permettant d'inclure le nombre de commentaires d'un post -->
<script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'blogscu'; // required: replace example with your forum shortname
        var disqus_title = 'WASP Blog';
        var disqus_developer = 1;

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function () {
            var s = document.createElement('script'); s.async = true;
            s.type = 'text/javascript';
            s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
            (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
        }());
</script>
<!-- Fin du script -->

<?php
require_once(dirname(__FILE__) . '/includes/bottom.php');
?>
