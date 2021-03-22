<?php
$custom_class = 'document';
global $document;
$doc = $document->get_current_doc();
?>
<article id="document-<?php the_ID(); ?>" <?php wud_document_class( $custom_class, $document ); ?>>

	<?php if ( has_post_thumbnail() ) { ?>
        <header class="document-header">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php echo wud_get_download_label( $doc['approved'], $doc['featured'], $doc['post_date'] ); ?>
				<?php the_post_thumbnail( 'document-thumbnail',
					array(
						'class' => 'img-responsive',
						'title' => get_the_title(),
						'alt'   => get_the_title()
					)
				);
				?>
            </a>
        </header>
	<?php } ?>

    <div class="document-content">
        <div class="wud-tooltip-container">
            <div class="document-title"><a href="<?php the_permalink(); ?>"
                                           title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
            <div class="wud-tooltip">
                <span class="wud-tooltip-header"><?php the_title(); ?></span>
				<?php the_excerpt(); ?>
                <span class="wud-tooltip-footer"><time><?php echo get_the_date( 'F j, Y' ); ?></time></span>
            </div>
        </div>
        <ul class="document-meta">
            <li class="document-author"><?php echo esc_html__( 'By', 'wud' ) . ' ' . wud_get_doc_author_link(); ?></li>
        </ul>
        <div class="document-footer">
            <p><?php printf( esc_html__( '%s Views | %s Likes', 'wud' ), wud_format_count( $doc['count'] ), wud_format_count( $doc['likes'] ) ); ?></p>
        </div>

    </div>

</article>