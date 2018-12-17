<?php

namespace ots_pro\portal;


function get_member( $member = null ) {

    // Try and get the current member
    if ( empty( $member ) ) {
        $member = Session::logged_in_user();

    // If we don't already have a team member / Prevent trying the global $post
    } else if ( !empty( $member ) && !is_a( $member, 'ots\TeamMember' ) ) {
        $member = \ots\team_member( $member );
    }

    return $member;

}


function set_member_status( $member = null , $status ) {

    $member = get_member( $member );

    if ( $member && in_array( $status, array( 'active', 'inactive' ) ) ) {

        $old = $member->status;

        if ( $member->set_metadata( 'status', $status ) ) {

            do_action( 'ots_team_member_status_updated', $member, $status, $old );

            return true;

        }

    }

    return false;

}


function first_time_activation( $member, $status ) {

    if ( $status == 'active' && !$member->activated ) {

        $pw = wp_generate_password( 24 );

        if ( update_user_pw( $member, $pw ) ) {

            $replace = array(
                'username' => $member->email,
                'password' => $pw
            );

            // Send welcome email
            send_welcome_email( $member, $replace );

            // Set previously activated status
            $member->activated = true;

        }

    }

}

add_action( 'ots_team_member_status_updated', 'ots_pro\portal\first_time_activation', 10, 2 );


function get_members_by_status( $status = '', $limit = -1 ) {

    $args = array(
        'post_type'      => 'team_member',
        'posts_per_page' => $limit,
        'post_status'    => 'publish'
    );

    if ( !empty( $status ) ) {

        if ( $status == 'active' ) {

            $args['meta_query'][] = array(
                'key'   => 'team_member_status',
                'value' => 'active'
            );

        } else {

            $args['meta_query'] = array(
                'relation' => 'OR',
                array(
                    'key'   => 'team_member_status',
                    'value' => 'inactive'
                ),
                array(
                    'key'     => 'team_member_status',
                    'compare' => 'NOT EXISTS'
                )
            );

        }

    }

    return new \WP_Query( $args );

}


function get_member_by_login( $login ) {

    $args = array(
        'post_type'      => 'team_member',
        'posts_per_page' => 1,
        'post_status'    => 'publish',
        'meta_query'     => array(
            array(
                'key'   => 'team_member_email',
                'value' => $login
            )
        )
    );

    $q = new \WP_Query( $args );

    if ( $q->have_posts() ) {
        return get_member( $q->post );
    }

    return false;

}


function add_team_member_custom_columns( $columns ) {

    $right = array_slice( $columns, 0, 2 );

    $custom = array(
        'portal_status' => __( 'Portal Status', 'ots-pro' )
    );

    return array_merge( $right, $custom, $columns );

}

add_filter( 'manage_edit-team_member_columns', 'ots_pro\portal\add_team_member_custom_columns' );


function set_team_member_sortable_columns( $columns ) {

    $sortable = array(
        'portal_status' => array( 'status', true )
    );

    return array_merge( $columns, $sortable );

}

add_filter( 'manage_edit-team_member_sortable_columns', 'ots_pro\portal\set_team_member_sortable_columns' );


function do_team_member_custom_columns( $column, $post_id ) {

    switch ( $column ) {

        case 'portal_status':

            $status = get_post_meta( $post_id, 'team_member_status', true );

            printf(
                '<span class="stp-status %s"></span> %s',
                $status,
                $status == 'active' ? __( 'Active', 'ots-pro' ) : __( 'Inactive', 'ots-pro' )
            );

            break;

    }

}

add_action( 'manage_team_member_posts_custom_column', 'ots_pro\portal\do_team_member_custom_columns', 10, 2 );


function add_team_member_meta_boxes() {

    add_meta_box(
        'team-member-portal',
        __( 'Member Portal', 'ots-pro' ),
        'ots_pro\portal\member_portal_meta_box',
        null,
        'normal',
        'high'
    );

}

add_action( 'add_meta_boxes_team_member', 'ots_pro\portal\add_team_member_meta_boxes' );


function save_member_portal_metabox( $post_id ) {

    if ( isset( $_POST['portal_meta_box_nonce'] ) &&
         wp_verify_nonce( $_POST['portal_meta_box_nonce'], 'save_portal_meta_box' ) ) {

        if ( !empty( $_POST['password'] ) && !empty( $_POST['password-text'] ) &&
             !empty( $_POST['password'] ) == !empty( $_POST['password-text'] ) ) {

            update_user_pw( $post_id, sanitize_text_field( $_POST['password'] ) );

        }

        update_post_meta( $post_id, 'team_member_status', sanitize_member_status( $_POST['team_member_status'] ) );

    }

}

add_action( 'save_post', 'ots_pro\portal\save_member_portal_metabox' );


function member_portal_meta_box( \WP_Post $post ) { ?>

    <?php wp_nonce_field( 'save_portal_meta_box', 'portal_meta_box_nonce' ); ?>

    <?php $member = \ots\team_member( $post ); ?>

    <table id="ots-portal-meta-box" class="ots-meta-box widefat">

        <tr>
            <th>
                <label for="ots-portal-active"><?php _e( 'Portal Access', 'ots-pro' ); ?></label>
            </th>
            <td>
                <input name="team_member_status"
                       value="inactive"
                       type="hidden" />

                <div class="ots-toggle">
                    <label class="switch">
                        <input id="ots-portal-active"
                               name="team_member_status"
                               value="active"
                               type="checkbox" <?php checked( $member->status, 'active' ); ?>  />
                        <span class="slider round"></span>
                    </label>

                    <?php _e( 'Portal login active', 'ots-pro' ); ?>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label><?php _e( 'Member Login', 'ots-pro' ); ?></label>
            </th>
            <td>
                <input readonly class="regular-text" value="<?php esc_attr_e( $member->email ); ?>">
            </td>
        </tr>
        <tr>
            <th>
                <label><?php _e( 'New Password', 'ots-pro' ); ?></label>
            </th>
            <td>
                <button type="button" class="button ots-generate-pw hide-if-no-js">
                    <?php _e( 'Generate Password', 'ots-pro' ); ?>
                </button>
                <div class="ots-pwd hide-if-js">
                    <span class="password-input-wrapper">

                        <input type="password"
                               name="password"
                               id="password"
                               class="regular-text"
                               value=""
                               autocomplete="off"
                               style="display: none"
                               data-pw="<?php echo esc_attr( wp_generate_password( 24 ) ); ?>" />

                        <input type="text"
                               id="password-text"
                               name="password-text"
                               autocomplete="off"
                               class="regular-text strong" />

                    </span>
                    <button type="button" class="button ots-hide-pw hide-if-no-js" data-toggle="0">
                        <span class="dashicons dashicons-hidden"></span>
                        <span class="text"><?php _e( 'Hide', 'ots-pro' ); ?></span>
                    </button>
                    <button type="button" class="button ots-cancel-pw hide-if-no-js" data-toggle="0">
                        <span class="text"><?php _e( 'Cancel', 'ots-pro' ); ?></span>
                    </button>
                </div>
            </td>
        </tr>

    </table>

<?php }
