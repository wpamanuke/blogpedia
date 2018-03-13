<?php /* Comments Template */
	if (post_password_required()) {
		return;
	}
	if (have_comments()) {
?>
<div class="bped-comment">
	<div  class="bped-comment-normal">
		<?php
			$comments_by_type = separate_comments($comments);
			if ( ! empty( $comments_by_type['comment'] ) ) {
				$comment_count = count( $comments_by_type['comment'] ); ?>
				<div id="bped-comments" class="bped-comments-wrap">
					<h4 class="bped-comments-title">
						<span class="bped-comments-title-inner">
							<?php printf( esc_html( _n( '%d Comment' , '%d Comments' , $comment_count , 'blogpedia' )), number_format_i18n( $comment_count ) ); ?>
						</span>
					</h4>
					<ol class="commentlist bped-comment-list">
						<?php echo wp_list_comments( 'callback=blogpedia_comments&type=comment' ); ?>
					</ol>
				</div><?php
			}
			if ( get_comments_number() > get_option( 'comments_per_page' ) ) { ?>
				<nav class="bped-comments-pagination">
					<?php paginate_comments_links( array( 'prev_text' => esc_html__('&laquo;', 'blogpedia'), 'next_text' => esc_html__('&raquo;', 'blogpedia') )); ?>
				</nav><?php
			}
			if ( !empty( $comments_by_type['pings'] ) ) {
				$pings = $comments_by_type['pings'];
				$ping_count = count( $comments_by_type['pings'] ); ?>
				<h4 class="bped-commentst-title">
					<span class="bped-comments-title-inner">
						<?php printf( esc_html( _n( '%d Trackback / Pingback' , '%d Trackbacks / Pingbacks' , $ping_count , 'blogpedia' ) ), number_format_i18n( $ping_count ) ); ?>
					</span>
				</h4>
				<ol class="pinglist bped-ping-list">
					<?php foreach ($pings as $ping) { ?>
						<li id="comment-<?php comment_ID() ?>" <?php comment_class( 'bped-ping-item' ); ?>>
							<?php echo '<i class="fa fa-link"></i>' . get_comment_author_link( $ping ); ?>
						</li>
					<?php } ?>
				</ol><?php
			}
			if (!comments_open()) { ?>
				<p class="bped-no-comments">
					<?php esc_html_e('Comments are closed.', 'blogpedia'); ?>
				</p><?php
			}
			if (comments_open()) {
				comment_form(array(
					'title_reply' => esc_html__( 'Leave a Reply' , 'blogpedia' ),
					'comment_notes_before' => ' <p class="comment-notes">' . esc_html__( 'Your email address will not be published.' , 'blogpedia' ) . '</p>',
					'comment_notes_after'  => '',
					'comment_field' => '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Comment' , 'blogpedia' ) . '</label><br/><textarea id="comment" name="comment" cols="45" rows="5" aria-required="true"></textarea></p>'
				));
			}
		?>
	</div>
</div>
<?php
} else {
	if (comments_open()) { ?>
		<div class="bped-comment">
			<div  class="bped-comment-normal">
				<h4 id="bped-comments" class="bped-widget-title bped-comment-form-title">
					<span class="bped-widget-title-inner">
						<?php esc_html_e('Be the first to comment', 'blogpedia'); ?>
					</span>
				</h4>
				<?php
				 comment_form(array(
					'title_reply' => esc_html__( 'Leave a Reply' , 'blogpedia' ),
					'comment_notes_before' => '<p class="comment-notes">' . esc_html__( 'Your email address will not be published.' , 'blogpedia' ) . '</p>',
					'comment_notes_after'  => '',
					'comment_field' => '<p class="comment-form-comment"><label for="comment">' . esc_html__('Comment', 'blogpedia') . '</label><br/><textarea id="comment" name="comment" cols="45" rows="5" aria-required="true"></textarea></p>'
				));
				?>
			</div>
		</div>
		<?php
	}
}
?>
	