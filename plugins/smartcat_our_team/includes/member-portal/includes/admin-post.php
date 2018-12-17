<?php

namespace ots_pro\portal;


function do_user_logout() {

    if ( verify_nonce( 'nonce', 'log_user_out' ) ) {
        log_user_out();
    }

}

add_action( 'admin_post_ots_portal_logout', 'ots_pro\portal\do_user_logout' );
add_action( 'admin_post_nopriv_ots_portal_logout', 'ots_pro\portal\do_user_logout' );


function do_update_password() {

   if ( verify_nonce( 'update_password_nonce', 'update_password' ) ) {

       $member   = get_member();
       $redirect = remove_query_arg( array( 'message', 'error' ), wp_get_referer() );

       $args = '';

       if ( !empty( $_POST['old_password'] ) &&
            wp_check_password( sanitize_text_field( $_POST['old_password'] ), $member->pw ) ) {

           if ( !empty( $_POST['password1'] ) &&
                !empty( $_POST['password2'] ) &&
                $_POST['password1'] === $_POST['password2'] ) {

               $pw = sanitize_text_field( $_POST['password1'] );

               if ( update_user_pw( $member, $pw ) ) {

                   // Destroy the old session to prevent hijacking
                   if ( Session::logout() && Session::authenticate( $member->email, $pw ) ) {

                       $args = array(
                           'message' => urlencode( __( 'Password updated', 'ots-pro' ) )
                       );

                   }

               }

           } else {

               $args = array(
                   'error' => urlencode( __( 'Passwords do not match', 'ots-pro' ) )
               );

           }

       } else {

           $args = array(
               'error' => urlencode( __( 'Please enter old password', 'ots-pro' ) )
           );

       }

       wp_safe_redirect( add_query_arg( $args, $redirect ) );

   }

}

add_action( 'admin_post_nopriv_ots_portal_update_pw', 'ots_pro\portal\do_update_password' );
add_action( 'admin_post_ots_portal_update_pw', 'ots_pro\portal\do_update_password' );


function do_update_profile() {

    if ( verify_nonce( 'update_profile_nonce', 'update_profile' ) ) {

        $member   = get_member();
        $redirect = remove_query_arg( array( 'message', 'error' ), wp_get_referer() );

        $args = '';

        if ( empty( $_POST['name'] ) ) {

            $args = array(
                'error' => urlencode( __( 'Name cannot be left blank', 'ots-pro' ) )
            );

        } else {

            $data = array(
                'ID'           => $member->get_id(),
                'post_title'   => sanitize_text_field( $_POST['name'] ),
                'post_content' => $_POST['bio'],
                'meta_input'   => array(
                    'team_member_email' => sanitize_email( $_POST['email'] ),
                    'team_member_phone' => sanitize_text_field( $_POST['phone'] ),
                    'team_member_title' => sanitize_text_field( $_POST['title'] )
                )
            );

            foreach ( $_POST['links'] as $link => $value ) {
                $data['meta_input']["team_member_$link"] = esc_url_raw( $value );
            }

            if ( wp_update_post( $data ) ) {

                $args = array(
                    'message' => urlencode( __( 'Profile updated', 'ots-pro' ) )
                );

            }

        }

        wp_safe_redirect( add_query_arg( $args, $redirect ) );

    }

}

add_action( 'admin_post_nopriv_ots_portal_update_profile', 'ots_pro\portal\do_update_profile' );
add_action( 'admin_post_ots_portal_update_profile', 'ots_pro\portal\do_update_profile' );


function do_avatar_update() {

    if ( verify_nonce( 'update_avatar_nonce', 'update_avatar' ) ) {

        $member   = get_member();
        $redirect = remove_query_arg( array( 'error', 'message' ), wp_get_referer() );

        $args = '';

        $allowed = array( 'image/jpg', 'image/jpeg', 'image/png' );

        if ( !empty( $_FILES['avatar'] ) || !in_array( $_FILES['avatar']['type'], $allowed ) ) {

            $id = media_handle_upload( 'avatar', 0 );

            if ( !is_wp_error( $id ) ) {

                set_post_thumbnail( $member->get_id(), $id );

                $args = array(
                    'message' => urlencode( __( 'Profile image changed', 'ots-pro' ) )
                );

            } else {

                $args = array(
                    'error' => urlencode( $id->get_error_message() )
                );

            }

        } else {

            $args = array(
                'error' => urlencode( __( 'Invalid file', 'ots-pro' ) )
            );

        }

        wp_safe_redirect( add_query_arg( $args, $redirect ) );

    }

}

add_action( 'admin_post_nopriv_ots_portal_update_avatar', 'ots_pro\portal\do_avatar_update' );
add_action( 'admin_post_ots_portal_update_avatar', 'ots_pro\portal\do_avatar_update' );


function do_cover_photo_update() {

    if ( verify_nonce( 'update_cover_photo_nonce', 'update_cover_photo' ) ) {

        $member   = get_member();
        $redirect = remove_query_arg( array( 'error', 'message' ), wp_get_referer() );

        $args = '';

        $allowed = array( 'image/jpg', 'image/jpeg', 'image/png' );

        if ( !empty( $_FILES['cover_photo'] ) || !in_array( $_FILES['cover_photo']['type'], $allowed ) ) {

            $id = media_handle_upload( 'cover_photo', 0 );

            if ( !is_wp_error( $id ) ) {

                $member->cover_photo = $id;

                $args = array(
                    'message' => urlencode( __( 'Cover photo changed', 'ots-pro' ) )
                );

            } else {

                $args = array(
                    'error' => urlencode( $id->get_error_message() )
                );

            }

        } else {

            $args = array(
                'error' => urlencode( __( 'Invalid file', 'ots-pro' ) )
            );

        }

        wp_safe_redirect( add_query_arg( $args, $redirect ) );

    }

}

add_action( 'admin_post_nopriv_ots_portal_update_cover_photo', 'ots_pro\portal\do_cover_photo_update' );
add_action( 'admin_post_ots_portal_update_cover_photo', 'ots_pro\portal\do_cover_photo_update' );


function do_remove_cover_photo() {

    if ( verify_nonce( 'nonce', 'remove_cover_photo' ) ) {

        get_member()->cover_photo = '';

        wp_safe_redirect( remove_query_arg( array( 'error', 'message' ), wp_get_referer() ) );

    }

}

add_action( 'admin_post_nopriv_ots_portal_remove_cover_photo', 'ots_pro\portal\do_remove_cover_photo' );
add_action( 'admin_post_ots_portal_remove_cover_photo', 'ots_pro\portal\do_remove_cover_photo' );


function do_reset_password() {

    if ( verify_nonce( 'reset_password_nonce', 'reset_password' ) ) {

        $args = '';
        $redirect = remove_query_arg( array( 'error', 'message' ), wp_get_referer() );

        if ( !empty( $_POST['login'] ) ) {

            $member = get_member_by_login( $_POST['login'] );

            if ( $member && $member->status == 'active' ) {

                $pw = wp_generate_password( 24 );

                if ( update_user_pw( $member, $pw ) ) {

                    $args = array(
                        'message' => urlencode( __( 'Your password has been reset', 'ots-pro' ) )
                    );

                    $replace = array(
                        'username' => $member->email,
                        'password' => $pw
                    );

                    send_password_reset_email( $member, $replace );

                }

            } else {

                $args = array(
                    'error' => urlencode( __( 'We could not find that user name', 'ots-pro' ) )
                );

            }

        } else {

            $args = array(
                'error' => urlencode( __( 'Username cannot be left blank', 'ots-pro' ) )
            );

        }

        wp_safe_redirect( add_query_arg( $args, $redirect ) );

    }

}

add_action( 'admin_post_nopriv_ots_portal_reset_pw', 'ots_pro\portal\do_reset_password' );
add_action( 'admin_post_ots_portal_reset_pw', 'ots_pro\portal\do_reset_password' );


function do_user_login() {

    if ( !Session::is_authenticated() ) {

        if ( verify_nonce( 'portal_login_nonce', 'portal_login' ) ) {

            $login = sanitize_text_field( $_POST['login'] );
            $pass  = sanitize_text_field( $_POST['pw'] );

            if ( Session::authenticate( $login, $pass ) ) {
                wp_safe_redirect( get_the_permalink( get_option( Options::LOGIN_REDIRECT ) ) );
            } else {

                $args = array(
                    'error' => urlencode( __( 'Invalid username or password', 'ots-pro' ) )
                );

                wp_safe_redirect( add_query_arg( $args, wp_get_referer() ) );
            }

        }

    } else {
        wp_safe_redirect( get_the_permalink( get_option( Options::PORTAL_PAGE ) ) );
    }

}

add_action( 'admin_post_nopriv_ots_portal_login', 'ots_pro\portal\do_user_login' );
add_action( 'admin_post_ots_portal_login', 'ots_pro\portal\do_user_login' );