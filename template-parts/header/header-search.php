<div class="header-site-search">
	<div class="header-search-form">
		<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
			
				<input type="search" class="search-field" placeholder="<?php echo esc_html__( 'Search Here &hellip;', 'blogpedia' ) ?>" value="<?php echo get_search_query() ?>" name="s" />
				<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
		
			
		</form>
	</div>
	<div class="header-border"></div>
	<div class="topmenu">
		<div class="topmenu__header">
			Information
		</div>
		<?php  
			wp_nav_menu( array( 
				'container'=> false,
				'theme_location' => 'topmenu', 
				'menu_id' => 'topmenu',
				'depth' => 1 
			) ); 
		?>
	</div>
</div>