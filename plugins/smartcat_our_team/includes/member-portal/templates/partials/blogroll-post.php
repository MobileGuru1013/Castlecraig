<?php

namespace ots_pro\portal;

?>
<div class="post">

    <div class="panel panel-default">

    <div class="panel-body post-content">

        <div class="the-author">

            <div class="media">

                <div class="media-left">
                    <img class="media-object author-avatar" src="<?php echo esc_url( get_avatar_url( $post->post_author ) ); ?>">
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

        <h3 class="the-title">
            <a href="<?php echo esc_url( get_the_permalink( $post ) ); ?>"><?php esc_html_e( $post->post_title ); ?></a>
        </h3>

        <div class="the-excerpt">
            <p><?php echo get_the_excerpt( $post->ID ) ?></p>
        </div>
        
        <div class="the-thumbnail">
            <a href="<?php echo esc_url( get_the_permalink( $post ) ); ?>">
                <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
            </a>
        </div>

        <hr>

        <?php get_template( 'post-metadata', array( 'post' => $post ), true, false ); ?>

    </div>

    <div class="panel-footer">

        <?php

            $args = array(
                'post_id' => $post->ID,
                'order'   => 'DESC',
                'limit'   => 1
            );

            $comment = get_post_comments( $args );

        ?>

        <?php if ( !empty( $comment ) ) : ?>

            <div class="text-center row">

                <a href="#"
                   data-post-id="<?php esc_attr_e( $post->ID ); ?>"
                   data-page-num="1"
                   class="load-more-comments"><?php esc_html_e( get_option( Options::LOAD_MORE_COMMENTS_TEXT ) ); ?></a>

            </div>

        <?php endif; ?>

        <div class="comments">

            <div class="recent" data-append="after">

                <?php if ( !empty( $comment ) ) : ?>

                    <?php get_template( 'comment', array( 'comment' => current( $comment ) ), true, false ); ?>

                <?php endif; ?>

            </div>

            <div class="comment-form">

                <div class="media">

                    <div class="media-left media-middle">
                        <img src="<?php echo esc_url( \ots\get_member_avatar( get_member()->get_id() ) ); ?>" class="media-object comment-author-avatar">
                    </div>

                    <div class="media-body media-middle">

                        <form method="post">

                            <textarea name="comment" class="form-control comment-box" placeholder="<?php esc_html_e( get_option( Options::COMMENT_PLACEHOLDER_TEXT ) ); ?>"></textarea>

                            <input type="hidden" name="post_id" value="<?php esc_attr_e( $post->ID ); ?>">

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</div>