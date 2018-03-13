<?php

if ( ! function_exists( 'blogpedia_customize_register' ) ) {
  function blogpedia_customize_register( $wp_customize ) {

	/***** Register Custom Controls *****/
	// Multiple Category
	class Blogpedia_Multiple_Select extends WP_Customize_Control {

		/**
		 * The type of customize control being rendered.
		 */
		public $type = 'multiple-select';

		/**
		 * Displays the multiple select on the customize screen.
		 */
		public function render_content() {

		if ( empty( $this->choices ) )
			return;
			?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<select <?php $this->link(); ?> multiple="multiple" style="height: 100%;">
						<?php
							foreach ( $this->choices as $value => $label ) {
								$selected = ( in_array( $value, $this->value() ) ) ? selected( 1, 1, false ) : '';
								echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
							}
						?>
					</select>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				</label>
		<?php }
	}
	
	
	
	
	// Upgrade Class
	class blogpedia_Upgrade extends WP_Customize_Control {
        public function render_content() {  ?>
 
			<p class="blogpedia-button">
				<a href="http://wpamanuke.com/blogpedia-wordpress-theme/" target="_blank" class="button button-secondary">
					<?php esc_html_e('Theme Documentation', 'blogpedia'); ?>
				</a>
			</p>
			<p class="blogpedia-button">
				<a href="http://wpamanuke.com/contact" target="_blank" class="button button-secondary">
					<?php esc_html_e('Support Forum', 'blogpedia'); ?>
				</a>
			</p><?php
        }
    }

    /***** Add Panels *****/

	$wp_customize->add_panel('blogpedia_theme_options', array('title' => esc_html__('Theme Options', 'blogpedia'), 'description' => '', 'capability' => 'edit_theme_options', 'theme_supports' => '', 'priority' => 1));

	/***** Add Sections *****/

	$wp_customize->add_section('blogpedia_general', array('title' => esc_html__('General', 'blogpedia'), 'priority' => 1, 'panel' => 'blogpedia_theme_options'));
	$wp_customize->add_section('blogpedia_layout', array('title' => esc_html__('Layout', 'blogpedia'), 'priority' => 2, 'panel' => 'blogpedia_theme_options'));
	$wp_customize->add_section('blogpedia_single', array('title' => esc_html__('Single', 'blogpedia'), 'priority' => 4, 'panel' => 'blogpedia_theme_options'));
	$wp_customize->add_section('blogpedia_homepage', array('title' => esc_html__('Magazine Template', 'blogpedia'), 'priority' => 5, 'panel' => 'blogpedia_theme_options'));
	
	$wp_customize->add_section('blogpedia_upgrade', array('title' => esc_html__('More Features &amp; Options', 'blogpedia'), 'priority' => 6, 'panel' => 'blogpedia_theme_options'));

    /***** Add Settings *****/
	
	// General
    $wp_customize->add_setting('blogpedia_options[general_excerpt_length]', array('default' => 25, 'type' => 'option', 'sanitize_callback' => 'blogpedia_sanitize_integer'));
    $wp_customize->add_setting('blogpedia_options[general_excerpt_more]', array('default' => '[...]', 'type' => 'option', 'sanitize_callback' => 'blogpedia_sanitize_text'));
    // Layout
    $wp_customize->add_setting('blogpedia_options[layout_theme]', array('default' => 'blogpedia-box', 'type' => 'option', 'sanitize_callback' => 'blogpedia_sanitize_select'));
	// Single
	$wp_customize->add_setting('blogpedia_options[single_breadcrumb_show]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'blogpedia_sanitize_select'));
	$wp_customize->add_setting('blogpedia_options[single_image_show]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'blogpedia_sanitize_select'));
	$wp_customize->add_setting('blogpedia_options[single_post_nav_show]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'blogpedia_sanitize_select'));
	$wp_customize->add_setting('blogpedia_options[single_related_post_show]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'blogpedia_sanitize_select'));
	$wp_customize->add_setting('blogpedia_options[single_breadcrumb_image_src]',array('default' => '','type' => 'option', 'transport' => 'refresh','sanitize_callback' => 'absint'));
	
	// Homepage Magazine Template
	$wp_customize->add_setting('blogpedia_options[magazine_slider_show]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'blogpedia_sanitize_select'));
	$wp_customize->add_setting('blogpedia_options[magazine_slider_cat]', array('default' => array(0), 'type' => 'option', 'sanitize_callback' => 'blogpedia_sanitize_multiple'));
	$wp_customize->add_setting('blogpedia_options[magazine_slider_post_count]', array('default' => '6', 'type' => 'option', 'sanitize_callback' => 'absint'));
	
	$wp_customize->add_setting('blogpedia_options[magazine_top_feature_show]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'blogpedia_sanitize_select'));
	$wp_customize->add_setting('blogpedia_options[magazine_top_feature_cat]', array('default' => array(0), 'type' => 'option', 'sanitize_callback' => 'blogpedia_sanitize_multiple'));
	$wp_customize->add_setting('blogpedia_options[magazine_top_feature_post_count]', array('default' => '6', 'type' => 'option', 'sanitize_callback' => 'absint'));
	
	
	// Upgrade
	$wp_customize->add_setting('blogpedia_options[premium_version_upgrade]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'esc_attr'));
	
	
    /***** Add Controls *****/
	
	// General
    $wp_customize->add_control('general_excerpt_length', array('label' => esc_html__('Custom excerpt length in words', 'blogpedia'), 'section' => 'blogpedia_general', 'settings' => 'blogpedia_options[general_excerpt_length]', 'priority' => 1, 'type' => 'text'));
    $wp_customize->add_control('general_excerpt_more', array('label' => esc_html__('Custom excerpt more text', 'blogpedia'), 'section' => 'blogpedia_general', 'settings' => 'blogpedia_options[general_excerpt_more]', 'priority' => 2, 'type' => 'text'));
	
  
    // Layout
	$wp_customize->add_control('layout_theme', array('label' => esc_html__('Layout Type', 'blogpedia'), 'section' => 'blogpedia_layout', 'settings' => 'blogpedia_options[layout_theme]', 'priority' => 1, 'type' => 'select', 'choices' => array('bped--l--full' => esc_html__('Full Width', 'blogpedia'), 'bped--l--box' => esc_html__('Boxed', 'blogpedia'))));
  
	// Header
	$wp_customize->add_control('header_image_show', array('label' => esc_html__('Header Image', 'blogpedia'), 'section' => 'blogpedia_header', 'settings' => 'blogpedia_options[header_image_show]', 'priority' => 1, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'blogpedia'), 'disable' => esc_html__('Disable', 'blogpedia'))));
	$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'header_image_src',
	   array(
		  'label' => esc_html__('Header Image Ads', 'blogpedia'),
		  'description' => esc_html__( 'Header Image Ads (728x90)','blogpedia' ),
		  'section' => 'blogpedia_header',
		  'settings' => 'blogpedia_options[header_image_src]',
		  'flex_width' => false, // Optional. Default: false
		  'flex_height' => false, // Optional. Default: false
          'width' => 728, // Optional. Default: 150
          'height' => 90, // Optional. Default: 150
		  'button_labels' => array( // Optional.
			 'select' => esc_html__('Select Image', 'blogpedia'),
			 'change' => esc_html__('Change Image', 'blogpedia'),
			 'remove' => esc_html__('Remove Image', 'blogpedia'),
			 'default' => esc_html__('Default', 'blogpedia'),
			 'placeholder' => esc_html__('No Image Selected', 'blogpedia'),
			 'frame_title' => esc_html__('Select Image', 'blogpedia'),
			 'frame_button' => esc_html__('Choose Image', 'blogpedia'),
		  ),
		  'priority' => 2
	   )
	) );
	$wp_customize->add_control( 'header_image_link', array(
	  'type' => 'text',
	  'section' => 'blogpedia_header', // Add a default or your own section
	  'settings' => 'blogpedia_options[header_image_link]',
	  'label' => esc_html__('Header Image Link', 'blogpedia'),	  
	  'description' => esc_html__('Custom URL', 'blogpedia'),
	  'input_attrs' => array(
		'placeholder' =>esc_html__('http://www.wpamanuke.com', 'blogpedia'),
	  ),
	  'priority' => 3
	) );
	$wp_customize->add_control( 'header_image_ads', array(
	  'type' => 'textarea',
	  'section' => 'blogpedia_header', // // Add a default or your own section
	   'settings' => 'blogpedia_options[header_image_ads]',
	  'label' => esc_html__('Header Ads Code', 'blogpedia'),
	  'description' => esc_html__('You can use this. If you disable header image', 'blogpedia'),
	  'priority' => 4
	) );
	// Single
	$wp_customize->add_control('single_breadcrumb_show', array('label' => esc_html__('Breadcrumb', 'blogpedia'), 'section' => 'blogpedia_single', 'settings' => 'blogpedia_options[single_breadcrumb_show]', 'priority' => 1, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'blogpedia'), 'disable' => esc_html__('Disable', 'blogpedia'))));
	$wp_customize->add_control('single_image_show', array('label' => esc_html__('Image on Single', 'blogpedia'), 'section' => 'blogpedia_single', 'settings' => 'blogpedia_options[single_image_show]', 'priority' => 2, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'blogpedia'), 'disable' => esc_html__('Disable', 'blogpedia'))));
	$wp_customize->add_control('single_post_nav_show', array('label' => esc_html__('Post Next Previous', 'blogpedia'), 'section' => 'blogpedia_single', 'settings' => 'blogpedia_options[single_post_nav_show]', 'priority' => 3, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'blogpedia'), 'disable' => esc_html__('Disable', 'blogpedia'))));
	$wp_customize->add_control('single_related_post_show', array('label' => esc_html__('Related Post', 'blogpedia'), 'section' => 'blogpedia_single', 'settings' => 'blogpedia_options[single_related_post_show]', 'priority' => 4, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'blogpedia'), 'disable' => esc_html__('Disable', 'blogpedia'))));
	$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'single_breadcrumb_image_src',
	   array(
		  'label' => esc_html__('Breadcrumb Image', 'blogpedia'),
		  'description' => esc_html__( 'Breadcrumb Image (1200x100)','blogpedia' ),
		  'section' => 'blogpedia_single',
		  'settings' => 'blogpedia_options[single_breadcrumb_image_src]',
		  'flex_width' => false, // Optional. Default: false
		  'flex_height' => false, // Optional. Default: false
          'width' => 1200, // Optional. Default: 150
          'height' => 100, // Optional. Default: 150
		  'button_labels' => array( // Optional.
			 'select' => esc_html__('Select Image', 'blogpedia'),
			 'change' => esc_html__('Change Image', 'blogpedia'),
			 'remove' => esc_html__('Remove Image', 'blogpedia'),
			 'default' => esc_html__('Default', 'blogpedia'),
			 'placeholder' => esc_html__('No Image Selected', 'blogpedia'),
			 'frame_title' => esc_html__('Select Image', 'blogpedia'),
			 'frame_button' => esc_html__('Choose Image', 'blogpedia'),
		  ),
		  'priority' =>5
	   )
	) );
	
	// Homepage Magazine Template
	$wp_customize->add_control('magazine_slider_show', array('label' => esc_html__('Header Slider', 'blogpedia'), 'section' => 'blogpedia_homepage', 'settings' => 'blogpedia_options[magazine_slider_show]', 'priority' => 1, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'blogpedia'), 'disable' => esc_html__('Disable', 'blogpedia'))));
	$wp_customize->add_control(
		new Blogpedia_Multiple_Select (
			$wp_customize,
			'magazine_slider_cat',
			array(
				'settings' => 'blogpedia_options[magazine_slider_cat]',
				'label'    => 'Slider Category',
				'section'  => 'blogpedia_homepage', // Enter the name of your own section
				'type'     => 'multiple-select', // The $type in our class
				'choices' => blogpedia_cats(),
				'description' => 'Hold Ctrl ( to select multiple categories ) ',
				 'priority' => 2
			)
		)
	);
	$wp_customize->add_control('magazine_slider_post_count', array('label' => esc_html__('Slider Post Count', 'blogpedia'), 'section' => 'blogpedia_homepage', 'settings' => 'blogpedia_options[magazine_slider_post_count]', 'priority' => 3, 'type' => 'text','description' => 'Fill 3 , 6 , 9 , 12 '));
	
	$wp_customize->add_control('magazine_top_feature_show', array('label' => esc_html__('Top Feature', 'blogpedia'), 'section' => 'blogpedia_homepage', 'settings' => 'blogpedia_options[magazine_top_feature_show]', 'priority' => 4, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'blogpedia'), 'disable' => esc_html__('Disable', 'blogpedia'))));
	$wp_customize->add_control(
		new Blogpedia_Multiple_Select (
			$wp_customize,
			'magazine_top_feature_cat',
			array(
				'settings' => 'blogpedia_options[magazine_top_feature_cat]',
				'label'    => 'Top Feature Category',
				'section'  => 'blogpedia_homepage', // Enter the name of your own section
				'type'     => 'multiple-select', // The $type in our class
				'choices' => blogpedia_cats(),
				'description' => 'Hold Ctrl ( to select multiple categories ) ',
				 'priority' => 5
			)
		)
	);
	$wp_customize->add_control('magazine_top_feature_post_count', array('label' => esc_html__('Top Feature Post Count', 'blogpedia'), 'section' => 'blogpedia_homepage', 'settings' => 'blogpedia_options[magazine_top_feature_post_count]', 'priority' => 8, 'type' => 'text','description' => 'Fill 4 , 8 , 12 '));
	
	// Upgrade
	$wp_customize->add_control(new blogpedia_Upgrade($wp_customize, 'premium_version_upgrade', array('section' => 'blogpedia_upgrade', 'settings' => 'blogpedia_options[premium_version_upgrade]', 'priority' => 1)));
	
  }
}
add_action('customize_register', 'blogpedia_customize_register');

/***** Data Sanitization *****/
if (!function_exists('blogpedia_sanitize_text')) {
	function blogpedia_sanitize_text($input) {
		return wp_kses_post(force_balance_tags($input));
	}
}

if (!function_exists('blogpedia_sanitize_integer')) {
	function blogpedia_sanitize_integer($input) {
		return strip_tags($input);
	}
}

if (!function_exists('blogpedia_sanitize_checkbox')) {
	function blogpedia_sanitize_checkbox($input) {
		if ($input == 1) {
			return 1;
		} else {
			return '';
		}
	}
}

if (!function_exists('blogpedia_sanitize_select')) {
	function blogpedia_sanitize_select($input) {
		return wp_filter_nohtml_kses( $input );
	}
}

if (!function_exists('blogpedia_sanitize_url')) {
	function blogpedia_sanitize_url( $url ) {
	  return esc_url_raw( $url );
	}
}

if (!function_exists('blogpedia_sanitize_multiple')) {
	function blogpedia_sanitize_multiple( $input ) {
		$multi_values = !is_array( $input ) ? explode( ',', $input ) : $input;

		return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
	}
}

if (!function_exists('blogpedia_cats')) {
	function blogpedia_cats() {
	  $cats = array();
	  $cats[0] = "All";
	  foreach ( get_categories() as $categories => $category ) {
		$cats[$category->term_id] = $category->name;
	  }
	  return $cats;
	}
}

/***** Return Theme Options / Set Default Options *****/
// load data

if (!function_exists('blogpedia_theme_options')) {
	function blogpedia_theme_options() {
		$blogpedia_options = get_option('blogpedia_options');
		$theme_options = wp_parse_args(
			$blogpedia_options,
			blogpedia_default_options()
		);
		return $theme_options;
	}
}

if (!function_exists('blogpedia_default_options')) {
	function blogpedia_default_options() {
		$default_options = array(
			'general_excerpt_length' => '35',
			'general_excerpt_more' => '[..]',
			'layout_theme' => 'bped--l--box',
			'single_breadcrumb_show' => 'enable',
			'single_image_show' => 'enable',
			'single_post_nav' => 'enable',
			'single_related_post_show' => 'enable',
			'single_breadcrumb_image_src' => '',
			'magazine_slider_show' => 'enable',
			'magazine_slider_cat' => array(0),
			'magazine_slider_post_count' => 6,
			'magazine_top_feature_show' => 'enable',
			'magazine_top_feature_cat' => array(0),
			'magazine_top_feature_post_count' => 8
		);
		return $default_options;
	}
}

// get data key
if (!function_exists('blogpedia_data')) {
	function blogpedia_data($key,$default='') {
		$data = blogpedia_theme_options();
		if ($data) {
			if (isset($data[$key])) {
				return $data[$key];
			}
		}
		return $default;
	}
}

if (!function_exists('blogpedia_echo_data')) {
	function blogpedia_echo_data() {
		print_r(blogpedia_theme_options());
	}
}
if (!function_exists('blogpedia_reset_data')) {
	function blogpedia_reset_data() {
		update_option('blogpedia_options','');
	}
}
/***** Enqueue Customizer CSS *****/

if (!function_exists('blogpedia_customizer_css')) {
	function blogpedia_customizer_css() {
		wp_enqueue_style('blogpedia-customizer', get_template_directory_uri() . '/public/admin/customizer.css', array());
	}
}
add_action('customize_controls_print_styles', 'blogpedia_customizer_css');

?>