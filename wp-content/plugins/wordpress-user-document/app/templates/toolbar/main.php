<?php
global $wud_settings;

$paged = isset( $attributes['page'] ) ? $attributes['page'] : wud_get_loop_prop( 'current_page' );
$limit = isset( $attributes['limit'] ) ? $attributes['limit'] : wud_get_loop_prop( 'per_page' );

if ( $paged > 1 ) {
	$position_end   = $limit * $paged;
	$position_start = $position_end - $limit + 1;
	$total          = wud_get_loop_prop( 'total_pages' );
	if ( $paged == $total ) {
		if ( wud_get_loop_prop( 'total' ) < $position_end ) {
			$r            = $position_end - wud_get_loop_prop( 'total' );
			$position_end = $position_end - $r;
		}
	}
} else {
	$position_start = 1;
	if ( wud_get_loop_prop( 'total' ) < $limit ) {
		$position_end = (int) wud_get_loop_prop( 'total' );
	} else {
		$position_end = (int) $limit;
	}
}
//get wud-category
$product_cats = get_terms(array(
    'taxonomy' => 'wud-category',
    'hide_empty' => false,
    'parent'   => 0
));
$category_options = [];
$currentPage = home_url($_SERVER['REQUEST_URI']);
foreach ( $product_cats as $product_cat ) {
    $termlink = get_term_link( $product_cat->term_id );
    $category_options['#'] = esc_html__('Category','wud');
    $category_options[$termlink] = $product_cat->name;
}

$sor_options        = wud_get_sortby_options();
$range_date_options = wud_get_range_date_options();

$is_my_documents = is_page( wud_get_page_id( 'my-account' ) ) ? true : false;
$user            = wp_get_current_user();
$display_buttons = $is_my_documents && $user->ID ? true : false;
$s               = isset( $_GET['wud_search'] ) ? sanitize_text_field( wp_unslash( $_GET['wud_search'] ) ) : '';
$orderby         = isset( $_GET['orderby'] ) ? sanitize_text_field( $_GET['orderby'] ) : $wud_settings->get_input_value( 'default_document_sortby', 'latest' );
$range_date      = isset( $_GET['range_date'] ) ? sanitize_text_field( $_GET['range_date'] ) : $wud_settings->get_input_value( 'default_range_date', 'all' );
?>

<div class="wud-documents-toolbar">
	<?php if ( $display_buttons ) { ?>
        <p class="wud-logout-toolbar"><?php
			printf(
				wp_kses( __( 'Hello %1$s (<a href="%2$s">Log out</a>)', 'wud' ), array( 'a' => array( 'href' => true ) )),
				'<strong>' . esc_html( $user->display_name ) . '</strong>',
				esc_url( wp_logout_url( wud_get_page_permalink( 'my-account' ) ) )
			);
			?></p>
	<?php } ?>
    <div class="row toolbar-top">
        <div class="<?php echo esc_attr( $display_buttons ) ? 'col-sm-6' : 'col-sm-12'; ?>">
			
            <form action="" method="get" id="wud-docs-form-search">
                <input class="form-control search-bar" type="search" id="search-bar" name="wud_search"
                       placeholder="<?php echo esc_html__( 'Search documents', 'wud' ); ?>" value="<?php echo esc_attr( $s ); ?>"/>
				<?php
				if ( current_theme_supports( 'document' ) ) { ?>
                    <input type="hidden" name="paged" value="1">
				<?php } ?>
				<?php
				if ( isset( $_GET['post_type'] ) && sanitize_text_field( $_GET['post_type'] ) == 'wud-doc' ) {
					echo '<input type="hidden" name="post_type" value="wud-doc">';
				}
				?>
                <a class="wud-search-button"><i class="fas fa-search"></i></a>
            </form>
        </div>
		<?php
		if ( $display_buttons ) { ?>
            <div class="col-sm-6">
                <div class="button-container button-right">
					<?php if ( $wud_settings->get_input_value( 'user_can_delete', 'yes' ) == 'yes' ) { ?>
                        <button id="wud-delete-docs" class="button button-salmon"><i
                                    class="fas fa-trash-alt"></i> <?php echo esc_html__( 'Delete selected', 'wud' ); ?></button>
					<?php } ?>
                    <a id="wud-create-doc" class="button button-regular"
                       href="<?php echo esc_url( wud_get_account_endpoint_url( 'create-document' ) ); ?>"><i
                                class="fas fa-plus-circle"></i> <?php echo esc_html__( 'Create document', 'wud' ); ?></a>
                </div>
            </div>
		<?php } ?>
    </div>
    <div class="row toolbar-footer">
        <div class="col-sm-4">
            <div class="results-found">
                <span><?php echo wud_get_loop_prop( 'total' ); ?> <?php echo esc_html__( 'Results', 'wud' ); ?></span>
                <span>(<?php echo esc_html__( 'Showing', 'wud' ); ?> <?php echo esc_html( $position_start ); ?> - <?php echo esc_html( $position_end ); ?>)</span>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="filter-form form-inline">
                <div class="form-group">
                    <?php
                    $field_options = array(
                        'type'    => 'select',
                        'name'    => 'cate',
                        'id'      => 'cate',
                        'value'   =>  $category_options,
                        'extra_attr'    => 'onchange="location = this.value; "',
                        'options' => $category_options,
                        'class'   => 'form-control cate',
                        'desc'    => '',
                        'wrapper' => ''
                    );
                    wud_app()->form->get_field( $field_options );
                    ?>
                </div>

                <form class="form-group" method="get">

                    <input type="hidden" name="wud_search" value="<?php echo esc_attr( $s ); ?>"/>
                    <div class="form-group">
                        <?php
                        $field_options = array(
                            'type'    => 'select',
                            'name'    => 'orderby',
                            'id'      => 'orderby',
                            'value'   => $orderby,
                            'options' => $sor_options,
                            'class'   => 'form-control orderby',
                            'desc'    => '',
                            'wrapper' => ''
                        );

                        wud_app()->form->get_field( $field_options );

                        ?>
                    </div>
                    <div class="form-group">
                        <?php

                        $field_options = array(
                            'type'    => 'select',
                            'name'    => 'range_date',
                            'id'      => 'range_date',
                            'value'   => $range_date,
                            'options' => $range_date_options,
                            'class'   => 'form-control range_date',
                            'desc'    => '',
                            'wrapper' => ''
                        );

                        wud_app()->form->get_field( $field_options );
                        ?>
                    </div>
                    <?php
                    if ( current_theme_supports( 'document' ) ) { ?>
                        <input type="hidden" name="paged" value="1">
                    <?php } ?>
                    <?php
                    if ( isset( $_GET['post_type'] ) && sanitize_text_field( $_GET['post_type'] ) == 'wud-doc' ) {
                        echo '<input type="hidden" name="post_type" value="wud-doc">';
                    }
                    ?>
                </form>
            </div>


        </div>
    </div>


</div>
