<article id="post-<?php the_ID(); ?>" <?php post_class('hentry'); ?>>
<div class="row">
	<div class="col-md-3">
		<div class="block-single__meta">
			<div class="block-meta__iconcat">
				<?php blogpedia_post_meta(array('icon'),''); ?>
				<div class="block-meta__category">
					<?php blogpedia_post_meta(array('cat'),''); ?>
				</div>
			</div>
			<div class="block-meta__other">
				<?php blogpedia_post_meta(array('author','date','comment'),''); ?>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<?php blogpedia_before_post_content(); ?>
		<div class="block-single">
			<?php the_title( 
				'<header class="entry-header"><h1 class="entry-title">', 
				'</h1></header>' 
			); ?>
			<?php if (blogpedia_data('single_image_show')=='enable') { ?>
				<?php if (has_post_thumbnail()) { ?>
						<figure class="post-thumbnail">
							<?php the_post_thumbnail( 'blogpedia-image-large'); ?>
						</figure>
				<?php } ?>
			<?php } ?>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
			<div class="clearfix"></div>
			<?php the_tags('<div class="entry-tags"><i class="fa fa-tag"></i><ul><li>','</li><li>','</li></ul><div class="clearfix"></div></div>'); ?>
		</div>
		<?php
			blogpedia_after_post_content();
		?>
		<?php
			comments_template();
		?>
	</div>	
</div>
</article>