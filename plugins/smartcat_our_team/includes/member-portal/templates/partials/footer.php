<?php

namespace ots_pro\portal;


$navbar =  array(
    'menu'              => 'ots_portal_footer',
    'theme_location'    => 'portal_footer',
    'depth'             => 2,
    'container'         => 'div',
    'container_id'      => 'ots-portal-footer-navbar',
    'menu_class'        => 'nav navbar-nav',
    'fallback_cb'       => 'cdemo\BootstrapNavWalker::fallback',
    'walker'            => new BootstrapNavWalker()
);


?>

        </div><!-- End page wrapper -->

        <footer id="footer">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-sm-6 footer-left">
                        <nav class="navbar">
                            <p class="navbar-text copyright text-center"><?php esc_html_e( get_option( Options::COPYRIGHT_TEXT ) ); ?></p>
                        </nav>
                    </div>

                    <div class="col-sm-6 footer-right">
                        <nav class="navbar">

                            <?php wp_nav_menu( $navbar ); ?>

                        </nav>
                    </div>

                </div>

            </div>

        </footer>

        <script src="<?php echo esc_url( OTS_PORTAL_ASSETS_URL . 'lib/jquery/jquery.min.js' ); ?>"></script>

        <script src="<?php echo esc_url( OTS_PORTAL_ASSETS_URL . 'js/script.js' ); ?>"></script>

        <script src="<?php echo esc_url( OTS_PORTAL_ASSETS_URL . 'lib/bootstrap/js/bootstrap.min.js' ); ?>"></script>

        <script src="<?php echo \ots_pro\asset( 'lib/datatables/datatables.min.js' ); ?>"></script>
        
        <script>

            jQuery(document).ready(function () {
                tinymce.init({
                    toolbar: 'styleselect bold italic alignleft aligncenter alignright justify outdent indent',
                    selector : "#bio",
                    branding: false,
                    statusbar: false,
                    menubar: false,
                    plugins: ["wpautoresize"],
                    wp_autoresize_on: true,
                    content_css: [
                        '<?php echo esc_url( resolve_url( 'assets/tinymce/css/content.css' ) ) ; ?>'
                    ]
                });
                
            });

        </script>

        <script src="<?php echo esc_url( includes_url( 'js/tinymce/wp-tinymce.php' ) ); ?>"></script>

        <?php do_action( 'ots-portal-footer' ); ?>
        
        <?php get_template( 'dynamic-scripts' ); ?>

    </body>
</html>
