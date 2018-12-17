<?php

namespace ots_pro;

/**
 * Enqueue scripts and styles when on a short-code page.
 *
 * @since 4.0.0
 */
function enqueue_team_view_scripts() {

	wp_enqueue_style( 'ots-pro-team-view' );
	wp_enqueue_style( 'ots-pro-single' );
	wp_enqueue_style( 'ots-pro-custom' );
	wp_enqueue_style( 'ots-pro-inline' );


	// libs
	wp_enqueue_script( 'datatables' );

	wp_enqueue_style(  'datatables' );

	wp_enqueue_script( 'owl-carousel' );
	wp_enqueue_script( 'honeycombs' );
	wp_enqueue_script( 'scroll' );


	$carousel_speed = get_option( Options::CAROUSEL_SPEED );

	// Main script
	$vars = array(
		'grid_columns'         => get_option( \ots\Options::GRID_COLUMNS ),
		'carousel_speed'       => !empty( $carousel_speed ) ? $carousel_speed : false,
		'sort_directory'       => get_option( Options::SORT_DIRECTORY_ALPHABETICALLY ) == 'on',
		'directory_search'     => get_option( Options::DISPLAY_DIRECTORY_SEARCH ) == 'on',
		'search_label'         => get_option( Options::DIRECTORY_SEARCH_LABEL ),
        'directory_pagination' => get_option( Options::DIRECTORY_PAGINATION ) == 'on',

        'string_dt_empty_table'   => get_option( Options::DT_EMPTY_TABLE ),
        'string_dt_zero_records'  => get_option( Options::DT_ZERO_RECORDS ),
        'string_dt_info'          => get_option( Options::DT_INFO ),
        'string_dt_info_filtered' => get_option( Options::DT_INFO_FILTERED ),
        'string_dt_info_empty'    => get_option( Options::DT_INFO_EMPTY ),
        'string_dt_length_menu'   => get_option( Options::DT_LENGTH_MENU ),
        'string_dt_paginate_next' => get_option( Options::DT_PAGINATE_NEXT ),
        'string_dt_paginate_prev' => get_option( Options::DT_PAGINATE_PREV ),
	);

	wp_localize_script( 'ots-pro', 'ots_pro', $vars );

	wp_enqueue_script( 'ots-pro' );

}

add_action( 'ots_enqueue_scripts', 'ots_pro\enqueue_team_view_scripts' );


/**
 * Include a group template from this plugin.
 *
 * @param $template
 * @return bool|string
 * @since 4.0.0
 */
function include_template( $template ) {

    $file = template_path( map_template( $template ) );

    if( $file ) {
        $template = $file;
    }

    return $template;

}

add_filter( 'ots_template_include', 'ots_pro\include_template', 1 );


/**
 * Override the theme's single template. If $single_template is set to custom, the theme root will be searched for a
 * template file called <code>team_members_template.php</code>, If that file is not found then the plugin's version will
 * be supplied as a default.
 *
 * @param $template
 * @return bool|string
 * @since 4.0.0
 */
function include_single_template( $template ) {

    if( is_single() && get_post_type() == 'team_member' ) {

        $single = map_template( get_option( \ots\Options::SINGLE_TEMPLATE ) );

        // If it's not an inline template and its not custom, then its single
        if( strpos( $single, 'inline' ) === false && $single != 'custom' ) {

            $file = template_path( $single );

            if ( $file ) {

                // If it belongs to this plugin assign it
                $template = $file;

                wp_enqueue_style( 'ots-pro-single' );

            }


            // If we're loading a custom template
        } else if ( $single == 'custom' ) {

            $file = get_stylesheet_directory() . '/team_members_template.php';

            if( file_exists( $file ) ) {

                $template = $file;

            } else {

                $template = template_path( 'team_members_template.php' );

            }

            wp_enqueue_style( 'ots-pro-custom' );

        }

    }

    return $template;

}

add_filter( 'template_include', 'ots_pro\include_single_template' );


function do_inline_member_data( $args ) {

	$template = template_path( map_template( $args['single_template'] ) );

	if( $template && strpos( $template, 'inline' ) !== false ) {

        // Print the inline data that matches this template in the footer
        add_action( 'wp_footer', function () use ( $template, $args ) {

            echo '<div class="inline-member-data" id="' . esc_attr( $args['guid'] ) . '">';

            while( $args['members']->have_posts() ) {

                $args['members']->the_post();

                include $template;

            }

            echo '</div>';

        } );

	}

}

add_action( 'ots_after_team_members', 'ots_pro\do_inline_member_data' );


/**
 * Print user configurable styles.
 *
 * @since 4.0.0
 */
function print_dynamic_styles() { ?>

    <!-- Global -->

    <style>

        #sc_our_team .sc_team_member_name {
            font-size: <?php echo esc_attr_e( get_option( Options::NAME_FONT_SIZE ) ); ?>px !important;
        }

        #sc_our_team .sc_team_member_jobtitle {
            font-size: <?php esc_attr_e( get_option( Options::JOB_TITLE_FONT_SIZE ) );?>px !important;
        }

        .sc_our_team_lightbox .name,
        .sc_personal_quote span.sc_team_icon-quote-left,
        .sc_team_single_member .sc_member_articles a,
        .sc-team-member-posts a {
            color: <?php esc_html_e( get_option( \ots\Options::MAIN_COLOR ) ); ?>;
        }

        #sc_team_sidebar_body .social span {
            background: <?php esc_html_e( get_option( \ots\Options::MAIN_COLOR ) ); ?>;
        }

        #sc_our_team_lightbox .progress,
        #sc_our_team_lightbox .social span,
        .sc_our_team_panel .sc-right-panel .sc-name,
        .sc_our_team_panel .sc-right-panel .sc-skills .progress,
        .sc_team_single_member .sc_single_side .social span,
        #sc_our_team .sc_team_member .icons span,
        .sc_team_single_member .sc_team_single_skills .progress,
        .sc-tags .sc-single-tag {
            background: <?php esc_html_e( get_option( \ots\Options::MAIN_COLOR ) ); ?>;
        }

        @media( min-width: 480px ) {

            #sc_our_team_lightbox .sc_our_team_lightbox {
                margin-top: <?php esc_html_e( get_option( Options::CARD_MARGIN_TOP ) ); ?>px !important;
            }

            #sc_our_team_panel .sc_our_team_panel {
                margin-top: <?php esc_html_e( get_option( Options::PANEL_MARGIN_TOP ) ); ?>px !important;
                padding-bottom: <?php esc_html_e( get_option( Options::PANEL_MARGIN_TOP ) ); ?>px !important;
            }

        }

    </style>

    <!-- Carousel -->

    <style>

        .carousel .sc_team_member {
            margin: <?php esc_attr_e( get_option( \ots\Options::MARGIN ) ); ?>px;
        }

    </style>

    <!-- Grid Boxes 2 -->

    <style>

        .grid2 .sc_team_member .sc_team_member_jobtitle,
        .grid2 .sc_team_member_inner .image-container i.icon:hover {
            color: <?php esc_html_e( get_option( \ots\Options::MAIN_COLOR ) ); ?>;
        }

        .grid2 .sc_team_member_inner .image-container {
            border-bottom: 20px solid <?php esc_html_e( get_option( \ots\Options::MAIN_COLOR ) ); ?>;
        }


    </style>

    <!-- Grid Boxes 3 -->

    <style>

        .grid3 .sc_team_member {
            padding: <?php esc_attr_e( get_option( \ots\Options::MARGIN ) ); ?>px;
        }

        .grid3 .sc_team_member_inner .image-container i.icon:hover {
            color: <?php esc_attr_e( get_option( \ots\Options::MAIN_COLOR ) ); ?>;
        }

        .grid3 .sc_team_member_inner .sc_team_member_name a {
            color: <?php esc_attr_e( get_option( \ots\Options::MAIN_COLOR ) ); ?>;
        }

        .grid3 .sc_team_member hr {
            margin: 2px 0 5px !important;
            border-color: <?php esc_attr_e( get_option( \ots\Options::MAIN_COLOR ) ); ?> !important;
        }

        #sc_our_team_filter ul.filter-list li:hover,
        #sc_our_team_filter ul.filter-list li.active-filter,
        .ots-team-view button.ots-search-reset-button:hover,
        .ots-team-view button.ots-search-button:hover{
            color: #fff;
            border-color: <?php esc_attr_e( get_option( \ots\Options::MAIN_COLOR ) ); ?>;
            background-color: <?php esc_attr_e( get_option( \ots\Options::MAIN_COLOR ) ); ?>;
        }
        
        #sc_our_team_filter ul.filter-list li.active-filter:hover {
            opacity: 1;
        }
        
        #sc_our_team_filter ul.filter-list li:hover {
            opacity: 0.8;
        }

        #sc_our_team.grid3 .styled-icons .sc-social {
            background-color: <?php esc_attr_e( get_option( \ots\Options::MAIN_COLOR ) ); ?>;
            border-radius: <?php echo get_option( Options::SOCIAL_ICON_STYLE ) == 'round' ? '50%' : '3px'; ?>;
        }

    </style>

    <!-- Honeycombs -->

    <style>

        .honeycombs .inner_span {
            background-color: <?php esc_html_e( get_option( Options::HONEYCOMB_COLOR ) ); ?>;
        }

        .honeycombs .sc_team_member .sc_team_member_jobtitle,
        .honeycombs .sc_team_member .sc_team_member_name {
            color: <?php esc_attr_e( get_option( \ots\Options::MAIN_COLOR ) ); ?>;
        }

    </style>

    <!-- Stacked List -->

    <style>

        .stacked#sc_our_team .smartcat_team_member {
            border-color: <?php esc_html_e( get_option( \ots\Options::MAIN_COLOR ) ); ?>;
        }

    </style>

    <!-- Staff Directory -->

    <style>

        div.dataTables_wrapper table.sc-team-table thead tr {
            background: <?php esc_html_e( get_option( \ots\Options::MAIN_COLOR ) ); ?>
        }

        div.dataTables_wrapper table.sc-team-table thead th{
            background-color: <?php esc_html_e( get_option( \ots\Options::MAIN_COLOR ) ); ?>;
        }

        #sc_our_team div.dataTables_wrapper div.dataTables_paginate.paging_simple_numbers a.paginate_button.current {
            background: <?php esc_html_e( get_option( \ots\Options::MAIN_COLOR ) ); ?>;
        }

    </style>

<?php }

add_action( 'wp_print_styles', 'ots_pro\print_dynamic_styles' );