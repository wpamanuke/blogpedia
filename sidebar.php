<aside class="blogpedia-sidebar" itemscope="itemscope" itemtype="http://schema.org/WPSideBar"><?php
	if (is_active_sidebar('sidebar')) {
		dynamic_sidebar('sidebar');
	} else { ?>
		<div class="blogpedia-widget blogpedia-sidebar-empty">
			<h4 class="blogpedia-widget-title">
				<span class="blogpedia-widget-title-inner">
					<?php esc_html_e('Sidebar', 'blogpedia') ?>
				</span>
			</h4>
			<div class="textwidget">
				<?php printf(esc_html__('Please navigate to %1$1s in your WordPress dashboard and add some widgets into the %2$2s widget area.', 'blogpedia'), '<strong>' . esc_html__('Appearance &#8594; Widgets', 'blogpedia') . '</strong>', '<em>' . esc_html__('Sidebar', 'blogpedia') . '</em>'); ?>
			</div>
		</div><?php
	} ?>
</aside>