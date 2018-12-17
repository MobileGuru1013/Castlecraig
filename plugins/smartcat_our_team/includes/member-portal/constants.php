<?php

namespace ots_pro\portal;


const VERSION = '2.0.0';


interface Options {

    /**
     * @since 2.0.0
     */
    const PLUGIN_VERSION = 'ots-member-portal-version';

    /**
     * @since 2.0.0
     */
    const PROFILE_PAGE = 'ots-member-portal-profile-page';

    /**
     * @since 2.0.0
     */
    const LOGIN_PAGE = 'ots-member-portal-login-page';

    /**
     * @since 2.0.0
     */
    const LOGOUT_PAGE = 'ots-member-portal-logout-page';

    /**
     * @since 2.0.0
     */
    const PORTAL_PAGE = 'ots-member-portal-portal-page';

    /**
     * @since 2.0.0
     */
    const LOGIN_REDIRECT = 'ots-member-portal-login-redirect';

    /**
     * @since 2.0.0
     */
    const UNAUTHORIZED_REDIRECT = 'ots-member-portal-unauthorized-redirect';

    /**
     * @since 2.0.0
     */
    const WRONG_GROUP_REDIRECT = 'ots-member-portal-wrong-group-redirect';

    /**
     * @since 2.0.0
     */
    const OUTGOING_EMAIL_NAME = 'ots-member-portal-outgoing-email-name';

    /**
     * @since 2.0.0
     */
    const OUTGOING_EMAIL_ADDRESS = 'ots-member-portal-outgoing-email-address';

    /**
     * @since 2.0.0
     */
    const WELCOME_EMAIL = 'ots-member-portal-welcome-email';

    /**
     * @since 2.0.0
     */
    const PASSWORD_RESET_EMAIL = 'ots-member-portal-pw-reset-email';

    /**
     * @since 2.0.0
     */
    const WELCOME_MESSAGE = 'ots-member-portal-welcome-message';

    /**
     * @since 2.0.0
     */
    const PORTAL_LOGO = 'ots-member-portal-logo';

    /**
     * @since 2.0.0
     */
    const POSTS_PER_PAGE = 'ots-member-portal-posts-per-page';

    /**
     * @since 2.0.0
     */
    const SIDEBAR_PAGES_TITLE = 'ots-member-portal-sidebar-pages-title';

    /**
     * @since 2.0.0
     */
    const SIDEBAR_GROUPS_TITLE = 'ots-member-portal-sidebar-groups-title';

    /**
     * @since 2.0.0
     */
    const LOAD_MORE_COMMENTS_TEXT = 'ots-member-portal-load-more-comments-text';

    /**
     * @since 2.0.0
     */
    const COMMENT_PLACEHOLDER_TEXT = 'ots-member-portal-comment-placeholder-text';

    /**
     * @since 2.0.0
     */
    const COPYRIGHT_TEXT = 'ots-member-portal-copyright-text';

    /**
     * @since 2.0.0
     */
    const PROFILE_EDIT_TITLE = 'ots-member-portal-profile-edit-title';

    /**
     * @since 2.0.0
     */
    const LOGOUT_MESSAGE = 'ots-member-portal-logout-message';

    /**
     * @since 2.0.0
     */
    const RESET_PASSWORD_MESSAGE = 'ots-member-portal-reset-password-message';

    /**
     * @since 2.0.0
     */
    const NAVBAR_HOME_TEXT = 'ots-member-portal-navbar-home-text';

    /**
     * @since 2.0.0
     */
    const NAVBAR_PROFILE_TEXT = 'ots-member-portal-navbar-profile-text';

    /**
     * @since 2.0.0
     */
    const NAVBAR_LOGOUT_TEXT = 'ots-member-portal-navbar-logout-text';

    /**
     * @since 2.0.0
     */
    const NAVBAR_BACK_TEXT = 'ots-member-portal-navbar-back-text';

    /**
     * @since 2.0.0
     */
    const SKIN = 'ots-member-portal-skin';

}


interface Defaults {

    /**
     * @since 2.0.0
     */
    const WELCOME_EMAIL = 'Hello [username],<br><br>Your password is [password]';

    /**
     * @since 2.0.0
     */
    const PASSWORD_RESET_EMAIL = 'Hello [username],<br><br>Your password is [password]';

    /**
     * @since 2.0.0
     */
    const WELCOME_MESSAGE = 'Welcome to our community';
    
    /**
     * @since 2.0.0
     */
    const SKIN = 'skin-app';

    /**
     * @since 2.0.0
     */
    const POSTS_PER_PAGE = 15;

    /**
     * @since 2.0.0
     */
    const SIDEBAR_PAGES_TITLE = 'Pages';

    /**
     * @since 2.0.0
     */
    const SIDEBAR_GROUPS_TITLE = 'In My Groups';

    /**
     * @since 2.0.0
     */
    const LOAD_MORE_COMMENTS_TEXT = 'Load More Comments';

    /**
     * @since 2.0.0
     */
    const COMMENT_PLACEHOLDER_TEXT = 'Write a comment...';

    /**
     * @since 2.0.0
     */
    const COPYRIGHT_TEXT = '2017 © Smartcat Solutions Inc';

    /**
     * @since 2.0.0
     */
    const PROFILE_EDIT_TITLE = 'Edit Profile';

    /**
     * @since 2.0.0
     */
    const LOGOUT_MESSAGE = 'You have been logged out';

    /**
     * @since 2.0.0
     */
    const RESET_PASSWORD_MESSAGE = 'Reset Password';

    /**
     * @since 2.0.0
     */
    const NAVBAR_HOME_TEXT = 'Home';

    /**
     * @since 2.0.0
     */
    const NAVBAR_PROFILE_TEXT = 'Profile';

    /**
     * @since 2.0.0
     */
    const NAVBAR_LOGOUT_TEXT = 'Logout';

    /**
     * @since 2.0.0
     */
    const NAVBAR_BACK_TEXT = 'Back to site';

}
