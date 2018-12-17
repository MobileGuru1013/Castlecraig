<?php
/**
 * Functions for custom post types
 *
 * @since 4.4.2
 * @package ots_pro
 * @subpackage portal
 */
namespace ots_pro\portal;

// Add quick edit fields
add_action('bulk_edit_custom_box', 'ots_pro\portal\add_team_member_quick_edit_fields', 10, 2 );
add_action('quick_edit_custom_box', 'ots_pro\portal\add_team_member_quick_edit_fields', 10, 2 );

// Save quick edit
add_action( 'save_post', 'ots_pro\portal\save_team_member_quick_edit_fields', 10, 2 );

// Save bulk edit
add_action( 'wp_ajax_save_bulk_edit_team_member', 'ots_pro\portal\save_team_member_bulk_edit_fields' );

// Enqueue quick edit scripts
add_action( 'admin_enqueue_scripts', 'ots_pro\portal\enqueue_quick_edit_scripts' );

/**
 * Enqueue scripts for the quick edit box
 *
 * @action admin_enqueue_scripts
 *
 * @param string pagehook
 *
 * @since 4.4.2
 * @return void
 */
function enqueue_quick_edit_scripts( $pagehook ) {
    if ( 'edit.php' != $pagehook ) {
        return;
    }

    if ( get_post_type() === 'team_member' ) {
        $deps = array(
            'jquery',
            'wp-util'
        );
        wp_enqueue_script( 'ots-team-member-quick-edit', resolve_url( 'assets/admin/quick-edit-team-member.js' ), $deps, VERSION );
    }
}

/**
 * Add custom fields to the quick edit box
 *
 * @action quick_edit_custom_box
 *
 * @param string $column
 * @param string $post_type
 *
 * @since 4.4.2
 * @return void
 */
function add_team_member_quick_edit_fields( $column, $post_type ) {
    if ( $post_type !== 'team_member' || $column !== 'portal_status' ) {
        return;
    }
    wp_nonce_field( 'ots_inline_edit', 'ots_inline_edit' ); ?>
    <div class="clear"></div>
    <fieldset id="ots-inline-edit" class="inline-edit-col-left">
        <div class="inline-edit-col">
            <div class="inline-edit-group wp-clearfix">
                <label class="alignleft">
                    <span class="title"><?php _e( 'Portal Access', 'ots-pro' ); ?></span>
                    <span class="input-text-wrap">
                        <span class="ots-toggle">
                            <label class="switch">
                                <input id="ots-portal-active" name="team_member_status" type="checkbox">
                                <span class="slider round"></span>
                            </label>
                        </span>
                    </span>
                </label>
            </div>
        </div>
    </fieldset>
<?php }

/**
 * Save quick edit fields
 *
 * @action save_post
 *
 * @param int $post_id
 * @param \WP_Post $post
 *
 * @since 4.4.2
 * @return void
 */
function save_team_member_quick_edit_fields( $post_id, $post ) {
    if ( empty( $_POST ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( $post->post_type !== 'team_member' ) {
        return;
    }

    if ( !isset( $_POST['ots_inline_edit'] ) || !wp_verify_nonce( $_POST['ots_inline_edit'], 'ots_inline_edit' ) ) {
        return;
    }
    $status = '';

    if ( !empty( $_POST['team_member_status'] ) ) {
        $status = 'active';
    }

    update_post_meta( $post_id, 'team_member_status', $status );
}

/**
 * Save bulk edit fields
 *
 * @action wp_ajax_save_bulk_edit_team_member
 *
 * @since 4.4.2
 * @return void
 */
function save_team_member_bulk_edit_fields() {
    if ( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'ots_inline_edit' ) ) {
        return;
    }

    if ( empty( $_POST['post_ids'] ) ) {
        return;
    }
    $status = '';

    if ( !empty( $_POST['status'] ) && $_POST['status'] === 'active' ) {
        $status = 'active';
    }

    foreach ( $_POST['post_ids'] as $id ) {
        $post = get_post( $id );

        if ( !$post || $post->post_type !== 'team_member' ) {
            continue;
        }
        update_post_meta( $post->ID, 'team_member_status', $status );
    }
}