<?php

namespace ots_pro;

?>

<div id="sc_our_team" class="stacked">

    <?php if ( $members->have_posts() ) : ?>

        <?php while ( $members->have_posts() ) :  $members->the_post(); ?>

            <?php $groups = \ots\member_groups( null, ';', false ); ?>
            <?php $member = \ots\team_member(); ?>

            <div itemscope itemtype="http://schema.org/Person" 
                 class="sc_team_member" 
                 data-id="<?php the_ID(); ?>"
                data-group="<?php echo !empty( $groups ) ? $groups : 'groupless'; ?>">

                <div class="sc_team_member_left">

	                <?php if( $single_template != 'disable' ) : ?>

                        <a href="<?php the_permalink() ?>" rel="bookmark" class="team_member_link">

			                <?php \ots\member_avatar(); ?>

                        </a>

	                <?php else : ?>

		                <?php \ots\member_avatar(); ?>

	                <?php endif; ?>

                    <?php if( get_option( \ots\Options::DISPLAY_NAME ) == 'on' ) : ?>

                        <h2 itemprop="name" class="sc_team_member_name">

                            <?php if( $single_template != 'disable' ) : ?>

                                <a href="<?php the_permalink() ?>"
                                   rel="bookmark"
                                   title="<?php the_title_attribute(); ?>"
                                   class="team_member_link">
                                    <?php the_title() ?>
                                </a>

                            <?php else : ?>

                                <?php the_title(); ?>

                            <?php endif; ?>

                        </h2>

                    <?php endif; ?>


                    <?php if ( get_option( \ots\Options::DISPLAY_NAME ) == 'on' ) : ?>

                        <h3 itemprop="jobtitle" class="sc_team_member_jobtitle"><?php esc_html_e( $member->title ); ?></h3>

                    <?php endif; ?>

                </div>

                <div class="sc_team_member_right">

                    <?php $quote = $member->quote; ?>

                    <?php if ( !empty( $quote ) ) : ?>

                        <div class="sc_personal_quote">
                            <span class="sc_team_icon-quote-left"></span>
                            <span class="sc_personal_quote_content"><?php esc_html_e( $quote ); ?></span>
                        </div>

                    <?php endif; ?>

                    <div>
                        <?php echo wp_trim_words( get_post_field ('post_content', get_the_ID() ), get_option( Options::MAX_WORD_COUNT ) ); ?>
                    </div>

                    <div class="icons"><?php \ots\do_member_social_links(); ?></div>

                </div>

            </div>

            <?php wp_reset_postdata(); ?>

        <?php endwhile; ?>

    <?php else : ?>

        <?php _e( 'There are no team members to display.', 'ots-pro' ); ?>

    <?php endif; ?>

    <div class="clear"></div>

</div>