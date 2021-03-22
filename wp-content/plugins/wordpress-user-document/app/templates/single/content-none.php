<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <p class="alert alert-warning"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'wud' ); ?></p>
    <button class="button button-regular"
            onclick="window.history.back(); return false;"><?php esc_html_e( 'Back', 'wud' ); ?></button>
</article>

