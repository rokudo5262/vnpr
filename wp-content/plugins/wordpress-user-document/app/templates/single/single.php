<?php
$custom_class = 'single-document';
global $document, $wud, $wud_settings, $wud, $show_thumbnail;
// set view count for documents
$document->set_view();
$use_preview = $wud_settings->get_input_value( 'use_previewer', 'yes' );
$doc         = $document->get_current_doc();
$enable_comment = isset($disable_comment) ? false : true;
$open_browser = $wud_settings->get_input_value( 'preview_by', 'google_viewer') == 'pdfjs' ? true : false;
?>
<article id="document-<?php the_ID(); ?>" <?php wud_document_class( $custom_class, $document ); ?>>
    <div class="document-information">
        <h2 class="post-title"><?php the_title(); ?></h2>

        <?php if ( $use_preview == 'yes' && ( isset( $doc['url_viewer'] ) || isset($doc['url_viewer_pdf']) )) {
            $show_thumbnail = false;
            ?>
            <div class="post-viewer">
                <?php echo wud_get_download_label( $doc['approved'], $doc['featured'], $doc['post_date'] ); ?>
	            <?php
	            if ( $open_browser && isset($doc['url_viewer_pdf'])) {
		            $url_viewer = $wud->plugin_url . 'vendor/assets/pdfjs/web/viewer.html?file=' . $doc['url_viewer_pdf'];

	            } else {
		            $url_viewer = $doc['url_viewer'];
	            }
	            ?>
                <iframe mozallowfullscreen="true" webkitallowfullscreen="true" allowfullscreen="true"
                        class="wud-preview-iframe" id="wud-preview-iframe" src="<?php echo esc_url($url_viewer) ; ?>" frameborder="0"></iframe>
            </div>
        <?php } else { ?>
            <?php if ( has_post_thumbnail() ) {
                $show_thumbnail = true;
                ?>
                <div class="post-image">
                    <?php echo wud_get_download_label( $doc['approved'], $doc['featured'], $doc['post_date'] ); ?>
                    <?php the_post_thumbnail( 'document-xlarge', array( 'class' => 'img-responsive' ) ); ?>
                </div>
            <?php } ?>
        <?php } ?>

        <div class="post-content">
            <div class="post-license">
                <?php
                $license = $document->get_license();
                if ( $license ) {
                    echo '<img src="' . esc_url( $license['icon'] ) . '" title="' . $license['name'] . '"/>';
                    echo '<p>' . esc_html__( 'This document is licensed under', 'wud' ) . ' <a href="' . esc_url( $license['reference_link'] ) . '" target="_blank">' . esc_html( $license['name'] ) . '</a></p>';
                } else {
                    esc_html_e( 'No licensing information is associated', 'wud' );
                }
                ?>
            </div>
            <?php if ( $doc['email_attachment'] || $doc['allow_download'] ) { ?>
                <div class="post-buttons">
                    <?php if ( $doc['email_attachment'] ) { ?>
                        <div id="my-content-id" style="display:none;">
                            <?php wud_app()->get_current()->view->render( 'email/attach', array( 'doc' => $doc ) ); ?>
                        </div>
                        <a href="#TB_inline?width=500&height=550&inlineId=my-content-id" class="thickbox"><i
                                    class="fa fa-paperclip"></i> <?php esc_html_e( 'Email as Attachment', 'wud' ); ?></a>
                    <?php } ?>
                    <?php if ( $doc['allow_download'] ) { ?>
                        <a href="<?php echo esc_url( $doc['link_download'] ); ?>"><i
                                    class="fa fa-download"></i> <?php esc_html_e( 'Download', 'wud' ); ?></a>
                    <?php } ?>
                </div>
            <?php } ?>
            <ul class="post-meta">
                <li class="post-author"><?php echo wud_get_doc_author_link( 0, '<i class="fa fa-user"></i> ' ); ?></a></li>
                <li class="post-date"><i class="fa fa-calendar-plus"></i>
                    <time><?php echo get_the_date( 'F j, Y' ); ?></time>
                </li>
                <li class="post-modified-date"><i class="fa fa-edit"></i>
                    <time><?php echo get_the_modified_date( 'F j, Y' ); ?></time>
                </li>
                <li class="post-views"><i class="fa fa-eye"></i> <?php echo wud_format_count( $doc['count'] ); ?></li>
                <li class="post-version"><i class="fa fa-clone"></i> <?php esc_html_e( 'Version', 'wud' ); ?>
                    : <?php echo wud_format_count( $doc['version'] ); ?> </li>
                <li class="post-comments"><a href="<?php echo get_comments_link(); ?>"><i
                                class="fa fa-comments"></i> <?php comments_number( false, false, false ); ?> </a></li>
                <li class="post-like"><?php echo wud_get_likes_button( $document->get_id() ); ?></li>
                <?php if (wud_user_can_edit_doc($doc)) { ?>
                    <li class="post-edit-button"><a class="wud-file-edit"
                                                    href="<?php echo esc_url( wud_get_account_endpoint_url( 'edit-document', $document->get_id() ) ); ?>"
                                                    data-id="<?php echo esc_attr( $document->get_id() ); ?>"
                                                    title="<?php echo esc_attr( $doc['name'] ); ?>"><i
                                    class="fas fa-edit"></i> <?php echo esc_html__( 'Edit', 'wud' ); ?></a></li>

                <?php } ?>
            </ul>
            <?php the_content(); ?>
            <br>
            <?php
            $category_html = get_the_term_list( $document->get_id(), 'wud-category', '', ', ', '' );
            $tag_html      = get_the_term_list( $document->get_id(), 'wud-tag', '<i class="fa fa-tags"></i> ', ', ', '' );
            ?>
            <?php if ( $category_html != '' ) { ?>
                <div class="post-categories"><?php esc_html_e( 'Categories', 'wud' ); ?>: <?php echo wp_kses( $category_html, array(
                        'a' => array(
                            'href' => array(),
                            'rel' => array(),
                        )
                    ) ); ?></div>
            <?php } ?>

            <?php if ( $tag_html != '' ) { ?>
                <div class="post-tags"><?php esc_html_e( 'Tags', 'wud' ); ?>: <?php echo wp_kses( $tag_html, array(
                        'a' => array(
                            'href' => array(),
                            'rel' => array(),
                        ),
                        'i' => array(
                            'class' => array()
                        )
                    ) ); ?></div>
            <?php } ?>

            <div class="social-share">
                <ul class="social-share-icons">
                    <li class="social-facebook">
                        <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php echo esc_attr($doc['name']); ?>"
                           title="<?php echo urlencode( esc_attr($doc['name']) ) ?>" target="_blank"><i class="fab fa-facebook"></i></a>
                    </li>
                    <li class="social-twitter">
                        <a href="https://twitter.com/share?url=<?php echo the_permalink() . '&amp;text=' . esc_attr($doc['name']) ; ?>"
                           title="<?php echo urlencode( esc_attr($doc['name']) ) ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                    </li>
                    <li class="social-linkedin">
                        <a href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php echo esc_attr($doc['name']); ?>"
                           title="<?php echo urlencode( esc_attr($doc['name']) ) ?>" target="_blank"><i class="fab fa-linkedin"></i></a>
                    </li>

                    <li class="social-googleplus">
                        <a href="https://plus.google.com/share?url=<?php the_permalink() ?>&amp;title=<?php echo urlencode( esc_attr($doc['name']) ) ?>"
                           title="<?php echo urlencode( esc_attr($doc['name']) ) ?>" target="_blank"><i class="fab fa-google-plus-g"></i></a>
                    </li>
                    <li class="social-email">
                        <a href="mailto:?subject=<?php echo esc_attr($doc['name']); ?>&amp;body=<?php the_permalink() ?>"
                           title="<?php echo urlencode( esc_attr($doc['name']) ) ?>" target="_blank"><i class="fas fa-envelope"></i></a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
	<?php if ($enable_comment) {
		comments_template();
	}
	?>

</article>
