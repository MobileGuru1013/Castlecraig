<?php

namespace ots_pro;

if( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die;
}


global $wpdb;


include_once dirname( __FILE__ ) . '/constants.php';
include_once dirname( __FILE__ ) . '/includes/member-portal/constants.php';


/**
 * Erase the plugin's options
 *
 * @since 4.0.0
 */

if ( get_option( Options::NUKE ) == 'on' ) {

	$options = new \ReflectionClass( '\ots_pro\Options' );
	$portal  = new \ReflectionClass( '\ots_pro\portal\Options' );

	foreach( array_merge( $options->getConstants(), $portal->getConstants() ) as $option ) {
		delete_option( $option );
	}


    $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}team_post_likes" );
    $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}team_post_views" );
    $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}team_comments" );

}
