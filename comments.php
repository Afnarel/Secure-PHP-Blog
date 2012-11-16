<?php
require_once(dirname(__FILE__) . '/includes/setup.php');
?>

<!-- Script affichant les commentaires DISQUS -->
	<div>
		<div id="disqus_thread"></div>
		<script type="text/javascript">
			/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
			var disqus_identifier = "<?php echo $purifier->purify($_GET['id']) ?>";
			var disqus_shortname = 'blogscu'; // required: replace example with your forum shortname
			var disqus_title = 'WASP Blog';
			var disqus_developer = 1;

			/* * * DON'T EDIT BELOW THIS LINE * * */
			(function() {
				var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
				dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
				(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
			})();
		</script>
		<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
		<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
	</div>
	<!-- Fin du script -->
