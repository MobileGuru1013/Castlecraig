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
        <div class="content-meta"><span class="job-categories"><i class="fa fa-tags" aria-hidden="true"></i> 
        <?php
			$taxonomy = 'jobs_categories';

            // Get the term IDs assigned to post.
            $post_terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );

            // Separator between links.
            $separator = ', ';
 
            if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {

                $term_ids = implode( ',' , $post_terms );

                $terms = wp_list_categories( array(
                    'title_li' => '',
                    'style'    => 'none',
                    'echo'     => false,
                    'taxonomy' => $taxonomy,
                    'include'  => $term_ids
                ) );

                $terms = rtrim( trim( str_replace( '<br />',  $separator, $terms ) ), $separator );

                // Display post categories.
                echo  $terms;
            }
		?>
        </span><span>|</span><span class="job-post-date">
        <i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo get_the_date('d/m/Y'); ?>  
        </span>
        </div>
		<?php the_content(); ?> 
		<div class="clearfix"></div>
        <?php 
        $contact_form_link = get_field( 'job_application_url');
        $job_file_link = get_field( 'application_form_file');
        echo '<div class="contactLinkWrapper">',__('You can use our ').'<a href="'.get_site_url().$contact_form_link .'">'.__('Online job application form').'</a> '.__('or download and fill the ').'<a target="_blank" href="'.$job_file_link.'">'.__('Offline application file').'<a/></div>';
        ?>
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
	</footer><!-- .entry-meta -->
</article><!-- #post -->