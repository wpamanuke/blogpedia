<?php 
	global $post;
	$post_ids = range(1, (($post->ID)-1)); 
	$related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 3, 'post__not_in' => array($post->ID), 'post__in' => $post_ids ) );
	if( $related ) { ?>
		<!-- Related Posts  -->
		<div class="bped-related-post">
			<div class="bped-related-post-title">
				<h2><?php esc_html_e('Related Post','blogpedia'); ?></h2>
			</div>
			
			<div class="row">
				<?php
					foreach( $related as $post ) {
						setup_postdata($post); ?>
						<div class="col-lg-4 col-md-4 col-sm-6">
							<article class="post-article">
								
								<div class="bped-related-post-header">
									<h4 class="meta-title"><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h4>
								</div>
								<figure class="bped-related-post-image"> 
									<a class="image-link" href="<?php the_permalink(); ?>" title="">
										<?php the_post_thumbnail( 'medium' ); ?>
									</a>
								</figure>
							</article>        
						</div>
				<?php } wp_reset_query(); ?>
			</div>
			
		</div>
		<!-- ./Related Posts --> 	
	<?php } 
?>
		
	