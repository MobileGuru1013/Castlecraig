<?php

namespace ots_pro\portal;

?>

<?php get_header(); ?>

    <div class="container-fluid">

        <div class="content">

            <div class="row">

                <?php $widget = get_option( Options::WELCOME_MESSAGE ); ?>

                <?php if ( !empty( $widget ) ) : ?>

                    <div class="col-md-12">
                        <div class="panel panel-default portal-widget-area">
                            <div class="panel-body"><?php echo wp_kses_post( $widget ); ?></div>
                        </div>
                    </div>

                <?php endif; ?>

                <div class="col-md-8 col-md-push-4">

                    <div class="blogroll">

                        <div class="blogroll-posts">

                            <?php $posts = get_member_viewable_pages( null, 'post', get_option( Options::POSTS_PER_PAGE ) ); ?>

                            <?php get_template( 'blogroll-page', array( 'posts' => $posts, 'page' => 1 ) ); ?>

                        </div>

                        <div class="text-center">

                            <a class="load-more" href="#">
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                            </a>

                        </div>

                    </div>

                </div>

                <div class="col-md-4 col-md-pull-8">

                    <?php get_template( 'sidebar-content' ); ?>

                </div>

            </div>

        </div>

    </div>

<?php get_footer(); ?>