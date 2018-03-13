<?php get_header(); ?>
<?php get_template_part( 'wrapper' ,  'start' ); ?>
<?php
	if ( have_posts() ) :
	?>
		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header><!-- .page-header -->
		<?php
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