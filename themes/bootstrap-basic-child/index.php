<?php
/**
 * The main template file
 * 
 * @package bootstrap-basic
 */

get_header();

/**
 * determine main column size from actived sidebar
 */
$main_column_size = bootstrapCCGetMainColumnSize();
?>
<div class="container">
<div class="row">
<?php get_sidebar('left'); ?> 
				<div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">
                    <ul id="breadcrumbs" class="breadcrumbs clearfix">
                        <li class="item-home"><a class="bread-link bread-home" href="//www.castlecraig.co.uk" title="Homepage"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="separator separator-home"> <i class="fa fa-angle-right" aria-hidden="true"></i> </li>
                        <li class="">Blog</li>
                    </ul>
							<h1 class="page-title">
                                <?php echo 'Blog'; ?>
                            </h1>
					<main id="main" class="site-main" role="main">
						<?php if (have_posts()) { ?> 
						<?php 
						// start the loop
						while (have_posts()) {
							the_post();
							
							/* Include the Post-Format-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Format name) and that will be used instead.
							*/
							get_template_part('partials/single/content', 'teaser');
						}// end while
						
						bootstrapBasicPagination();
						?> 
						<?php } else { ?> 
						<?php get_template_part('no-results', 'index'); ?>
						<?php } // endif; ?> 
					</main>
				</div>
<?php get_sidebar('right'); ?> 
 <?php echo '</div></div>'; ?>
<?php get_footer(); ?> 