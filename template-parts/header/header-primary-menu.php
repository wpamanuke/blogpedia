<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="header-primarymenu">
				<nav itemscope itemtype="http://schema.org/SiteNavigationElement">
				<?php  
					wp_nav_menu( array( 
						'theme_location' => 'primarymenu', 
						'menu_id' => 'primarymenu',
						'items_wrap' => '
							<div id="bped-primarymenu-responsive-icon" class="pull-left"><div class="hidden-md hidden-lg"><i class="fa fa-navicon"> </i> Main Menu </div></div>
							<ul id="primarymenu">%3$s</ul>'
					) ); ?>
				</nav>
			</div>
		</div>
	</div>
</div>
