<?php

namespace ots_pro\portal;


$member = get_member( get_the_ID() );

?>

<?php get_header(); ?>

    <div id="view-profile" class="profile profile-preview">

        <div class="container-fluid">

            <div class="content">

                <div class="panel panel-default profile-header">

                    <div class="panel-body">

                        <div class="cover-photo col-sm-12 <?php echo has_cover_photo( $member ) ? '' : 'no-cover-photo'; ?>"
                             style="background-image: url(<?php echo esc_url( get_cover_photo( $member ) ); ?>)">
                            
                            <?php if ( Session::is_authenticated() && Session::logged_in_user()->get_id() == get_the_ID() ) : ?>

                                <a class="edit-profile-link" href="<?php echo esc_url( get_the_permalink( get_option( Options::PROFILE_PAGE ) ) ); ?>">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>

                            <?php endif; ?>
                            
                        </div>

                        <div class="profile-img col-sm-12">
                            <img class="img-responsive"
                                 src="<?php echo esc_url( \ots\get_member_avatar( $member->get_id() ) ); ?>">
                        </div>

                        <div class="name text-center col-sm-12">


                            <h2><?php esc_html_e( $member->get_name() ); ?></h2>

                            <small class="text-muted"><?php esc_html_e( $member->title ); ?></small>

                            <?php $groups = $member->get_groups(); ?>

                            <?php if ( count( $groups ) > 1 ) : ?>

                                <div>

                                    <?php foreach ( $groups as $group ) : ?>

                                        <div class="label label-default"><?php esc_html_e( $group->name ); ?></div>

                                    <?php endforeach; ?>

                                </div>

                            <?php elseif ( count( $groups ) > 0 ) : ?>

                                <div class="label label-default"><?php esc_html_e( current( $groups )->name ); ?></div>

                            <?php endif; ?>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-sm-12">

                        <div class="panel panel-default bio">
                            <div class="panel-body">
                                <div class="profile-bio"><?php echo wp_kses_post( $member->get_bio() ); ?></div>
                            </div>
                        </div>

                        <div class="fade"></div>

                    </div>

                    <div class="col-sm-12">

                        <div class="text-center profile-contact">

                            <?php if ( !empty( $member->email ) ) : ?>

                                <a href="mailto:<?php echo esc_attr_e( $member->email ); ?>">
                                    <span class="social-link glyphicon glyphicon-envelope"></span>
                                </a>

                            <?php endif; ?>

                            <?php if ( !empty( $member->phone ) ) : ?>

                                <a href="tel:<?php echo esc_attr_e( $member->phone ); ?>">
                                    <span class="social-link glyphicon glyphicon-phone-alt"></span>
                                </a>

                            <?php endif; ?>

                            <?php if ( !empty( $member->facebook ) ) : ?>

                                <a href="<?php echo esc_attr_e( $member->facebook ); ?>">
                                    <span class="social-link icon-facebook"></span>
                                </a>

                            <?php endif; ?>

                            <?php if ( !empty( $member->twitter ) ) : ?>

                                <a href="<?php echo esc_attr_e( $member->twitter ); ?>">
                                    <span class="social-link icon-twitter"></span>
                                </a>

                            <?php endif; ?>

                            <?php if ( !empty( $member->linkedin ) ) : ?>

                                <a href="<?php echo esc_attr_e( $member->linkedin ); ?>">
                                    <span class="social-link icon-linkedin"></span>
                                </a>

                            <?php endif; ?>

                            <?php if ( !empty( $member->gplus ) ) : ?>

                                <a href="<?php echo esc_attr_e( $member->gplus ); ?>">
                                    <span class="social-link icon-google"></span>
                                </a>

                            <?php endif; ?>

                            <?php if ( !empty( $member->instagram ) ) : ?>

                                <a href="<?php echo esc_attr_e( $member->instagram ); ?>">
                                    <span class="social-link icon-instagram"></span>
                                </a>

                            <?php endif; ?>

                            <?php if ( !empty( $member->pinterest ) ) : ?>

                                <a href="<?php echo esc_attr_e( $member->pinterest ); ?>">
                                    <span class="social-link icon-pinterest"></span>
                                </a>

                            <?php endif; ?>

                            <?php if ( !empty( $member->website ) ) : ?>

                                <a href="<?php echo esc_attr_e( $member->website ); ?>">
                                    <span class="social-link glyphicon glyphicon-globe"></span>
                                </a>

                            <?php endif; ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

<?php get_footer(); ?>
