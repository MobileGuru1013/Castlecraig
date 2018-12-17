<?php

namespace ots_pro;

?>

<div id="sc_our_team" class="honeycombs sc-col<?php esc_html_e( get_option( \ots\Options::GRID_COLUMNS ) ); ?>">

    <?php if ( $members->have_posts() ) : ?>

        <?php while ( $members->have_posts() ) : $members->the_post(); ?>

            <?php $member = \ots\team_member(); ?>

            <div itemscope itemtype="http://schema.org/Person" class="sc_team_member comb" data-id="<?php the_ID(); ?>">

                <?php if( $single_template != 'disable' ) : ?>

                    <a href="<?php the_permalink() ?>" rel="bookmark" class="team_member_link">

                <?php endif; ?>

                    <?php \ots\member_avatar(); ?>

                    <span>

                        <b>

                            <?php if ( get_option( \ots\Options::DISPLAY_NAME ) == 'on' ) : ?>

                                <div itemprop="name" class="sc_team_member_name"><?php the_title() ?></div>

                            <?php endif; ?>

                            <?php if ( get_option( \ots\Options::DISPLAY_TITLE ) == 'on' ) : ?>

                                <div itemprop="jobtitle" class="sc_team_member_jobtitle"><?php esc_html_e( $member->title ); ?></div>

                            <?php endif; ?>

                        </b>

                    </span>

                <?php if( $single_template != 'disable' ) : ?>

                    </a>

                <?php endif; ?>

            </div>

            <?php wp_reset_postdata(); ?>

        <?php endwhile; ?>

    <?php else : ?>

        <?php _e( 'There are no team members to display.', 'ots-pro' ); ?>

    <?php endif; ?>

    <div class="clear"></div>

</div>