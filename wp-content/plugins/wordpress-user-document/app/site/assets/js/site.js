/**
 * jQuery WordPress User Document
 * @author     ZuFusion
 * @copyright  Copyright (C) 2020 ZuFusion All Rights Reserved.
 */


(function ($) {
    "use strict";

    var my_account_form = $('#wud-my-account-form');
    var form_document = $('#wud-form-document');

    // Responsive table
    $('.wud-theme-table').zufusiontable({
        breakpoint: {
            xs: 480,
            sm: 576,
            md: 992,
            lg: 1200,
            xlg: 1400,
        }
    });

    // Tags
    var suggestions = [];
    var tags = $.parseJSON(wud_vars.tags);
    if (!$.isEmptyObject(tags)) {
        $.each(tags, function (i, v) {
            suggestions.push({'tag': v, 'value': i});
        })
    }

    $('#wud-form-document #tags').amsifySuggestags({
        type: 'amsify',
        suggestions: suggestions
    });
    // multi select
    $('.wud-multiple').select2();

    // document image
    $('#wud-remove-post-thumbnail').on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        var parent = $(this).closest('#forms_field_post_image');
        var _thumbnail_id = $('#_thumbnail_id', parent);
        var doc_image = $('#doc_image', parent);
        var description = $('.description', parent);

        parent.find('img').remove();
        _thumbnail_id.val(-1);
        doc_image.addClass('wud-show');
        doc_image.attr('data-parsley-required', true);
        description.addClass('wud-show');
        $this.addClass('wud-hide');
    });

    // Captcha
    var captcha = $('#captcha');
    var field_spam = $('#forms_field_spam');
    var num1 = Math.round(Math.random() * 8) + 1;
    var num2 = Math.round(Math.random() * 8) + 1;
    var sum_num = num1 + num2;
    field_spam.find('label').text(num1 + ' + ' + num2 + ' = ?');
    captcha.attr('data-parsley-captcha', sum_num);

    window.Parsley.addValidator('captcha', {
        requirementType: 'integer',
        validateNumber: function (value, requirement) {
            return value === requirement;
        },
        messages: {
            en: wud_vars.translate.incorrect_response,
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

    window.Parsley.addValidator('fileextension', {
        validateString: function (value, requirement, parsleyInstance) {
            var tagslistarr = requirement.split(',');
            var fileExtension = value.split('.').pop().toLowerCase();
            var arr=[];
            $.each(tagslistarr,function(i,val){
                arr.push(val.toLowerCase());
            });
            if($.inArray(fileExtension, arr)!='-1') {
                return true;
            } else {
                return false;
            }
        },
        messages: {
            en: wud_vars.translate.fileextension,
        }
    });

    if (form_document.find('form').length > 0) {
        var form = form_document.find('form');
        form.parsley().on('form:submit', function (formInstance) {
            $('#wud-overlay-loading').show();
        });

        $('#wud-delete-doc').on('click', function (e) {
            e.preventDefault();
            var $this = $(this);
            if (confirm(wud_vars.translate.are_you_sure)) {
                $('#wud-overlay-loading').show();
                window.location = $this.attr('href');
            }
        })
    }

    // like/dislike
    $(document).on('click', '.wud-button-like', function () {
        var button = $(this);
        var post_id = button.attr('data-post-id');
        var security = button.attr('data-nonce');
        var iscomment = button.attr('data-iscomment');
        var buttons;
        if ( iscomment === '1' ) { /* Comments can have same id */
            buttons = $('.wud-comment-button-'+post_id);
        } else {
            buttons = $('.wud-button-like-' + post_id);
        }
        var loader = buttons.next('#wud-loader');
        if (post_id !== '') {
            $.ajax({
                type: 'POST',
                url: wud_vars.ajaxurl + '&controller=doc&task=like',
                data: {
                    post_id: post_id,
                    nonce: security,
                    is_comment: iscomment,
                },
                beforeSend: function () {
                    loader.html('&nbsp;<div class="wud-loading">Loading...</div>');
                },
                success: function (response) {
                    var icon = response.icon;
                    var count = response.count;
                    buttons.html(icon + count);
                    if (response.status === 'unliked') {
                        var like_text = wud_vars.like;
                        buttons.prop('title', like_text);
                        buttons.removeClass('liked');
                    } else {
                        var unlike_text = wud_vars.unlike;
                        buttons.prop('title', unlike_text);
                        buttons.addClass('liked');
                    }
                    loader.empty();
                }
            });

        }
        return false;
    });


    $(document).on('click', '.wud-search-button', function () {
        var button = $(this);
        button.closest('form').submit();
    });

    $('.wud-documents-toolbar .filter-form select').on('change', function () {
        var select = $(this);
        select.closest('form').submit();
    });


    // My account page
    $('#cb-select-all').on('click', function () {
        var $this = $(this),
            table = $this.closest('table');
        if ($this.is(':checked')) {
            table.find('input[type="checkbox"]').prop('checked', true);
        } else {
            table.find('input[type="checkbox"]').prop('checked', false);
        }
    });

    $('#wud-delete-docs').on('click', function (e) {
        e.preventDefault();
        var checked = my_account_form.find('.post-checkbox:checked');
        if (checked.length > 0) {
            if (confirm(wud_vars.translate.delete_document)) {
                my_account_form.submit();
            } else {
                return false;
            }
        }

        my_account_form.submit();
    });

    // get access options
    $('#group_id').on('change', function () {

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: wud_vars.admin_ajaxurl + '&controller=doc&task=getaccessoptions',
            data: {
                group_id: $(this).val(),
            },
            success: function (response) {
                $('#visibility_by').html(response.access_options);
                $('#comment_by').html(response.access_options);
                $('#edit_by').html(response.edit_option);

            }
        });

    });

    // Single document
    var email_form = $('#share-email-form');
    if (email_form.length) {
        email_form.parsley().on('form:submit', function (formInstance) {

            var $send = email_form.find('#send_email');
            $.ajax({
                url: wud_vars.ajaxurl + '&controller=email&task=send',
                type: "POST",
                dataType: 'json',
                data: $('#share-email-form').serialize(),
                beforeSend: function () {
                    $send.attr('disabled', true);
                    email_form.find('#message_response').text(wud_vars.translate.sending);
                },
            }).done(function (response) {

                email_form.find('#message_response').text(response.message);
                $send.attr('disabled', false);

                setTimeout(function () {
                    email_form.find('#message_response').text('');
                }, 5000)
            });

            return false;
        })
    }

    $( document ).ready(function() {

        var check_iframe_loaded_interval = setInterval( check_iframe_loaded, 1000 );

        function check_iframe_loaded() {
            var iframe_content = $('#wud-preview-iframe');
            var src = iframe_content.attr('src');
            var did = false;
            try {
                if (iframe_content.contents().find('body').children().length > 0) {
                    // is loaded
                } else {
                    // iframe_content.src = iframe_content.src;
                    iframe_content.attr('src', src);
                    clearInterval(check_iframe_loaded_interval);
                    did = true;
                }

            } catch (e) {
                if (e.message.indexOf('Blocked a frame with origin') > -1 || e.message.indexOf('from accessing a cross-origin frame.') > -1) {
                    console.log('Same origin Iframe error found!!!');
                    //Do fallback handling if you want here
                    if (!did) {
                        iframe_content.attr('src', src);
                        clearInterval(check_iframe_loaded_interval);
                    }

                }
            }

        }

        // $(".pdf-container").pdfviewer();

    });

})(jQuery);