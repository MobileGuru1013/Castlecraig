<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>    
        <header class="entry-header">
            <h2 class="entry-title">
                <a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a>
            </h2>
        </header>
    
	<div class="entry-content">
        <div class="post_featured_image"><?php the_post_thumbnail( 'banner-size-normal', ''); ?></div>
		<?php the_excerpt(); ?> 
		<div class="clearfix"></div>
	</div><!-- .entry-content -->

</article><!-- #post -->