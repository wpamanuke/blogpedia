<?php get_header(); ?>
<?php get_template_part( 'wrapper' ,  'start' ); ?>
<?php
	if ( have_posts() ) :
		/* Start the Loop */
		echo '<div class="hfeed">';
		while ( have_posts() ) : the_post();
			
			get_template_part( 'template-parts/page/content');
			
		endwhile;
		echo '</div>';
		
		
	else :
	
		get_template_part( 'template-parts/block/content', 'none' );
		
	endif;
?>
<?php get_template_part( 'wrapper' , 'end' ); ?>
<?php get_footer(); ?>