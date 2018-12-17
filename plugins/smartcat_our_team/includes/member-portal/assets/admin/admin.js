jQuery(document).ready(function ($) {
    "use strict";

    $.wpMediaUploader({
        target: '.ots-portal-upload',
        uploaderTitle:  ots_portal_i10n.media_uploader_title,
        uploaderButton: ots_portal_i10n.media_uploader_button
    });


    $('.ots-generate-pw').click(function () {

        $(this).toggle();

        const pwd   = $(this).siblings('.ots-pwd').toggle();
        const input = pwd.find('[name="password"]');
        const text  = pwd.find('[name="password-text"]');

        input.prop('disabled', false).val(input.data('pw'));
        text.prop('disabled', false).val(input.data('pw'));

        pwd.find('.password-input-wrapper').addClass('show-password');

    });

    $('.ots-cancel-pw').click(function () {

        const pwd   = $(this).parents('.ots-pwd').toggle();
        const input = pwd.find('[name="password"]');
        const text  = pwd.find('[name="password-text"]');

        input.prop('disabled', true);
        text.prop('disabled', true);

        pwd.siblings('.ots-generate-pw').toggle();
        pwd.find('.password-input-wrapper').removeClass('show-password');

        input.hide();
        text.show();

        $.ajax({
            url: ots_portal_i10n.ajax_url,
            data: {
                _ajax_nonce: ots_portal_i10n.ajax_nonce,
                action: 'ots_portal_generate_password'
            },
            success: function (pw) {
                input.data('pw', pw);
            }
        })

    });

    $('.ots-hide-pw').click(function () {

        $(this).find('.dashicons')
            .toggleClass('dashicons-hidden')
            .toggleClass('dashicons-visibility');

        const pwd   = $(this).parents('.ots-pwd');
        const input = pwd.find('[name="password"]');
        const text  = pwd.find('[name="password-text"]');

        pwd.find('.password-input-wrapper')
            .toggleClass('show-password');

        input.val(text.val());
        input.toggle();
        text.toggle();

        $(this).find('.text')
            .text(text.is(':visible') ? ots_portal_i10n.pw_hide: ots_portal_i10n.pw_show);

    });

    $('.password-input-wrapper > input').keyup(function () {

        $(this).siblings('input')
            .val($(this).val());

    });

    $('[name="stp_access"]').change(function() {
        $('#ots-portal-restrict-groups').toggle();
    });

    $('#ots-portal-restrict').change(function() {

        $('#ots-portal-restrict-access').toggle();

        if ($(this).is(':checked')) {

            if ($('[name="stp_access"]:checked').val() === 'group') {
                $('#ots-portal-restrict-groups').show();
            }

        } else {
            $('#ots-portal-restrict-groups').hide();
        }

    });


    $('#ots-activate-all-members').click(function () {
        $(this).fadeToggle(function () {
            $('#confirm-member-activation').fadeToggle();
        });
    });

    $('#ots-cancel-activate-members').click(function () {
        $('#confirm-member-activation').fadeToggle(function () {
            $('#ots-activate-all-members').fadeToggle();
        });
    });

    $('#ots-confirm-activate-members').click(function () {

        $.ajax({
            url: ots_portal_i10n.ajax_url,
            data: {
                _ajax_nonce: ots_portal_i10n.ajax_nonce,
                action: 'ots_portal_activate_members'
            },
            success: function (pw) {
                location.reload();
            }
        })

    });


});