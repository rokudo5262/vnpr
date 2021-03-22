/*
 * @version    $Id$
 * @package   WordPress User Document
 * @author     ZuFusion
 * @copyright  (C) 2020  ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */


(function ($) {
    "use strict";

    $(document).ready(function () {


        var _this = this;

        $('.wud-upload-image').on('click', function (e) {
            e.preventDefault();
            var $this = $(this);
            var field_key = $this.attr('data-field');

            var media = wp.media({
                title: 'Insert a media',
                library: {type: 'image'},
                multiple: false,
                button: {text: 'Insert'}
            });

            media.on('select', function () {
                var first = media.state().get('selection').first().toJSON();
                $('#' + field_key, $this.parent().parent()).val(first.url);
            });

            media.open();

            return false;


        });

        var wud_compare_ele = function (el1, el2) {
            if (el1.val() == el2.attr('depend-value')) {
                el2.show();
            } else {
                el2.hide();
            }
        };

        $("[depend-id]").each(function () {
            var $this = $(this);
            var select = $('#' + $this.attr('depend-id'));

            wud_compare_ele(select, $this);
            select.change(function () {
                wud_compare_ele(select, $this);
            })
        });
    });

})(jQuery);