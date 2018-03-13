<?php
echo '<div id="masthead" class="site-header" role="banner"  itemscope="itemscope" itemtype="http://schema.org/Brand">';
if ( has_custom_logo() ) {
	echo '<div class="header-site-logo">';
	if (function_exists('the_custom_logo')) {
		the_custom_logo();
	}
	echo '</div>';
} else {
	echo '<div class="site-branding">' . "\n";
		if (is_front_page()) {
			$header_title_before = '<h1 class="site-title"  itemprop="name">';
			$header_title_after = '</h1>' . "\n";
			$header_tagline_before = '<p class="site-description" itemprop="description">';
			$header_tagline_after = '</p>' . "\n";
		} else {
			$header_title_before = '<h2 class="site-title"  itemprop="name">';
			$header_title_after = '</h2>' . "\n";
			$header_tagline_before = '<p class="site-description"  itemprop="description">';
			$header_tagline_after = '</p>' . "\n";
		}
			if (get_bloginfo('name')) {
				echo $header_title_before . '<a href="'.  esc_url( home_url( '/' )) .'"  itemprop="url">'. esc_attr(get_bloginfo('name')) . '</a>'. $header_title_after;
			}
			if (get_bloginfo('description')) {
				echo $header_tagline_before . esc_attr(get_bloginfo('description')) . $header_tagline_after;
			}
		
	echo '</div>' . "\n";
	
}
echo '</div>' . "\n";
?>