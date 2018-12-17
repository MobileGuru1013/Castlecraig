<?php
/**
 * Functions & hooks for WP admin
 * 
 * @since 4.3.0
 */
namespace ots_pro;

add_action( 'admin_menu', 'ots_pro\create_admin_landing_page' );



/**
 * 
 * @action admin_menu
 * @since 4.3.0
 */
function create_admin_landing_page() {
    add_submenu_page( null, __( 'Our Team Showcase - Intro', 'ots' ), __( 'Our Team Showcase - Intro', 'ots' ), 'manage_options', 'ots-tutorial', function() {
        
        include( template_path( 'tutorial' ) );
        
    } );
    
}