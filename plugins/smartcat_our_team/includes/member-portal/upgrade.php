<?php

namespace ots_pro\portal;


function do_install() {

    // Don't run the installer if we're migrating options
    if ( !get_option( 'stp_options', false ) ) {

        $pages = array(

            Options::PORTAL_PAGE => array(
                'is_parent' => true,
                'data'      => array(
                    'post_title'  => __( 'Member Portal', 'ots-pro' ),
                    'post_status' => 'publish',
                    'post_type'   => 'page'
                ),
            ),

            Options::PROFILE_PAGE => array(
                'data' => array(
                    'post_title'  => __( 'Profile', 'ots-pro' ),
                    'post_status' => 'publish',
                    'post_type'   => 'page'
                )
            ),

            Options::LOGIN_PAGE => array(
                'data' => array(
                    'post_title'  => __( 'Login', 'ots-pro' ),
                    'post_status' => 'publish',
                    'post_type'   => 'page'
                )
            ),

            Options::LOGOUT_PAGE => array(
                'data' => array(
                    'post_title'  => __( 'Logout', 'ots-pro' ),
                    'post_status' => 'publish',
                    'post_type'   => 'page'
                )
            )

        );

        $parent_id = 0;

        foreach ( $pages as $option => $post_data ) {

            $page = get_post( get_option( $option, 0 ) );

            if ( !$page ) {

                if ( empty( $post_data['is_parent'] ) ) {
                    $post_data['data']['post_parent'] = $parent_id;
                }

                $id = wp_insert_post( $post_data['data'] );

                if ( is_numeric( $id ) ) {

                    if ( ! empty( $post_data['is_parent'] ) ) {
                        $parent_id = $id;
                    }

                    update_option( $option, $id );
                }

            } else if ( $page->post_status == 'trash' ) {
                wp_untrash_post( $page->ID );
            }

        }


        $redirects = array(
            Options::LOGIN_REDIRECT        => Options::PORTAL_PAGE,
            Options::WRONG_GROUP_REDIRECT  => Options::PORTAL_PAGE,
            Options::UNAUTHORIZED_REDIRECT => Options::LOGIN_PAGE
        );

        foreach ( $redirects as $redirect => $page ) {

            $redirect_page = get_post( get_option( $redirect, 0 ) );

            if ( ! $redirect_page ) {
                update_option( $redirect, get_post( get_option( $page ) )->ID );
            } else if ( $redirect_page->post_status == 'trash' ) {
                wp_untrash_post( $redirect_page->ID );
            }

        }

    } else {

        // Run the first update script
        upgrade_200();

    }

}

add_action( 'ots_portal_activated', 'ots_pro\portal\do_install' );


function upgrade_200() {

    $old_options = get_option( 'stp_options' );

    if ( $old_options && get_option( Options::PLUGIN_VERSION, 0 ) < '2.0.0' ) {

        $options_map = array(
            'page_login'            => Options::LOGIN_PAGE,
            'page_portal'           => Options::PORTAL_PAGE,
            'page_profile'          => Options::PROFILE_PAGE,
            'page_logout'           => Options::LOGOUT_PAGE,
            'redirect_login'        => Options::LOGIN_REDIRECT,
            'redirect_noaccess'     => Options::WRONG_GROUP_REDIRECT,
            'redirect_unauthorized' => Options::UNAUTHORIZED_REDIRECT,
            'logo'                  => Options::PORTAL_LOGO,
            'email_from_name'       => Options::OUTGOING_EMAIL_NAME,
            'email_from_address'    => Options::OUTGOING_EMAIL_ADDRESS,
            'email_welcome'         => Options::WELCOME_EMAIL,
            'email_reset'           => Options::PASSWORD_RESET_EMAIL,
            'welcome_message'       => Options::WELCOME_MESSAGE
        );

        foreach ( $options_map as $old => $new ) {
            update_option( $new, $old_options[ $old ] );
        }

        update_option( Options::PLUGIN_VERSION, VERSION );


        // Deactivate the old plugin
        if ( !function_exists( 'get_plugins' ) ) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        $old_portal = get_plugins();

        if ( !empty( $old_portal['smartcat_our_team_portal/portal.php'] ) ) {
            deactivate_plugins( 'smartcat_our_team_portal/portal.php', true );
        }

        delete_option( 'stp_options' );

    }

}

add_action( 'admin_init', 'ots_pro\portal\upgrade_200' );
