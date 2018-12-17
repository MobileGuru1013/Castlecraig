<?php

namespace ots_pro;

?>




<div id="sc_our_team" class="grid3 sc-col<?php esc_html_e( get_option( \ots\Options::GRID_COLUMNS ) ); ?> masonry">

    <div class="grid-sizer"></div>
    <div class="gutter-sizer"></div>

    <?php if ( $members->have_posts() ) : ?>

        <?php while ( $members->have_posts() ) : $members->the_post(); ?>

            <?php $member = \ots\team_member(); ?>

            <?php $groups = \ots\member_groups( null, ';', false ); ?>

            <div itemscope itemtype="http://schema.org/Person"
                 class="sc_team_member"
                 data-group="<?php echo !empty( $groups ) ? $groups : 'groupless'; ?>"
                 data-id="<?php the_ID(); ?>">

                <div class="sc_team_member_inner">

                    <?php $avatar = \ots\get_member_avatar(); ?>

                    <div class="image-container wp-post-image" style="background-image: url(<?php echo esc_url( $avatar ); ?>);" data-url="<?php echo esc_url( $avatar ); ?>">

	                    <?php if( $single_template != 'disable' ) : ?>

                            <a href="<?php the_permalink() ?>" rel="bookmark" class="team_member_link"></a>

                        <?php endif; ?>

                    </div>

                    <?php if ( get_option( \ots\Options::DISPLAY_NAME ) ) : ?>

                        <div itemprop="name" class="sc_team_member_name">

                            <?php if( $single_template != 'disable' ) : ?>

                                <a href="<?php the_permalink() ?>" rel="bookmark" class="team_member_link"><?php the_title() ?></a>

                            <?php else : ?>

                                <?php the_title(); ?>

                            <?php endif; ?>

                        </div>

                    <?php endif; ?>

                    <hr>

                    <?php if ( get_option( \ots\Options::DISPLAY_TITLE ) ) : ?>

                        <div itemprop="jobtitle" class="sc_team_member_jobtitle"><?php esc_html_e( $member->title ); ?></div>

                    <?php endif; ?>

                    <div class="sc_team_content_short">
                        <?php echo wp_trim_words( get_the_content(), get_option( Options::MAX_WORD_COUNT ) ); ?>
                    </div>

                    <?php if( get_option( \ots\Options::SHOW_SOCIAL ) == 'on' ) : ?>

                        <div class="icons"><?php \ots\do_member_social_links(); ?></div>

                    <?php endif; ?>

                </div>

            </div>

            <?php wp_reset_postdata(); ?>

        <?php endwhile; ?>

    <?php else : ?>

        <?php _e( 'There are no team members to display.', 'ots-pro' ); ?>

    <?php endif; ?>

    <div class="clear"></div>

</div>

