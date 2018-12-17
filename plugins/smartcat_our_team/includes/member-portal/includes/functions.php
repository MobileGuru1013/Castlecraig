<?php

namespace ots_pro\portal;


function sanitize_page_id( $id ) {

    $post = get_post( $id );

    if ( $post && $post->post_type =='page' ) {
        return $id;
    }

    return false;

}


function sanitize_skin( $skin ) {

    if ( array_key_exists( $skin, skins() ) ) {
        return $skin;
    }
    
    return Defaults::SKIN;

}


function skins() {

    $skins = array(
        'skin-app'          => 'App',
        'skin-plain'        => 'Plain',
        'skin-business'     => 'Business',
    );

    return $skins;
    
}


function sanitize_member_status( $status ) {

    if ( in_array( $status, array( 'active', 'inactive' ) ) ) {
        return $status;
    }

    return false;

}


function verify_nonce( $name = '_wpnonce', $action = -1 ) {

    return isset( $_REQUEST[ $name ] ) && wp_verify_nonce( $_REQUEST[ $name ], $action );

}