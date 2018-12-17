<?php
/**
 * The theme header
 * 
 * @package bootstrap-basic
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>  <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>     <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>     <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width">

		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		
		<!--wordpress head-->
		<?php wp_head(); ?>

		 <!-- Facebook Pixel Code -->
		<script>
		!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
		n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
		document,'script','https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '592025674301152'); // Insert your pixel ID here.
		fbq('track', 'PageView');
		</script>
		<noscript>
			<img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=592025674301152&ev=PageView&noscript=1" />
		</noscript>
		<!-- DO NOT MODIFY -->
		<!-- End Facebook Pixel Code -->
		

<meta name="geo.region" content="GB" />
<meta name="geo.placename" content="Blyth Bridge" />
<meta name="geo.position" content="55.684303;-3.375343" />
<meta name="ICBM" content="55.684303, -3.375343" />
		
<script type="application/ld+json">
 {
  "@context": "http://schema.org",
  "@type": "LocalBusiness",
  "logo": "https://castlecraig.co.uk/wp-content/themes/bootstrap-basic-child/images-src/castle-craig-logo.svg",
  "url": "https://castlecraig.co.uk/",
  "priceRange":"$$$",
  "image": "https://castlecraig.co.uk/wp-content/uploads/2017/04/cc-home-banner.jpg",
  "sameAs": ["https://facebook.com/CastleCraigHospital", "https://twitter.com/CastleCraig", "https://plus.google.com/+CastlecraigCoUk"],
  "legalName": "Castle Craig Hospital",
  "name": "Castle Craig Hospital",
  "alternateName": "Castle Craig Hospital",
  "telephone": "+44-1721-788-257",
  "founder":{
   "@type": "Person",
     "name":"Dr. Margaret McCann",
     "honorificPrefix":"Dr",
     "givenName":"Margaret",
     "familyName":"McCann",
     "jobTitle":"CEO",
     "image":"https://castlecraig.co.uk/wp-content/uploads/2017/09/Dr-Margaret-McCann-Medical-Director-Castle-Craig-Hospital.jpg",
     "worksFor":"Castle Craig Hospital",
     "affiliation":"",
     "memberOf":"",
     "sameAs":["", "https://castlecraig.co.uk/about-us/meet-the-team/"]
},
  "makesOffer": ["Drug Detox","Residential Treatment","Alcohol Addiction Treatment", "Drug Rehab","Alcohol Rehab"],
  "address":{
   "@type": "PostalAddress",
    "addressLocality":"Peeblesshire",
    "addressRegion":"Scotland",
    "streetAddress":"Blyth Bridge, West Linton",
    "postalCode":"EH46 7DH"
   },
  "geo":{
   "@type": "GeoCoordinates",
    "latitude":"55.684303",
    "longitude":"-3.375343"
   },   "contactPoint":{
   "@type": "contactPoint",
    "contactType": "customer service", 
    "telephone":"+44-1721-788-257",
    "url":"https://castlecraig.co.uk/contact-us/"
   } 
 }
</script>
		
		
		<meta name="google-site-verification" content="n8GoXBzVZM-1Ie_LnWUMeYsiAHM3Wbuh4XuEA1xkglU" />
	</head>
	<body <?php body_class(); ?>>
		<!--[if lt IE 8]>
			<p class="ancient-browser-alert">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" target="_blank">upgrade your browser</a>.</p>
		<![endif]-->
		
		
		
		
		<div class="page-container">
			<?php do_action('before'); ?> 
			<header role="banner" class="header_top">
                <div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-3 header_top--left">
						
                     <?php  

                     $custom_logo_id =  get_theme_mod( 'cc_logo' ); 
                     //print_r($custom_logo_id);
                     $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                     	

                     ?>
                            <div class='site_logo--desktop'>
                                <a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><img src='<?php echo $custom_logo_id; ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'></a>
                            </div>
                        <?php if ( get_theme_mod( 'cc_mobile_logo' ) ) : ?>
                            <div class='site_logo--mobile'>
                                <a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><img src='<?php echo get_stylesheet_directory_uri(); ?>/images-src/castle-craig-logo-mobile.svg' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'></a>
                            </div>
                        <?php endif; ?>
					</div>
					<div class="col-xs-12 col-md-9 header_top--right">
						<div class="sr-only">
							<a href="#content" title="<?php esc_attr_e('Skip to content', 'bootstrap-basic'); ?>"><?php _e('Skip to content', 'bootstrap-basic'); ?></a>
						</div>
                        <?php wp_nav_menu( array( 'theme_location' => 'header-top-menu', 'container_class' => 'header_top--right-menu' ) ); ?>
						<?php if (is_active_sidebar('header-right')) { ?> 
						<div class="header_top--right-content clearfix">
							<?php dynamic_sidebar('header-right'); ?> 
						</div>
						<div class="clearfix"></div>
						<?php } // endif; ?> 
					</div>
				</div><!--.site-branding-->
                </div>
                <div class="main_navigation">
                    <div class="container">
                    <div class="row">
					<div class="col-md-12">
						<nav class="navbar navbar-default" role="navigation">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-primary-collapse">
									<span class="sr-only"><?php _e('Toggle navigation', 'bootstrap-basic'); ?></span>
									<span class="icon-bar first"></span>
									<span class="icon-bar middle"></span>
									<span class="icon-bar last"></span>
								</button>
							</div>
							
							<div class="collapse navbar-collapse navbar-primary-collapse">
                                <span class="search_wrapper">
                                    <span class="search_toggle_wrapper"><a class="search_toggle" href="#"><i class="fa fa-search" aria-hidden="true"></i></a></span>
                                    <div class="search_form_wrapper" style="display:none;"><?php get_search_form(); ?></div>
                                </span>
								<?php wp_nav_menu(array('theme_location' => 'primary', 'container' => false, 'menu_class' => 'nav navbar-nav', 'walker' => new BootstrapCCMyWalkerNavMenu())); ?> 
								<?php dynamic_sidebar('navbar-right'); ?>
							</div><!--.navbar-collapse-->
						</nav>
					</div>
                    </div>
                    </div>
				</div><!--.main-navigation-->
			</header>
<!-- Front page banner code with hardcoded values -->
            
<?php if ( is_front_page() ) { ?>
   
<div class="page_banner_wrapper">

<?php 

$image = get_field('banner_image');

if( !empty($image) ): 

	// vars
	$url = $image['url'];
	$title = $image['title'];
	$alt = $image['alt'];
	$caption = $image['caption'];

	// thumbnail
	$size_full = 'banner-size-full';
	$thumb_full = $image['sizes'][ $size_full ];
	$width = $image['sizes'][ $size_full . '-width' ];
	$height = $image['sizes'][ $size_full . '-height' ]; 
?>

		<img src="<?php echo $thumb_full; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
        <span class="imageOverlay"></span>
        <div class="banner_content">
        	<div class="banner_content_wrapper container">
        		<div class="banner_content_wrapper--inner col-md-12">
        			<h1>Leave Addiction Behind</h1>        
        			<div class="banner-text">Castle Craig is a world-renowned alcohol and drug residential rehab clinic. Established in 1988, we are one of Europe's leading inpatient addiction clinics.</div>
        			<div class="banner-link">
    					<a class="btn btn-primary" href="/admissions/">Find out about Admissions</a>
        			</div> 
        		</div>  
        	</div>        
        </div>

<?php endif; ?>
</div>  
 

 <?php } else { // -end front page banner ?>


<?php
    
    $banner_layout = get_field('banner_layout');
    $banner_image = get_field('banner_image');
    
    if( !empty($banner_image) ) {

		// title
		$long_title = get_field( "long_title" );
		$page_title = $long_title ? $long_title : get_the_title();

		// vars
		$url = $banner_image['url'];
		$title = $banner_image['title'];
		$alt = $banner_image['alt'];
		$caption = $banner_image['caption'];

		// thumbnail
		$size_full = 'banner-size-full';
		$thumb_full = $banner_image['sizes'][ $size_full ];
		$width = $banner_image['sizes'][ $size_full . '-width' ];
		$height = $banner_image['sizes'][ $size_full . '-height' ];

     ?>       
    <?php if ($banner_layout == 'full_width'): ?>
        <div class="page_banner_wrapper">
        	<img src="<?php echo $thumb_full; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
            <span class="imageOverlay"></span>
        	<div class="banner_content">
        		<div class="banner_content_wrapper container">
        			<div class="banner_content_wrapper--inner col-md-12">
			            <h1>
			                <?php echo $page_title; ?>
			            </h1>
        			</div>
        		</div>
        	</div>
        </div>
    <?php endif; ?>
    <?php } // - end "banner image" ?>
 <?php } // - end "non front page" banner ?>
<div id="content" class="site-content">