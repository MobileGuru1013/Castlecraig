<?php

namespace ots_pro;


/**
 * Output flat styled social icons.
 *
 * @param $html
 * @param int|\WP_Post|null $member
 * @return string
 * @since 4.0.0
 */
function styled_social_icons( $html, $member ) {

    if ( get_option( Options::SOCIAL_ICON_STYLE ) == 'flat' ) {

        $member = \ots\team_member( $member );
        $other  = $member->other_icon;

        $channels = array(
            'facebook'  => array( '',        'sc_team_icon-facebook' ),
            'twitter'   => array( '',        'sc_team_icon-twitter' ),
            'linkedin'  => array( '',        'sc_team_icon-linkedin' ),
            'gplus'     => array( '',        'sc_team_icon-google-plus' ),
            'email'     => array( 'mailto:', 'sc_team_icon-envelope-o' ),
            'phone'     => array( 'tel:',    'sc_team_icon-phone' ),
            'pinterest' => array( '',        'sc_team_icon-pinterest-p' ),
            'instagram' => array( '',        'sc_team_icon-instagram' ),
            'website'   => array( '',        'sc_team_icon-share-alt' )
        );

        $other_icons = array(
            'etsy'       => 'sc_team_icon-etsy',
            'skype'      => 'sc_team_icon-skype',
            'vimeo'      => 'sc_team_icon-vimeo',
            'whatsapp'   => 'sc_team_icon-whatsapp',
            'soundcloud' => 'sc_team_icon-soundcloud'
        );

        if ( !empty( $other ) && array_key_exists( $other, $other_icons ) ) {
            $channels['other'] = array( '', $other_icons[ $other ] );
        }

        $html = '';

        foreach ( $channels as $channel => $args ) {

            if ( !empty( $member->$channel ) ) {
                $html .= \ots\social_link( $args[0] . $member->$channel, '', array(), '<span class="' . $args[1] . '">', '</span>' );
            }

        }

    }

    return $html;

}

add_filter( 'ots_parse_social_links', 'ots_pro\styled_social_icons', 10, 2 );


/**
 * Output the member's favorite articles.
 *
 * @param int|\WP_Post|null $member
 * @since 4.0.0
 */
function do_member_articles( $member = null ) {

    $member = \ots\team_member( $member ); ?>

    <div class="sc-team-member-posts">

        <?php for( $ctr = 1; $ctr <= 3; $ctr++ ) : $article = $member->{"article$ctr"}; ?>

            <?php $post = !empty( $article ) ? get_post( $article ) : false; ?>

            <?php if( $post ) : ?>

                <div class="sc-team-member-post">

                    <div class="width25 sc-left">

                        <?php if ( has_post_thumbnail( $post ) ) : ?>

                            <?php echo get_the_post_thumbnail( $post->ID, 'medium' ); ?>

                        <?php endif; ?>

                    </div>

                    <div class="width75 sc-left">
                        <a href="<?php echo get_the_permalink( $post->ID ); ?>"><?php echo get_the_title( $post->ID ); ?></a>
                    </div>

                    <div class="clear"></div>

                </div>

            <?php endif; ?>

        <?php endfor; ?>

    </div>

<?php }


/**
 * Output the member's skills.
 *
 * @param int|\WP_Post|null $member
 * @since 4.0.0
 */
function do_member_skills( $member = null ) {

    $member = \ots\team_member( $member ); ?>

    <?php for( $ctr = 1; $ctr <= 5; $ctr++ ) :

            $title = $member->{"skill$ctr"};
            $value = $member->{"skill_value$ctr"}; ?>

        <?php if( !empty( $title ) ) : ?>

            <?php esc_html_e( $title ); ?>

            <div class="progress" style="width: <?php esc_attr_e( $value ); ?>0%">
                <span><?php esc_attr_e( $value ); ?>0%</span>
            </div>

        <?php endif; ?>

    <?php endfor; ?>

<?php }

