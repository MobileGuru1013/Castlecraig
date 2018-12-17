<?php
/**
 * Outputs the filter template on Grid templates
 * 
 * @since 4.3.0
 */
namespace ots_pro;

$all_terms = get_terms( array( 'taxonomy' => 'team_member_position' ) );

?>


<?php if ( empty( $group ) || count( $group ) > 1 ) : ?>

    <?php $all_terms = get_terms( array( 'taxonomy' => 'team_member_position' ) ); ?>

    <div id="sc_our_team_filter">

        <ul class="filter-list">

            <li data-group="all" class="active-filter"><?php echo get_option( Options::SEARCH_ALL_TEXT ); ?></li>

            <?php foreach( $all_terms as $term ) : ?>

                <li data-group="<?php echo $term->name; ?>"><?php echo $term->name; ?></li>

            <?php endforeach; ?>

        </ul>

    </div>

<?php endif; ?>
