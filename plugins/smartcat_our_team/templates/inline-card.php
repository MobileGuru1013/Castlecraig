<?php

namespace ots_pro;

?>

<?php $member = \ots\team_member(); ?>

<div id="sc_our_team_lightbox" class="scrollbar-macosx">

    <div class="sc_our_team_lightbox permanent scrollbar-macosx" id="inline-<?php the_ID(); ?>">

        <span class="sc_team_icon-close"></span>

        <div class="width25 sc-left">

            <img src="<?php echo esc_url( \ots\get_member_avatar( null, 'large' ) ); ?>" class="image <?php esc_attr_e( get_option( Options::SINGLE_IMAGE_STYLE ) ); ?>" />

            <h4 class="title"><?php esc_html_e( $member->title ); ?></h4>

            <?php if( get_option( \ots\Options::SHOW_SINGLE_SOCIAL ) == 'on' ) : ?>

                <div class="social"><?php \ots\do_member_social_links(); ?></div>

            <?php endif; ?>

            <?php if( $member->skill_bool == 'on' ) : ?>

                <div class="skills">

                    <h3 class="skills-title"><?php esc_html_e( $member->skill_title ); ?></h3>

                    <?php do_member_skills(); ?>

                </div>

            <?php endif; ?>

        </div>

        <div class="sc-left width75">

            <h2 class="name"><?php the_title(); ?></h2>

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

                <div class="sc-posts">

                    <h3 class="skills-title"><?php esc_html_e( $member->article_title ); ?></h3>

                    <?php do_member_articles(); ?>

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>