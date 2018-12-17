<?php
/*
 * Plugin Name: Our Team Showcase Pro
 * Plugin URI: https://smartcatdesign.net/downloads/our-team-showcase/
 * Description: Pro version of Our Team Showcase
 * Version: 4.4.2
 * Author: Smartcat
 * Author URI: https://smartcatdesign.net
 * License: GPL2
 * 
 * 
 * Copyright 2018 Smartcat Solutions Inc
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 */

namespace ots_pro;


/**
 * Include constants and option definitions
 */
include_once dirname( __FILE__ ) . '/constants.php';
include_once dirname( __FILE__ ) . '/includes/tgm-plugin-activation.php';


/**
 * Load plugin text domain.
 *
 * @since 4.0.0
 */
function load_text_domain() {

    load_plugin_textdomain( 'ots-pro', false, dirname( plugin_basename( __FILE__ ) ) );

}

add_action( 'plugins_loaded', 'ots_pro\load_text_domain' );


/**
 * Register the licence with the License Manager.
 *
 * @param \SC_License_Manager $license_manager
 * @since 4.0.0
 */
function register_license( $license_manager ) {

    $options = array(
        'license'    => Options::LICENSE_KEY,
        'status'     => Options::STATUS,
        'expiration' => Options::LICENSE_EXPIRATION
    );

    $edd_args = array(
        'version' 	=> VERSION,
        'item_name' => 'Our Team Showcase Pro',
        'author' 	=> 'Smartcat'
    );

    $license_manager->add_license( 'ots-pro', EDD_STORE_URL, __FILE__, $options, $edd_args );

}

add_action( 'ots_register_extensions', 'ots_pro\register_license' );


/**
 * Initializes plugin and pulls in required files.
 *
 * @since 4.0.0
 */
function init() {

	if ( function_exists( 'ots\init' ) ) {

		if ( get_option( Options::STATUS ) === 'valid' ) {

			include_once dirname( __FILE__ ) . '/includes/functions.php';
			include_once dirname( __FILE__ ) . '/includes/functions-search.php';
			include_once dirname( __FILE__ ) . '/includes/functions-admin.php';
			include_once dirname( __FILE__ ) . '/includes/helpers.php';
			include_once dirname( __FILE__ ) . '/includes/admin-settings.php';
			include_once dirname( __FILE__ ) . '/includes/team-member.php';
			include_once dirname( __FILE__ ) . '/includes/template.php';

			// Pull in the member portal plugin
			if ( get_option( Options::PORTAL_ENABLED ) == 'on' ) {
			    include_once dirname( __FILE__ ) . '/includes/member-portal/member-portal.php';
            }

			add_action( 'ots_enable_pro_preview', '__return_false' );


			do_action( 'ots_pro_loaded' );

		}

		include_once dirname( __FILE__ ) . '/upgrade.php';

	}

}

add_action( 'ots_loaded', 'ots_pro\init' );


/**
 * Register the newest version of the free plugin as a dependency.
 *
 * @since 4.0.0
 */
function require_plugins() {

    $plugins = array(

        array(
            'name'               => 'Our Team Showcase',
            'slug'               => 'our-team-enhanced',
            'is_callable'        => 'ots\init',
            'required'           => true,
            'version'            => '4.0.0',
            'force_activation'   => true
        ),

    );

    $config = array(

        'id'           => 'ots-pro',
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'parent_slug'  => 'plugins.php',
        'capability'   => 'manage_options',
        'has_notices'  => true,
        'dismissable'  => false,
        'dismiss_msg'  => '',
        'is_automatic' => true,
        'message'      => '',
        'strings'      => array(
            'notice_can_install_required' => _n_noop(
                'Our Team Showcase Pro requires the following plugin: %1$s.',
                'Our Team Showcase Pro requires the following plugins: %1$s.',
                'ots-pro'
            ),
            'notice_ask_to_update' => _n_noop(
                'The following plugin needs to be updated to its latest version to ensure maximum compatibility with Our Team Showcase Pro: %1$s.',
                'The following plugins need to be updated to their latest version to ensure maximum compatibility with Our Team Showcase Pro: %1$s.',
                'ots-pro'
            ),
        )

    );

    tgmpa( $plugins, $config );

}

add_action( 'tgmpa_register', 'ots_pro\require_plugins' );



/**
 * Preforms activation routine.
 *
 * @since 4.0.0
 */
function activate() {

    init();

}

register_activation_hook( __FILE__, 'ots_pro\activate' );


/**
 * Preforms plugin deactivation.
 *
 * @since 4.0.0
 */
function deactivate() {

    init();

}

register_deactivation_hook( __FILE__, 'ots_pro\deactivate' );


/**
 * Enqueue plugin scripts and styles.
 *
 * @since 4.0.0
 */
function register_scripts() {

    wp_enqueue_style( 'ots-pro-common', asset( 'css/common.css' ), null, VERSION );

    wp_register_style( 'ots-pro-team-view', asset( 'css/team-view.css' ), null, VERSION );
    wp_register_style( 'ots-pro-single',    asset( 'css/single.css' ),    null, VERSION );
    wp_register_style( 'ots-pro-custom',    asset( 'css/custom.css' ),    null, VERSION );
    wp_register_style( 'ots-pro-inline',    asset( 'css/inline.css' ),    null, VERSION );


    // libs
	wp_register_script( 'datatables', asset( 'lib/datatables/datatables.min.js' ), array( 'jquery' ), VERSION );

	wp_register_style(  'datatables', asset( 'lib/datatables/datatables.min.css' ), null, VERSION );

	wp_register_script( 'owl-carousel', asset( 'lib/carousel.min.js' ), array( 'jquery' ), VERSION );
	wp_register_script( 'honeycombs',   asset( 'lib/honeycombs.js' ),   array( 'jquery' ), VERSION );
	wp_register_script( 'scroll',       asset( 'lib/scroll.min.js' ),   array( 'jquery' ), VERSION );


	// Main script
	wp_register_script( 'ots-pro', asset( 'js/script.js' ), array( 'jquery', 'jquery-masonry' ), VERSION );

}

add_action( 'init', 'ots_pro\register_scripts' );


/**
 * Get the URL of an asset from the assets folder.
 *
 * @param string $path
 * @return string
 * @since 4.0.0
 */
function asset( $path = '', $url = true ) {

    if( $url ) {
        $file = trailingslashit( plugin_dir_url( __FILE__ ) );
    } else {
        $file =  trailingslashit( plugin_dir_path( __FILE__ ) );
    }

    return $file . 'assets/' . ltrim( $path, '/' );

}


/**
 * Add action links to plugins page.
 *
 * @param $links
 * @return array
 * @since 4.0.0
 */
function plugin_action_links( $links ) {

    $settings = array( 'license' => '<a href="' . menu_page_url( 'ots-licenses', false ) . '">' . __( 'License', 'ots' ) . '</a>' );

    return array_merge( $settings, $links );

}

add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'ots_pro\plugin_action_links' );


/**
 * Get the path of a template.
 *
 * @param $template
 * @return bool|string
 *
 * @since 4.0.0
 */
function template_path( $template ) {

    $template = ltrim( $template, '/' );
    $template = rtrim( $template, '.php' );

    $file = trailingslashit( dirname( __FILE__ ) . '/templates' ) . $template . '.php';

    // Check if override exists in the theme first
    if( file_exists( \ots\get_theme_override( $template . '.php' ) ) ) {
        return \ots\get_theme_override( $template . '.php' );
    }
    
    if( file_exists( $file ) ) {
        return $file;
    }
    
    return false;

}

/**
 * 
 * @since 4.2.0
 * 
 */
function remove_addons_pages() {
    remove_submenu_page( 'edit.php?post_type=team_member', 'ots-add-ons' );
}

add_action( 'ots_loaded', function() {
    add_action( 'admin_menu', 'ots_pro\remove_addons_pages' );
});
