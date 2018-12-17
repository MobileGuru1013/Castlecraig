<?php

namespace ots_pro;


/**
 * Register settings with the Settings API.
 *
 * @since 4.0.0
 */
function register_settings() {

    register_setting( 'ots-team-view', Options::CAROUSEL_SPEED, array(
        'type'              => 'integer',
        'default'           => Defaults::CAROUSEL_SPEED,
        'sanitize_callback' => 'absint'
    ) );

    register_setting( 'ots-team-view', Options::HONEYCOMB_COLOR, array(
        'type'              => 'string',
        'default'           => Defaults::HONEYCOMB_COLOR,
        'sanitize_callback' => 'sanitize_hex_color'
    ) );

    register_setting( 'ots-team-view', Options::SOCIAL_ICON_STYLE, array(
        'type'              => 'string',
        'default'           => Defaults::SOCIAL_ICON_STYLE,
        'sanitize_callback' => 'ots_pro\sanitize_social_icon_style'
    ) );

    register_setting( 'ots-team-view', Options::NAME_FONT_SIZE, array(
        'type'              => 'integer',
        'default'           => Defaults::NAME_FONT_SIZE,
        'sanitize_callback' => 'absint'
    ) );

    register_setting( 'ots-team-view', Options::JOB_TITLE_FONT_SIZE, array(
        'type'              => 'integer',
        'default'           => Defaults::JOB_TITLE_FONT_SIZE,
        'sanitize_callback' => 'absint'
    ) );

    register_setting( 'ots-team-view', Options::MAX_WORD_COUNT, array(
        'type'              => 'integer',
        'default'           => Defaults::MAX_WORD_COUNT,
        'sanitize_callback' => 'absint'
    ) );

    register_setting( 'ots-team-search', Options::SEARCH_TOGGLE, array(
        'type'              => 'string',
        'default'           => Defaults::SEARCH_TOGGLE,
        'sanitize_callback' => 'ots\sanitize_checkbox'
    ) );

    register_setting( 'ots-team-search', Options::FILTER_TOGGLE, array(
        'type'              => 'string',
        'default'           => Defaults::FILTER_TOGGLE,
        'sanitize_callback' => 'ots\sanitize_checkbox'
    ) );

    register_setting( 'ots-team-search', Options::SEARCH_TEXT, array(
        'type'              => 'string',
        'default'           => Defaults::SEARCH_TEXT,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-team-search', Options::SEARCH_ALL_TEXT, array(
        'type'              => 'string',
        'default'           => Defaults::SEARCH_ALL_TEXT,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-team-search', Options::RESET_TEXT, array(
        'type'              => 'string',
        'default'           => Defaults::RESET_TEXT,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-team-view', Options::DIRECTORY_PAGINATION, array(
        'type'              => 'string',
        'default'           => Defaults::DIRECTORY_PAGINATION,
        'sanitize_callback' => 'ots\sanitize_checkbox'
    ) );

    register_setting( 'ots-team-view', Options::DISPLAY_DIRECTORY_JOB_TITLE, array(
        'type'              => 'string',
        'default'           => Defaults::DISPLAY_DIRECTORY_JOB_TITLE,
        'sanitize_callback' => 'ots\sanitize_checkbox'
    ) );

    register_setting( 'ots-team-view', Options::DIRECTORY_JOB_TITLE_LABEL, array(
        'type'              => 'string',
        'default'           => Defaults::DIRECTORY_JOB_TITLE_LABEL,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-team-view', Options::DISPLAY_DIRECTORY_GROUP, array(
        'type'              => 'string',
        'default'           => Defaults::DISPLAY_DIRECTORY_GROUP,
        'sanitize_callback' => 'ots\sanitize_checkbox'
    ) );

    register_setting( 'ots-team-view', Options::DIRECTORY_GROUP_LABEL, array(
        'type'              => 'string',
        'default'           => Defaults::DIRECTORY_GROUP_LABEL,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-team-view', Options::DISPLAY_DIRECTORY_PHONE, array(
        'type'              => 'string',
        'default'           => Defaults::DISPLAY_DIRECTORY_PHONE,
        'sanitize_callback' => 'ots\sanitize_checkbox'
    ) );

    register_setting( 'ots-team-view', Options::DIRECTORY_PHONE_LABEL, array(
        'type'              => 'string',
        'default'           => Defaults::DIRECTORY_PHONE_LABEL,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-team-view', Options::DISPLAY_DIRECTORY_SEARCH, array(
        'type'              => 'string',
        'default'           => Defaults::DISPLAY_DIRECTORY_SEARCH,
        'sanitize_callback' => 'ots\sanitize_checkbox'
    ) );

    register_setting( 'ots-team-view', Options::DIRECTORY_SEARCH_LABEL, array(
        'type'              => 'string',
        'default'           => Defaults::DIRECTORY_SEARCH_LABEL,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-team-view', Options::SORT_DIRECTORY_ALPHABETICALLY, array(
        'type'              => 'string',
        'default'           => Defaults::SORT_DIRECTORY_ALPHABETICALLY,
        'sanitize_callback' => 'ots\sanitize_checkbox'
    ) );

    register_setting( 'ots-single-member-view', Options::CARD_MARGIN_TOP, array(
        'type'              => 'integer',
        'default'           => Defaults::CARD_MARGIN_TOP,
        'sanitize_callback' => 'absint'
    ) );

    register_setting( 'ots-single-member-view', Options::PANEL_MARGIN_TOP, array(
        'type'              => 'integer',
        'default'           => Defaults::PANEL_MARGIN_TOP,
        'sanitize_callback' => 'absint'
    ) );

    register_setting( 'ots-single-member-view', Options::SINGLE_IMAGE_STYLE, array(
        'type'              => 'string',
        'default'           => Defaults::SINGLE_IMAGE_STYLE,
        'sanitize_callback' => 'ots_pro\sanitize_image_style'
    ) );

    register_setting( 'ots-team-view', Options::DT_LENGTH_MENU, array(
        'type'              => 'string',
        'default'           => __( 'Display _MENU_ records', 'ots-pro' ),
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-team-view', Options::DT_EMPTY_TABLE, array(
        'type'              => 'string',
        'default'           => __( 'No records found', 'ots-pro' ),
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-team-view', Options::DT_ZERO_RECORDS, array(
        'type'              => 'string',
        'default'           => __( 'No matching records found', 'ots-pro' ),
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-team-view', Options::DT_PAGINATE_NEXT, array(
        'type'              => 'string',
        'default'           => __( 'Next', 'ots-pro' ),
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-team-view', Options::DT_PAGINATE_PREV, array(
        'type'              => 'string',
        'default'           => __( 'Previous', 'ots-pro' ),
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-team-view', Options::DT_INFO, array(
        'type'              => 'string',
        'default'           => __( 'Showing _START_ to _END_ of _TOTAL_ entries', 'ots-pro' ),
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-team-view', Options::DT_INFO_EMPTY, array(
        'type'              => 'string',
        'default'           => __( 'Showing 0 to 0 of 0 entries', 'ots-pro' ),
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-team-view', Options::DT_INFO_FILTERED, array(
        'type'              => 'string',
        'default'           => __( '(filtered from _MAX_ total entries)', 'ots-pro' ),
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-team-view', Options::DIRECTORY_NAME_LABEL, array(
        'type'              => 'string',
        'default'           => __( 'Name', 'ots-pro' ),
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-member-portal', Options::PORTAL_ENABLED, array(
        'type'              => 'string',
        'sanitize_callback' => 'ots\sanitize_checkbox'
    ) );

}

add_action( 'init', 'ots_pro\register_settings' );


function add_settings_tabs( $tabs ) {

    $custom = array();


    if ( PHP_VERSION >= MIN_PHP_VERSION ) {

        $custom = array(
            'ots-member-portal' => __( 'Team Portal', 'ots-pro' ),
            'ots-team-search' => __( 'Member Search', 'ots-pro' ),
            'ots-advanced'      => __( 'Advanced', 'ots-pro' )
        );

        unset( $tabs['ots-advanced'] );

    }


    return array_merge( $tabs, $custom );

}

add_filter( 'ots_settings_page_tabs', 'ots_pro\add_settings_tabs' );


/**
 * Add settings section to the free version's admin page.
 *
 * @since 4.0.0
 */
function add_settings_sections() {
    
    add_settings_section( 'search', __( 'Search', 'ots' ), '', 'ots-team-search' );
    add_settings_section( 'directory', __( 'Staff Directory', 'ots-pro' ), '', 'ots-team-view' );
    add_settings_section( 'portal', __( 'Member Portal', 'ots-pro' ), '', 'ots-member-portal' );

}

add_action( 'admin_init', 'ots_pro\add_settings_sections' );


/**
 * Add settings fields to the free version's settings page.
 *
 * @since 4.0.0
 */
function add_settings_fields() {

    /**
     * Team view settings
     */
    
    add_settings_field(
        'ots_search_note',
        __( 'Note', 'ots-pro' ),
        'ots_pro\settings_search_note',
        'ots-team-search',
        'search'
    );
    
    add_settings_field(
        Options::SEARCH_TOGGLE,
        __( 'Enable Member Search', 'ots-pro' ),
        'ots\settings_check_box',
        'ots-team-search',
        'search',
        array(
            'name'    => Options::SEARCH_TOGGLE,
            'checked' => get_option( Options::SEARCH_TOGGLE ),
            'label'   => __( 'Toggles keyword & group search', 'ots-pro' )
        )
    );
    
    add_settings_field(
        Options::FILTER_TOGGLE,
        __( 'Enable Member Group Filter', 'ots-pro' ),
        'ots\settings_check_box',
        'ots-team-search',
        'search',
        array(
            'name'    => Options::FILTER_TOGGLE,
            'checked' => get_option( Options::FILTER_TOGGLE ),
            'label'   => __( 'Toggles filtering by group', 'ots-pro' )
        )
    );
    
    add_settings_field(
        Options::SEARCH_TEXT,
        __( 'Search button text', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-team-search',
        'search',
        array(
            'name'    => Options::SEARCH_TEXT,
            'value'   => get_option( Options::SEARCH_TEXT ),
            'attrs'   => array(
                'class'       => 'regular-text',
                'type'        => 'text',
            ),
        )
    );
    
    add_settings_field(
        Options::SEARCH_ALL_TEXT,
        __( 'All Departments Label', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-team-search',
        'search',
        array(
            'name'    => Options::SEARCH_ALL_TEXT,
            'value'   => get_option( Options::SEARCH_ALL_TEXT ),
            'attrs'   => array(
                'class'       => 'regular-text',
                'type'        => 'text',
            ),
        )
    );
    
    add_settings_field(
        Options::RESET_TEXT,
        __( 'Reset button text', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-team-search',
        'search',
        array(
            'name'    => Options::RESET_TEXT,
            'value'   => get_option( Options::RESET_TEXT ),
            'attrs'   => array(
                'class'       => 'regular-text',
                'type'        => 'text',
            ),
        )
    );
    
    add_settings_field(
        Options::CAROUSEL_SPEED,
        __( 'Carousel Speed (ms)', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-team-view',
        'display',
        array(
            'name'    => Options::CAROUSEL_SPEED,
            'value'   => get_option( Options::CAROUSEL_SPEED ),
            'attrs'   => array(
                'class'       => 'regular-text',
                'type'        => 'number',
                'min'         => 0
            ),
            'description' => __( 'The delay in milliseconds before the carousel switches (0ms disables automatic switching)', 'ots-pro' )
        )
    );

    add_settings_field(
        Options::SOCIAL_ICON_STYLE,
        __( 'Social Icon Style', 'ots-pro' ),
        'ots\settings_radio_buttons',
        'ots-team-view',
        'display',
        array(
            'name'     => Options::SOCIAL_ICON_STYLE,
            'selected' => get_option( Options::SOCIAL_ICON_STYLE ),
            'options'  => array(
                'flat'  => __( 'Flat', 'ots-pro' ),
                'round' => __( 'Round', 'ots-pro' )
            ),
            'before' => '<fieldset>',
            'after'  => '</fieldset>'
        )
    );

    add_settings_field(
        Options::MAX_WORD_COUNT,
        __( 'Max Word Count', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-team-view',
        'display',
        array(
            'name'  => Options::MAX_WORD_COUNT,
            'value' => get_option( Options::MAX_WORD_COUNT ),
            'attrs' => array(
                'class' => 'regular-text',
                'type'  => 'number',
                'min'   => 0
            ),
            'description' => __( 'The word limit for templates with biography previews', 'ots-pro' )
        )
    );

    add_settings_field(
        Options::NAME_FONT_SIZE,
        __( 'Name Font Size (px)', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-team-view',
        'display',
        array(
            'name'  => Options::NAME_FONT_SIZE,
            'value' => get_option( Options::NAME_FONT_SIZE ),
            'attrs' => array(
                'class' => 'regular-text',
                'type'  => 'number',
                'min'   => 8
            ),
            'description' => __( 'The font size for the members name', 'ots-pro' )
        )
    );

    add_settings_field(
        Options::JOB_TITLE_FONT_SIZE,
        __( 'Job Title Font Size (px)', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-team-view',
        'display',
        array(
            'name'  => Options::JOB_TITLE_FONT_SIZE,
            'value' => get_option( Options::JOB_TITLE_FONT_SIZE ),
            'attrs' => array(
                'class' => 'regular-text',
                'type'  => 'number',
                'min'   => 8
            ),
            'description' => __( 'The font size for the members job title', 'ots-pro' )
        )
    );

    add_settings_field(
        Options::HONEYCOMB_COLOR,
        __( 'Honeycomb Color', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-team-view',
        'display',
        array(
            'name'  => Options::HONEYCOMB_COLOR,
            'value' => get_option( Options::HONEYCOMB_COLOR ),
            'attrs' => array(
                'class' => 'wp-color-picker'
            )
        )
    );

    /**
     * Directory settings
     */
    add_settings_field(
        Options::DIRECTORY_PAGINATION,
        __( 'Pagination', 'ots-pro' ),
        'ots\settings_check_box',
        'ots-team-view',
        'directory',
        array(
            'name'    => Options::DIRECTORY_PAGINATION,
            'checked' => get_option( Options::DIRECTORY_PAGINATION ),
            'label'   => __( 'Use pagination for the team member display', 'ots-pro' )
        )
    );

    add_settings_field(
        Options::DIRECTORY_NAME_LABEL,
        __( 'Name Label', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-team-view',
        'directory',
        array(
            'name'  => Options::DIRECTORY_NAME_LABEL,
            'value' => get_option( Options::DIRECTORY_NAME_LABEL ),
            'attrs' => array(
                'class' => 'regular-text'
            )
        )
    );


    add_settings_field(
        Options::DISPLAY_DIRECTORY_JOB_TITLE,
        __( 'Display Job Titles', 'ots-pro' ),
        'ots\settings_check_box',
        'ots-team-view',
        'directory',
        array(
            'name'    => Options::DISPLAY_DIRECTORY_JOB_TITLE,
            'checked' => get_option( Options::DISPLAY_DIRECTORY_JOB_TITLE ),
            'label'   => __( 'Toggles whether member job titles are displayed', 'ots-pro' )
        )
    );

    add_settings_field(
        Options::DIRECTORY_JOB_TITLE_LABEL,
        __( 'Job Title Label', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-team-view',
        'directory',
        array(
            'name'  => Options::DIRECTORY_JOB_TITLE_LABEL,
            'value' => get_option( Options::DIRECTORY_JOB_TITLE_LABEL ),
            'attrs' => array(
                'class' => 'regular-text'
            )
        )
    );

    add_settings_field(
        Options::DISPLAY_DIRECTORY_GROUP,
        __( 'Display Groups', 'ots-pro' ),
        'ots\settings_check_box',
        'ots-team-view',
        'directory',
        array(
            'name'    => Options::DISPLAY_DIRECTORY_GROUP,
            'checked' => get_option( Options::DISPLAY_DIRECTORY_GROUP ),
            'label'   => __( 'Toggles whether member groups are displayed', 'ots-pro' )
        )
    );

    add_settings_field(
        Options::DIRECTORY_GROUP_LABEL,
        __( 'Group Label', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-team-view',
        'directory',
        array(
            'name'  => Options::DIRECTORY_GROUP_LABEL,
            'value' => get_option( Options::DIRECTORY_GROUP_LABEL ),
            'attrs' => array(
                'class' => 'regular-text'
            )
        )
    );

    add_settings_field(
        Options::DISPLAY_DIRECTORY_PHONE,
        __( 'Display Phone Numbers', 'ots-pro' ),
        'ots\settings_check_box',
        'ots-team-view',
        'directory',
        array(
            'name'    => Options::DISPLAY_DIRECTORY_PHONE,
            'checked' => get_option( Options::DISPLAY_DIRECTORY_PHONE ),
            'label'   => __( 'Toggles whether members phone numbers are displayed', 'ots-pro' )
        )
    );

    add_settings_field(
        Options::DIRECTORY_PHONE_LABEL,
        __( 'Phone Number Label', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-team-view',
        'directory',
        array(
            'name'  => Options::DIRECTORY_PHONE_LABEL,
            'value' => get_option( Options::DIRECTORY_PHONE_LABEL ),
            'attrs' => array(
                'class' => 'regular-text'
            )
        )
    );

    add_settings_field(
        Options::DISPLAY_DIRECTORY_SEARCH,
        __( 'Display Search', 'ots-pro' ),
        'ots\settings_check_box',
        'ots-team-view',
        'directory',
        array(
            'name'    => Options::DISPLAY_DIRECTORY_SEARCH,
            'checked' => get_option( Options::DISPLAY_DIRECTORY_SEARCH ),
            'label'   => __( 'Toggles the search bar for the directory', 'ots-pro' )
        )
    );

    add_settings_field(
        Options::DIRECTORY_SEARCH_LABEL,
        __( 'Search Label', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-team-view',
        'directory',
        array(
            'name'  => Options::DIRECTORY_SEARCH_LABEL,
            'value' => get_option( Options::DIRECTORY_SEARCH_LABEL ),
            'attrs' => array(
                'class' => 'regular-text'
            )
        )
    );

    add_settings_field(
        Options::SORT_DIRECTORY_ALPHABETICALLY,
        __( 'Sort Alphabetically', 'ots-pro' ),
        'ots\settings_check_box',
        'ots-team-view',
        'directory',
        array(
            'name'    => Options::SORT_DIRECTORY_ALPHABETICALLY,
            'checked' => get_option( Options::SORT_DIRECTORY_ALPHABETICALLY ),
            'label'   => __( 'Toggles whether the directory should be sorted alphabetically by default', 'ots-pro' )
        )
    );


    /**
     * Single member settings
     */
    add_settings_field(
        Options::CARD_MARGIN_TOP,
        __( 'Card Margin Top (px)', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-single-member-view',
        'single-layout',
        array(
            'name'  => Options::CARD_MARGIN_TOP,
            'value' => get_option( Options::CARD_MARGIN_TOP ),
            'attrs' => array(
                'class' => 'regular-text',
                'type'  => 'number',
                'min'   => 0
            ),
	        'description' => __( 'The margin between the popup card and the top of the screen', 'ots-pro' )
        )
    );

    add_settings_field(
        Options::PANEL_MARGIN_TOP,
        __( 'Panel Margin Top (px)', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-single-member-view',
        'single-layout',
        array(
            'name'  => Options::PANEL_MARGIN_TOP,
            'value' => get_option( Options::PANEL_MARGIN_TOP ),
            'attrs' => array(
                'class' => 'regular-text',
                'type'  => 'number',
                'min'   => 0
            ),
	        'description' => __( 'The margin between the slide-out panel and the top of the screen', 'ots-pro' )
        )
    );

    add_settings_field(
        Options::SINGLE_IMAGE_STYLE,
        __( 'Avatar Image Style', 'ots-pro' ),
        'ots\settings_radio_buttons',
        'ots-single-member-view',
        'single-display',
        array(
            'name'     => Options::SINGLE_IMAGE_STYLE,
            'selected' => get_option( Options::SINGLE_IMAGE_STYLE ),
            'options'  => array(
                'square' => __( 'Square', 'ots-pro' ),
                'circle' => __( 'Circle', 'ots-pro' ),

            ),
            'before' => '<fieldset>',
            'after'  => '</fieldset>'
        )
    );

    add_settings_field(
        Options::DT_LENGTH_MENU,
        __( 'Result Limit Label', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-team-view',
        'directory',
        array(
            'name'  => Options::DT_LENGTH_MENU,
            'value' => get_option( Options::DT_LENGTH_MENU ),
            'attrs' => array(
                'class' => 'regular-text'
            )
        )
    );
    add_settings_field(
        Options::DT_PAGINATE_NEXT,
        __( 'Next Button Label', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-team-view',
        'directory',
        array(
            'name'  => Options::DT_PAGINATE_NEXT,
            'value' => get_option( Options::DT_PAGINATE_NEXT ),
            'attrs' => array(
                'class' => 'regular-text'
            )
        )
    );
    add_settings_field(
        Options::DT_PAGINATE_PREV,
        __( 'Previous Button Label', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-team-view',
        'directory',
        array(
            'name'  => Options::DT_PAGINATE_PREV,
            'value' => get_option( Options::DT_PAGINATE_PREV ),
            'attrs' => array(
                'class' => 'regular-text'
            )
        )
    );
    add_settings_field(
        Options::DT_EMPTY_TABLE,
        __( 'Empty Table Message', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-team-view',
        'directory',
        array(
            'name'  => Options::DT_EMPTY_TABLE,
            'value' => get_option( Options::DT_EMPTY_TABLE ),
            'attrs' => array(
                'class' => 'regular-text'
            )
        )
    );
    add_settings_field(
        Options::DT_ZERO_RECORDS,
        __( 'No Records Message', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-team-view',
        'directory',
        array(
            'name'  => Options::DT_ZERO_RECORDS,
            'value' => get_option( Options::DT_ZERO_RECORDS ),
            'attrs' => array(
                'class' => 'regular-text'
            )
        )
    );
    add_settings_field(
        Options::DT_INFO,
        __( 'Pagination Info', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-team-view',
        'directory',
        array(
            'name'  => Options::DT_INFO,
            'value' => get_option( Options::DT_INFO ),
            'attrs' => array(
                'class' => 'regular-text'
            )
        )
    );
    add_settings_field(
        Options::DT_INFO_EMPTY,
        __( 'Pagination Info (Empty)', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-team-view',
        'directory',
        array(
            'name'  => Options::DT_INFO_EMPTY,
            'value' => get_option( Options::DT_INFO_EMPTY ),
            'attrs' => array(
                'class' => 'regular-text'
            )
        )
    );
    add_settings_field(
        Options::DT_INFO_FILTERED,
        __( 'Pagination Info (Filtered)', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-team-view',
        'directory',
        array(
            'name'  => Options::DT_INFO_FILTERED,
            'value' => get_option( Options::DT_INFO_FILTERED ),
            'attrs' => array(
                'class' => 'regular-text'
            )
        )
    );


    /**
     * Team Portal
     */
    add_settings_field(
        Options::PORTAL_ENABLED,
        __( 'Member Portal Enabled', 'ots-pro' ),
        'ots\settings_toggle',
        'ots-member-portal',
        'portal',
        array(
            'name'    => Options::PORTAL_ENABLED,
            'checked' => get_option( Options::PORTAL_ENABLED ),
            'label'   => __( 'Enable or disable the member portal', 'ots-pro' ),
            'slider'  => 'round'
        )
    );

}

add_action( 'admin_init', 'ots_pro\add_settings_fields' );


/**
 * Add extra template options.
 *
 * @param $templates
 * @return array
 * @since 4.0.0
 */
function add_templates( $templates ) {

    return array_merge( $templates, get_templates() );

}

add_filter( 'ots_templates', 'ots_pro\add_templates' );


/**
 * Add extra single template options.
 *
 * @param $templates
 * @return array
 * @since 4.0.0
 */
function add_single_templates( $templates ) {

    return array_merge( $templates, get_single_templates() );

}

add_filter( 'ots_single_templates', 'ots_pro\add_single_templates' );


function add_inline_templates( $templates ) {

	return array_merge( $templates, get_inline_templates() );

}

add_filter( 'ots_inline_templates', 'ots_pro\add_inline_templates' );


/**
 * Synchronize nuke option with the free version's setting.
 *
 * @param $old
 * @param $value
 * @since 4.0.0
 */
function update_nuke_options( $old, $value ) {

	update_option( Options::NUKE, $value );

}

add_action( 'update_option_' . \ots\Options::NUKE, 'ots_pro\update_nuke_options', 10, 2 );


function member_portal_toggled( $old, $value ) {


    include_once dirname( __FILE__ ) . '/member-portal/member-portal.php';

    portal\member_portal();


    if ( $value == 'on' ) {
        do_action( 'ots_portal_activated' );
    } else {
        do_action( 'ots_portal_deactivated' );
    }

}

add_action( 'update_option_' . Options::PORTAL_ENABLED, 'ots_pro\member_portal_toggled', 10, 2 );


function settings_search_note() { ?> 
    
    <?php _e( 'The search and filter features are not compatible with Carousel or Honey Combs templates. Staff Directory has it\'s own search bar', 'ots' ); ?>

<?php }