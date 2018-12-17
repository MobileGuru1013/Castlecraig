<?php
/**
 * The theme footer
 * 
 * @package bootstrap-basic
 */
?>

			</div><!--.site-content-->
<?php if ( is_active_sidebar( 'content-bottom' ) ) : ?>
			<div class="content_bottom_wrapper"><div class="container"><div class="row"><div class="col-xs-12"><?php dynamic_sidebar('content-bottom'); ?> </div></div></div></div>
<?php endif; ?>
<?php if(is_main_site()){ ?>
	       <div class="footer_contact_wrapper"><div class="container"><div class="row"><div class="col-xs-12"><?php dynamic_sidebar('footer-contact'); ?> </div></div></div></div>
            
            <div class="contact_form_wrapper"><div class="container"><div class="row">
            	<?php 
            	echo do_shortcode( '[contact-form-7 id="20" title="Contact us"]' ); 
            
            	?></div></div></div> <?php } ?>

            <div class="footer_contact_wrapper"><div class="container"><div class="row"><div class="col-xs-12"><?php dynamic_sidebar('footer-contact'); ?> </div></div></div></div>
            
            <div class="contact_form_wrapper">
            	<div class="container">
	            	<div class="row">
		            	<?php 
		            	echo do_shortcode( '[contact-form-7 id="3723" title="Footer contact"]' ); 
		            
		            	?>
	            	</div>
            	</div>
            </div>

			<footer id="site-footer" role="contentinfo">
                <div class="container">
				<div class="row footer">
					<div class="col-md-6 footer-left">
						<?php dynamic_sidebar('footer-left'); ?>
					</div>
                    <div class="col-md-3 footer-middle">
						<?php dynamic_sidebar('footer-middle'); ?> 
					</div>
					<div class="col-md-3 footer-right">
						<?php dynamic_sidebar('footer-right'); ?> 
					</div>
				</div>
                </div>
			</footer>
		</div><!--.container page-container-->

		<!-- Google Tag Manager -->
		<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-NVFGTV"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-NVFGTV');</script>
		<!-- End Google Tag Manager -->


		<script type="text/javascript">
		   var adiInit ="564";
		   (function() {
		      var adiSrc = document.createElement("script"); adiSrc.type = "text/javascript";
		      adiSrc.async = true;
		      adiSrc.src = ("https:" == document.location.protocol ? "https://" : "http://") + "static.adinsight.eu/static/scripts/adiTrack.min.js";
		      var s = document.getElementsByTagName("script")[0];
		      s.parentNode.insertBefore(adiSrc, s);
		   })();
		</script>

		<!-- Google Code for Remarketing Tag -->
		<script type="text/javascript">
		/* <![CDATA[ */
		var google_conversion_id = 1064390389;
		var google_custom_params = window.google_tag_params;
		var google_remarketing_only = true;
		/* ]]> */
		</script>
		<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
		</script>
		<noscript>
		<div style="display:inline;">
		<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1064390389/?value=0&amp;guid=ON&amp;script=0"/>
		</div>
		</noscript>


		<script src="http://www.linkstant.com/linkstant.js" type="text/javascript"></script>


		<!--wordpress footer-->
		<?php wp_footer(); ?> 
	</body>
</html>