<?php

namespace ots_pro\portal;

?>

<?php get_header(); ?>

    <?php while( have_posts() ) : the_post(); ?>

        <div class="single post">

            <?php if ( has_post_thumbnail() ) : ?>

                <div class="post-image parallax"
                     style="background-image: url(<?php echo esc_url( get_the_post_thumbnail_url( get_post(), 'large' ) ); ?>)">
                </div>

            <?php endif; ?>

            <div class="container-fluid">

                <div class="content">

                    <div class="row">

                        <div class="col-sm-12">

                            <div class="panel panel-default">

                                <div class="panel-body">
                            
                                    <div class="the-author">

                                        <div class="media">

                                            <div class="media-left">
                                                <img class="media-object author-avatar" src="<?php echo esc_url( \ots\get_member_avatar( $post->post_author ) ); ?>">
                                            </div>

                                            <?php $author = get_userdata( $post->post_author ); ?>

                                            <div class="media-body media-middle">

                                                <h6 class="author-name"><?php echo "$author->first_name $author->last_name"; ?></h6>

                                                <div class="post-date">
                                                    <time><?php esc_html_e( get_the_time( 'F j @ g:ia', $post ) ); ?></time>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <hr>

                                    <h2 class="the-title"><?php the_title(); ?></h2>

                                    <?php get_template( 'post-metadata', array( 'post' => $post ) ); ?>

                                    <div class="the-content"><?php the_content(); ?></div>

                                </div>
                                
                            </div>
                            
                        </div>

                        <div class="col-sm-12">

                            <div class="comments">

                                <div class="panel panel-default">

                                    <div class="panel-body">

                                        <div class="comment-form">

                                            <div class="media">

                                                <div class="media-left media-middle">
                                                    <img src="<?php echo esc_url( \ots\get_member_avatar( get_member()->get_id() ) ); ?>" class="media-object comment-author-avatar">
                                                </div>

                                                <div class="media-body media-middle">

                                                    <form method="post">
                                                        <textarea name="comment" class="form-control comment-box" placeholder="<?php _e( 'Write a comment...', 'ots-pro' ); ?>"></textarea>
                                                        <input type="hidden" name="post_id" value="<?php esc_attr_e( $post->ID ); ?>">
                                                    </form>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="panel-footer">

                                        <div class="recent" data-append="before">

                                            <?php

                                                $args = array(
                                                    'post_id' => $post->ID,
                                                    'order'   => 'DESC',
                                                    'limit'   => -1
                                                );

                                                $comments = get_post_comments( $args );

                                            ?>

                                            <?php foreach( $comments as $comment ) : ?>

                                                <?php get_template( 'comment', array( 'comment' => $comment ), true, false ); ?>

                                            <?php endforeach; ?>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <?php wp_reset_postdata(); ?>

    <?php endwhile; ?>

<?php get_footer(); ?>