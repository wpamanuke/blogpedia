<?php get_header(); ?>


<?php get_template_part( 'wrapper' ,  'start' ); ?>
<?php
	if ( have_posts() ) : ?>
		
		<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'blogpedia' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
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
		/* Pagination Ends */
		
	else :
	
		get_template_part( 'template-parts/block/content', 'none' );
		
	endif;
?>
<?php get_template_part( 'wrapper' , 'end' ); ?>
<?php get_footer(); ?>