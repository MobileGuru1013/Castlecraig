<?php

namespace ots_pro\portal;


$views = get_post_views( $post );
$likes = get_post_likes( $post );


$viewed_by = list_member_names( array_map( function( $view ) { return $view['user_id']; }, $views ), '<br>' );
$liked_by = list_member_names( array_map( function( $like ) { return $like['user_id']; }, $likes ), '<br>' );

?>

<?php $comments = count_post_comments( $post ) ?: 0 ?>

<div class="post-metadata">

    <span class="metadata">

        <a href="#"
           class="inline-items"
           title="<?php esc_attr_e( $viewed_by ); ?>"
           data-toggle="tooltip"
           data-placement="bottom">

            <span class="glyphicon glyphicon-eye-open"></span> <span class="count"><?php esc_attr_e( count( $views ) ); ?></span>

        </a>


        <a href="#"
           class="like-post inline-items"
           title="<?php esc_attr_e( $liked_by ); ?>"
           data-toggle="tooltip"
           data-placement="bottom"
           data-id="<?php esc_attr_e( $post->ID ); ?>"
           data-liked="<?php echo member_liked_post( $post ) ? 'true' : 'false' ; ?>">

            <span class="glyphicon liked"></span> <span class="count"><?php esc_attr_e( count( $likes ) ); ?></span>

        </a>

        <span class="inline-items comment-count">
            <span class="glyphicon glyphicon-comment <?php echo $comments > 0 ? 'comments-exist' : ''; ?>"></span> <span class="count count-comments"><?php esc_attr_e( $comments ); ?></span>
        </span>

    </span>

</div>
