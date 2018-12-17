<?php

namespace ots_pro;


/**
 * Sanitize a member's skill rating.
 *
 * @param $value
 * @param string $default
 * @return string
 * @since 4.0.0
 */
function sanitize_skill_rating( $value, $default = '' ) {

    if( ( int ) $value < 0 || ( int ) $value > 10 ) {
        return $default;
    }

    return $value;

}


/**
 * Sanitize the social icon style.
 *
 * @param $value
 * @return string
 * @since 4.0.0
 */
function sanitize_social_icon_style( $value ) {

    $styles = array(
        'round',
        'flat'
    );

    if( !in_array( $value, $styles ) ) {
        return get_option( Options::SOCIAL_ICON_STYLE );
    }

    return $value;

}


/**
 * Sanitize the member's avatar image style.
 *
 * @param $value
 * @return string
 * @since 4.0.0
 */
function sanitize_image_style( $value ) {

    $styles = array(
        'square',
        'circle'
    );

    if( !in_array( $value, $styles ) ) {
        return get_option( Options::SINGLE_IMAGE_STYLE );
    }

    return $value;

}

/**
 * Get the list of available templates.
 *
 * @return array
 * @since 4.0.0
 */
function get_templates() {

    $templates = array(
        'grid2'     => __( 'Grid - Boxes 2', 'ots-pro' ),
        'grid3'     => __( 'Grid - Boxes 3', 'ots-pro' ),
        'directory' => __( 'Staff Directory', 'ots-pro' ),
        'stacked'   => __( 'Stacked List', 'ots-pro' ),
        'hc'        => __( 'Honeycombs', 'ots-pro' ),
        'carousel'  => __( 'Carousel', 'ots-pro' ),
//        'drawer'    => __( 'Drawer', 'ots-pro' )
    );

    return $templates;

}


/**
 * Get a list of available single templates.
 *
 * @return array
 * @since 4.0.0
 */
function get_single_templates() {

    $templates = array(
        'custom'  => __( 'Custom Template', 'ots-pro' ),
        'sidebar' => __( 'Single with a Sidebar', 'ots-pro' ),
    );

    return array_merge( $templates, get_inline_templates() );

}


function get_inline_templates() {

	$templates = array(
		'panel'   => __( 'Side Panel', 'ots-pro' ),
		'vcard'   => __( 'Popup Card', 'ots-pro' )
	);


	return $templates;

}


/**
 * Map a template slug to its new file name.
 *
 * @param $slug
 * @return mixed The file name if found, else the slug.
 * @since 4.0.0
 */
function map_template( $slug ) {

    $templates = array(
        'grid2'     => 'grid-2.php',
        'grid3'     => 'grid-3.php',
        'directory' => 'staff-directory.php',
        'stacked'   => 'stacked-list.php',
        'hc'        => 'honeycombs.php',
        'sidebar'   => 'single-sidebar.php',
        'panel'     => 'inline-panel.php',
        'vcard'     => 'inline-card.php'
    );



    if( array_key_exists( $slug, $templates ) ) {
	    $slug = $templates[ $slug ];
    }

    return $slug;

}
