<div class="header-site-social">
	<div class="header-time">
		<div class="pull-right">
			<i class="fa fa-clock-o"></i>
			<span><?php echo blogpedia_current_time(get_option( 'date_format' )); ?></span>
		</div>
		<div class="clearfix">
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="header-border"></div>
	<div class="header-social">
		<div class="pull-right">
			<div class="text-center"  itemscope itemtype="http://schema.org/Organization">
				<?php if ( has_nav_menu( 'socialmenu' ) ) { // Check if there's a menu assigned to the 'social' location. ?>
				<link itemprop="url" href="<?php  echo esc_url( home_url( '/' )); ?>">
				<?php  
					wp_nav_menu( array( 
						'theme_location' => 'socialmenu', 
						'menu_id' => 'socialmenu',
						'depth'           => 1,
						'link_before'     => '<i class="fa"></i><span class="scmu-hide">',
						'link_after'      => '</span>'
					) ); ?>
				<?php } else { // End check for menu. ?>
					<ul id="socialmenu">
						<li></i><span class="scmu-hide"></span></li></li>
					</ul>
				<?php } ?>
			</div>
		</div>
		<div class="clearfix">
		</div>
	</div>
	<div class="clearfix"></div>
</div>
<div class="clearfix"></div>