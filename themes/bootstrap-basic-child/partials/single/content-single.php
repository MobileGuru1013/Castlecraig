<?php
	// title
	$long_title = get_field( "long_title" );
	$page_title = $long_title ? $long_title : get_the_title();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>    
        <header class="entry-header">
            <h1 class="entry-title">
                <?php echo $page_title; ?>
            </h1>
        </header>
    
	<div class="entry-content">
        <div class="post_featured_image"><?php the_post_thumbnail( 'banner-size-normal', ''); ?></div>
		<?php the_content(); ?> 
		<div class="clearfix"></div>
		<?php
		/**
		 * This wp_link_pages option adapt to use bootstrap pagination style.
		 * The other part of this pager is in inc/template-tags.php function name bootstrapBasicLinkPagesLink() which is called by wp_link_pages_link filter.
		 */
		wp_link_pages(array(
			'before' => '<div class="page-links">' . __('Pages:', 'bootstrap-basic') . ' <ul class="pagination">',
			'after'  => '</ul></div>',
			'separator' => ''
		));
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list(__(', ', 'bootstrap-basic'));

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list('', __(', ', 'bootstrap-basic'));
			
			echo bootstrapBasicCategoriesList($category_list);
			if ($tag_list) {
				echo ' ';
				echo bootstrapBasicTagsList($tag_list);
			}
			echo ' ';
		?> 

		<?php bootstrapBasicEditPostLink(); ?> 
	</footer><!-- .entry-meta -->
</article><!-- #post -->