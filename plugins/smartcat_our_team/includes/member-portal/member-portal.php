<?php

namespace ots_pro\portal;


// Pull in constants
include_once dirname( __FILE__ ) . '/constants.php';


class MemberPortal {


    private static $instance;


    public static function instance() {

        if ( is_null( self::$instance ) ) {

            self::$instance = new self();

            // Run setup
            self::$instance->do_defines();
            self::$instance->include_modules();


            // All done
            do_action( 'ots_portal_loaded', self::$instance );

        }

        return self::$instance;

    }


    private function include_modules() {

        include_once dirname( __FILE__ ) . '/includes/class-session.php';
        include_once dirname( __FILE__ ) . '/includes/class-comment.php';
        include_once dirname( __FILE__ ) . '/includes/class-bootstrap-nav-walker.php';
        include_once dirname( __FILE__ ) . '/includes/admin-settings.php';
        include_once dirname( __FILE__ ) . '/includes/admin-ajax.php';
        include_once dirname( __FILE__ ) . '/includes/admin-post.php';
        include_once dirname( __FILE__ ) . '/includes/post.php';
        include_once dirname( __FILE__ ) . '/includes/auth.php';
        include_once dirname( __FILE__ ) . '/includes/functions.php';
        include_once dirname( __FILE__ ) . '/includes/helpers.php';
        include_once dirname( __FILE__ ) . '/includes/template.php';
        include_once dirname( __FILE__ ) . '/includes/team-member.php';
        include_once dirname( __FILE__ ) . '/includes/email-notifications.php';
        include_once dirname( __FILE__ ) . '/includes/custom-tables.php';
        include_once dirname( __FILE__ ) . '/includes/comment.php';
        include_once dirname( __FILE__ ) . '/includes/functions-cpts.php';
        include_once dirname( __FILE__ ) . '/upgrade.php';

    }


    private function do_defines() {

        define( 'OTS_PORTAL_PATH', trailingslashit( resolve_path() ) );
        define( 'OTS_PORTAL_URL', trailingslashit( resolve_url() ) );
        define( 'OTS_PORTAL_ASSETS_URL', trailingslashit( resolve_url( 'assets' ) ) );
        define( 'OTS_PORTAL_TEMPLATES_DIR', trailingslashit( resolve_path( 'templates' ) ) );
        define( 'OTS_PORTAL_PARTIALS_DIR', trailingslashit( resolve_path( 'templates/partials' ) ) );

    }


}


function member_portal() {

    return MemberPortal::instance();

}

add_action( 'ots_pro_loaded', 'ots_pro\portal\member_portal' );


function enqueue_admin_scripts() {

    wp_enqueue_media();
    wp_enqueue_script( 'wp-media-uploader', resolve_url( 'assets/lib/wp-media-uploader.js' ), array( 'jquery' ), VERSION );

    $i10n = array(
        'media_uploader_title'  => __( 'Select or upload image', 'ots-pro' ),
        'media_uploader_button' => __( 'Set image', 'ots-pro' ),
        'media_upload_button'   => __( 'Upload image', 'ots-pro' ),
        'pw_show'               => __( 'Show', 'ots-pro' ),
        'pw_hide'               => __( 'Hide', 'ots-pro' ),

        // Other Vars
        'ajax_url'              => admin_url( 'admin-ajax.php' ),
        'ajax_nonce'            => wp_create_nonce( 'ots_portal_ajax' )
    );

    wp_register_script( 'ots-portal', resolve_url( 'assets/admin/admin.js' ), array( 'jquery' ), VERSION );
    wp_localize_script( 'ots-portal', 'ots_portal_i10n', $i10n );

    wp_enqueue_script( 'ots-portal' );

    wp_enqueue_style( 'ots-portal', resolve_url( 'assets/admin/admin.css' ), null, VERSION );

}

add_action( 'admin_enqueue_scripts', 'ots_pro\portal\enqueue_admin_scripts' );


function resolve_url( $path = '' ) {

    return trailingslashit( plugin_dir_url( __FILE__ ) ) . ltrim( $path, '/' );

}


function resolve_path( $path = '' ) {

    return trailingslashit( plugin_dir_path( __FILE__ ) ) . ltrim( $path, '/' );

}
