<?php

namespace ots_pro\portal;

?>

<?php get_header(); ?>


<div class="container">

    <div class="login-form panel panel-default">

        <?php if ( empty( $_REQUEST['reset'] ) ) : ?>

            <div class="row">

                <div class="col-sm-12">
                    <img class="logo img-responsive" src="<?php echo esc_url( get_option( Options::PORTAL_LOGO ) ); ?>" style="width: 150px"/>
                </div>

            </div>

            <div class="row">

                <form method="post" id="login-form" action="<?php echo esc_url( admin_url( 'admin-post.php?action=ots_portal_login' ) ); ?>">

                    <?php if( isset( $_REQUEST['error'] ) ) : ?>

                        <div class="col-sm-12">
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                                <?php esc_attr_e( $_REQUEST['error'] ); ?>
                            </div>
                        </div>

                    <?php endif; ?>

                    <div class="col-sm-12">

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon1">
                                    <span class="glyphicon glyphicon-user"></span>
                                </span>
                                <input type="text" class="form-control" placeholder="<?php _e( 'Username', 'ots-pro' ); ?>" name="login">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon1">
                                    <span class="glyphicon glyphicon-lock"></span>
                                </span>
                                <input type="password" class="form-control" placeholder="<?php _e( 'Password', 'ots-pro' ); ?>" name="pw">
                            </div>

                            <p class="pw-reset-link">
                                <a href="?reset=password"><?php _e( 'Forgot password?', 'ots-pro' ); ?></a>
                            </p>

                        </div>

                    </div>

                    <?php wp_nonce_field( 'portal_login', 'portal_login_nonce' ); ?>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <button id="login" class="btn btn-primary input-sm-12"><?php _e( 'Login', 'ots-pro' ); ?></button>
                        </div>
                    </div>
                    
                    <?php do_action( 'ots-portal-login-form' ); ?>
                    
                    
                </form>

            </div>

        <?php else : ?>

            <div class="row">

                <div class="col-sm-12">
                    <h2><?php esc_html_e( get_option( Options::RESET_PASSWORD_MESSAGE ) ); ?></h2>
                </div>

                <form method="post" id="login-form" action="<?php echo esc_url( admin_url( 'admin-post.php?action=ots_portal_reset_pw' ) ); ?>">

                    <?php if( isset( $_REQUEST['error'] ) ) : ?>

                        <div class="col-sm-12">
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                                <?php esc_attr_e( $_REQUEST['error'] ); ?>
                            </div>
                        </div>

                    <?php endif; ?>

                    <?php if( isset( $_REQUEST['message'] ) ) : ?>

                        <div class="col-sm-12">
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                                <?php esc_attr_e( $_REQUEST['message'] ); ?>
                            </div>
                        </div>

                    <?php endif; ?>

                    <div class="col-sm-12">

                        <div class="form-group">
                            <input type="text" class="form-control" name="login" placeholder="<?php _e( 'Username', 'ots-pro' ); ?>"/>
                        </div>

                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <button id="login" class="btn btn-primary input-sm-12"><?php _e( 'Reset Password', 'ots-pro' ); ?></button>
                        </div>

                    </div>

                    <?php wp_nonce_field( 'reset_password', 'reset_password_nonce' ); ?>

                </form>

            </div>

        <?php endif; ?>

    </div>

</div>


<?php get_footer(); ?>