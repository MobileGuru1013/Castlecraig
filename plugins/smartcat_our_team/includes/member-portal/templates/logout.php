<?php

namespace ots_pro\portal;

?>

<?php get_header(); ?>


    <div class="container logout-page">

        <div class="content">

            <div class="row">

                <div class="col-sm-12 text-center">
                    <div>
                        <img src="<?php echo esc_url( get_option( Options::PORTAL_LOGO ) ) ?>" width="150px"/>
                    </div>
                    <h2><?php esc_html_e( get_option( Options::LOGOUT_MESSAGE ) ); ?></h2>
                    <a class="btn btn-primary" href="<?php echo esc_url( get_the_permalink( get_option( Options::LOGIN_PAGE ) ) ); ?>">
                        <?php _e( 'Back to login', 'ots-pro' ); ?>
                    </a>
                </div>

            </div>

        </div>

    </div>


<?php get_footer(); ?>