		<div class="footer-space">
		</div>
		
		<footer itemscope itemtype="http://schema.org/WPFooter">
		
		<?php
			blogpedia_footer_widgets();
		?>
		
		<div class="footer-copyright">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="text-center">
							<p class="blogpedia-copyright"><?php printf(esc_html__('Copyright &copy; %1$s | %2$s Multipurpose Blog Theme by %3$s', 'blogpedia'), date("Y"),  '<a href="' . esc_url('http://wpamanuke.com/blogpedia') . '" rel="nofollow">Blogpedia</a>'	, '<a href="' . esc_url('http://wpamanuke.com') . '" rel="nofollow">wpamanuke</a>'); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		</footer>
	
	</div><!-- .nys-full-box ends -->

<?php wp_footer(); ?>
</body>
</html>