<?php

namespace ots_pro\portal;


function post_categories( $post = false, $separator = ' ', $field = 'name', $echo = true ) {

    $categories = is_a( $post, '\WP_Post' ) ? get_the_category( $post->ID ) : get_the_category( $post );
    $output = '';

    if ( !empty( $categories ) ) {

        foreach( $categories as $category ) {
            $output .= $category->$field . $separator;
        }

        $output = trim( $output, $separator );

        if ( $echo ) {
            esc_html_e( $output );
        }

    }

    return $output;

}


function get_member_viewable_pages( $member = null , $post_type = 'page', $limit = -1, $page = 1 ) {

    $member   = get_member( $member );
    $viewable = array();

    $args = array(
        'post_type'      => $post_type,
        'posts_per_page' => $limit,
        'paged'          => $page,
        'meta_key'       => 'stp_restrict',
        'meta_value'     => 'on'
    );

    $q = new \WP_Query( $args );

    if ( $member ) {

        foreach ( $q->posts as $page ) {

            if ( member_can_access( $page, $member ) ) {
                $viewable[] = $page;
            }

        }

    }

    return $viewable;

}


function is_post_protected( $post = null ) {

    $post = get_post( $post );

    if ( $post && get_post_meta( $post->ID, 'stp_restrict', true ) == 'on' ) {
        return true;
    }

    return false;

}


function member_can_access( $post = null, $member = null ) {

    $member = get_member( $member );
    $post   = get_post( $post );

    if ( $post && $member ) {

        if ( get_post_meta( $post->ID, 'stp_restrict', true ) == 'on' ) {

            if ( get_post_meta( $post->ID, 'stp_access', true ) == 'group' ) {

                $groups  = array_map( function ( $group ) { return $group->term_id; }, $member->get_groups() );
                $allowed = get_post_meta( $post->ID, 'stp_groups', true ) ?: array();

                $intersect = array_intersect( $groups, $allowed );

                return !empty( $intersect );

            }

        }

    }

    return true;

}


function like_post( $post = null, $member = null ) {

    global $wpdb;

    $post   = get_post( $post );
    $member = get_member( $member );

    if ( $member && $post )  {

        if ( member_can_access( $post, $member ) && !member_liked_post( $post, $member ) ) {

            $data = array(
                'post_id' => $post->ID,
                'user_id' => $member->get_id()
            );

            $wpdb->insert( "{$wpdb->prefix}team_post_likes", $data );

        }

    }

}


function unlike_post( $post = null, $member = null ) {

    global $wpdb;

    $post   = get_post( $post );
    $member = get_member( $member );

    if ( $member && $post ) {

        if ( member_can_access( $post, $member ) && member_liked_post( $post, $member ) ) {

            $where = array(
                'user_id' => $member->get_id(),
                'post_id' => $post->ID
            );

            return $wpdb->delete( "{$wpdb->prefix}team_post_likes", $where ) > 0;

        }

    }

    return false;

}


function member_liked_post( $post = null, $member = null ) {

    global $wpdb;

    $post   = get_post( $post );
    $member = get_member( $member );

    if ( $post && $member ) {

        $q = "SELECT * 
              FROM {$wpdb->prefix}team_post_likes 
              WHERE post_id = %d && user_id = %d";

        return $wpdb->get_var( $wpdb->prepare( $q, $post->ID, $member->get_id() ) ) > 0;

    }

    return false;

}


function count_post_likes( $post = null ) {

    global $wpdb;

    $post = get_post( $post );

    if ( $post ) {

        $q = "SELECT COUNT( * ) 
              FROM {$wpdb->prefix}team_post_likes
              WHERE post_id = %d";

        return $wpdb->get_var( $wpdb->prepare( $q, $post->ID ) );

    }

    return 0;

}


function count_unique_post_views( $post = null ) {

    global $wpdb;

    $post = get_post( $post );

    if ( $post ) {

        $q = "SELECT COUNT( * ) 
              FROM {$wpdb->prefix}team_post_views 
              WHERE post_id = %d";

        return $wpdb->get_var( $wpdb->prepare( $q, $post->ID ) );

    }

    return 0;

}


function get_post_likes( $post = null ) {

    global $wpdb;

    $post = get_post( $post );

    if ( $post ) {

        $sql = "SELECT * 
                FROM {$wpdb->prefix}team_post_likes
                WHERE post_id = %d";

        return $wpdb->get_results( $wpdb->prepare( $sql, $post->ID ), ARRAY_A );

    }

    return array();

}


function get_post_views( $post = null ) {

    global $wpdb;

    $post = get_post( $post );

    if ( $post ) {
        $sql = "SELECT * 
                FROM {$wpdb->prefix}team_post_views
                WHERE post_id = %d";

        return $wpdb->get_results( $wpdb->prepare( $sql, $post->ID ), ARRAY_A );

    }

    return array();

}


function member_viewed_post( $post = null, $member = null ) {

    global $wpdb;

    $post   = get_post( $post );
    $member = get_member( $member );

    if ( $post && $member ) {

        $q = "SELECT * 
              FROM {$wpdb->prefix}team_post_views 
              WHERE post_id = %d && user_id = %d";

        return $wpdb->get_var( $wpdb->prepare( $q, $post->ID, $member->get_id() ) ) > 0;

    }

    return false;

}


function increment_post_views() {

    global $wpdb;

    if ( is_single() && is_post_protected() ) {

        $total_views = get_post_meta( get_the_ID(), 'stp_views', true );

        // Update the total lifetime number of views
        update_post_meta( get_the_ID(), 'stp_views', $total_views + 1 );

        if ( !member_viewed_post() ) {

            $data = array(
                'post_id' => get_the_ID(),
                'user_id' => get_member()->get_id()
            );

            $wpdb->insert( "{$wpdb->prefix}team_post_views", $data );

        }

    }

}

add_action( 'template_redirect', 'ots_pro\portal\increment_post_views', 100 );


function add_post_meta_boxes() {

    if ( can_restrict_post() ) {

        add_meta_box(
            'team-portal-restriction',
            __( 'Member Portal Restriction', 'ots-pro' ),
            'ots_pro\portal\restriction_meta_box',
            null,
            'normal',
            'high'
        );

    }

}

add_action( 'add_meta_boxes', 'ots_pro\portal\add_post_meta_boxes' );


function can_restrict_post() {

    $allowed_types = array(
        'post',
        'page'
    );

    return

        // Make sure we have a valid post type
        in_array( get_post_type(), $allowed_types ) &&

        // Don't show on the blog page
        get_the_ID() != get_option( 'page_for_posts' ) &&

        // Don't show on portal pages
        !( is_portal_page() || is_edit_profile_page() || is_login_page() || is_logout_page() );

}


function save_restrict_metabox( $post_id ) {

    if ( isset( $_POST['restrict_meta_box_nonce'] ) &&
         wp_verify_nonce( $_POST['restrict_meta_box_nonce'], 'save_restrict_meta_box' ) ) {

        update_post_meta( $post_id, 'stp_restrict', \ots\sanitize_checkbox( $_POST['stp_restrict'] ) );

        if ( in_array( $_POST['stp_access'], array( 'all', 'group' ) ) ) {
            update_post_meta( $post_id, 'stp_access', $_POST['stp_access'] );
        }

        update_post_meta( $post_id, 'unauthorized_redirect', sanitize_page_id( $_POST['stp_unauthorized_redirect'] ) );
        update_post_meta( $post_id, 'wrong_group_redirect',  sanitize_page_id( $_POST['stp_wrong_group_redirect']  ) );

        if ( !empty( $_POST['stp_groups'] ) ) {

            $groups    = $_POST['stp_groups'];
            $group_ids = array_keys( \ots\get_groups() );

            foreach ( $groups as $group ) {

                if ( !in_array( $group, $group_ids ) ) {
                    unset( $groups[ $group ] );
                }

            }

            update_post_meta( $post_id, 'stp_groups', $groups );

        }

    }

}

add_action( 'save_post', 'ots_pro\portal\save_restrict_metabox' );


function restriction_meta_box( \WP_Post $post ) { ?>

    <?php wp_nonce_field( 'save_restrict_meta_box', 'restrict_meta_box_nonce' ); ?>

    <?php $restrict = get_post_meta( $post->ID, 'stp_restrict', true ); ?>

    <table id="ots-portal-restriction" class="ots-meta-box widefat">

        <tbody>
            <tr>
                <th>
                    <label for="ots-portal-restrict"><?php _e( 'Restrict Content', 'ots-pro' ); ?></label>
                </th>
                <td>
                    <input name="stp_restrict"
                           value="off"
                           type="hidden" />
                        <div class="ots-toggle">

                            <label class="switch">
                                <input id="ots-portal-restrict"
                                       name="stp_restrict"
                                       value="on"
                                       type="checkbox" <?php checked( 'on', $restrict ); ?>  />
                                <span class="slider round"></span>
                            </label>

                            <?php _e( 'Only allow Team Members to view this content', 'ots-pro' ); ?>
                        </div>
                </td>
            </tr>
        </tbody>

        <tbody style="<?php echo $restrict == 'on' ? '' : 'display: none;'; ?>" id="ots-portal-restrict-access">

            <tr>
                <th>
                    <label><?php _e( 'Unauthorized Redirect', 'ots-pro' ); ?></label>
                </th>
                <td>
                    <?php

                        $args = array(
                            'name'     => 'stp_unauthorized_redirect',
                            'selected' => get_post_meta( $post->ID, 'unauthorized_redirect', true )
                        );

                    ?>

                    <?php page_dropdown( $args ); ?>

                </td>
            </tr>

            <?php $access = get_post_meta( $post->ID, 'stp_access', true ); ?>

            <tr>
                <th>
                    <label><?php _e( 'Allow Access', 'ots-pro' ); ?></label>
                </th>
                <td>
                    <fieldset>
                        <label>
                            <input checked type="radio" name="stp_access" value="all" <?php checked( 'all', $access ); ?> />
                            <?php _e( 'All logged in members', 'ots-pro' ); ?>
                        </label>
                        <br>
                        <label>
                            <input type="radio" name="stp_access" value="group" <?php checked( 'group', $access ); ?> />
                            <?php _e( 'Only selected groups', 'ots-pro' ); ?>
                        </label>
                    </fieldset>
                </td>
            </tr>

            <?php $groups   =  \ots\get_groups(); ?>
            <?php $selected = get_post_meta( $post->ID, 'stp_groups', true ) ?: array(); ?>

        </tbody>

        <tbody style="<?php echo $access == 'group' ? '' : 'display: none;'; ?>" id="ots-portal-restrict-groups">

            <tr>
                <th>
                    <label><?php _e( 'Wrong Group Redirect', 'ots-pro' ); ?></label>
                </th>
                <td>

                    <?php

                    $args = array(
                        'name'     => 'stp_wrong_group_redirect',
                        'selected' => get_post_meta( $post->ID, 'wrong_group_redirect', true )
                    );

                    ?>

                    <?php page_dropdown( $args ); ?>

                </td>
            </tr>

            <tr>
                <th>
                    <label><?php _e( 'Allowed Groups', 'ots-pro' ); ?></label>
                </th>
                <td>
                    <fieldset>

                        <?php foreach ( $groups as $id => $name ) : ?>

                            <label>

                                <input type="checkbox"
                                       name="stp_groups[]"
                                       value="<?php esc_attr_e( $id ); ?>"

                                    <?php checked( true, in_array( $id, $selected ) ); ?> />

                                <?php esc_html_e( $name ); ?>

                            </label>

                            <br>

                        <?php endforeach; ?>

                    </fieldset>
                </td>
            </tr>
        </tbody>

    </table>


<?php }


function add_custom_post_columns( $columns ) {

    $left = array_splice( $columns, 0, 2 );

    $custom = array(
        'portal_status' => __( 'Portal Status', 'ots-pro' )
    );

    return array_merge( $left, $custom, $columns );

}

add_filter( 'manage_pages_columns', 'ots_pro\portal\add_custom_post_columns' );
add_filter( 'manage_post_posts_columns', 'ots_pro\portal\add_custom_post_columns' );


function do_posts_custom_columns( $column, $post_id ) {

    if ( can_restrict_post() ) {

        switch ( $column ) {

            case 'portal_status':

                $status = get_post_meta( $post_id, 'stp_restrict', true );
                $access = get_post_meta( $post_id, 'stp_access', true );

                printf( '<span class="stp-status %s"></span>', $status == 'on' ? 'active' : '' );

                if ( $status == 'on' ) {
                    if ( $access == 'all' ) {
                        _e( 'Members Only', 'ots-pro' );
                    } else {

                        $groups = get_post_meta( $post_id, 'stp_groups', true );

                        if ( !empty( $groups ) ) {

                            $str = __( 'Only ', 'ots-pro' );

                            foreach ( $groups as $group ) {

                                $group = get_term( $group );

                                if ( $group ) {
                                    $str .= get_term( $group )->name . ', ';
                                }

                            }

                            echo rtrim( $str, ', ' );

                        }

                    }
                } else {
                    _e( 'Public', 'ots-pro' );
                }

                break;

        }

    } else {
        echo '—';
    }



}

add_action( 'manage_pages_custom_column', 'ots_pro\portal\do_posts_custom_columns', 10, 2 );
add_action( 'manage_post_posts_custom_column', 'ots_pro\portal\do_posts_custom_columns', 10, 2 );
