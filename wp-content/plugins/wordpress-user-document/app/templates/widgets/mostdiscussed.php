<?php
/**
 * @version    $Id$
 * @package   WordPress User Document
 * @author     ZuFusion
 * @copyright  (C) 2020  ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

?>
<?php if ( count( $docs ) ) { ?>
    <div class="wud-docs-list">
		<?php foreach ( $docs as $doc ) {
			?>
            <div class="wud-doc-item">

				<?php if ( has_post_thumbnail( $doc->ID ) ) { ?>
                    <div class="doc-left">
                        <a href="<?php the_permalink( $doc->ID ); ?>" title="<?php echo esc_attr( $doc->name ); ?>">
							<?php echo get_the_post_thumbnail( $doc->ID, 'document-widget',
								array(
									'class' => 'img-responsive',
									'title' => $doc->name,
									'alt'   => $doc->name
								)
							);
							?>
                        </a>
                    </div>
				<?php } ?>

                <div class="doc-right">
                    <div class="doc-title"><a href="<?php the_permalink( $doc->ID ); ?>"
                                              title="<?php echo esc_attr( $doc->name ); ?>"><?php echo esc_attr( $doc->name ); ?></a></div>
                    <div class="doc-author"><?php echo esc_html__( 'By', 'wud' ); ?>
                        : <?php echo wud_get_doc_author_link( $doc->post_author ); ?></div>
                    <div class="doc-footer"><?php printf( esc_html__( '%s Comments', 'wud' ), wud_format_count( $doc->comment_count ) ); ?></div>
                    <div class="wud-clear"></div>
                </div>
            </div>

		<?php }
		?>
    </div>
<?php } ?>


