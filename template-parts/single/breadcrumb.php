<?php
	$show = blogpedia_data( 'single_breadcrumb_show' );
	if ($show=='enable') {
?>
	<div class="bped-breadcrumb-container">
		<div class="bped-breadcrumb-image">
			<?php
				$breadcrumb_image_src = blogpedia_data('single_breadcrumb_image_src','');
				if ($breadcrumb_image_src) {
					$breadrumb_html = wp_get_attachment_image(absint($breadcrumb_image_src), 'full', false, array(
										'class'    => 'header-ads-img'
									));
					echo wp_kses_post($breadrumb_html);
				}
			?>	
		</div>
		<div class="bped-breadcrumb-list">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
				<?php
					blogpedia_the_breadcrumb();
				?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	}
?>