
<?php 

if (is_active_sidebar('sidebar-right-nav') && is_page()) { ?> 
				<div class="col-md-3 pagesSidebar" id="sidebar-right">
					<?php do_action('before_sidebar'); ?> 

                    <?php dynamic_sidebar('sidebar-right-nav'); ?> 
                    <?php cc_related_pages(); ?>
				</div>
<?php } ?> 
