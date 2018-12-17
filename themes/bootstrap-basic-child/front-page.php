<?php
/**
 * Template for displaying pages
 * 
 * @package bootstrap-basic
 */

get_header();

/**
 * determine main column size from actived sidebar
 */

$main_column_size = bootstrapCCGetMainColumnSize();
?> 

<div class="container-full">
				<div class="content-area" id="main-column">
					<main id="main" class="test site-main" role="main">
						<?php 
						while (have_posts()) {
							the_post();

							get_template_part('partials/page/content', 'page-front');

							echo "\n\n";
							
							// If comments are open or we have at least one comment, load up the comment template
							if (comments_open() || '0' != get_comments_number()) {
								comments_template();
							}

							echo "\n\n";

						} //endwhile;
						?> 
					</main>
                   
				</div>
 <?php echo '</div>'; ?>

<?php get_footer(); ?> 