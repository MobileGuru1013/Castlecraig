<?php

namespace ots_pro\portal;


$member = get_member();

?>

<?php get_header(); ?>

    <div id="edit-profile" class="profile">

        <div class="container-fluid">

            <div class="content">

                <div class="panel panel-default profile-header">

                    <div class="panel-body">

                        <div class="cover-photo col-sm-12 <?php echo has_cover_photo( $member ) ? '' : 'no-cover-photo'; ?>"
                             style="background-image: url(<?php echo esc_url( get_cover_photo( $member ) ); ?>)">
                        </div>

                        <div class="profile-img col-sm-12">
                            <img class="img-responsive"
                                 src="<?php echo esc_url( \ots\get_member_avatar( $member->get_id() ) ); ?>">
                        </div>

                        <div class="name text-center col-sm-12">

                            <h2><?php esc_html_e( $member->get_name() ); ?></h2>

                            <small class="text-muted"><?php esc_html_e( $member->title ); ?></small>

                            <?php $groups = $member->get_groups(); ?>

                            <?php if ( count( $groups ) > 1 ) : ?>

                                <div>

                                    <?php foreach ( $groups as $group ) : ?>

                                        <div class="label label-default"><?php esc_html_e( $group->name ); ?></div>

                                    <?php endforeach; ?>

                                </div>

                            <?php elseif ( count( $groups ) > 0 ) : ?>

                                <div class="label label-default"><?php esc_html_e( current( $groups )->name ); ?></div>

                            <?php endif; ?>

                        </div>

                    </div>

                </div>

                <div class="page-top">

                    <h2><?php esc_html_e( get_option( Options::PROFILE_EDIT_TITLE ) ); ?></h2>

                    <a class="btn btn-default pull-right" href="<?php echo esc_url( get_the_permalink( $member->get_id() ) ); ?>">
                        <?php _e( 'Preview', 'ots-pro' ); ?>
                    </a>

                </div>

                <hr>

                <?php if( isset( $_REQUEST['error'] ) ) : ?>

                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                        <?php esc_attr_e( $_REQUEST['error'] ); ?>
                    </div>

                <?php endif; ?>

                <?php if( isset( $_REQUEST['message'] ) ) : ?>

                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                        <?php esc_attr_e( $_REQUEST['message'] ); ?>
                    </div>

                <?php endif; ?>

                <form method="post" enctype="multipart/form-data" action="<?php echo esc_url( admin_url( 'admin-post.php?action=ots_portal_update_avatar' ) ); ?>">

                    <?php wp_nonce_field( 'update_avatar', 'update_avatar_nonce' ); ?>

                    <div class="form-group">
                        <label><?php _e( 'Upload Profile Image', 'ots-pro' ) ?></label>
                        <input type="file" class="form-control" name="avatar" />
                    </div>

                    <input type="submit" value="<?php _e( 'Update Profile Image', 'ots-pro' ); ?>" class="btn btn-primary" />

                </form>

                <hr>

                <form method="post" enctype="multipart/form-data" action="<?php echo esc_url( admin_url( 'admin-post.php?action=ots_portal_update_cover_photo' ) ); ?>">

                    <?php wp_nonce_field( 'update_cover_photo', 'update_cover_photo_nonce' ); ?>

                    <div class="form-group">
                        <label><?php _e( 'Upload Cover Photo', 'ots-pro' ) ?></label>
                        <input type="file" class="form-control" name="cover_photo" />
                    </div>

                    <input type="submit" value="<?php _e( 'Update Cover Photo', 'ots-pro' ); ?>" class="btn btn-primary" />

                    <a href="<?php echo esc_url( admin_url( 'admin-post.php?action=ots_portal_remove_cover_photo&nonce=' . wp_create_nonce( 'remove_cover_photo' ) ) ); ?>"
                       class="btn btn-default">
                        <?php _e( 'Remove Cover Photo' ); ?>
                    </a>

                </form>

                <hr>

                <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php?action=ots_portal_update_profile' ) ); ?>">

                    <?php wp_nonce_field( 'update_profile', 'update_profile_nonce' ); ?>

                    <div class="form-group">
                        <label><?php _e( 'Name', 'ots-pro' ); ?></label>
                        <input class="form-control" type="text" name="name" value="<?php  esc_attr_e( $member->get_name() ); ?>" />
                    </div>

                    <div class="form-group">
                        <label><?php _e( 'Title', 'ots-pro' ); ?></label>
                        <input class="form-control" type="text" name="title" value="<?php esc_attr_e( $member->title ); ?>" />
                    </div>

                    <div class="bio form-group">
                        <label><?php _e( 'Bio', 'stp' ); ?></label>
                        <textarea rows="10" id="bio" name="bio" class="form-control"><?php echo esc_textarea( $member->get_bio() ); ?></textarea>
                    </div>

                    <hr>

                    <div id="social">

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="text" name="email" class="form-control" value="<?php echo esc_attr( $member->email ); ?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-phone-alt"></span>
                                </span>
                                <input type="text" name="phone" class="form-control" value="<?php echo esc_attr( $member->phone ); ?>" placeholder="(123) 456-7890"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="icon-facebook"></span>
                                </span>
                                <input type="text" name="links[facebook]" class="form-control" value="<?php echo esc_attr( $member->facebook ); ?>" placeholder="http://" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="icon-twitter"></span>
                                </span>
                                <input type="text" name="links[twitter]" class="form-control" value="<?php echo esc_attr( $member->twitter ); ?>" placeholder="http://" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="icon-linkedin"></span>
                                </span>
                                <input type="text" name="links[linkedin]" class="form-control" value="<?php echo esc_attr( $member->linkedin ); ?>" placeholder="http://" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="icon-google"></span>
                                </span>
                                <input type="text" name="links[gplus]" class="form-control" value="<?php echo esc_attr( $member->gplus ); ?>" placeholder="http://" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="icon-instagram"></span>
                                </span>
                                <input type="text" name="links[instagram]" class="form-control" value="<?php echo esc_attr( $member->instagram ); ?>" placeholder="http://" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="icon-pinterest"></span>
                                </span>
                                <input type="text" name="links[pinterest]" class="form-control" value="<?php echo esc_attr( $member->pinterest ); ?>" placeholder="http://" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-globe"></span>
                                </span>
                                <input type="text" name="links[website]" class="form-control" value="<?php echo esc_attr( $member->website ); ?>" placeholder="http://" />
                            </div>
                        </div>


                        <input type="submit" value="<?php _e( 'Update About Me', 'ots-pro' ); ?>" class="btn btn-primary" />

                    </div>

                </form>

                <hr>

                <div id="change-password">

                    <form method="post" autocomplete="off" action="<?php echo esc_url( admin_url( 'admin-post.php?action=ots_portal_update_pw' ) ); ?>">

                        <div class="form-group">
                            <label><?php _e( 'Old password', 'ots-pro' ); ?></label>
                            <input type="password" name="old_password" class="form-control" autocomplete="off" />
                        </div>

                        <div class="form-group">
                            <label><?php _e( 'New password', 'ots-pro' ); ?></label>
                            <input type="password" name="password1" class="form-control" autocomplete="off" />
                        </div>

                        <div class="form-group">
                            <label><?php _e( 'Confirm new password', 'ots-pro' ); ?></label>
                            <input type="password" name="password2" class="form-control" autocomplete="off" />
                        </div>

                        <?php wp_nonce_field( 'update_password', 'update_password_nonce' ); ?>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="<?php _e( 'Change Password', 'ots-pro' ); ?>"/>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

<?php get_footer(); ?>