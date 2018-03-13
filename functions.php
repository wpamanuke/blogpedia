<?php



/***** Custom Hooks *****/
if (!function_exists('blogpedia_after_header')) {
	function blogpedia_after_header() {
		do_action('blogpedia_after_header');
	}
}

if (!function_exists('blogpedia_before_post_content')) {
	function blogpedia_before_post_content() {
		do_action('blogpedia_before_post_content');
	}
}

if (!function_exists('blogpedia_after_post_content')) {	
	function blogpedia_after_post_content() {
		do_action('blogpedia_after_post_content');
	}
}		

/***** Theme Setup *****/

if (!function_exists('blogpedia_setup')) {
	function blogpedia_setup() {
		// Translation
		load_theme_textdomain('blogpedia', get_template_directory() . '/languages');
		add_theme_support('automatic-feed-links');
		/* Wordpress Title */
		add_theme_support( 'title-tag' );
		/* post format */
		add_theme_support( 'post-formats', array( 'aside','gallery', 'link', 'image','quote','status','video','audio','chat' ) );
		//add_filter('use_default_gallery_style', '__return_false');
		add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
		add_theme_support('post-thumbnails', array( 'post' ));
		add_theme_support('custom-background', array('default-color' => 'ffffff'));
		add_theme_support('custom-header', array('default-image' => '', 'default-text-color' => '000', 'width' => 1200, 'height' => 250, 'flex-width' => true, 'flex-height' => true,'wp-head-callback'       => 'blogpedia_header_style'));
		add_theme_support('custom-logo', array('width' => 370, 'height' => 90, 'flex-width' => true, 'flex-height' => true));
		add_theme_support('customize-selective-refresh-widgets');
		/* Menus */
		register_nav_menu('primarymenu', esc_html__('Primary Menu', 'blogpedia'));
		register_nav_menu('topmenu', esc_html__('Top Menu', 'blogpedia'));
		register_nav_menu('socialmenu', esc_html__('Social Network Menu', 'blogpedia'));
		/* Style For WP Editor */
		add_editor_style();
	}
}
add_action('after_setup_theme', 'blogpedia_setup');


/***** Add Custom Image Sizes *****/

if (!function_exists('blogpedia_image_sizes')) {
	function blogpedia_image_sizes() {
		add_image_size('blogpedia-image-biggest', 810, 550, true);
		add_image_size('blogpedia-image-gallery', 280, 280, true);
		add_image_size('blogpedia-image-large', 720, 400, true);
		add_image_size('blogpedia-image-medium', 270, 160, true);
		add_image_size('blogpedia-image-small', 110, 80, true);
	}
}
add_action('after_setup_theme', 'blogpedia_image_sizes');


/***** Set Content Width *****/

if (!function_exists('blogpedia_content_width')) {
	function blogpedia_content_width() {
		global $content_width;
		if (!isset($content_width)) {
			$content_width = 760;
		}
	}
}
add_action('template_redirect', 'blogpedia_content_width');


/***** Load CSS & JavaScript *****/

if (!function_exists('blogpedia_scripts')) {
	function blogpedia_scripts() {
		global $blogpedia_version;
		// GOOGLE FONTS
		wp_enqueue_style('blogpedia-google-opensans', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i', array(), null);
		wp_enqueue_style('blogpedia-google-sourceserifpro', 'https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600,700&amp;subset=latin-ext', array(), null);
		
		// CSS
		wp_enqueue_style('blogpedia-bootstrap', get_template_directory_uri() . '/public/css/bootstrap.min.css', array(), null);
		wp_enqueue_style('blogpedia-font-awesome', get_template_directory_uri() . '/public/css/font-awesome.min.css', array(), null);
		wp_enqueue_style('blogpedia-owlcarousel', get_template_directory_uri() . '/public/js/owlcarousel/assets/owl.carousel.min.css', array(), null);
		wp_enqueue_style('blogpedia-style', get_stylesheet_uri(), false, $blogpedia_version);
		
		// SCRIPT JS
		wp_enqueue_script("jquery");
		wp_enqueue_script('blogpedia-owlcarousel-slider', get_template_directory_uri() . '/public/js/owlcarousel/owl.carousel.min.js', array('jquery'), $blogpedia_version);
		wp_enqueue_script('blogpedia-news-ticker', get_template_directory_uri() . '/public/js/jquery.marquee.js', array('jquery'), $blogpedia_version);
		wp_enqueue_script('blogpedia-scripts', get_template_directory_uri() . '/public/js/scripts.js', array('jquery'), $blogpedia_version);
		if (is_singular() && comments_open() && get_option('thread_comments') == 1) {
			wp_enqueue_script('comment-reply');
		}
	}
}
add_action('wp_enqueue_scripts', 'blogpedia_scripts');

if (!function_exists('blogpedia_admin_scripts')) {
	function blogpedia_admin_scripts($hook) {
		if ('appearance_page_magazine' === $hook || 'widgets.php' === $hook) {
			wp_enqueue_style('blogpedia-admin', get_template_directory_uri() . '/public/admin/admin.css');
		}
	}
}
add_action('admin_enqueue_scripts', 'blogpedia_admin_scripts');

/***** Include Several Functions *****/

/***** Register Widget Areas / Sidebars	*****/

if (!function_exists('blogpedia_widgets_init')) {
	function blogpedia_widgets_init() {
		register_sidebar(array('name' => esc_html__('Sidebar)', 'blogpedia'), 'id' => 'sidebar', 'description' => esc_html__('Widget area (sidebar left/right) on single posts, pages and archives.', 'blogpedia'), 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span class="widget-title-inner">', 'after_title' => '</span></h4>'));
		
		
		
		register_sidebar(array('name' => esc_html__('Footer 1', 'blogpedia'), 'id' => 'footer-1', 'description' => esc_html__('Widget area (sidebar left/right) on single posts, pages and archives.', 'blogpedia'), 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span class="widget-title-inner">', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => esc_html__('Footer 2', 'blogpedia'), 'id' => 'footer-2', 'description' => esc_html__('Widget area (sidebar left/right) on single posts, pages and archives.', 'blogpedia'), 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span class="widget-title-inner">', 'after_title' => '</span></h4>'));
		register_sidebar(array('name' => esc_html__('Footer 3', 'blogpedia'), 'id' => 'footer-3', 'description' => esc_html__('Widget area (sidebar left/right) on single posts, pages and archives.', 'blogpedia'), 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span class="widget-title-inner">', 'after_title' => '</span></h4>'));
	}
}
add_action('widgets_init', 'blogpedia_widgets_init');

/*
if (is_admin()) {
	 get_template_directory() .'/admin/admin.php';
}


/******** include function custom ***********/

require_once get_template_directory() .'/includes/blogpedia-customizer.php';
//require_once get_template_directory() .'/includes/blogpedia-widgets.php';
require_once get_template_directory() .'/includes/blogpedia-custom-functions.php';


?>