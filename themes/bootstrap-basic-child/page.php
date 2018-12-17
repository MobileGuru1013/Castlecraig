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

<div class="container">
<div class="row">
<?php get_sidebar('left'); ?> 
				<div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">
					<main id="main" class="test site-main" role="main">
						<?php 
						while (have_posts()) {
							the_post();

							get_template_part('partials/page/content', 'page');

							echo "\n\n";
							
							// If comments are open or we have at least one comment, load up the comment template
							if (comments_open() || '0' != get_comments_number()) {
								comments_template();
							}

							echo "\n\n";

						} //endwhile;
						?> 
						   	<?php  if(is_main_site()){ } else {?>
<div class="red_born">

  			<?php global $post;?>
  			<style>
  			#pgc-<?php echo $post->ID;?>-0-1{display:none;}
  			.panel-grid.panel-no-style .panel-grid-cell {width: 90% !important;}
			.page article {float: left;width: 70%;}
			.red_born {float: left;width: 30%;margin-top: 10%;}
			.red_born li {padding-left: 10px;}
  			</style>
  			<!-- <?php if($post->post_parent)
  			$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
  			else
  			$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
  			if ($children) { ?>
  			<div class="sidebar-menu clearfix"><h3>Quick Links</h3><ul class="child-sidebar-menu children submenu">
  			<?php echo $children; ?>
  			</ul></div>

  			<?php } ?> -->
  			</div>
  			<?php }?>
					</main>
					<?php 




					dynamic_sidebar('content-bottom'); ?> 
				</div>   
<?php 
    if ( is_page() ) :?>

    <?php get_sidebar( 'right-nav' );
    else: get_sidebar('right');?>

    <?php endif;
?>



 <?php echo '</div></div>'; ?>
<?php get_footer(); ?> 