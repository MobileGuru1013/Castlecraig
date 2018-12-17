jQuery(document).ready(function ($) {


    $(document).ready(function() {
        tooltips();
    });

    function tooltips() {
        $('[data-toggle="tooltip"]').tooltip({ html: true });
    }


    $('.sc-team-table').DataTable({
        filter: true,
        sorting: [],
        language: {
            lengthMenu: '_MENU_'
        },
        responsive: true,
    });


    $(document).on('click', '.like-post', function (e) {

        const btn = $(this);

        $.ajax({
            url: i10n.ajax_url,
            method: 'post',
            data: {
                _ajax_nonce: i10n.ajax_nonce,
                action: 'ots_portal_like_post',
                liked: btn.attr('data-liked'),
                post_id: btn.data('id')
            },
            success: function (res) {

                if (res.success) {

                    btn.parents('.post-metadata')
                        .replaceWith(res.data.template.rendered);

                    tooltips();

                }

            }
        });

        e.preventDefault();

    });


    $(document).scroll(function () {
        $('.parallax').css({
            'background-position-y': ($(window).scrollTop() * -0.3) + 'px'
        });
    });


    $('.blogroll .load-more').click(function (e) {

        var load_more_btn = $(this);
        var blogroll      = $('.blogroll-posts');
        var current_page  = blogroll.find('.blogroll-page').last();

        load_more_btn.addClass('loading');

        $.ajax({
            url: i10n.ajax_url,
            data: {
                action: 'ots_portal_get_blogroll_posts',
                _ajax_nonce: i10n.ajax_nonce,
                page: current_page.data('page-num') + 1
            },
            success: function (res) {

                if (res.data.count > 0) {

                    if (res.data.template) {

                        var new_page = $(res.data.template.rendered).hide();

                        blogroll.append(new_page);
                        new_page.slideToggle();

                        tooltips();

                    }

                }

                setTimeout(function () { load_more_btn.removeClass('loading'); }, 1000);

            }
        });

        e.preventDefault();

    });


    $('.toggle-menu').click(function (e) {

        var sidebar = $('#sidebar').toggleClass('open');

        var open =  sidebar.find('.open');
        var close = sidebar.find('.close');

        if (open.is(':visible')) {
            open.fadeToggle('fast', function () {
                close.fadeToggle();
            });
        } else if (close.is(':visible')) {
            close.fadeToggle('fast', function () {
                open.fadeToggle();
            });
        }

        e.preventDefault();

    });


    $( '.comment-form form' ).bind('keypress', function (e) {

        if ( e.keyCode === 13 ) {

            var count = $(this).parents('.post').find('.count-comments');

            var recent = $(this).parents('.comments').find('.recent');
            var data   = {};

            $(this).serializeArray().map(function (input) {
                data[input.name] = input.value;
            });

            if (data.comment !== '') {

                $(this).find('textarea.comment-box').val(null);

                $.ajax({
                    url: i10n.ajax_url,
                    data: Object.assign(data, {
                        _ajax_nonce: i10n.ajax_nonce,
                        action: 'ots_portal_comment_submit',
                    }),
                    method: 'post',
                    success: function (res) {

                        if (res.success) {

                            var comment = $(res.data.template.rendered).hide();

                            if (recent.data('append') === 'after') {
                                recent.append(comment);
                            } else if (recent.data('append') === 'before') {
                                recent.prepend(comment);
                            }

                            comment.slideToggle();
                            count.text(Number(count.text()) + 1);

                        }

                    }
                });

            }

            e.preventDefault();

        }

    });


    $(document).on('click', '.load-more-comments', function (e) {

        var btn  = $(this);
        var page = btn.attr('data-page-num');

        $.ajax({
            url: i10n.ajax_url,
            data: {
                action: 'ots_portal_load_more_comments',
                _ajax_nonce: i10n.ajax_nonce,
                post_id: btn.data('post-id'),
                page: page
            },
            success: function (res) {

                if (res.success && res.data.page > page) {

                    var comments = $(res.data.template.rendered).hide();

                    btn.parents('.post').find('.recent').prepend(comments);
                    btn.attr('data-page-num', res.data.page);
                    comments.slideToggle();

                }

            }
        });

        e.preventDefault();

    });

});

