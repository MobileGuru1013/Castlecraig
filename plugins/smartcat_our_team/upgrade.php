<?php

namespace ots_pro;


/**
 * Migrate the plugin's settings
 *
 * @since 4.0.0
 */
function upgrade_400() {

    if( get_option( Options::STATUS ) === 'valid' && get_option( Options::PLUGIN_VERSION, 0 ) < '4.0.0' ) {

        // Pull in for extra templates
        include_once dirname( __FILE__ ) . '/includes/functions.php';
        include_once dirname( __FILE__ ) . '/includes/admin-settings.php';


        // Migrate post meta
        $posts = get_posts(
        	array(
        		'post_type'      => 'team_member',
		        'posts_per_page' => -1
	        )
        );

        foreach( $posts as $post ) {

            // Fix a typo in one of the meta keys
            update_post_meta( $post->ID, 'team_member_quote', get_post_meta( $post->ID, 'team_member_qoute', true ) );

        }

        // Migrate settings
        $options = get_option( 'smartcat_team_options' );

        if( $options ) {

            $map = array(
                'name_font_size'        => Options::NAME_FONT_SIZE,
                'title_font_size'       => Options::JOB_TITLE_FONT_SIZE,
                'card_margin'           => Options::CARD_MARGIN_TOP,
                'panel_margin'          => Options::PANEL_MARGIN_TOP,
                'word_count'            => Options::MAX_WORD_COUNT,
                'carousel_play'         => Options::CAROUSEL_SPEED,
                'social_link_style'     => Options::SOCIAL_ICON_STYLE,
                'directory_phone'       => Options::DIRECTORY_PHONE_LABEL,
                'directory_title'       => Options::DIRECTORY_JOB_TITLE_LABEL,
                'directory_group'       => Options::DIRECTORY_GROUP_LABEL,
                'directory_search'      => Options::DIRECTORY_SEARCH_LABEL,
                'single_image_style'    => Options::SINGLE_IMAGE_STYLE,
                'template'              => \ots\Options::TEMPLATE,
                'single_template'       => \ots\Options::SINGLE_TEMPLATE
            );

            foreach ( $map as $old => $new ) {
                update_option( $new, $options[ $old ] );
            }


            $booleans = array(
                'directory_title_bool'   => Options::DISPLAY_DIRECTORY_JOB_TITLE,
                'directory_phone_bool'   => Options::DISPLAY_DIRECTORY_PHONE,
                'directory_group_bool'   => Options::DISPLAY_DIRECTORY_GROUP,
                'directory_search_bool'  => Options::DISPLAY_DIRECTORY_SEARCH,
                'directory_sort_bool'    => Options::SORT_DIRECTORY_ALPHABETICALLY
            );

            foreach( $booleans as $old => $new ) {
                update_option( $new, $options[ $old ] == 1 || $options[ $old ] === 'yes' ? 'on' : '' );
            }

            // Migrate honeycomb color
            update_option( Options::HONEYCOMB_COLOR, '#' . $options['honeycomb_color'] );

        }

        update_option( Options::PLUGIN_VERSION, VERSION );

    }

}


add_action( 'admin_init', 'ots_pro\upgrade_400' );


function upgrade_420() {

    // Add the default portal toggle
    add_option( Options::PORTAL_ENABLED, Defaults::PORTAL_ENABLED );

}

add_action( 'admin_init', 'ots_pro\upgrade_420' );


function upgrade_430() {
    
    if( get_option( Options::STATUS ) === 'valid' && get_option( Options::PLUGIN_VERSION, 0 ) < '4.3.0' ) {
        
        
        update_option( Options::PLUGIN_VERSION, VERSION );
        
        wp_safe_redirect( admin_url( 'admin.php?page=ots-tutorial' ) );
        
    }
    
}

add_action( 'admin_init', 'ots_pro\upgrade_430' );