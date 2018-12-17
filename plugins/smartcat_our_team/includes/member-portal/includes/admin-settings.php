<?php

namespace ots_pro\portal;


function add_settings_sections() {

    add_settings_section( 'general', __( 'General', 'ots-pro' ), '', 'ots-member-portal' );
    add_settings_section( 'portal-pages', __( 'Portal Pages', 'ots-pro' ), '', 'ots-member-portal' );
    add_settings_section( 'redirection', __( 'Redirection', 'ots-pro' ), '', 'ots-member-portal' );
    add_settings_section( 'email-settings', __( 'Email Settings', 'ots-pro' ), '', 'ots-member-portal' );
    add_settings_section( 'strings', __( 'Strings', 'ots-pro' ), '', 'ots-member-portal' );
    add_settings_section( 'extra-settings', __( 'Extras', 'ots-pro' ), '', 'ots-member-portal' );

}

add_action( 'admin_init', 'ots_pro\portal\add_settings_sections' );


function register_settings() {

    register_setting( 'ots-member-portal', Options::PORTAL_LOGO, array(
        'type'              => 'string',
        'default'           => resolve_url( 'assets/images/user.png' ),
        'sanitize_callback' => 'esc_url_raw'
    ) );

    register_setting( 'ots-member-portal', Options::SKIN, array(
        'type'              => 'string',
        'default'           => Defaults::SKIN,
        'sanitize_callback' => 'ots_pro\portal\sanitize_skin'
    ) );

    register_setting( 'ots-member-portal', Options::PROFILE_PAGE, array(
        'type'              => 'integer',
        'sanitize_callback' => 'ots_pro\portal\sanitize_page_id'
    ) );

    register_setting( 'ots-member-portal', Options::LOGIN_PAGE, array(
        'type'              => 'integer',
        'sanitize_callback' => 'ots_pro\portal\sanitize_page_id'
    ) );

    register_setting( 'ots-member-portal', Options::LOGOUT_PAGE, array(
        'type'              => 'integer',
        'sanitize_callback' => 'ots_pro\portal\sanitize_page_id'
    ) );

    register_setting( 'ots-member-portal', Options::PORTAL_PAGE, array(
        'type'              => 'integer',
        'sanitize_callback' => 'ots_pro\portal\sanitize_page_id'
    ) );

    register_setting( 'ots-member-portal', Options::LOGIN_REDIRECT, array(
        'type'              => 'integer',
        'sanitize_callback' => 'ots_pro\portal\sanitize_page_id'
    ) );

    register_setting( 'ots-member-portal', Options::UNAUTHORIZED_REDIRECT, array(
        'type'              => 'integer',
        'sanitize_callback' => 'ots_pro\portal\sanitize_page_id'
    ) );

    register_setting( 'ots-member-portal', Options::WRONG_GROUP_REDIRECT, array(
        'type'              => 'integer',
        'sanitize_callback' => 'ots_pro\portal\sanitize_page_id'
    ) );

    register_setting( 'ots-member-portal', Options::OUTGOING_EMAIL_NAME, array(
        'type'              => 'string',
        'default'           => get_option( 'admin_email' ),
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-member-portal', Options::OUTGOING_EMAIL_ADDRESS, array(
        'type'              => 'string',
        'default'           => get_option( 'admin_email' ),
        'sanitize_callback' => 'sanitize_email'
    ) );

    register_setting( 'ots-member-portal', Options::WELCOME_EMAIL, array(
        'type'              => 'string',
        'default'           => Defaults::WELCOME_EMAIL,
        'sanitize_callback' => 'wp_kses_post'
    ) );

    register_setting( 'ots-member-portal', Options::PASSWORD_RESET_EMAIL, array(
        'type'              => 'string',
        'default'           => Defaults::PASSWORD_RESET_EMAIL,
        'sanitize_callback' => 'wp_kses_post'
    ) );

    register_setting( 'ots-member-portal', Options::WELCOME_MESSAGE, array(
        'type'              => 'string',
        'default'           => Defaults::WELCOME_MESSAGE,
        'sanitize_callback' => 'wp_kses_post'
    ) );

    register_setting( 'ots-member-portal', Options::POSTS_PER_PAGE, array(
        'type'              => 'integer',
        'default'           => Defaults::POSTS_PER_PAGE,
        'sanitize_callback' => 'absint'
    ) );


    // Strings
    register_setting( 'ots-member-portal', Options::SIDEBAR_PAGES_TITLE, array(
        'type'              => 'string',
        'default'           => Defaults::SIDEBAR_PAGES_TITLE,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-member-portal', Options::SIDEBAR_GROUPS_TITLE, array(
        'type'              => 'string',
        'default'           => Defaults::SIDEBAR_GROUPS_TITLE,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-member-portal', Options::LOAD_MORE_COMMENTS_TEXT, array(
        'type'              => 'string',
        'default'           => Defaults::LOAD_MORE_COMMENTS_TEXT,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-member-portal', Options::COMMENT_PLACEHOLDER_TEXT, array(
        'type'              => 'string',
        'default'           => Defaults::COMMENT_PLACEHOLDER_TEXT,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-member-portal', Options::COPYRIGHT_TEXT, array(
        'type'              => 'string',
        'default'           => Defaults::COPYRIGHT_TEXT,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-member-portal', Options::PROFILE_EDIT_TITLE, array(
        'type'              => 'string',
        'default'           => Defaults::PROFILE_EDIT_TITLE,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-member-portal', Options::LOGOUT_MESSAGE, array(
        'type'              => 'string',
        'default'           => Defaults::LOGOUT_MESSAGE,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-member-portal', Options::RESET_PASSWORD_MESSAGE, array(
        'type'              => 'string',
        'default'           => Defaults::RESET_PASSWORD_MESSAGE,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-member-portal', Options::NAVBAR_HOME_TEXT, array(
        'type'              => 'string',
        'default'           => Defaults::NAVBAR_HOME_TEXT,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-member-portal', Options::NAVBAR_PROFILE_TEXT, array(
        'type'              => 'string',
        'default'           => Defaults::NAVBAR_PROFILE_TEXT,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-member-portal', Options::NAVBAR_LOGOUT_TEXT, array(
        'type'              => 'string',
        'default'           => Defaults::NAVBAR_LOGOUT_TEXT,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    register_setting( 'ots-member-portal', Options::NAVBAR_BACK_TEXT, array(
        'type'              => 'string',
        'default'           => Defaults::NAVBAR_BACK_TEXT,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

}

add_action( 'init', 'ots_pro\portal\register_settings' );


function add_settings_fields() {

    add_settings_field(
        Options::PORTAL_LOGO,
        __( 'Portal Logo', 'ots-pro' ),
        'ots_pro\portal\settings_media_uploader',
        'ots-member-portal',
        'general',
        array(
            'name'  => Options::PORTAL_LOGO,
            'value' => get_option( Options::PORTAL_LOGO ),
            'attrs' => array(
                'class' => array( 'regular-text', 'ots-portal-upload' )
            )
        )
    );
    
    
    add_settings_field(
        Options::SKIN,
        __( 'Portal Skin', 'ots-pro' ),
        'ots_pro\portal\skin_dropdown',
        'ots-member-portal',
        'general',
        array(
            'name'      => Options::SKIN,
            'selected'  => get_option( Options::SKIN, Defaults::SKIN  ),
        )
    );
    
    

    add_settings_field(
        Options::POSTS_PER_PAGE,
        __( 'Posts Per Page', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-member-portal',
        'general',
        array(
            'name'  => Options::POSTS_PER_PAGE,
            'value' => get_option( Options::POSTS_PER_PAGE ),
            'attrs' => array(
                'class' => array( 'regular-text' ),
                'type'  => 'number',
                'min'   => 1
            )
        )
    );

    add_settings_field(
        Options::PROFILE_PAGE,
        __( 'Profile Page', 'ots-pro' ),
        'ots_pro\portal\page_dropdown',
        'ots-member-portal',
        'portal-pages',
        array(
            'name'     => Options::PROFILE_PAGE,
            'selected' => get_option( Options::PROFILE_PAGE )
        )
    );

    add_settings_field(
        Options::LOGIN_PAGE,
        __( 'Login Page', 'ots-pro' ),
        'ots_pro\portal\page_dropdown',
        'ots-member-portal',
        'portal-pages',
        array(
            'name'     => Options::LOGIN_PAGE,
            'selected' => get_option( Options::LOGIN_PAGE )
        )
    );

    add_settings_field(
        Options::LOGOUT_PAGE,
        __( 'Logout Page', 'ots-pro' ),
        'ots_pro\portal\page_dropdown',
        'ots-member-portal',
        'portal-pages',
        array(
            'name'     => Options::LOGOUT_PAGE,
            'selected' => get_option( Options::LOGOUT_PAGE )
        )
    );

    add_settings_field(
        Options::PORTAL_PAGE,
        __( 'Portal Page', 'ots-pro' ),
        'ots_pro\portal\page_dropdown',
        'ots-member-portal',
        'portal-pages',
        array(
            'name'     => Options::PORTAL_PAGE,
            'selected' => get_option( Options::PORTAL_PAGE )
        )
    );

    add_settings_field(
        Options::LOGIN_REDIRECT,
        __( 'Login Redirect Destination', 'ots-pro' ),
        'ots_pro\portal\page_dropdown',
        'ots-member-portal',
        'redirection',
        array(
            'name'     => Options::LOGIN_REDIRECT,
            'selected' => get_option( Options::LOGIN_REDIRECT )
        )
    );

    add_settings_field(
        Options::UNAUTHORIZED_REDIRECT,
        __( 'Unauthorized Redirect Destination', 'ots-pro' ),
        'ots_pro\portal\page_dropdown',
        'ots-member-portal',
        'redirection',
        array(
            'name'     => Options::UNAUTHORIZED_REDIRECT,
            'selected' => get_option( Options::UNAUTHORIZED_REDIRECT )
        )
    );

    add_settings_field(
        Options::WRONG_GROUP_REDIRECT,
        __( 'Wrong Group Redirect Destination', 'ots-pro' ),
        'ots_pro\portal\page_dropdown',
        'ots-member-portal',
        'redirection',
        array(
            'name'     => Options::WRONG_GROUP_REDIRECT,
            'selected' => get_option( Options::WRONG_GROUP_REDIRECT )
        )
    );

    add_settings_field(
        Options::OUTGOING_EMAIL_NAME,
        __( 'Sender Name', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-member-portal',
        'email-settings',
        array(
            'name'  => Options::OUTGOING_EMAIL_NAME,
            'value' => get_option( Options::OUTGOING_EMAIL_NAME  ),
            'attrs' => array( 'class' => 'regular-text' ),
        )
    );

    add_settings_field(
        Options::OUTGOING_EMAIL_ADDRESS,
        __( 'Sender Email Address', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-member-portal',
        'email-settings',
        array(
            'name'  => Options::OUTGOING_EMAIL_ADDRESS,
            'value' => get_option( Options::OUTGOING_EMAIL_ADDRESS  ),
            'attrs' => array(
                'class' => 'regular-text',
                'type'  => 'email'
            )
        )
    );

    add_settings_field(
        Options::WELCOME_EMAIL,
        __( 'Welcome Email', 'ots-pro' ),
        'ots_pro\portal\settings_editor_field',
        'ots-member-portal',
        'email-settings',
        array(
            'id'       => Options::WELCOME_EMAIL,
            'content'  => get_option( Options::WELCOME_EMAIL ),
            'settings' => array(
                'textarea_rows' => 8
            )
        )
    );

    add_settings_field(
        Options::PASSWORD_RESET_EMAIL,
        __( 'Password Reset Email', 'ots-pro' ),
        'ots_pro\portal\settings_editor_field',
        'ots-member-portal',
        'email-settings',
        array(
            'id'       => Options::PASSWORD_RESET_EMAIL,
            'content'  => get_option( Options::PASSWORD_RESET_EMAIL ),
            'settings' => array(
                'textarea_rows' => 8
            )
        )
    );

    add_settings_field(
        Options::WELCOME_MESSAGE,
        __( 'Content Widget Area', 'ots-pro' ),
        'ots_pro\portal\settings_editor_field',
        'ots-member-portal',
        'extra-settings',
        array(
            'id'       => Options::WELCOME_MESSAGE,
            'content'  => get_option( Options::WELCOME_MESSAGE ),
            'settings' => array(
                'textarea_rows' => 6
            )
        )
    );


    // Strings
    add_settings_field(
        Options::SIDEBAR_PAGES_TITLE,
        __( 'Sidebar Pages Title', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-member-portal',
        'strings',
        array(
            'name'  => Options::SIDEBAR_PAGES_TITLE,
            'value' => get_option( Options::SIDEBAR_PAGES_TITLE ),
            'attrs' => array(
                'class' => array( 'regular-text' )
            )
        )
    );

    add_settings_field(
        Options::SIDEBAR_GROUPS_TITLE,
        __( 'Sidebar Groups Title', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-member-portal',
        'strings',
        array(
            'name'  => Options::SIDEBAR_GROUPS_TITLE,
            'value' => get_option( Options::SIDEBAR_GROUPS_TITLE ),
            'attrs' => array(
                'class' => array( 'regular-text' )
            )
        )
    );

    add_settings_field(
        Options::LOAD_MORE_COMMENTS_TEXT,
        __( 'Load More Comments', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-member-portal',
        'strings',
        array(
            'name'  => Options::LOAD_MORE_COMMENTS_TEXT,
            'value' => get_option( Options::LOAD_MORE_COMMENTS_TEXT ),
            'attrs' => array(
                'class' => array( 'regular-text' )
            )
        )
    );

    add_settings_field(
        Options::COMMENT_PLACEHOLDER_TEXT,
        __( 'Comment Placeholder', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-member-portal',
        'strings',
        array(
            'name'  => Options::COMMENT_PLACEHOLDER_TEXT,
            'value' => get_option( Options::COMMENT_PLACEHOLDER_TEXT ),
            'attrs' => array(
                'class' => array( 'regular-text' )
            )
        )
    );

    add_settings_field(
        Options::COPYRIGHT_TEXT,
        __( 'Copyright', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-member-portal',
        'strings',
        array(
            'name'  => Options::COPYRIGHT_TEXT,
            'value' => get_option( Options::COPYRIGHT_TEXT ),
            'attrs' => array(
                'class' => array( 'regular-text' )
            )
        )
    );

    add_settings_field(
        Options::PROFILE_EDIT_TITLE,
        __( 'Edit Profile Title', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-member-portal',
        'strings',
        array(
            'name'  => Options::PROFILE_EDIT_TITLE,
            'value' => get_option( Options::PROFILE_EDIT_TITLE ),
            'attrs' => array(
                'class' => array( 'regular-text' )
            )
        )
    );

    add_settings_field(
        Options::LOGOUT_MESSAGE,
        __( 'Logout Message', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-member-portal',
        'strings',
        array(
            'name'  => Options::LOGOUT_MESSAGE,
            'value' => get_option( Options::LOGOUT_MESSAGE ),
            'attrs' => array(
                'class' => array( 'regular-text' )
            )
        )
    );

    add_settings_field(
        Options::RESET_PASSWORD_MESSAGE,
        __( 'Reset Password Message', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-member-portal',
        'strings',
        array(
            'name'  => Options::RESET_PASSWORD_MESSAGE,
            'value' => get_option( Options::RESET_PASSWORD_MESSAGE ),
            'attrs' => array(
                'class' => array( 'regular-text' )
            )
        )
    );

    add_settings_field(
        Options::NAVBAR_HOME_TEXT,
        __( 'Navbar Home', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-member-portal',
        'strings',
        array(
            'name'  => Options::NAVBAR_HOME_TEXT,
            'value' => get_option( Options::NAVBAR_HOME_TEXT ),
            'attrs' => array(
                'class' => array( 'regular-text' )
            )
        )
    );

    add_settings_field(
        Options::NAVBAR_PROFILE_TEXT,
        __( 'Navbar Profile', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-member-portal',
        'strings',
        array(
            'name'  => Options::NAVBAR_PROFILE_TEXT,
            'value' => get_option( Options::NAVBAR_PROFILE_TEXT ),
            'attrs' => array(
                'class' => array( 'regular-text' )
            )
        )
    );

    add_settings_field(
        Options::NAVBAR_LOGOUT_TEXT,
        __( 'Navbar Logout', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-member-portal',
        'strings',
        array(
            'name'  => Options::NAVBAR_LOGOUT_TEXT,
            'value' => get_option( Options::NAVBAR_LOGOUT_TEXT ),
            'attrs' => array(
                'class' => array( 'regular-text' )
            )
        )
    );

    add_settings_field(
        Options::NAVBAR_BACK_TEXT,
        __( 'Navbar Back to Site', 'ots-pro' ),
        'ots\settings_text_box',
        'ots-member-portal',
        'strings',
        array(
            'name'  => Options::NAVBAR_BACK_TEXT,
            'value' => get_option( Options::NAVBAR_BACK_TEXT ),
            'attrs' => array(
                'class' => array( 'regular-text' )
            )
        )
    );

}

add_action( 'admin_init', 'ots_pro\portal\add_settings_fields' );


function page_dropdown( $args ) {

    $defaults = array(
        'id'       => '',
        'selected' => ''
    );

    $args = wp_parse_args( $args, $defaults );

    $posts = get_posts( array(
        'post_type'      => 'page',
        'posts_per_page' => -1,
        'post__not_in'   => array( get_option( 'page_for_posts' ) )
    ) );

    echo '<select id="' . esc_attr( $args['id'] ) . '" name="' . esc_attr( $args['name'] ) . '" class="regular-text">';

    echo '<option value="">' . __( 'Select a page', 'ots' ). '</option>';

    foreach( $posts as $post ) {
        echo '<option value="' . esc_attr( $post->ID ) . '" ' . selected( $post->ID, $args['selected'], false ) . '>' . esc_html( $post->post_title ) . '</option>';
    }

    echo '</select>';

}

function skin_dropdown( $args ) {
    
    echo '<select name="' . esc_attr( $args['name'] ) . '" class="regular-text">';

    echo '<option value="">' . __( 'Select a skin', 'ots' ). '</option>';

    foreach( skins() as $key => $val ) {
        
        echo '<option value="' . $key . '" ' . selected( $key, $args['selected'], false ) . '>' . $val . '</option>';
        
    }
    
    echo '</select>';
    
}


function settings_textarea( array $args ) {

    $defaults = array(
        'attrs'       => array(),
        'value'       => '',
        'description' => ''
    );

    $args = wp_parse_args( $args, $defaults );

    echo '<textarea name="' . esc_attr( $args['name'] ) . '"';

    \ots\print_attrs( $args['attrs'] ) ;

    echo '>' . esc_html( $args['value'] ) . '</textarea>';

    if( !empty( $args['description'] ) ) {
        echo '<p class="description">' . esc_html( $args['description'] ) . '</p>';
    }

}


function settings_editor_field( array $args ) {

    $defaults = array(
        'id'       => '',
        'content'  => '',
        'settings' => array()
    );

    $args = wp_parse_args( $args, $defaults );

    wp_editor( $args['content'], $args['id'], $args['settings'] );

}


function settings_media_uploader( array $args ) {

    $defaults = array(
        'attrs'       => array(),
        'value'       => ''
    );

    $args = wp_parse_args( $args, $defaults );

    echo '<div style="text-align: center;" ' . \ots\print_attrs( $args['attrs'], false ) . '>';
    echo '<input style="display: none;" name="' . esc_attr( $args['name'] ) .
         '" value="' . esc_attr( $args['value'] ) . '" />' ;
    echo '</div>';

}


function portal_status_widget() {

    $q = get_members_by_status();

    $inactive = 0;
    $invalid  = 0;

    foreach ( $q->posts as $member ) {

        if ( get_post_meta( $member->ID, 'team_member_status', true ) ?: 'inactive' == 'inactive' ) {
            $inactive++;
        }

        if ( !is_email( get_post_meta( $member->ID, 'team_member_email', true ) ) ) {
            $invalid++;
        }

    }

    ?>

    <div class="widget">

        <h2><?php _e( 'Team Portal', 'ots' ); ?></h2>

        <div class="content">

            <?php if ( $invalid > 0 ) : ?>

                <?php $members = _n( 'member', 'members', $invalid, 'ots-pro' ); ?>

                <div class="ots-portal-notice">
                    <p>
                        <?php

                        printf(
                            __( 'There are %1$s team %2$s with an invalid email address. Please correct them to ensure that they can receive emails from the portal properly', 'ots-pro' ),
                            $invalid,
                            $members
                        );

                        ?>
                    </p>
                </div>

            <?php endif; ?>

            <?php if ( $inactive > 0 ) : ?>

               <div style="text-align: center" id="ots-activate-members">

                   <p>
                       <button id="ots-activate-all-members" class="button button-primary">
                           <?php _e( 'Activate all team members', 'ots-pro' ); ?>
                       </button>
                   </p>

                    <div id="confirm-member-activation" style="display: none">

                        <p>
                            <?php _e( 'Are you sure you want to do this? All inactive members portal access will be enabled and each will receive a new auto-generate password.', 'ots-pro' ); ?>
                        </p>
                        <p>
                            <button id="ots-confirm-activate-members" class="button">
                                <?php _e( 'Yes', 'ots-pro' ); ?>
                            </button>

                            <button id="ots-cancel-activate-members" class="button">
                                <?php _e( 'Cancel', 'ots-pro' ); ?>
                            </button>
                        </p>
                    </div>

               </div>

            <?php endif; ?>

        </div>
    </div>

<?php }

add_action( 'ots_admin_sidebar_widgets', 'ots_pro\portal\portal_status_widget' );