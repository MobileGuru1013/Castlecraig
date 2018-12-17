<?php

namespace ots_pro\portal;

?>

<div class="content-sidebar">

    <?php $pages = get_member_viewable_pages(); ?>

    <div class="panel panel-default">

        <div class="panel-heading">
            <h4><?php esc_html_e( get_option( Options::SIDEBAR_PAGES_TITLE ) ); ?></h4>
        </div>

        <ul class="list-group">

            <?php foreach ( $pages as $page ) : $permalink = get_the_permalink( $page ); ?>

                <li class="list-group-item <?php echo $permalink == get_permalink() ? 'current' : ''; ?>">
                    <a href="<?php echo esc_url( $permalink ); ?>">
                        <?php esc_html_e( $page->post_title ); ?>
                    </a>
                </li>

            <?php endforeach; ?>

        </ul>

    </div>

    <?php $groups = get_member()->get_groups(); ?>

    <div class="panel panel-default">

        <div class="panel-heading">
            <h4><?php esc_html_e( get_option( Options::SIDEBAR_GROUPS_TITLE ) ); ?></h4>
        </div>

        <ul class="list-group">

            <?php $exclude = array( get_member()->get_id() ); ?>

            <?php foreach ( $groups as $group ) :

                $members = get_members_in_group( $group->term_id, $exclude ); ?>

                <?php if ( $members->have_posts() ) : ?>

                <li class="list-group-item">

                    <strong><?php esc_html_e( $group->name ); ?></strong>

                    <span class="badge"><?php esc_attr_e( $members->post_count ); ?></span>

                </li>

                <?php foreach ( $members->posts as $member ) : ?>

                    <?php if ( !in_array( $member->ID, $exclude ) ) : $exclude[] = $member->ID; ?>

                        <li class="list-group-item sub-list-item">
                            <a href="<?php echo esc_url( get_the_permalink( $member ) ); ?>">
                                <?php esc_html_e( $member->post_title ); ?>
                            </a>
                        </li>

                    <?php endif; ?>

                <?php endforeach; ?>

            <?php endif; ?>

            <?php endforeach; ?>

            <?php // If no other members were displayed ?>

            <?php if ( count( $exclude ) < 2 ) : ?>

                <li class="list-group-item"><?php _e( 'Looks like there\'s no other members in your groups', 'ots-pro' ); ?></li>

            <?php endif; ?>

        </ul>

    </div>

</div>
