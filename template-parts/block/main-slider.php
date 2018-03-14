

<?php
		$slider_cat = blogpedia_data('magazine_slider_cat',array(0));
		$query_args = array();
		$query_args['cat'] = implode( ', ',$slider_cat);
		$query_args['ignore_sticky_posts'] = 1;
		$query_args['posts_per_page'] = blogpedia_data('magazine_slider_post_count',6);
		$query_args['meta_query'] = array(array('key' => '_thumbnail_id'));
		$widget_posts = new WP_Query($query_args);
      
			if ($widget_posts->have_posts()) :
		
				$last = $widget_posts->post_count;
						
				echo '<div class="owl-carousel bped-main-slider-block">' . "\n";
					$i = 0;
					
					while ($widget_posts->have_posts()) : $widget_posts->the_post();
						echo '<div class="bped-main-slider">';
							 if (has_post_thumbnail()) { 
								echo '<figure class="bped-main-slider__media post-thumbnail">';
									the_post_thumbnail( 'blogpedia-image-biggest'); 
								echo '</figure>';
							} 
							echo '<div class="bped-main-slider__content">';
								echo '<div class="container"><div class="row">';
								echo '<div class="col-md-1"><span class="icon icon-arrow-left7"><i class="fa fa-angle-left"></i></span></div>';
								echo '<div class="col-md-10">';
									echo '<div class="bped-main-slider__meta1">';
											blogpedia_post_meta(array('cat'),''); 	
									echo '</div>';
									the_title( 
										'<header class="entry-header"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', 
										'</a></header>');
									echo '<div class="bped-main-slider__meta2">';
											blogpedia_post_meta(array('author','date','comment'),''); 	
									echo '</div>';									
								echo '</div>';
								echo '<div class="col-md-1"><span class="icon icon-arrow-right7"><i class="fa fa-angle-right"></i></span></div>';
								echo '</div></div>';
							echo '</div>';
						echo '</div>';
					endwhile;
					
					wp_reset_postdata();
					
					
				echo '</div>' . "\n";
				
				
				
			endif;
	

?>
