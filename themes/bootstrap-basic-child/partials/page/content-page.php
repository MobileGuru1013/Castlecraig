<?php
	// title
	$long_title = get_field( "long_title" );
	$page_title = $long_title ? $long_title : get_the_title();
	$banner_layout = get_field( 'banner_layout');

	$banner = get_field('banner_image');
    if( !empty($banner) ) {
		// vars
		$url = $banner['url'];
		$title = $banner['title'];
		$alt = $banner['alt'];
		$caption = $banner['caption'];

		// thumbnail
		$size = 'banner-size-normal';
		$thumb = $banner['sizes'][ $size ];
		$width = $banner['sizes'][ $size . '-width' ];
		$height = $banner['sizes'][ $size . '-height' ];
	} 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php custom_breadcrumbs(); ?>
	
    <?php if( empty($banner) || $banner_layout != 'full_width'): ?>
        
        <header class="entry-header">
            <h1 class="entry-title">
                <?php echo $page_title; ?>
            </h1>
        </header>

    <?php endif; ?>
    
	<div class="entry-content">
    <?php 
        ?>

       <?php if( $banner_layout != 'full_width' && !empty($banner)): ?>
               <div class="post_featured_image"><img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" /></div>
        
        <?php endif; ?>
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
		<?php bootstrapBasicEditPostLink(); ?> 
	</footer>
</article><!-- #post-## -->