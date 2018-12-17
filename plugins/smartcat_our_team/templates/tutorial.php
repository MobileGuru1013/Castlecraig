<?php

namespace ots_pro;

?>


<style>
    #ucare-tutorial .wrap {
        padding: 15px;
    }

    #ucare-tutorial .postbox {
        padding: 15px;
    }

    #ucare-tutorial h1 {
        font-size: 40px;
        line-height: 44px;
    }

    #ucare-tutorial h3 {
        font-size: 24px;
        line-height: 28px;
    }
    
    #ucare-tutorial .notice,
    #message{
        display: none;
    }
    
    #ucare-tutorial li{
        font-size: 18px;
    }
    
    

</style>

<div id="ucare-tutorial">

    <div class="wrap">
        
        <div class="postbox">

            <h1><?php echo __( 'Our Team Showcase Pro ', 'ucare' ) . VERSION ?></h1>

            <p><?php _e( 'Our Team Showcase is WordPress\'s best plugin to showcase and manage Staff & Team Members', 'ucare' ); ?></p>           


            <hr>
            
            <h3><?php _e( 'New Features in 4.3.0', 'ucare' ); ?></h3>
            <ul>
                <li><?php _e( '- Added ability to <strong>Search for team members</strong> in Grid & Circle templates', 'ucare' ); ?></li>
                <li><?php _e( '- Added ability to <strong>filter team members</strong> to Grid & Circle templates', 'ucare' ); ?></li>
            </ul>

            <h3><?php _e( 'We re-wrote the way search and filtering works based on your feedback! Please take a minute to update your '
                    . 'search and filters in the plugin settings, or using the new shortcode parameters.', 'ots' ); ?></h3>
            
            <ul>
                <li>
                    <a href="<?php echo esc_url( admin_url( 'edit.php?post_type=team_member&page=ots-settings&tab=ots-team-search' ) ); ?>">
                        <?php _e( 'Go to Search & Filter settings', 'ots' ) ?>
                    </a>
                </li>
                <li>
                    <a target="_BLANK" href="http://wordpressteamplugin.com/templates/">
                        <?php _e( 'View Demo', 'ots' ) ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo esc_url( admin_url( 'edit.php?post_type=team_member&page=ots-docs' ) ); ?>">
                        <?php _e( 'Shortcode Details', 'ots' ) ?>
                    </a>
                </li>
            </ul>
            
            <hr>
            
            <p>
            <h3><?php _e( 'Search & Filter Preview', 'ots' ) ?></h3>
                <img src="<?php echo asset( 'images/search-demo.jpg' ); ?>"
            </p>
            
        </div>

    </div>
    
</div>