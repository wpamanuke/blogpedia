<article id="post-<?php the_ID(); ?>" <?php post_class('hentry'); ?>>
<div class="row block1">
	<div class="col-md-3 col-sm-3 col-xs-12">
		<div class="block1__meta entry-meta">
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
		<div class="clear-fix"></div>
			
	</div>
	<div class="col-md-9 col-sm-9 col-xs-12">
		<?php the_title( 
			'<header class="entry-header"><h3 class="block1__title entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', 
			'</a></h3></header>' 
		); ?>
		<?php if (has_post_thumbnail()) { ?>
				<figure class="block1__media post-thumbnail">
					<?php the_post_thumbnail( 'blogpedia-image-large'); ?>
				</figure>
		<?php } ?>
		<div class="block1__summary entry-summary">
			<?php the_excerpt(); ?>
		</div>
		<div class="block1__readmore pull-right">
			<a href="<?php the_permalink(); ?>" title=""><i class="fa fa-arrow-circle-right"></i>CONTINUE READING</a>
		</div>
		<div class="clear-fix"></div>
	</div>	
</div>
</article>