
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
	<div class="entry-content">
		<?php the_content(); ?> 
		<div class="clearfix"></div>
	</div><!-- .entry-content -->
	
	<footer class="entry-meta">
		<?php bootstrapBasicEditPostLink(); ?> 
	</footer>
</article><!-- #post-## -->