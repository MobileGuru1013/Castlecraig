<?php

namespace ots_pro\portal;


$author = get_member( $comment->author_id );

?>

<div class="comment row">

    <div class="media comment-author">

        <div class="media-left media-middle">
            <img src="<?php echo esc_url( \ots\get_member_avatar( $comment->author_id ) ); ?>" class="media-object comment-author-avatar">
        </div>

        <div class="media-body media-middle">

            <strong><?php esc_html_e( $author->get_name() ); ?></strong>
            <div class="text-muted">
                <time><?php esc_html_e( relatime_diff( $comment->comment_date ) ); ?></time>
            </div>

        </div>

    </div>

    <div class="comment-content"><?php esc_html_e( $comment->content ); ?></div>
</div>
