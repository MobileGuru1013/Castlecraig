<?php

namespace ots_pro\portal;

?>

<div id="sidebar">

    <ul>

        <li>

            <a href="#" class="toggle-menu">

                <span class="icon open glyphicon glyphicon-menu-hamburger"></span>
                <span class="icon close" style="display: none">&times;</span>

                <span><?php _e( 'Close Menu', 'ots-pro' ); ?></span>

            </a>

        </li>

        <?php $permalink = get_the_permalink( get_option( Options::PORTAL_PAGE ) ); ?>

        <li class="<?php echo $permalink == get_permalink() ? 'active' : ''; ?>">

            <a href="<?php echo esc_url( $permalink ); ?>">

                <span class="icon glyphicon glyphicon-home"></span>

                <span><?php esc_html_e( get_option( Options::NAVBAR_HOME_TEXT ) ); ?></span>

            </a>

        </li>

        <?php $permalink = get_the_permalink( get_member()->get_id() ); ?>

        <li class="<?php echo $permalink == get_permalink() ? 'active' : ''; ?>">

            <a href="<?php echo esc_url( $permalink ); ?>">

                <span class="icon glyphicon glyphicon glyphicon-user"></span>

                <span><?php esc_html_e( get_option( Options::NAVBAR_PROFILE_TEXT ) ); ?></span>

            </a>

        </li>

        <li>

            <a href="<?php echo esc_url( logout_link() ); ?>">

                <span class="icon glyphicon glyphicon glyphicon-log-out"></span>

                <span><?php esc_html_e( get_option( Options::NAVBAR_LOGOUT_TEXT ) ); ?></span>

            </a>

        </li>

    </ul>

</div>