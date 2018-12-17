<?php

namespace ots_pro\portal;

?>


<nav class="navbar navbar-default">

    <div class="container-fluid">

        <div class="navbar-header">

            <div class="v-center-table">
                <div class="v-center">

                    <a href="#" class="navbar-toggle toggle-menu">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <a class="hidden-xs" href="<?php echo esc_url( get_the_permalink( get_option( Options::PORTAL_PAGE ) ) ); ?>">
                        <img class="logo" src="<?php echo esc_url( get_option( Options::PORTAL_LOGO ) ); ?>">
                    </a>

                </div>
            </div>

            <?php $user = get_member(); ?>


                <div id="navbar-primary">

                    <div class="profile">

                        <div class="v-center-table">
                            <div class="v-center">

                                <div class="dropdown hidden-xs">

                                    <div class="media">

                                        <div class="media-left media-middle">
                                            <a href="<?php echo esc_url( get_the_permalink( $user->get_id() ) ); ?>">
                                                <img src="<?php echo esc_url( \ots\get_member_avatar( $user->get_id() ) ); ?>" class="media-object profile-img" />
                                            </a>
                                        </div>

                                        <div class="media-body media-middle">

                                            <div class="dropdown-toggle" data-toggle="dropdown">

                                                <div class="navbar-text">
                                                    <div class="name">
                                                        <?php esc_html_e( $user->get_name() ); ?>
                                                    </div>
                                                    <div class="title">
                                                        <small><?php esc_html_e( $user->title ); ?></small>
                                                    </div>
                                                </div>

                                            </div>

                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="<?php echo esc_url( home_url() ); ?>">
                                                        <span class="glyphicon glyphicon-globe"></span> <?php _e( 'Back to site', 'ots-pro' ); ?>
                                                    </a>
                                                </li>
                                                <li role="separator" class="divider"></li>
                                                <li>
                                                    <a href="<?php echo esc_url( logout_link() ); ?>">
                                                        <span class="glyphicon glyphicon-log-out"></span> <?php echo get_option( Options::NAVBAR_LOGOUT_TEXT ); ?>
                                                    </a>
                                                </li>
                                            </ul>

                                        </div>

                                        <div class="media-right media-middle">
                                            <span class="caret"></span>
                                        </div>

                                    </div>

                                </div>

                                <div class="visible-xs">

                                    <img src="<?php echo esc_url( \ots\get_member_avatar( $user->get_id() ) ); ?>" class="media-object profile-img" />

                                </div>

                            </div>
                        </div>

                    </div>

                </div>



        </div>

    </div>

</nav>