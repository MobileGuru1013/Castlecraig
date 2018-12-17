<?php

namespace ots_pro\portal;

?>

<div class="blogroll-page" data-page-num="<?php esc_attr_e( $page ); ?>">

    <?php if ( !empty( $posts ) ) : ?>

        <?php foreach ( $posts as $post ) : ?>

            <?php get_template( 'blogroll-post', array( 'post' => $post ), true, false ); ?>

        <?php endforeach; ?>

    <?php endif; ?>

</div>
