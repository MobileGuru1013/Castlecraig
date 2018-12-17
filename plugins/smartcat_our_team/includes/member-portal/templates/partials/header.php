<?php

namespace ots_pro\portal;

?>

<!doctype html>
<html>
    <head>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="<?php echo esc_url( OTS_PORTAL_ASSETS_URL . '/lib/bootstrap/css/bootstrap.min.css' );?>">
        <link rel="stylesheet" href="<?php echo esc_url( OTS_PORTAL_ASSETS_URL . '/fonts/style.css' ); ?>">
        <link rel="stylesheet" href="<?php echo esc_url( OTS_PORTAL_ASSETS_URL . '/css/layout.css' ); ?>">
        <link rel="stylesheet" href="<?php echo esc_url( OTS_PORTAL_ASSETS_URL . '/css/theme.css' ); ?>">
        <link rel="stylesheet" href="<?php echo \ots_pro\asset( 'lib/datatables/datatables.min.css' ); ?>">
        
        <script>

            const i10n = {
                ajax_url: '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>',
                ajax_nonce: '<?php echo esc_attr( wp_create_nonce( 'ots_portal_ajax' ) ); ?>'
            };

        </script>

        <?php get_template( 'dynamic-styles' ); ?>

    <?php do_action( 'ots-portal-head' ); ?>
        
    </head>
    
    <body class="ots-portal <?php echo get_option( Options::SKIN, Defaults::SKIN ); ?>">

    <?php do_action( 'ots-portal-body-top' ); ?>
        
    <?php $is_authenticated = Session::is_authenticated(); ?>

    <?php if ( $is_authenticated ) : ?>

        <?php get_template( 'sidebar-nav' ); ?>

    <?php endif; ?>

    <!-- Start page wrapper -->
    <div class="page-wrapper <?php echo $is_authenticated ? 'has-sidebar': ''; ?>">

        <div id="header">

            <?php if ( $is_authenticated ) : ?>

                <?php get_template( 'navbar' ); ?>

            <?php endif; ?>

        </div>