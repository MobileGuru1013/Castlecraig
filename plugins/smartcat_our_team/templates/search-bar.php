<?php
/**
 * Outputs the search & filter template on Grid templates
 * 
 * @since 4.3.0
 */
namespace ots_pro;

$all_terms = get_terms( array( 'taxonomy' => 'team_member_position' ) );

?>

<input type="search" class="ots-search-bar" />
<?php if ( empty( $group ) || count( $group ) > 1 ) : ?>
    

    <select class="ots-search-group">
        
        <option value=""><?php echo get_option( Options::SEARCH_ALL_TEXT ); ?></option>
    
        <?php foreach( $all_terms as $term ) : ?>

            <option data-group="<?php echo $term->name; ?>"><?php echo $term->name; ?></option>

        <?php endforeach; ?>
    </select>


<?php endif; ?>

<button class="ots-search-button"><?php echo get_option( Options::SEARCH_TEXT ); ?></button>
<button class="ots-search-reset-button"><?php echo get_option( Options::RESET_TEXT ); ?></button>    

