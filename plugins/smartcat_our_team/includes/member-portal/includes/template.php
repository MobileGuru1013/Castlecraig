<?php

namespace ots_pro\portal;


function is_portal_page() {

    return get_the_ID() == get_option( Options::PORTAL_PAGE );

}


function is_edit_profile_page() {

    return get_the_ID() == get_option( Options::PROFILE_PAGE );

}


function is_login_page() {

    return get_the_ID() == get_option( Options::LOGIN_PAGE );

}


function is_logout_page() {

    return get_the_ID() == get_option( Options::LOGOUT_PAGE );

}


function is_profile_page() {

    return get_post_type() == 'team_member';

}


function get_template( $name, $args = array(), $include = true, $once = true ) {

    $tmpl = false;
    $name = rtrim( $name, '.php' ) . '.php';

    if ( file_exists( OTS_PORTAL_TEMPLATES_DIR . $name ) ) {
        $tmpl = OTS_PORTAL_TEMPLATES_DIR . $name;
    } else if ( file_exists( OTS_PORTAL_PARTIALS_DIR . $name ) ) {
        $tmpl = OTS_PORTAL_PARTIALS_DIR . $name;
    }

    if ( $tmpl && $include ) {

        if ( is_array( $args ) ) {
            extract( $args );
        }

        if ( $once ) {
            include_once $tmpl;
        } else {
            include $tmpl;
        }
    }

    return $tmpl;

}


function buffer_template( $name, $args = array(), $once = true ) {

    ob_start();

    get_template( $name, $args, true, $once );

    return ob_get_clean();

}


function get_header( $args = array() ) {

    get_template( 'header', $args );

}


function get_footer( $args = array() ) {

    get_template( 'footer', $args );

}


function include_portal_template( $template ) {

    if ( is_login_page() ) {
        $template = get_template( 'login', null, false );
    } else if ( is_logout_page() ) {
        $template = get_template( 'logout', null, false );
    } else if ( is_portal_page() ) {
        $template = get_template( 'portal', null, false );
    } else if ( is_edit_profile_page() ) {
        $template = get_template( 'profile', null, false );
    } else if ( Session::is_authenticated() && is_profile_page() ) {
        $template = get_template( 'team-member', null, false );
    } else if ( is_edit_profile_page() ) {
        $template = get_template( 'profile', null, false );
    } else if ( is_single() && is_post_protected() ) {
        $template = get_template( 'post', null, false );
    } else if ( is_page() && is_post_protected() ) {
        $template = get_template( 'page', null, false );
    }

    return $template;

}

add_filter( 'template_include', 'ots_pro\portal\include_portal_template' );


function register_nav_menus() {

    register_nav_menu( 'portal_footer', __( 'Portal Footer Menu', 'ots-pro' ) );

}

add_action( 'after_setup_theme', 'ots_pro\portal\register_nav_menus' );
