<div class="post">
	<?php
		$author = R::load('user', $post->author);
	?>
	<h1 class="title">
		<a href="detail.php?id=<?php echo $post->id; ?>">
			<?php echo $post->title; ?>
		</a>
		<span class="post-meta">
			by <?php echo $author->username; ?> on <?php echo date("m.d.y", toTime($post->creation_time)); ?>
		</span>
		<?php if(!empty($_SESSION['user']) && $post->author == $_SESSION['user']) { ?>
			<div class="post-actions">
				[<a href="edit.php?id=<?php echo $post->id; ?>">edit</a>]
				[<a href="delete.php?id=<?php echo $post->id; ?>">delete</a>]
			</div>
		<?php } ?>
	</h1>
	<div class="content">
		<?php
			if($LIMIT_TEXT && strlen($post->content) > 1385) {
				echo substr($post->content, 0, 1385) . '... <a href="detail.php?id=' . $post->id .  '">(see more)</a>';
			}
			else {
				echo $post->content;
			}
		?>
		<?php if($post->update_time !== NULL) { ?>
			<div class="post-edit">
				Edited on <?php echo date("m.d.y", toTime($post->update_time)); ?>
			</div>
		<?php } ?>
	</div>
</div>

