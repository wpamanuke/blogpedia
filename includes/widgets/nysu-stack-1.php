<?php

/***** BLOGPEDIA Stack 1 *****/

class blogpedia_stack_1_widget extends WP_Widget {
   function __construct() {
		parent::__construct(
			'blogpedia_stack_1', esc_html_x('BLOGPEDIA Stack 1 - Mag (12/12)', 'widget name', 'blogpedia'),
			array(
				'classname' => 'blogpedia-stack-1-widget',
				'description' => esc_html__('BLOGPEDIA Stack 1 widget posts (3 in 1).', 'blogpedia'),
				'customize_selective_refresh' => true
			)
		);
	}
	function widget($args, $instance) {
		$defaults = array('title' => '', 'category' => 0, 'tags' => '','sticky' => 1);
        $instance = wp_parse_args($instance, $defaults);
		$query_args = array();
		$query_args['ignore_sticky_posts'] = $instance['sticky'];
		if (0 !== $instance['category']) {
			$query_args['cat'] = $instance['category'];
		}
		if (!empty($instance['tags'])) {
			$tag_slugs = explode(',', $instance['tags']);
			$tag_slugs = array_map('trim', $tag_slugs);
			$query_args['tag_slug__in'] = $tag_slugs;
		}
		$query_args['posts_per_page'] = 3;
		
		$widget_posts = new WP_Query($query_args);
        echo $args['before_widget'];
			if ($widget_posts->have_posts()) :
				if (!empty($instance['title'])) {
					echo $args['before_title'] . esc_html(apply_filters('widget_title', $instance['title'])) . $args['after_title'];
				}
				$last = $widget_posts->post_count;
				echo '<div class="blogpedia-normal-widget">' . "\n";
				echo '<div class="blogpedia-stack-post-widget">' . "\n";
					$i = 0;
					
					while ($widget_posts->have_posts()) : $widget_posts->the_post();
						$i++;
						if ($i==1) { 
							echo '<div class="blogpedia-stack-1">';
							get_template_part( 'template-parts/block/stack', '1-1' );
						
						} else {
							if ($i==2) { 
								echo '<div class="blogpedia-stack-right">';
								get_template_part( 'template-parts/block/stack', '1-2' );
								
							} else 
							if ($i==3) {
								get_template_part( 'template-parts/block/stack', '1-2');
								echo '</div>';
								echo '<div class="clearfix"></div>';
								echo '</div>';
							}
						}
					endwhile;
					if (($i%3)==1) { 
						get_template_part( 'template-parts/block/stack', '1-2-1');
					}
					if (($i%3)==2) { 
						get_template_part( 'template-parts/block/stack', '1-2-2');
					}
					wp_reset_postdata();
				echo '</div>' . "\n";
				echo '</div>' . "\n";
			endif;
		echo $args['after_widget'];
    }
	function update($new_instance, $old_instance) {
        $instance = array();
        if (!empty($new_instance['title'])) {
			$instance['title'] = sanitize_text_field($new_instance['title']);
		}
        if (0 !== absint($new_instance['category'])) {
			$instance['category'] = absint($new_instance['category']);
		}
		if (!empty($new_instance['tags'])) {
			$tag_slugs = explode(',', $new_instance['tags']);
			$tag_slugs = array_map('sanitize_title', $tag_slugs);
			$instance['tags'] = implode(', ', $tag_slugs);
		}

        return $instance;
    }
    function form($instance) {
        $defaults = array('title' => '', 'category' => 0, 'tags' => '', 'sticky' => 1);
        $instance = wp_parse_args($instance, $defaults); ?>
		<div class="blogpedia-border">
			<img src="<?php echo get_template_directory_uri() . '/public/images/widget/stack-1.png'; ?>" alt="" />
		</div>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'blogpedia'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('category')); ?>"><?php esc_html_e('Select a Category:', 'blogpedia'); ?></label>
            <select id="<?php echo esc_attr($this->get_field_id('category')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('category')); ?>">
            	<option value="0" <?php selected(0, $instance['category']); ?>><?php esc_html_e('All', 'blogpedia'); ?></option><?php
            		$categories = get_categories();
            		foreach ($categories as $cat) { ?>
            			<option value="<?php echo absint($cat->cat_ID); ?>" <?php selected($cat->cat_ID, $instance['category']); ?>><?php echo esc_html($cat->cat_name) . ' (' . absint($cat->category_count) . ')'; ?></option><?php
            		} ?>
            </select>
            <small><?php esc_html_e('Select a category to display posts from.', 'blogpedia'); ?></small>
		</p>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('tags')); ?>"><?php esc_html_e('Filter Posts by Tags (e.g. lifestyle):', 'blogpedia'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['tags']); ?>" name="<?php echo esc_attr($this->get_field_name('tags')); ?>" id="<?php echo esc_attr($this->get_field_id('tags')); ?>" />
	    </p>
		<?php
    }
}

?>