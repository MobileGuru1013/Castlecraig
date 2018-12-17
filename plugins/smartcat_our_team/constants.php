<?php

namespace ots_pro;


const VERSION = '4.4.2';
const EDD_STORE_URL = 'https://smartcatdesign.net';


const MIN_PHP_VERSION = '5.4.0';


interface Options {

    /**
     * @since 4.0.0
     */
    const    PLUGIN_VERSION                 = 'ots-pro-plugin-version'
            ,HONEYCOMB_COLOR                = 'ots-pro-honeycomb-color'
            ,STATUS                         = 'ots-pro-status'
            ,LICENSE_KEY                    = 'ots-pro-license-key'
            ,LICENSE_EXPIRATION             = 'ots-pro-license-expiration'
            ,LICENSE_NOTIFICATION           = 'ots-pro-license-notification'
            ,CAROUSEL_SPEED                 = 'ots-pro-carousel-speed'
            ,SOCIAL_ICON_STYLE              = 'ots-pro-social-icon-style'
            ,NAME_FONT_SIZE                 = 'ots-pro-name-font-size'
            ,JOB_TITLE_FONT_SIZE            = 'ots-pro-job-title-font-size'
            ,CARD_MARGIN_TOP                = 'ots-pro-card-margin-top'
            ,PANEL_MARGIN_TOP               = 'ots-pro-panel-margin-top'
            ,SINGLE_IMAGE_STYLE             = 'ots-pro-single-image-style'
            ,MAX_WORD_COUNT                 = 'ots-pro-max-word-count'
            ,DISPLAY_DIRECTORY_JOB_TITLE    = 'ots-pro-display-directory-job-title'
            ,DIRECTORY_JOB_TITLE_LABEL      = 'ots-pro-directory-job-title-label'
            ,DISPLAY_DIRECTORY_GROUP        = 'ots-pro-display-directory-group'
            ,DIRECTORY_GROUP_LABEL          = 'ots-pro-directory-group-label'
            ,DISPLAY_DIRECTORY_PHONE        = 'ots-pro-display-directory-phone'
            ,DIRECTORY_PHONE_LABEL          = 'ots-pro-directory-phone-label'
            ,DISPLAY_DIRECTORY_SEARCH       = 'ots-pro-display-directory-search'
            ,DIRECTORY_SEARCH_LABEL         = 'ots-pro-directory-search-label'
            ,SORT_DIRECTORY_ALPHABETICALLY  = 'ots-pro-sort-directory-alphabetically'
            ,NUKE                           = 'ots-pro-nuke-install'
            ;

    /**
     * @since 4.2.0
     */
    const   PORTAL_ENABLED                  = 'ots-pro-member-portal-enabled'
            ;
    
    /**
     * @since 4.3.0
     */
    const    SEARCH_TOGGLE                  = 'ots-team-search-toggle'
            ,FILTER_TOGGLE                  = 'ots-team-filter-toggle'
            ,SEARCH_TEXT                    = 'ots-team-search-text'
            ,RESET_TEXT                     = 'ots-team-reset-text'
            ,SEARCH_ALL_TEXT                = 'ots-team-search-text-all'
            ,DIRECTORY_PAGINATION           = 'ots-team-directory-pagination'
            ;

    /**
     * @since 4.4.2
     */
    const    DT_EMPTY_TABLE                 = 'ots-pro-string_dt_empty_table'
            ,DT_ZERO_RECORDS                = 'ots-pro-string_dt_zero_records'
            ,DT_INFO                        = 'ots-pro-string_dt_info'
            ,DT_INFO_FILTERED               = 'ots-pro-string_dt_info_filtered'
            ,DT_INFO_EMPTY                  = 'ots-pro-string_dt_info_empty'
            ,DT_LENGTH_MENU                 = 'ots-pro-string_dt_length_menu'
            ,DT_PAGINATE_NEXT               = 'ots-prop-string_dt_paginate_next'
            ,DT_PAGINATE_PREV               = 'ots-pro-string_dt_paginate_prev'
            ,DIRECTORY_NAME_LABEL           = 'ots-pro-string_directory_name_label'
            ;
}


interface Defaults {

    /**
     * @since 4.0.0
     */
    const CAROUSEL_SPEED = 5000;

    /**
     * @since 4.0.0
     */
    const HONEYCOMB_COLOR = '#37C2E5';

    /**
     * @since 4.0.0
     */
    const SOCIAL_ICON_STYLE = 'round';

    /**
     * @since 4.0.0
     */
    const NAME_FONT_SIZE = 18;

    /**
     * @since 4.0.0
     */
    const JOB_TITLE_FONT_SIZE = 18;

    /**
     * @since 4.0.0
     */
    const CARD_MARGIN_TOP = 100;

    /**
     * @since 4.0.0
     */
    const PANEL_MARGIN_TOP = 0;

    /**
     * @since 4.0.0
     */
    const SINGLE_IMAGE_STYLE = 'square';

    /**
     * @since 4.0.0
     */
    const MAX_WORD_COUNT = 30;

    /**
     * @since 4.0.0
     */
    const DISPLAY_DIRECTORY_JOB_TITLE = 'on';

    /**
     * @since 4.0.0
     */
    const DIRECTORY_JOB_TITLE_LABEL = 'Position';

    /**
     * @since 4.0.0
     */
    const DISPLAY_DIRECTORY_GROUP = 'on';

    /**
     * @since 4.0.0
     */
    const DIRECTORY_GROUP_LABEL = 'Department';

    /**
     * @since 4.0.0
     */
    const DISPLAY_DIRECTORY_PHONE = 'on';

    /**
     * @since 4.0.0
     */
    const DIRECTORY_PHONE_LABEL = 'Phone Number';

    /**
     * @since 4.0.0
     */
    const DISPLAY_DIRECTORY_SEARCH = 'on';

    /**
     * @since 4.0.0
     */
    const DIRECTORY_SEARCH_LABEL = 'Search';

    /**
     * @since 4.0.0
     */
    const SORT_DIRECTORY_ALPHABETICALLY = 'on';


	/**
	 * @since 4.0.0
	 */
	const NUKE = '';

    /**
     * @since 4.2.0
     */
    const PORTAL_ENABLED = 'off';
    
    /**
     * @since 4.3.0
     */
    const SEARCH_TOGGLE = 'off';
    
    /**
     * @since 4.3.0
     */
    const FILTER_TOGGLE = 'off';
    
    /**
     * @since 4.3.0
     */
    const SEARCH_TEXT = 'Search';
    
    /**
     * @since 4.3.0
     */
    const RESET_TEXT = 'Reset';
    
    /**
     * @since 4.3.0
     */
    const SEARCH_ALL_TEXT = 'All departments';

    /**
     * @since 4.3.1
     */
    const DIRECTORY_PAGINATION = 'on';

}
