<?php

namespace ots_pro\portal;

?>

<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

    <div class="single post page">

        <?php if ( has_post_thumbnail() ) : ?>

            <div class="post-image parallax"
                 style="background-image: url(<?php echo esc_url( get_the_post_thumbnail_url( get_post(), 'large' ) ); ?>)">
            </div>

        <?php endif; ?>

        <div class="container-fluid">

            <div class="content">

                <div class="row">

                    <div class="col-md-8 col-md-push-4">
                        
                        <div class="post">
                            
                            <div class="panel panel-default">
                                
                                <div class="panel-heading">
                                    <h2 class="the-title"><?php the_title(); ?></h2>
                                </div>
                                
                                <div class="panel-body the-content"><?php the_content(); ?></div>                                
                                
                            </div>

                        </div>

                    </div>

                    <div class="col-md-4 col-md-pull-8">

                        <?php get_template( 'sidebar-content' ); ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <?php wp_reset_postdata(); ?>

<?php endwhile; ?>

<?php get_footer(); ?>