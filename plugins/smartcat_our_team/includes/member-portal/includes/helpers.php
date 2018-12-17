<?php

namespace ots_pro\portal;


function get_members_in_group( $group_id, $exclude = array() ) {

    $args = array(
        'post_type'      => 'team_member',
        'posts_per_page' => -1,
        'post__not_in'   => $exclude,
        'tax_query'      => array(
            array(
                'taxonomy'  => 'team_member_position',
                'field'     => 'term_id',
                'terms'     => $group_id
            )
        )
    );

    return new \WP_Query( $args );

}


function get_cover_photo( $member = null, $size = 'large' ) {

    $member = get_member( $member );

    if ( $member && !empty( $member->cover_photo ) ) {
        return wp_get_attachment_image_url( $member->cover_photo, $size );
    }

    return false;

}


function has_cover_photo( $member = null ) {

    $member = get_member( $member );

    if ( $member ) {
        return !empty( $member->cover_photo );
    }

    return false;

}


function relatime_diff( $from, $to = '' ) {

    return human_time_diff( strtotime( $from ), strtotime( $to ) ) . ' ' . __( 'ago', 'ots-pro' );

}


function list_member_names( $members, $separator = ', ' ) {

    $list = '';

    foreach ( $members as $member ) {

        $member = get_member( $member );

        if ( $member ) {
            $list .= $member->get_name() .  $separator;
        }

    }

    return $list;

}