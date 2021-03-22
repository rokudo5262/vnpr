<?php
/**
 * @version    $Id$
 * @package   WordPress User Document
 * @author     ZuFusion
 * @copyright  (C) 2020  ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

use Zufusion\Core\Classes\Form;
use Zufusion\Core\Helpers\Apphelper;

global $wud_settings;
$form        = new Form();
$task        = Apphelper::get_var( 'task', 'GET', 'string', 'add' );
$heading     = $task == 'edit' || $task == 'save' ? esc_html__( 'Edit License', 'wud' ) : esc_html__( 'Add New License', 'wud' );
$current_url = $task == 'edit' || $task == 'save' ? admin_url( 'edit.php?post_type=wud-doc&page=wud-licenses&zufusionapp=wud&zufusion=admin&controller=license&task=save' ) : admin_url( 'edit.php?post_type=wud-doc&page=wud-add-license&zufusionapp=wud&zufusion=admin&controller=license&task=add' );
?>
<div class="wrap wud-add-license">

    <h1 class="wp-heading-inline"><?php echo esc_html( $heading ); ?></h1>

    <hr class="wp-header-end">

	<?php
	if ( isset( $action ) ) {
		echo wud_print_notices( $action, 'License', $status, $msg );
	}
	?>

    <form name="post" action="<?php echo esc_url( $current_url ); ?>" method="post" id="post" enctype="multipart/form-data"
          encoding="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo esc_attr( $row['ID'] ); ?>">
        <div id="license-body" class="metabox-holder columns-1">
            <div id="license-body-content" style="position: relative;">

                <div id="titlediv">
                    <div id="titlewrap">
                        <input type="text" name="license_name" size="30" value="<?php echo esc_attr__( $row['name'] ); ?>"
                               class="form-control" placeholder="<?php echo esc_attr__( 'Name', 'wud' ); ?>">
                    </div>
                </div>
                <br>
                <div class="postbox ">
                    <h2 class="hndle"><span><?php echo esc_html__( 'License icon', 'wud' ); ?> : </span></h2>
                    <div class="inside">
                        <div class="input-group image-url-wrapper">
                            <input type="text" class="form-control image-url" name="license_icon" id="license_icon"
                                   value="<?php echo esc_attr__( $row['icon'] ); ?>"/>
                            <a href="#" class="btn btn-light wud-upload-image" data-field="license_icon"
                               title="<?php echo esc_attr__( 'Add Media', 'wud' ); ?>"><span
                                        class="wp-media-buttons-icon"></span> <?php echo esc_html__( 'Upload image', 'wud' ); ?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="postbox ">
                    <h2 class="hndle"><span><?php echo esc_html__( 'Reference link', 'wud' ); ?> : </span></h2>
                    <div class="inside">
                        <input type="text" name="reference_link" size="30" value="<?php echo esc_url( $row['reference_link'] ); ?>"
                               class="form-control">
                    </div>
                </div>
            </div>

        </div><!-- /post-body -->

        <p style="margin-top:20px;">
            <input type="submit" name="publish" id="publish" class="button button-primary button-large"
                   value="<?php echo esc_attr__( 'Submit', 'wud' ); ?>">
        </p>
    </form>

</div>
