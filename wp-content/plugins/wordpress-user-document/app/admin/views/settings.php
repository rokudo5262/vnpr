<?php
/**
 * @version    $Id$
 * @package    WordPress User Document
 * @author     ZuFusion
 * @copyright  Copyright (C) 2020 ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

use Zufusion\Core\Helpers\Apphelper;

$current_tab = Apphelper::get_var( 'tab', 'GET', 'string', 'home' );
$url         = admin_url( 'edit.php?post_type=wud-doc&page=wud-settings' );

$tabs = array(
	'home'         => esc_html__( 'General', 'wud' ),
	'document'     => esc_html__( 'Document', 'wud' ),
	'roles'        => esc_html__( 'Roles', 'wud' ),
	'notification' => esc_html__( 'Notification', 'wud' ),
);
?>

<div class="wud-admin-options">

    <br>

    <form method="post" action="options.php">
		<?php settings_fields( 'wud_settings_fields' ); ?>

        <ul class="nav nav-tabs" id="myTab" role="tablist">

			<?php
			foreach ( $tabs as $tab => $name_tab ) {
				$class_link = '';
				if ( $tab == $current_tab ) {
					$class_link = 'active';
				}
				?>
                <li class="nav-item">
                    <a class="nav-link <?php echo esc_attr( $class_link ); ?>" id="wud-<?php echo esc_attr__( $tab ); ?>-tab"
                       href="<?php echo esc_url( $url ) . '&tab=' . $tab; ?>" role="tab"><?php echo esc_html( $name_tab ); ?></a>
                </li>
				<?php
			}
			?>
        </ul>
        <div class="tab-content" id="myTabContent">
			<?php
			foreach ( $tabs as $tab2 => $tab_name ) {
				$class_link = '';
				if ( $tab2 == $current_tab ) {
					$class_link = 'show active';
				}
				?>
                <div class="tab-pane fade <?php echo esc_attr( $class_link ) ; ?>" id="wud-<?php echo esc_attr( $tab2 ); ?>" role="tabpanel">
					<?php
					include 'settings/tab-' . $tab2 . '.php';
					?>
                </div>
				<?php
			}
			?>
        </div>

        <p style="margin-top:20px;">
            <input type="submit" name="submit" id="submit" class="btn btn-primary"
                   value="<?php echo esc_attr__( 'Save Changes', 'wud' ); ?>">
        </p>
    </form>

</div>
