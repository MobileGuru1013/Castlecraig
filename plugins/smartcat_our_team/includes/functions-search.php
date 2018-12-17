<?php
/**
 * 
 * Handles the Search functionality
 * 
 * @since 4.3.0
 */
namespace ots_pro;

add_action( 'ots_before_team_members', 'ots_pro\output_team_filter' );

add_action( 'ots_before_team_members', 'ots_pro\output_team_search' );

add_filter( 'ots_default_shortcode_atts', 'ots_pro\edit_shortcode_defaults', 10, 1 );


/**
 * 
 * Render the search bar
 * 
 * @since 4.3.0
 * @param Array $args
 */
function output_team_search( $args ) {
    
    if( $args['template'] == 'directory' || $args['template'] == 'carousel' || $args['template'] == 'hc' ) {
        return;
    }
    
    if( isset( $args['show_search'] ) ) {
        
        if( is_search_enabled( $args[ 'show_search' ] ) ) {
            include( template_path( 'search-bar' ) );
        }else {
            return;
        }
        
    }elseif( is_search_enabled( get_option( Options::SEARCH_TOGGLE ) ) ) {
        include( template_path( 'search-bar' ) );
    }else{
        return;
    }
    
    
}

/**
 * 
 * Render the filter
 * 
 * @since 4.3.0
 * @param Array $args
 */
function output_team_filter( $args ) {
    
    if( $args['template'] == 'directory' || $args['template'] == 'carousel' || $args['template'] == 'hc' ) {
        return;
    }
    
    if( isset( $args['show_filter'] ) ) {
        
        if( is_search_enabled( $args[ 'show_filter' ] ) ) {
            include( template_path( 'filter-bar' ) );
        }else {
            return;
        }
        
    }elseif( is_search_enabled( get_option( Options::FILTER_TOGGLE ) ) ) {
        include( template_path( 'filter-bar' ) );
    }else{
        return;
    }
    
    
}

/**
 * 
 * Add a shortcode parameter allowing user to toggle search
 * 
 * @action 
 * @since 4.3.0
 * @param Array $defaults
 * @return Array
 */
function edit_shortcode_defaults( $defaults ) {
    
    $defaults['show_search'] = get_option( Options::SEARCH_TOGGLE );
    $defaults['show_filter'] = get_option( Options::FILTER_TOGGLE );
    
    return $defaults;
    
}

/**
 * 
 * Check if the user requested search to be enabled
 * 
 * @since 4.3.0
 * @return boolean True if Search is enabled
 */
function is_search_enabled( $val ) {
    
    if( $val == 'on' || $val == 'true' || $val == 1 ) {
        return true;
    }
    
    return false;
    
}

