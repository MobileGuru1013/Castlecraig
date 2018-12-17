<?php

namespace ots_pro;

?>

<div id="sc_our_team" class="directory sc-col<?php esc_html_e( get_option( \ots\Options::GRID_COLUMNS ) ); ?>">

    <div class="clear"></div>

    <?php if ( $members->have_posts() ) : ?>

        <table class="dataTable hover sc-team-table nowrap" cellspacing="0" width="100%">

            <thead>
                <tr>
                    <?php if ( get_option( \ots\Options::DISPLAY_NAME ) == 'on' ) : ?>

                        <th><?php esc_html_e( get_option( Options::DIRECTORY_NAME_LABEL ) ); ?></th>

                    <?php endif; ?>

                    <?php if( get_option( Options::DISPLAY_DIRECTORY_JOB_TITLE ) == 'on' ) : ?>

                        <th><?php esc_html_e( get_option( Options::DIRECTORY_JOB_TITLE_LABEL ) ); ?></th>

                    <?php endif; ?>

                    <?php if( get_option( Options::DISPLAY_DIRECTORY_GROUP ) == 'on' ) : ?>

                        <th><?php esc_html_e( get_option( Options::DIRECTORY_GROUP_LABEL ) ); ?></th>

                    <?php endif; ?>

                    <?php if( get_option( Options::DISPLAY_DIRECTORY_PHONE ) == 'on' ) : ?>

                        <th><?php esc_html_e( get_option( Options::DIRECTORY_PHONE_LABEL ) ); ?></th>

                    <?php endif; ?>

                </tr>
            </thead>

            <tbody>

                <?php while ( $members->have_posts() ) : $members->the_post(); ?>

                    <?php $member = \ots\team_member(); ?>

                    <tr itemscope itemtype="http://schema.org/Person" class="sc_team_member" data-id="<?php the_ID(); ?>">

                        <?php if ( get_option( \ots\Options::DISPLAY_NAME ) == 'on' ) : ?>

                            <td>
                                <div itemprop="name">

                                    <?php if( $single_template != 'disable' ) : ?>

                                        <a href="<?php the_permalink() ?>"
                                           rel="bookmark"
                                           class="team_member_link"><?php the_title() ?></a>

                                    <?php else : ?>

                                        <?php the_title(); ?>

                                    <?php endif; ?>

                                </div>
                            </td>

                        <?php endif; ?>

                        <?php if( get_option( Options::DISPLAY_DIRECTORY_JOB_TITLE ) == 'on' ) : ?>
                            <td>
                                <div itemprop="jobtitle"><?php esc_html_e( $member->title ); ?></div>
                            </td>

                        <?php endif; ?>

                        <?php if( get_option( Options::DISPLAY_DIRECTORY_GROUP ) == 'on' ) : ?>

                            <td>

                                <?php $terms = wp_get_post_terms( get_the_ID(), 'team_member_position' ); ?>

                                <?php esc_html_e( $terms ? $terms[0]->name : '' ); ?>

                            </td>

                        <?php endif; ?>

                        <?php if( get_option( Options::DISPLAY_DIRECTORY_PHONE ) == 'on' ) : ?>

                            <td><?php esc_html_e( $member->phone ); ?></td>

                        <?php endif; ?>

                    </tr>

                <?php wp_reset_postdata(); ?>

            <?php endwhile; ?>

            </tbody>

        </table>

    <?php else : ?>

        <?php _e( 'There are no team members to display.', 'ots-pro' ); ?>

    <?php endif; ?>

    <div class="clear"></div>

</div>