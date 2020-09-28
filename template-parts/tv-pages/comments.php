<?php
$args = wp_parse_args($args);
?>

<div class="broadcast__comments comments--youtube">
	<?php foreach ($args['comments'] as $comment) {?>
		<div class="comment">
			<div class="comment_author">
				<img src="<?php echo $comment->snippet->topLevelComment->snippet->authorProfileImageUrl; ?>" alt="">
			</div>
			<div class="comment_author_name">
                <strong><?php echo $comment->snippet->topLevelComment->snippet->authorDisplayName; ?></strong> <?php echo $comment->snippet->topLevelComment->snippet->textOriginal; ?>
			</div>

			<!--div class="text"></div-->

		</div>
	<?php } ?>
</div>