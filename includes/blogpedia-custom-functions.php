<?php

/***** Date *****/
if ( ! function_exists( 'blogpedia_current_time' ) ) {
	function blogpedia_current_time(  $format = 'd F Y') {
		$current_timestamp = current_time( 'timestamp' , 0 );
		return date( $format, $current_timestamp );
	}
}
/***** Post Meta *****/
if (!function_exists('blogpedia_post_format_icon')) {
	function blogpedia_post_format_icon() {
		switch ( get_post_format() ) {
			case 'audio': $icon = 'fa-volume-up'; break;
			case 'aside' : $icon = 'fa-sticky-note'; break;
			case 'chat' : $icon = 'fa-list-alt'; break;
			case 'image': $icon = 'fa-camera-retro'; break;
			case 'link' : $icon = 'fa-link	'; break;
			case 'gallery': $icon = 'fa-newspaper-o'; break;
			case 'status' : $icon = 'fa-commenting'; break;
			case 'video': $icon = 'fa-file-video-o'; break;
			case 'quote': $icon = 'fa-quote-left'; break;
			default: $icon = 'fa-pencil-square-o'; break;
		}
		return '<i class="fa ' . $icon . '"></i>';
	}
}

if ( ! function_exists( 'blogpedia_post_meta' )) {
	function blogpedia_post_meta( $args , $separator='<span class="entry-meta-separator">|</span>' ) {
		$clearfix = ' <div class="clear-fix"></div>' . "\n";
	
		if ( in_array('cat',$args) ) {
			$meta['cat'] = '<span class="entry-meta-categories">' .  get_the_category_list(' ', '') . '</span>' . "\n";
		}
		if ( in_array('icon',$args) ) {
			$meta['icon'] = '<span class="entry-meta-icon">' .  blogpedia_post_format_icon()  . '</span>' . "\n";
		}
		if ( in_array('cat-icon',$args)  ) {
			$meta['cat-icon'] = '<span class="entry-meta-categories entry-cat-icon">' . blogpedia_post_format_icon()  . get_the_category_list(' ', '') . '</span>' . "\n";
		}
		if ( in_array('date',$args) ) {
			$meta['date'] =  '<span class="entry-meta-date updated" datetime="'. esc_attr(get_the_modified_time( 'c' )) .'"><i class="fa fa-calendar"></i> '. get_the_date() . '</span>' . "\n";
		}
		if ( in_array('date-link',$args) ) {
			$meta['date-link'] =  '<span class="entry-meta-date updated" datetime="'. esc_attr(get_the_modified_time( 'c' )) .'"><a href="' . esc_url( get_month_link( get_the_time('Y') , get_the_time('m') ) ) . '">' . get_the_date() . '</a></span>' . "\n";
		}
		if ( in_array('author',$args) ) {
			$meta['author'] = '<span class="entry-meta-author author vcard" ><i class="fa fa-user-circle"></i> <a class="url fn n" href="' . esc_url( get_author_posts_url ( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>' . "\n";
		}
		if ( in_array('comment',$args) ) {	
			$meta['comment'] = '<span class="entry-meta-comments"><i class="fa fa-newspaper-o"></i><a class="blogpedia-comment-scroll" href="' . esc_url( get_permalink() . '#bped-comments' ) . '">' . absint(get_comments_number()) . ' COMMENTS</a> </span>' . "\n";
		}
		
		
		
		$numItems = count($args);
		$i = 0;
		foreach( $args as $item ) {
			echo wp_kses_post( $meta[$item] );
			if ( ++$i!=$numItems ) {
				echo wp_kses_post( $separator );
			}
		}
		
	}
}

if ( ! function_exists( 'blogpedia_the_post_thumbnail' ) ) {
	function blogpedia_the_post_thumbnail( $size='blogpedia-image-medium' , $filename='placeholder-medium.png' ) {
		echo '<figure class="post-thumbnail">';
		blogpedia_post_thumbnail( $size , $filename ); 
		echo '</figure>';
	}
}

/** Post Thumbnail **/
if (!function_exists('blogpedia_post_thumbnail')) {
	function blogpedia_post_thumbnail($size='',$file_img='') {
		
			echo '<a href="'. get_the_permalink() .'" title="'. the_title_attribute(array('echo'=>false)) .'">';
			if ( has_post_thumbnail() ) { 
				the_post_thumbnail($size);
			} else {
				echo '<img class="blogpedia-image-placeholder" src="' . get_template_directory_uri() . '/public/images/'. $file_img . '" alt="" />';
			}
			echo '<span class="overlay">'. blogpedia_post_format_icon() .'</span>';
			echo '</a>';
		
	}
}

/***** Custom Excerpts *****/
if ( ! function_exists( 'blogpedia_excerpt_length' ) ) {
	function blogpedia_excerpt_length( $length ) {
		
		$excerpt_length = blogpedia_data( 'general_excerpt_length' , 35 );
		return $excerpt_length;
	}
}
add_filter( 'excerpt_length' , 'blogpedia_excerpt_length' , 999 );

if ( ! function_exists( 'blogpedia_excerpt_more' ) ) {
	function blogpedia_excerpt_more( $more ) {		
		return ' ' . blogpedia_data( 'general_excerpt_more' , '' );
	}
}
add_filter( 'excerpt_more' , 'blogpedia_excerpt_more' );

/***** Custom Commentlist *****/

if (!function_exists('blogpedia_comments')) {
	function blogpedia_comments( $comment , $args, $depth ) { ?>
		<li id="comment-<?php comment_ID() ?>" <?php comment_class( 'bped-comment-item' ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="bped-comment-body"  itemscope itemtype="http://schema.org/Comment">
				<footer class="bped-comment-footer bped-clearfix">
					<div class="bped-comment-meta">
						<div class="vcard author bped-comment-meta-author">
							<span class="fn"><a class="comment-author-link" href="<?php comment_author_url(); ?>" itemprop="author"><?php comment_author(); ?></a></span>
						</div>
						<a class="bped-comment-meta-date"  datetime="<?php comment_date( 'Y-m-d' ) ?>T<?php comment_time( 'H:iP' ) ?>" itemprop="datePublished" href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
							<?php printf(esc_html__('%1$s at %2$s', 'blogpedia'), get_comment_date(),  get_comment_time()); ?>
						</a>
					</div>
					<figure class="bped-comment-gravatar">
						<?php echo get_avatar( $comment->comment_author_email , 60 ); ?>
					</figure>
					
				</footer>
				<?php if ( $comment->comment_approved == '0') { ?>
					<div class="bped-comment-info">
						<?php esc_html_e( 'Your comment is awaiting moderation.', 'blogpedia' ) ?>
					</div>
				<?php } ?>
				<div class="entry-content bped-comment-content"  itemprop="text">
					<?php comment_text() ?>
				</div>
				<div class="bped-meta bped-comment-meta-links"><?php
					edit_comment_link( esc_html__( 'Edit' , 'blogpedia' ), '  ', '');
					if (comments_open() && $args['max_depth'] != $depth) {
						comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'])));
					} ?>
                </div>
			</article><?php
	}
}

/***** Custom Comment Fields *****/

if ( ! function_exists( 'blogpedia_comment_fields' ) ) {
	function blogpedia_comment_fields( $fields ) {
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ($req ? " aria-required='true'" : '');
		$fields =  array(
			'author'	=>	'<p class="comment-form-author"><label for="author">' . esc_html__('Name ', 'blogpedia') . '</label>' . ($req ? '<span class="required">*</span>' : '') . '<br/><input id="author" name="author" type="text"  value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></p>',
			'email' 	=>	'<p class="comment-form-email"><label for="email">' . esc_html__('Email ', 'blogpedia') . '</label>' . ($req ? '<span class="required">*</span>' : '' ) . '<br/><input id="email" name="email" type="text"  value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></p>',
			'url' 		=>	'<p class="comment-form-url"><label for="url">' . esc_html__('Website', 'blogpedia') . '</label><br/><input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></p>'
		);
		return $fields;
	}
}
add_filter( 'comment_form_default_fields' , 'blogpedia_comment_fields' );

/***** Comment Count Output *****/

if ( ! function_exists( 'blogpedia_comment_count' ) ) {
	function blogpedia_comment_count() {
		echo '<a class="bped-comment-count-link" href="' . esc_url( get_permalink() . '#bped-comments' ) . '">' . absint( get_comments_number() ) . '</a>';
	}
}

/***** Pagination for paginated Posts *****/

if ( ! function_exists( 'blogpedia_paginated_posts' ) ) {
	function blogpedia_paginated_posts( $content ) {
		if ( is_singular() && in_the_loop() ) {
			$content .= wp_link_pages( array( 'before' => '<div class="bped-single-pagination clearfix">', 'after' => '</div>', 'link_before' => '<span class="pagelink">', 'link_after' => '</span>', 'nextpagelink' => esc_html__('&raquo;', 'blogpedia'), 'previouspagelink' => esc_html__('&laquo;', 'blogpedia'), 'pagelink' => '%', 'echo' => 0));
		}
		return $content;
	}
}
add_filter('the_content', 'blogpedia_paginated_posts', 1);

/***** Post / Attachment Navigation *****/

if ( ! function_exists( 'blogpedia_next_post_link_attributes' ) ) {
	function blogpedia_next_post_link_attributes($output) {
		$code = 'class="post-next"';
		return str_replace('<a href=', '<a '.$code.' href=', $output);
	}
}
add_filter('next_post_link', 'blogpedia_next_post_link_attributes');

if (!function_exists('blogpedia_previous_post_link_attributes')) {
	function blogpedia_previous_post_link_attributes($output) {
		$code = 'class="post-previous"';
		return str_replace('<a href=', '<a '.$code.' href=', $output);
	}
}
add_filter('previous_post_link', 'blogpedia_previous_post_link_attributes');

if ( ! function_exists( 'blogpedia_single_postnav' ) ) {
	function blogpedia__single_postnav() {
		
		if ( 'enable' === blogpedia_data( 'single_post_nav_show' , 'enable' ) ) {
			get_template_part( 'template-parts/single/prev' , 'next' );
		
		}
	}
}
add_action('blogpedia_after_post_content', 'blogpedia__single_postnav');

if ( ! function_exists( 'blogpedia_single_related_post' ) ) {
	function blogpedia_single_related_post() {
		if ( blogpedia_data( 'single_related_post_show' ) == 'enable' ) {
			get_template_part( 'template-parts/single/related' , 'post' );
			
		}
	}
}
add_action('blogpedia_after_post_content', 'blogpedia_single_related_post');

/** breadcrumb **/
function blogpedia_the_breadcrumb( $str_start='' , $str_end='') {
	$show = blogpedia_data( 'single_breadcrumb_show' );
	if ( $show == 'enable' ) {
		echo wp_kses_post( $str_start );
		$sep = '<li> > </li>';

		if (!is_front_page()) {
		
		// Start the breadcrumb with a link to your homepage
			echo '<ul itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">';
			echo '<li><a itemprop="url" title="" href="';
			echo esc_url( home_url( '/' ) );
			echo '"><i class="fa fa-home"></i> ';
			bloginfo('name');
			echo '</a></li>' . wp_kses_post( $sep );
		
		// Check if the current page is a category, an archive or a single page. If so show the category or archive name.
			if ( is_category() || is_single() ){
				echo '<li itemprop="itemListElement" itemscope
		  itemtype="http://schema.org/ListItem">';
				//the_category(' , ');
				global $post;
				$cats = get_the_category( $post->ID );
				$count = count( $cats );
				$i = 0;
				foreach ( $cats as $cat ){
					$i++;
					echo '<a itemprop="url" href="'. esc_url( get_category_link( $cat->term_id ) )  .'" title="">'. esc_html( $cat->cat_name ) . '</a>';
					if ( $i < $count ) {
						echo '  ,  ';
					}
				}
				echo '</li>';
			} elseif ( is_archive() || is_single() ){
				
			}
		
		// If the current page is a single post, show its title with the separator
			if ( is_single() ) {
				
				echo wp_kses_post($sep);
				echo '<li itemprop="itemListElement" itemscope
		  itemtype="http://schema.org/ListItem">';
				the_title();
				echo '</li>';
			}
		
		// If the current page is a static page, show its title.
			if (is_page()) {
				echo '<li itemprop="itemListElement" itemscope
		  itemtype="http://schema.org/ListItem">';
				echo the_title();
				echo '</li>';
			}
		
				
			echo '</ul>';
			echo '<div class="clearfix"></div>';
			echo wp_kses_post( $str_end );
		}
    }
}

// Footer Widget

if ( ! function_exists( 'blogpedia_footer_widgets' ) ) {
	function blogpedia_footer_widgets() {
		$footer_1 = ''; $footer_2 = ''; $footer_3 = '';  $footer_columns = 0; $footer_class = 'col-md-4';
		if ( is_active_sidebar( 'footer-1') ) {
			$footer_1 = 1; $footer_columns++;
		}
		if ( is_active_sidebar( 'footer-2' ) ) {
			$footer_2 = 1; $footer_columns++;
		}
		if ( is_active_sidebar( 'footer-3') ) {
			$footer_3 = 1; $footer_columns++;
		}
		
		if ( $footer_columns == 1 ) {
			$footer_class = 'col-md-12';
		} 
		
		if ( $footer_1 || $footer_2 || $footer_3 ) {
			echo '<div id="footer" class="footer-white">';
				echo '<div class="container">';
					echo '<div class="row">';
						if ( $footer_1 ) {
							echo '<div class="' . esc_attr( $footer_class ) . '">' . "\n";
								dynamic_sidebar( 'footer-1' );
							echo '</div>' . "\n";
							
							if ($footer_columns == 2) {
								$footer_class = 'col-md-8';
							}
						}
						if ($footer_2) {
							echo '<div class="' . esc_attr( $footer_class ) . '">' . "\n";
								dynamic_sidebar( 'footer-2' );
							echo '</div>' . "\n";
							if ($footer_columns == 2) {
								$footer_class = 'col-md-8';
							}
						}
						if ($footer_3) {
							echo '<div class="' . esc_attr( $footer_class ) . '">' . "\n";
								dynamic_sidebar( 'footer-3' );
							echo '</div>' . "\n";
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
	}
}

// header image 
if ( ! function_exists( 'blogpedia_header_style' ) ) :
	function blogpedia_header_style() {
		$header_image = get_header_image();

		// If no custom options for text are set, let's bail.
		if ( empty( $header_image ) ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css" id="blogpedia-header-css">
		<?php
		
			if ( ! empty( $header_image ) ) :
		?>
			#site-header {

				/*
				 * No shorthand so the Customizer can override individual properties.
				 * @see https://core.trac.wordpress.org/ticket/31460
				 */
				background-image: url(<?php header_image(); ?>);
				background-repeat: no-repeat;
				background-position: 50% 50%;
				-webkit-background-size: cover;
				-moz-background-size:    cover;
				-o-background-size:      cover;
				background-size:         cover;
				margin-bottom: 30px;
			}
			.header-search-form .search-field {
				padding-left: 10px;
			}
		<?php if ((is_single())||(is_page())) { ?>
			<?php 
				$show = blogpedia_data( 'single_breadcrumb_show' );
				if ($show=='enable') {
			?>
					#site-header {
						margin-bottom: 0px;
					}
			<?php 
				}
			?>
		<?php } ?>
			
		<?php
			endif;
		?>
		</style>
		<?php
	}
endif; 
?>