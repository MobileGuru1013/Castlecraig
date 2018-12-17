<?php

namespace ots_pro;


get_header();

?>

<style>

    .sc_team_single_member.sidebar #sc_team_sidebar_profile .sc_team_profile_image img {
        border-bottom: 5px solid <?php esc_html_e( get_option( \ots\Options::MAIN_COLOR ) ); ?>;
    }

    .sc_team_single_member.sidebar .styled-icons .sc-social {
        background-color: <?php esc_html_e( get_option( \ots\Options::MAIN_COLOR ) ); ?>;
        border-radius: <?php echo get_option( Options::SOCIAL_ICON_STYLE ) == 'circle' ? '50%' : '3px'; ?>;
    }

    .sc_team_single_member.sidebar .sc-team-member-posts .width75.left a:hover,
    .sc_team_single_member.sidebar .sc_team_list .sc_team_group .sc_team_group_members li a {
        color: <?php esc_html_e( get_option( \ots\Options::MAIN_COLOR ) ); ?>;
    }

    .sc_team_single_member.sidebar .sc_team_list .sc_team_group .sc_team_group_members li {
        border-bottom: thin solid <?php esc_html_e( get_option( \ots\Options::MAIN_COLOR ) ); ?>;
    }

</style>

<script>

    jQuery(document).ready(function ($) {

        /**
         * Toggle Hide and Show of Sidebar Single Team Member Template Groups
         */

        $('.sc_team_single_member.sidebar .sc_team_list .sc_team_group').click(function () {

            $(this).find('.sc_team_group_members')
                .stop()
                .slideToggle();

        });

    });

</script>

<div class="sc-single-wrapper">

    <?php while ( have_posts() ) : the_post(); ?>

        <?php $member = \ots\team_member(); ?>

        <div class="sc_team_single_member sidebar">

            <div id="sc_team_sidebar_staff_list">

                <?php $all_terms = get_terms( array( 'taxonomy' => 'team_member_position' ) ); ?>

                <ul class="sc_team_list">

                    <?php foreach( $all_terms as $term ) : ?>

                        <li class="sc_team_group">

                            <span><?php echo $term->name; ?></span>

                            <ul class="sc_team_group_members">

                                <?php

                                    $members = get_posts( array(
                                        'posts_per_page' => -1,
                                        'post_type'      => 'team_member',
                                        'tax_query'      => array(
                                            array(
                                                'taxonomy' => 'team_member_position',
                                                'field' => 'name',
                                                'terms' => $term->name,
                                            )
                                        )
                                    ) );

                                ?>

                                <?php foreach( $members as $team_member ) : ?>

                                    <li>
                                        <a href="<?php echo get_permalink( $team_member->ID ); ?>" rel="bookmark"><?php echo $team_member->post_title; ?></a>
                                    </li>

                                <?php endforeach; ?>

                            </ul>

                        </li>

                    <?php endforeach; ?>

                    <li class="sc_team_group">

                        <span><?php _e( 'Team Members', 'ots-pro' ); ?></span>

                        <ul class="sc_team_group_members">

                            <?php foreach( \ots\get_members_in_order( 'all' )->posts as $team_member ) : ?>

                                <li>
                                    <a href="<?php echo get_permalink( $team_member->ID ); ?>" rel="bookmark"><?php echo $team_member->post_title; ?></a>
                                </li>

                            <?php endforeach; ?>

                        </ul>

                    </li>

                </ul>

            </div>

            <div id="sc_team_sidebar_body">

                <h2 class="name" itemprop="name"><?php echo the_title(); ?></h2>

                <h3 class="title" itemprop="jobtitle"><?php esc_html_e( $member->title ); ?></h3>

                <hr>

                <?php if( get_option( \ots\Options::SHOW_SINGLE_SOCIAL ) == 'on' ) : ?>

                    <div class="social"><?php \ots\do_member_social_links(); ?></div>

                <?php endif; ?>

                <div class="sc_team_sidebar_content"><?php echo the_content(); ?></div>

                <?php if( $member->article_bool == 'on' ) : ?>

                    <div class="sc_team_posts">

                        <h3 class="skills-title"><?php esc_html_e( $member->articles_title ); ?></h3>

                        <?php do_member_articles(); ?>

                    </div>

                <?php endif; ?>

            </div>

            <div id="sc_team_sidebar_profile">

                <div class="sc_team_profile_image <?php esc_attr_e( get_option( Options::SINGLE_IMAGE_STYLE ) ); ?>">

                    <?php \ots\member_avatar( null, 'medium' ); ?>

                </div>

                <?php $quote = $member->quote; ?>

                <?php if ( !empty( $quote ) ) : ?>

                    <div class="sc_personal_quote">
                        <span class="sc_personal_quote_content">"<?php esc_html_e( $quote ); ?>"</span>
                    </div>

                <?php endif; ?>

                <?php if ( $member->skill_bool == 'on' ) : ?>

                    <hr>

                     <div class="sc_team_single_skills">

                        <h3 class="skills-title"><?php esc_html_e( $member->skill_title ); ?></h3>

                         <?php do_member_skills(); ?>

                     </div>

                <?php endif; ?>

                <?php if( $member->tags_bool == 'on' ) : ?>

                    <hr>

                    <div class="sc-tags">

                        <h3 class="skills-title"><?php esc_html_e( $member->tags_title ); ?></h3>

                        <?php $tags = explode( ',', $member->tags ); ?>

                        <?php foreach( $tags as $tag ) : ?>

                            <span class="sc-single-tag"><?php esc_html_e( $tag ); ?></span>

                        <?php endforeach; ?>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    <?php wp_reset_postdata(); ?>

    <?php endwhile; ?>

</div>

<?php get_footer(); ?>