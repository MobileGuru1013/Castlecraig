<?php 
if (is_active_sidebar('sidebar-right') && is_page()) { ?> 
				<div class="col-md-3" id="sidebar-right">
					<?php do_action('before_sidebar'); ?> 
	
                    <?php dynamic_sidebar('sidebar-right'); ?> 
                    <?php if (is_active_sidebar('sidebar-right-nav')) { ?> 
				
                    <?php dynamic_sidebar('sidebar-right-nav'); ?> 
                    <?php cc_related_pages(); ?>

                    <?php } ?>
				</div>
<?php } ?> 
<?php 
if (is_active_sidebar('sidebar-right') && !is_page()) { ?> 
				<div class="col-md-3" id="sidebar-right">
					<?php do_action('before_sidebar'); ?> 
                    <?php dynamic_sidebar('sidebar-right'); ?> 
				</div>
<?php } ?>


