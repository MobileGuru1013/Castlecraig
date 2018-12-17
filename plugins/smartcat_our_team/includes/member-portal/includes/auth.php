<?php

namespace ots_pro\portal;


function logout_link() {

    return admin_url( 'admin-post.php?action=ots_portal_logout&nonce=' . wp_create_nonce( 'log_user_out' ) );

}


function log_user_out( $redirect = true ) {

    if ( Session::logout() ) {

        if ( $redirect ) {
            wp_safe_redirect( get_permalink( get_option( Options::LOGOUT_PAGE ) ) );
        }

    }

}


function update_user_pw( $member = null, $pw ) {

    $member = get_member( $member );

    return $member->set_metadata( 'pw', wp_hash_password( $pw ) ) !== false;

}



function auth_redirect() {

    if ( !Session::is_authenticated() &&
           ( is_portal_page() || is_edit_profile_page() || ( is_single() || is_page() ) && is_post_protected() ) ) {

        // Check post override set
        $override = get_post_meta( get_the_ID(), 'unauthorized_redirect', true );
        $redirect = $override ? $override : get_option( Options::UNAUTHORIZED_REDIRECT );

        // Redirect the user to the unauthorized page
        wp_safe_redirect( get_the_permalink( $redirect ), 303 );

    } else if ( !member_can_access() ) {

        // Check post override set
        $override = get_post_meta( get_the_ID(), 'wrong_group_redirect', true );
        $redirect = $override ? $override : get_option( Options::WRONG_GROUP_REDIRECT );

        // Redirect the user to the wrong group page
        wp_safe_redirect( get_the_permalink( $redirect ), 303 );

    } else if ( Session::is_authenticated() && ( is_login_page() || is_logout_page() ) ) {
        wp_safe_redirect( get_the_permalink( get_option( Options::PORTAL_PAGE ) ) );
    }

}

add_action( 'template_redirect', 'ots_pro\portal\auth_redirect' );
