<?php

namespace ots_pro;

?>

<div id="sc_our_team" class="carousel">

    <?php if ( $members->have_posts() ) : ?>

        <?php while ( $members->have_posts() ) : $members->the_post(); ?>

            <?php $member = \ots\team_member(); ?>

            <div itemscope itemtype="http://schema.org/Person" class="sc_team_member" data-id="<?php the_ID(); ?>">

                <div class="sc_team_member_inner">

	                <?php if( $single_template != 'disable' ) : ?>

                        <a href="<?php the_permalink() ?>" rel="bookmark" class="team_member_link">

                            <?php \ots\member_avatar(); ?>

                        </a>

                    <?php else : ?>

	                    <?php \ots\member_avatar(); ?>

                    <?php endif; ?>

                    <?php if ( get_option( \ots\Options::DISPLAY_NAME ) == 'on' ) : ?>

                        <div itemprop="name" class="sc_team_member_name">

                            <?php if( $single_template != 'disable' ) : ?>

                                <a href="<?php the_permalink() ?>" rel="bookmark" class="team_member_link"><?php the_title() ?></a>

                            <?php else : ?>

                                <?php the_title(); ?>

                            <?php endif; ?>

                        </div>

                    <?php endif; ?>

                    <?php if ( get_option( \ots\Options::DISPLAY_TITLE ) == 'on' ) : ?>

                        <div itemprop="jobtitle" class="sc_team_member_jobtitle"><?php esc_html_e( $member->title ); ?></div>

                    <?php endif; ?>

                    <div>
                        <?php echo wp_trim_words( get_the_content( '...' ), get_option( Options::MAX_WORD_COUNT ) ); ?>
                    </div>

                    <?php $quote = $member->quote; ?>

                    <?php if( !empty( $quote ) ) : ?>

                        <div class="sc_personal_quote">
                            <span class="sc_team_icon-quote-left"></span>
                            <span class="sc_personal_quote_content"><?php esc_html_e( $quote ); ?></span>
                        </div>

                    <?php endif; ?>

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