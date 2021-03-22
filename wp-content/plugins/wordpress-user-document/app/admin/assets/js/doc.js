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
        var post_form = $('#post');
        $('#forms_field_wud_approved').on('click', 'input', function () {
            var $this = $(this);
            var reject_message = $('#forms_field_reject_notify');
            if ($this.val() != -1) {
                reject_message.removeClass('wud-show');
            } else {
                reject_message.addClass('wud-show');
            }
        });

        window.Parsley.addValidator('maxfilesize', {

            validateString: function (_value, maxSize, parsleyInstance) {
                if (!window.FormData) {
                    alert('You are making all developpers in the world cringe. Upgrade your browser!');
                    return true;
                }
                var files = parsleyInstance.$element[0].files;

                return files.length != 1 || files[0].size / (1024 * 1024) <= parseInt(maxSize);
            },
            requirementType: 'string',
            messages: {
                en: wud_vars.translate.max_file_size,
            }
        });


        if (!post_form.is('[enctype="multipart/form-data"]')) {
            post_form.attr('enctype', 'multipart/form-data');
        }
        post_form.parsley();
        // get access options
        $('#group_id').on('change', function () {

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: wud_vars.ajaxurl + '&controller=doc&task=getaccessoptions',
                data: {
                    group_id: $(this).val(),
                },
                beforeSend: function () {

                },
                success: function (response) {
                    $('#wud_params_visibility_by').html(response.access_options);
                    $('#wud_params_comment_by').html(response.access_options);
                    $('#wud_params_edit_by').html(response.edit_option);

                }
            });

        });
    });

})(jQuery);

