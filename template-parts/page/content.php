<div class="row block1">
	<div class="col-md-12">
		<div id="post-<?php the_ID(); ?>" <?php post_class('block-single'); ?>>
			<?php the_title( 
				'<header class="entry-header"><h1 class="entry-title">', 
				'</h1></header>' 
			); ?>
			<?php if (has_post_thumbnail()) { ?>
					<figure class="post-thumbnail">
						<?php the_post_thumbnail( 'blogpedia-image-large'); ?>
					</figure>
			<?php } ?>
			<div class="entry-summary">
				<?php the_content(); ?>
			</div>
			<div class="clearfix"></div>
			<?php the_tags('<div class="entry-tags"><i class="fa fa-tag"></i><ul><li>','</li><li>','</li></ul><div class="clearfix"></div></div>'); ?>
		</div>
		<?php
			comments_template();
		?>
	</div>	
</div>