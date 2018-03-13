<?php get_header(); ?>
<?php get_template_part( 'wrapper' ,  'start' ); ?>
	<section class="error-404 not-found">
		<header class="page-header">
			<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'blogpedia' ); ?></h1>
		</header><!-- .page-header -->

		<div class="page-content">
			<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'blogpedia' ); ?></p>

			<?php get_search_form(); ?>
		</div><!-- .page-content -->
	</section><!-- .error-404 -->
<?php get_template_part( 'wrapper' , 'end' ); ?>
<?php get_footer(); ?>