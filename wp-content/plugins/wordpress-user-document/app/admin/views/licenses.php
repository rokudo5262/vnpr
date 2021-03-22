<?php
/**
 * @version    $Id$
 * @package   WordPress User Document
 * @author     ZuFusion
 * @copyright  (C) 2020  ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

use Zufusion\Core\Classes\Form;

global $wud_settings;

$form = new Form();

global $post_type, $post_type_object, $pagenow, $typenow;

$editing = false;

if ( isset( $_REQUEST['post_type'] ) && post_type_exists( wp_unslash( $_REQUEST['post_type'] ) ) ) {
	$typenow = wp_unslash( $_REQUEST['post_type'] );
} else {
	$typenow = '';
}

$post_type        = $typenow;
$post_type_object = get_post_type_object( $post_type );


?>
<div class="wrap wud-licenses">
    <div class="wrap">
        <h1 class="wp-heading-inline"><?php echo esc_html__( 'Manage Licenses', 'wud' ); ?></h1>

		<?php
		if ( current_user_can( $post_type_object->cap->create_posts ) ) {
			echo ' <a href="' . esc_url( admin_url( 'edit.php?post_type=wud-doc&page=wud-add-license' ) ) . '" class="page-title-action">' . esc_html( $post_type_object->labels->add_new ) . '</a>';
		}

		if ( isset( $_REQUEST['s'] ) && strlen( $_REQUEST['s'] ) ) {
			/* translators: %s: Search query. */
			printf( ' <span class="subtitle">' . esc_html__( 'Search results for &#8220;%s&#8221;' ) . '</span>', get_search_query() );
		}
		?>

        <hr class="wp-header-end">

		<?php
		if ( isset( $action ) ) {
			echo wud_print_notices( $action, 'Licenses', $status, $msg );
		}
		?>
        <br>

        <form method="GET" action="">
            <input type="hidden" name="post_type" value="wud-doc">
            <input type="hidden" name="page" value="wud-licenses">
            <input type="hidden" name="zufusionapp" value="wud">
            <input type="hidden" name="zufusion" value="admin">
            <input type="hidden" name="controller" value="licenses">
            <input type="hidden" name="task" value="index">

            <table class="table table-hover">
                <thead>
                <tr>
                    <th id="cb" class="manage-column column-cb check-column"><label class="screen-reader-text"
                                                                                    for="cb-select-all-1"><?php echo esc_html__( 'Select All', 'wud' ); ?></label><input
                                id="cb-select-all-1" type="checkbox"></th>
                    <th scope="col"><?php echo esc_html__( 'Name', 'wud' ); ?></th>
                    <th scope="col"><?php echo esc_html__( 'License icon', 'wud' ); ?></th>
                    <th scope="col"><?php echo esc_html__( 'Reference link', 'wud' ); ?></th>
                    <th scope="col"><?php echo esc_html__( 'Created', 'wud' ); ?></th>
                    <th scope="col"><?php echo esc_html__( 'Manage', 'wud' ); ?></th>
                </tr>
                </thead>
                <tbody>
				<?php
				if ( ! empty( $rows ) ) {
					foreach ( $rows as $row ) {
						?>
                        <tr>
                            <th scope="row" class="check-column">
                                <input id="cb-select-<?php echo esc_attr( $row->ID ); ?>" type="checkbox" name="post[]"
                                       value="<?php echo esc_attr( $row->ID ); ?>">
                            </th>
                            <td><?php echo esc_html__( $row->post_title ); ?></td>
                            <td><img src="<?php echo esc_url( $row->icon ); ?>" alt="" width="100"></td>
                            <td><?php echo '<a href="' . esc_url( $row->reference_link ) . '" target="_blank">' . esc_url( $row->reference_link ) . '</a>'; ?></td>
                            <td><?php echo mysql2date( get_option( 'date_format' ), $row->post_date ); ?></td>
                            <td><?php if ( current_user_can( 'wud_edit_license' ) ) { ?><?php echo '<a href="' . esc_url( admin_url( 'edit.php?post_type=wud-doc&page=wud-licenses&zufusionapp=wud&zufusion=admin&controller=license&task=edit&id=' . $row->ID ) ) . '">' . esc_html__( 'Edit', 'wud' ) . '</a>'; ?><?php } else {
									'--';
								} ?></td>
                        </tr>
						<?php
					}
				}
				?>

                </tbody>
            </table>
            <div class="tablenav bottom">
                <div class="alignleft actions bulkactions">
                    <label for="bulk-action-selector-bottom"
                           class="screen-reader-text"><?php echo esc_html__( 'Select bulk action', 'wud' ); ?></label>
                    <select name="action" id="bulk-action-selector-bottom">
                        <option value="-1"><?php echo esc_html__( 'Bulk Actions', 'wud' ); ?></option>
						<?php if ( current_user_can( 'wud_delete_license' ) ) { ?>
                            <option value="delete" class="hide-if-no-js"><?php echo esc_html__( 'Delete', 'wud' ); ?></option>
						<?php } ?>
                    </select>
                    <input type="submit" class="button action" value="<?php echo esc_html__( 'Apply', 'wud' ); ?>">
                </div>
				<?php
				if ( $pagination ) {
					echo wp_kses_post( $pagination );
				}
				?>
            </div>

        </form>

    </div>
</div>
