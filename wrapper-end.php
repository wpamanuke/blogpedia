<?php
	$column = 2;
	
	switch ($column) {
		case 1:
			echo '
						</div> <!-- col-md-12 -->
					</div> <!-- row -->
				</div>	<!-- container -->';
			break;
		default:
			echo '
						</div> <!-- col-md-9 -->
						<div class="col-md-3">';
							 get_sidebar();
			echo '		</div>
					</div> <!-- row -->
				</div>	<!-- container -->';
			
	}
	
?>