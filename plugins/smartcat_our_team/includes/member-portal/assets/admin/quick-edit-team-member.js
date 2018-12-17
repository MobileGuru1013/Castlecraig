jQuery(document).ready(function ($) {
    "use strict";

    var wp_inline_edit_function = inlineEditPost.edit;

    /**
     * Handle Quick edit
     */
    inlineEditPost.edit = function(post_id) {
        wp_inline_edit_function.apply(this, arguments);

        var id = 0;

        if (typeof(post_id) === 'object') {
            id = parseInt( this.getId(post_id));
        }

        if (!id) {
            return;
        }

        var edit_row = $('#edit-' + id),
            post_row = $('#post-' + id),
            portal_status = $('.column-portal_status', post_row).text().toLowerCase().trim();

        $(':input[name="team_member_status"]', edit_row).prop('checked', portal_status === 'active');
    };

    /**
     * Handle Bulk edit
     */
    $(document).on('click', '#bulk_edit', function (e) {
        var $bulk_row = $('#bulk-edit'),
            post_ids  = [];

        $bulk_row.find('#bulk-titles').children().each(function () {
            post_ids.push($(this).attr('id').replace(/^(ttle)/i, ''));
        });

        var isActive = $bulk_row.find(':input[name="team_member_status"]').is(':checked');

        wp.ajax.post('save_bulk_edit_team_member', {
            post_ids: post_ids,
            status: isActive ? 'active' : 'inactive',
            nonce: $(':input[name="ots_inline_edit"]').val()
        });
    });

});