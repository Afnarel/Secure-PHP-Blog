<?php
$PAGE_TITLE = 'Index';
require_once(dirname(__FILE__) . '/includes/top.php');
?>

<?php

	echo is_connected() ? 'connecte' : 'pas connecte';
	
	
foreach(R::findAll('post') as $post){
	include('post.php');
}
?>
	
	<a href="detail.php#disqus_thread" data-disqus-identifier="lol">Commentaires de l'article</a><br /><br />
	<?
}

?>

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
