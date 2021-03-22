<?php
$doc_page_id = wud_get_page_id( 'documents' );
$url = $doc_page_id > 0  ? esc_url( get_page_link( $doc_page_id ) ) : '';
$s           = isset( $_GET['wud_search'] ) ? sanitize_text_field( wp_unslash( $_GET['wud_search'] )  ) : '';
?>
<form action="<?php echo esc_url( $url ); ?>" method="get" class="wud-search-form" role="search">
    <input type="text" class="wud-search-query" name="wud_search" placeholder="<?php esc_html_e( 'Search Documents', 'wud' ); ?>" value="<?php echo esc_attr( $s );?>">
    <button type="submit" class="wud-search-submit"><span><?php esc_html_e( 'Search', 'wud' ); ?></span></button>
</form>
