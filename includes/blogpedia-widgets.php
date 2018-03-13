<?php
	/***** Register Widgets *****/

function blogpedia_magazine_register_widgets() {
	register_widget('blogpedia_block_1_widget');
	register_widget('blogpedia_block_2_widget');
	register_widget('blogpedia_block_3_widget');
	register_widget('blogpedia_block_4_widget');
	register_widget('blogpedia_block_5_widget');
	register_widget('blogpedia_stack_1_widget');
	register_widget('blogpedia_gallery_1_widget');
	register_widget('blogpedia_slider_1_widget');
	register_widget('blogpedia_slider_2_widget');
	register_widget('blogpedia_slider_3_widget');
	
	
}
add_action('widgets_init', 'blogpedia_magazine_register_widgets');

/***** Include Widgets *****/

require_once get_template_directory() .'/includes/widgets/blogpedia-block-1.php';
require_once get_template_directory() .'/includes/widgets/blogpedia-block-2.php';
require_once get_template_directory() .'/includes/widgets/blogpedia-block-3.php';
require_once get_template_directory() .'/includes/widgets/blogpedia-block-4.php';
require_once get_template_directory() .'/includes/widgets/blogpedia-block-5.php';

require_once get_template_directory() .'/includes/widgets/blogpedia-gallery-1.php';

require_once get_template_directory() .'/includes/widgets/blogpedia-stack-1.php';

require_once get_template_directory() .'/includes/widgets/blogpedia-slider-1.php';
require_once get_template_directory() .'/includes/widgets/blogpedia-slider-2.php';
require_once get_template_directory() .'/includes/widgets/blogpedia-slider-3.php';
?>