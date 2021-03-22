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
			<?php
			include wud_get_template( 'widgets/layout/default', false, false );
			?>
		<?php }
		?>

    </div>
<?php } ?>