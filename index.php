<?php get_header(); ?>
<?php 
	if ( blogpedia_data('magazine_slider_show','enable')=='enable' ) {
		get_template_part( 'template-parts/block/main', 'slider' ); 
	}
?>
<?php 
	if ( blogpedia_data('magazine_top_feature_show','enable')=='enable' ) {
		get_template_part( 'template-parts/block/top', 'featured' ); 
	}
?>

<?php get_template_part( 'wrapper' ,  'start' ); ?>
<?php
	if ( have_posts() ) :
		/* Start the Loop */
		echo '<div class="hfeed">';
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/block/block', '1' );
		endwhile;
		echo '</div>';
		/* End Loop */
		
		/* Pagination Start */
		$nav = get_the_posts_pagination();
		$nav = str_replace('<h2 class="screen-reader-text">Posts navigation</h2>', '', $nav);
		echo $nav;
		echo '<div class="clearfix"></div>';
		/* Pagination Ends */
		
	else :
	
		get_template_part( 'template-parts/block/content', 'none' );
		
	endif;
?>
<?php get_template_part( 'wrapper' , 'end' ); ?>
<?php get_footer(); ?>