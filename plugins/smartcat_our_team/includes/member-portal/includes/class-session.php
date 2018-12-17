<?php

namespace ots_pro\portal;


class Session {


    public static function is_authenticated() {

        if ( self::active_session() ) {
            return isset( $_SESSION['ots_portal']['auth'] );
        }

        return false;

    }


    public static function authenticate( $login, $pw ) {

        $member = get_member_by_login( $login );

        if ( $member && $member->status == 'active' ) {

            if ( wp_check_password( $pw, $member->pw ) ) {

                if ( self::active_session() ) {

                    $_SESSION['ots_portal']['auth'] = true;
                    $_SESSION['ots_portal']['uid']  = $member->get_id();

                    return $member;

                }

            }

        }

        return false;

    }


    public static function logged_in_user() {

        if ( self::active_session() ) {

            if ( isset( $_SESSION['ots_portal']['uid'] ) ) {
                return get_member( $_SESSION['ots_portal']['uid'] );
            }

        }

        return false;

    }


    public static function logout() {

        if ( self::active_session() ) {
            return self::destroy_session();
        }

        return false;

    }


    private static function active_session() {

        if ( session_status() == PHP_SESSION_NONE ) {
            return session_start();
        }

        return true;

    }


    private static function destroy_session() {

        if ( session_status() !== PHP_SESSION_NONE ) {
            return session_destroy();
        }

    }


}