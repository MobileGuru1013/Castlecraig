<?php

namespace ots_pro;

/**
 * Save the member's skills meta box.
 *
 * @param $post_id
 * @since 4.0.0
 */
function save_skills_meta_box( $post_id ) {

    if( isset( $_POST['skills_meta_box_nonce'] ) &&
        wp_verify_nonce( $_POST['skills_meta_box_nonce'], 'skills_meta_box' ) ) {

        update_post_meta( $post_id, 'team_member_skill_bool', isset( $_POST['team_member_skill_bool'] ) ? 'on' : '' );
        update_post_meta( $post_id, 'team_member_skill_title', sanitize_text_field( $_POST['team_member_skill_title'] ) );

        for( $ctr = 0; $ctr < count( $_POST['team_member_skill_titles'] ); $ctr++ ) {

            $title  = $_POST['team_member_skill_titles'][ $ctr ];
            $rating = $_POST['team_member_skill_ratings'][ $ctr ];

            update_post_meta( $post_id, 'team_member_skill' . intval( $ctr + 1 ), sanitize_text_field( $title ) );

            // Don't save the rating if they haven't set a title for the skill
            if( !empty( $title ) ) {
                update_post_meta( $post_id, 'team_member_skill_value' . intval( $ctr + 1 ), sanitize_skill_rating( $rating ) );
            }

        }

    }

}

add_action( 'save_post_team_member', 'ots_pro\save_skills_meta_box' );


/**
 * Save the member's tags meta box.
 *
 * @param $post_id
 * @since 4.0.0
 */
function save_tags_meta_box( $post_id ) {

    if( isset( $_POST['tags_meta_box_nonce'] ) &&
        wp_verify_nonce( $_POST['tags_meta_box_nonce'], 'tags_meta_box' ) ) {

        update_post_meta( $post_id, 'team_member_tags_bool', isset( $_POST['team_member_tags_bool'] ) ? 'on' : '' );
        update_post_meta( $post_id, 'team_member_tags_title', sanitize_text_field( $_POST['team_member_tags_title'] ) );
        update_post_meta( $post_id, 'team_member_quote', sanitize_text_field( $_POST['team_member_quote'] ) );
        update_post_meta( $post_id, 'team_member_tags', sanitize_textarea_field( $_POST['team_member_tags'] ) );

    }

}

add_action( 'save_post_team_member', 'ots_pro\save_tags_meta_box' );
