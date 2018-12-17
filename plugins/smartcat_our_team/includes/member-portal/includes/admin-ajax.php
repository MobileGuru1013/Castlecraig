<?php

namespace ots_pro\portal;


function ajax_generate_password() {

    $length = isset( $_REQUEST['length'] ) ? $_REQUEST['length'] : 24;

    if ( check_ajax_referer( 'ots_portal_ajax' ) ) {
        wp_send_json( wp_generate_password( $length ) );
    }

}

add_action( 'wp_ajax_ots_portal_generate_password', 'ots_pro\portal\ajax_generate_password' );


function ajax_activate_members() {

    if ( check_ajax_referer( 'ots_portal_ajax' ) ) {

        foreach ( get_members_by_status( 'inactive' )->posts as $member ) {
            set_member_status( $member, 'active' );
        }

        wp_send_json_success();

    }

}

add_action( 'wp_ajax_ots_portal_activate_members', 'ots_pro\portal\ajax_activate_members' );


function ajax_set_post_like() {

    if ( check_ajax_referer( 'ots_portal_ajax' ) ) {

       $post  = get_post( $_POST['post_id'] );
       $liked = $_POST['liked'] == 'true' ? true : false;

       if ( $liked ) {
           $liked = !unlike_post( $post );
       } else {
           $liked = !like_post( $post );
       }

        $data = array(
            'liked'    => $liked,
            'count'    => count_post_likes( $post ),
            'template' => array(
                'rendered' => buffer_template( 'post-metadata', array( 'post' => $post ) )
            )
        );

        wp_send_json_success( $data );

    }

}

add_action( 'wp_ajax_ots_portal_like_post', 'ots_pro\portal\ajax_set_post_like' );
add_action( 'wp_ajax_nopriv_ots_portal_like_post', 'ots_pro\portal\ajax_set_post_like' );


function ajax_get_blogroll_posts() {

    if ( check_ajax_referer( 'ots_portal_ajax' ) ) {

        $limit = get_option( Options::POSTS_PER_PAGE );

        $page  = isset( $_REQUEST['page'] ) ? absint( $_REQUEST['page'] ) : 1;
        $posts = get_member_viewable_pages( get_member(), 'post', $limit, $page );

        if ( !empty( $posts ) ) {

            $data = array(
                'count'    => count( $posts ),
                'limit'    => $limit,
                'page'     => $page,
                'template' => array(
                    'rendered' => buffer_template( 'blogroll-page', array( 'posts' => $posts, 'page' => $page ) )
                )
            );

        } else {

            $data = array(
                'count'    => count( $posts ),
                'page'     => $page,
                'limit'    => $limit
            );

        }

        wp_send_json_success( $data );

    }

}

add_action( 'wp_ajax_ots_portal_get_blogroll_posts', 'ots_pro\portal\ajax_get_blogroll_posts' );
add_action( 'wp_ajax_nopriv_ots_portal_get_blogroll_posts', 'ots_pro\portal\ajax_get_blogroll_posts' );


function ajax_comment_submit() {

    if ( check_ajax_referer( 'ots_portal_ajax' ) ) {

        $comment = array(
            'post_id'          => absint( $_POST['post_id'] ),
            'author_id'        => get_member()->get_id(),
            'content'          => sanitize_text_field( $_POST['comment'] ),
            'comment_date'     => current_time( 'mysql' ),
            'comment_date_gmt' => current_time( 'mysql', 1 ),
        );

        $id = insert_comment( $comment );

        if ( is_numeric( $id ) ) {

            $data = array(
                'template' => array(
                    'rendered' => buffer_template( 'comment', array( 'comment' => get_comment( $id ) ) )
                )
            );

            wp_send_json_success( $data );

        }

    }

}

add_action( 'wp_ajax_ots_portal_comment_submit', 'ots_pro\portal\ajax_comment_submit' );
add_action( 'wp_ajax_nopriv_ots_portal_comment_submit', 'ots_pro\portal\ajax_comment_submit' );


function ajax_load_more_comments() {

    if ( check_ajax_referer( 'ots_portal_ajax' ) ) {

        $post = absint( $_REQUEST['post_id'] );
        $page = absint( $_REQUEST['page'] );

        $args = array(
            'post_id' => $post,
            'page'    => $page,
            'order'   => 'DESC',
            'limit'   => 5,
            'offset'  => 1
        );

        $comments = get_post_comments( $args );


        $data = array(
            'page'     => count( $comments ) > 0 ? $page + 1 : $page,
            'post_id'  => $post,
            'count'    => count( $comments ),
            'template' => array(
                'rendered' => ''
            )
        );

        foreach ( $comments as $comment ) {
            $data['template']['rendered'] .= buffer_template( 'comment', array( 'comment' => $comment ), false );
        }

        wp_send_json_success( $data );

    }

}

add_action( 'wp_ajax_ots_portal_load_more_comments', 'ots_pro\portal\ajax_load_more_comments' );
add_action( 'wp_ajax_nopriv_ots_portal_load_more_comments', 'ots_pro\portal\ajax_load_more_comments' );