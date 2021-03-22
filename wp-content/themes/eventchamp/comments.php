<?php
/*
 * The template for displaying comments part
*/
if ( post_password_required() )

	return;

	if( !function_exists( 'eventchamp_comment' ) ) {

		function eventchamp_comment( $comment, $args, $depth ) {

			$GLOBALS['comment'] = $comment;

			extract($args, EXTR_SKIP);

			if ( 'div' == $args['style'] ) {

				$tag = 'div';
				$add_below = 'comment';

			} else {

				$tag = 'li';
				$add_below = 'div-comment';

			}

			?>

			<<?php echo esc_attr( $tag ) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
			
			<?php if ( 'div' != $args['style'] ) { ?>

				<div id="div-comment-<?php comment_ID() ?>" class="gt-comment-wrapper">

			<?php } ?>

				<div class="gt-user-avatar">

					<?php $user = get_user_by( 'email', $comment->comment_author_email ); ?>

					<?php if ( $args['avatar_size'] != 0 ) { echo get_avatar( $comment, $args['avatar_size'] ); } ?>

				</div>

				<div class="gt-comment-content">
					<div class="gt-comment-user">

						<?php
							$author_control = get_comment_author();
							if( !empty( $author_control ) ) {
								echo get_comment_author(); 
							}
						?>

					</div>

					<?php if ( $comment->comment_approved == '0' ) { ?>

						<p class="moderation-message"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'eventchamp' ); ?></p>

					<?php } ?>

					<?php comment_text(); ?>

					<div class="gt-comment-details">
						<div class="gt-item comment-meta commentmetadata">
							<i class="far fa-clock" aria-hidden="true"></i>
							<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
								<?php printf( esc_html__( '%1$s', 'eventchamp' ), get_comment_date(), get_comment_time() ); ?>
							</a>
						</div>
						
						<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'], 'before' => '<div class="gt-item reply"><i class="fas fa-reply" aria-hidden="true"></i>', 'after' => '</div>' ) ) ); ?>
						
						<?php edit_comment_link( esc_html__( 'Edit', 'eventchamp' ), '<div class="gt-item edit"><i class="fas fa-pencil-alt" aria-hidden="true"></i>', '</div>' ); ?>

					</div>
				</div>

			<?php if ( 'div' != $args['style'] ) { ?>

				</div>

			<?php }

		}

	}
?>	

	<div class="gt-post-comments">

		<?php if ( have_comments() ) { ?>

			<div id="comments" class="gt-comment-list gt-section">
				<div class="gt-section-title">
					<span><?php printf( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'eventchamp' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?></span>
				</div>
				<ol>
					<?php
						if ( function_exists( 'eventchamp_comment' ) ) {

							$callback = 'eventchamp_comment';

						} else {

							$callback = '';

						}
						
						wp_list_comments(
							array(
								'style' => 'ol',
								'short_ping' => true,
								'avatar_size' => 100,
								'callback' => $callback,
								'reply_text' => '' . esc_html__( 'Reply', 'eventchamp' ),
							)
						);
					?>
				</ol>
				
				<?php
					if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {

						echo '<div class="gt-pagination gt-light">';
							echo '<ul>';

								if( !empty( get_previous_comments_link() ) ) {

									echo '<li>';
										echo get_previous_comments_link( esc_html__( 'Previous Comments', 'eventchamp' ) );
									echo '</li>';

								}

								if( !empty( get_next_comments_link() ) ) {

									echo '<li>';
										next_comments_link( esc_html__( 'Next Comments', 'eventchamp' ) );
									echo '</li>';

								}

							echo '</ul>';
						echo '</div>';

					}
				?>

				<?php if ( ! comments_open() && get_comments_number() ) { ?>

					<p class="no-comments"><?php esc_html_e( 'Comments are closed.' , 'eventchamp' ); ?></p>

				<?php } ?>
			</div>
		<?php } ?>

		<div class="gt-comment-respond gt-section">
			<?php
				$consent = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

				$comments_args = array(
					'id_form' => '',
					'id_submit' => '',
					'title_reply_before' => '',
					'title_reply_after' => '',
					'class_form' => 'gt-form',
					'title_reply' => '<div class="gt-section-title">' . esc_html__( 'Leave a Comment', 'eventchamp' ) . '</div>',
					'title_reply_to' => '<div class="gt-section-title">' . esc_html__( 'Comment', 'eventchamp' ) . '</div>',
					'cancel_reply_link' => esc_html__( 'Cancel Reply', 'eventchamp'),
					'label_submit' => esc_html__( 'Post Comment', 'eventchamp'),
					'comment_field' => '<div class="gt-comment-textarea"><textarea placeholder="' . esc_attr__( 'Your Comment', 'eventchamp' ) . '" name="comment" class="commentbody" id="comment" rows="4" tabindex="4"></textarea></div>',
					'comment_notes_before' => '',
					'fields' => apply_filters(
						'comment_form_default_fields',
						array(
							'author' =>
								'<div class="gt-comment-inputs"><div class="gt-comment-input name"><input type="text" placeholder="' . esc_attr__( 'Name', 'eventchamp' ) . '" name="author" id="author" value="' . esc_attr( $comment_author ) . '" size="22" tabindex="1"' . ( $req ? "aria-required='true'" : '' ). ' /></div>',
							'email' =>
								'<div class="gt-comment-input email"><input type="text" placeholder="' . esc_attr__( 'Email', 'eventchamp' ) . '" name="email" id="email" value="' . esc_attr( $comment_author_email ) . '" size="22" tabindex="1"' . ( $req ? "aria-required='true'" : '' ). ' /></div>',
							'url' =>
								'<div class="gt-comment-input website"><input type="text" placeholder="' . esc_attr__('Website URL', 'eventchamp') . '" name="url" id="url" value="' . esc_attr($comment_author_url) . '" size="22" tabindex="1" /></div></div>',
							'cookies' =>
								'<div class="gt-comment-cookies"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" class="gt-checkbox" value="yes"' . $consent . ' />' . '<label for="wp-comment-cookies-consent" class="gt-checkbox-label">' . esc_html__( 'Save my name, email and website in this browser for the next time I comment.', 'eventchamp' ) . '</label></div>',
						)
					),
				);
				
				comment_form( $comments_args );
			?>
		</div>
	</div>