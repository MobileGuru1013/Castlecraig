<?php

namespace ots_pro;

?>

<?php $member = \ots\team_member(); ?>

<div id="sc_our_team_panel" class="scrollbar-macosx">

    <div class="sc_our_team_panel permanent scrollbar-macosx" id="inline-<?php the_ID(); ?>">

        <?php if( get_option( \ots\Options::SHOW_SINGLE_SOCIAL ) == 'on' ) : ?>

            <div class="sc-left-panel">
                <div class="sc-social"><?php \ots\do_member_social_links(); ?></div>
            </div>

        <?php endif; ?>

        <div class="sc-right-panel">

            <span class="sc_team_icon-close"></span>

            <h2 class="sc-name"><?php the_title(); ?></h2>

            <img src="<?php echo esc_url( \ots\get_member_avatar( null, 'large' ) ); ?>" class="sc-image <?php esc_attr_e( get_option( Options::SINGLE_IMAGE_STYLE ) ) ?>" />

            <h3 class="sc-title"><?php esc_html_e( $member->title ); ?></h3>

            <?php $quote = $member->quote; ?>

            <?php if ( !empty( $quote ) ) : ?>

                <div class="sc_personal_quote">
                    <span class="sc_team_icon-quote-left"></span>
                    <span class="sc_personal_quote_content"><?php esc_html_e( $quote ); ?></span>
                </div>

            <?php endif; ?>

            <div class="sc-content"><?php the_content(); ?></div>

            <?php if( $member->tags_bool == 'on' ) : ?>

                <div class="sc-tags">
                    <h3 class="skills-title"><?php esc_html_e( $member->tags_title ); ?></h3>

                    <?php $tags = explode( ',', $member->tags ); ?>

                    <?php foreach( $tags as $tag ) : ?>

                        <span class="sc-single-tag"><?php esc_html_e( $tag ); ?></span>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

            <?php if( $member->article_bool == 'on' ) : ?>

                <div class="sc_team_posts">

                    <h3 class="skills-title"><?php esc_html_e( $member->article_title ); ?></h3>

                    <?php do_member_articles(); ?>

                </div>

            <?php endif; ?>

            <?php if ( $member->skill_bool == 'on' ) : ?>

                <div class="sc-skills">

                    <h3 class="skills-title"><?php esc_html_e( $member->skill_title ); ?></h3>

                    <?php do_member_skills(); ?>

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>