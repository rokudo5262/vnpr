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

        var WUD_License = {
            init: function () {
                this.init_element_media();
            },

            // Init elements media for a object
            init_element_media: function () {
                var _this = this;
                $('.wud-upload-image').on('click', function (e) {
                    e.preventDefault();
                    var $this = $(this);
                    var field_key = $this.attr('data-field');
                    _this.upload_media(field_key, $this.parent());
                });
            },

            upload_media: function (field_key, ob) {

                var media = wp.media({
                    title: 'Insert a media',
                    library: {type: 'image'},
                    multiple: false,
                    button: {text: 'Insert'}
                });

                media.on('select', function () {
                    var first = media.state().get('selection').first().toJSON();
                    $('#' + field_key, ob).val(first.url);
                });

                media.open();

                return false;

            },

        };

        WUD_License.init();

    });

})(jQuery);

