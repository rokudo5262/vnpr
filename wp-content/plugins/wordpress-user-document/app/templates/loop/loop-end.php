<?php
/**
 * @version    $Id$
 * @package    WordPress User Document
 * @author     ZuFusion
 * @copyright  Copyright (C) 2020 ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */
?>

<?php if ( wud_get_loop_prop( 'list_type', 'list' ) === 'table' ) { ?>
    </tbody>
    </table>
<?php } else if ( wud_get_loop_prop( 'list_type', 'list' ) === 'list_table' ) { ?>
	</tbody>
    </table>
<?php } else { ?>
    </ul>
<?php } ?>
<?php if ( wud_get_loop_prop( "name" ) === 'author' ) { ?>
    </form>
<?php } ?>
