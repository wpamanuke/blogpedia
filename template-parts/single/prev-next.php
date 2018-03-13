<?php
	global $post;
	$parent_post = get_post($post->post_parent);
	$attachment = is_attachment();
	$prev_post = get_previous_post();
	$next_post = get_next_post();
	if (!empty($prev_post) || !empty($next_post) || $attachment) {
		echo '<div id="bped-single-prev-next">';
		echo '<nav class="row" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">' . "\n";
			if (!empty($prev_post) || $attachment) {
				echo '<div class="col-md-6 col-xs-6">' . "\n";
						previous_post_link('%link',  
							'<div class="row">
								<div class="col-md-12  col-xs-12">'. '<span>' . esc_html__('Previous', 'blogpedia') . '</span>' .'</div>' .
								'<div class="col-md-3  col-xs-3"><i class="fa fa-angle-left"></i></div><div class="col-md-9  col-xs-9"><h4>%title</h4></div>
							</div>');
				echo '</div>' . "\n";
			} else {
				echo '<div class="col-md-6 col-xs-6"></div>';
			}
			if (!empty($next_post) || $attachment) {
				echo '<div class="col-md-6  col-xs-6">' . "\n";
						next_post_link('%link',  
							'<div class="row">
								<div class="col-md-12 col-xs-12">'. '<span>' . esc_html__('Next', 'blogpedia') . '</span>' .'</div>' .
								'<div class="col-md-9  col-xs-9"><h4>%title</h4></div><div class="col-md-3  col-xs-3"><i class="fa fa-angle-right"></i></div></div>');
				echo '</div>' . "\n";
			} else {
				echo '<div class="col-md-6 col-xs-6"></div>';
			}
		echo '</nav>' . "\n";
		echo '</div>';
	}
?>