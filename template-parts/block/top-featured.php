<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="bped-top-featured-title">
				
				<h3><?php  esc_html__('Top Featured Stories','blogpedia'); ?></h3>
				
				<span class="bped-top-featured-title__nav pull-right">
					<i class="fa fa-angle-left"></i>
					<i class="fa fa-angle-right"></i>
				</span>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="col-md-12">
			
<?php
		$slider_cat = blogpedia_data('magazine_top_feature_cat',array(0));
		$query_args = array();
		$query_args['cat'] = implode( ', ',$slider_cat);
		$query_args['ignore_sticky_posts'] = 1;
		$query_args['posts_per_page'] = blogpedia_data('magazine_top_feature_post_count',8);
		$query_args['meta_query'] = array(array('key' => '_thumbnail_id'));
		$widget_posts = new WP_Query($query_args);
      
			if ($widget_posts->have_posts()) :
		
				$last = $widget_posts->post_count;
						
				echo '<div class="owl-carousel bped-top-featured-block">' . "\n";
					$i = 0;
					
					while ($widget_posts->have_posts()) : $widget_posts->the_post();
						$i++;
						echo '<div class="bped-top-featured>';
								
						if (has_post_thumbnail()) { 
								echo '<figure class="bped-top-featured__media post-thumbnail">';
									the_post_thumbnail( 'blogpedia-image-medium'); 
								echo '</figure>';
								
						}
							echo '<div class="bped-top-featured__content">';
								echo '<div class="bped-top-featured__header">';
									echo '<div class="bped-top-featured__meta">';
											blogpedia_post_meta(array('cat-icon'),''); 	
									echo '</div>';
									the_title( 
			'<header class="entry-header"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', 
			'</a></header>');
								echo '</div>';
							echo '</div>';
							
						echo '</div>';
						
					endwhile;
					
						
					wp_reset_postdata();
				echo '</div>' . "\n";
			endif;
	

?>
		</div>
	</div>
</div>