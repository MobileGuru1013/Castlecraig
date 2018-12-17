<?php
/**
 * Template for displaying single post (read full post page).
 * 
 * @package bootstrap-basic
 */

get_header();

/**
 * determine main column size from actived sidebar
 */
$main_column_size = bootstrapCCGetMainColumnSize();

?> 
<?php get_sidebar('left'); ?> 
            <div class="container">
            <div class="row">
				<div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">
                    <ul id="breadcrumbs" class="breadcrumbs clearfix">
                        <li class="item-home"><a class="bread-link bread-home" href="http://castlecraig.local" title="Homepage"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="separator separator-home"> <i class="fa fa-angle-right" aria-hidden="true"></i> </li>
                        <li class=""><a href="/blog/">Blog</a></li>
                        <li class="separator separator-home"> <i class="fa fa-angle-right" aria-hidden="true"></i> </li>
                        <li class=""><?php the_title(); ?></li>
                    </ul>
					<main id="main" class="site-main" role="main">
						<?php 
						while (have_posts()) {
							the_post();

							get_template_part('partials/single/content', 'single');

							echo "\n\n";
							
							bootstrapBasicPagination();

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
<?php get_sidebar('right'); ?> 
 <?php echo '</div></div>'; ?>
<?php get_footer(); ?> 
