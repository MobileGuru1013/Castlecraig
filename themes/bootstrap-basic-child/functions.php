<?php

add_filter( 'auto_update_plugin', '__return_true' );
add_filter( 'auto_update_theme', '__return_true' );

function cc_fonts_enqueue_scripts() {
    wp_register_style( 'fontawesome', get_stylesheet_directory_uri() . '/css/font-awesome.css'  );
    wp_enqueue_style( 'fontawesome' );
}
add_action( 'wp_enqueue_scripts', 'cc_fonts_enqueue_scripts', 89);

// enqueue the child theme stylesheet

function cc_styles_enqueue_scripts() {
    wp_register_style( 'childstyle', get_stylesheet_directory_uri() . '/css/cc_styles.css'  );
    wp_enqueue_style( 'childstyle' );
}
add_action( 'wp_enqueue_scripts', 'cc_styles_enqueue_scripts', 90);

// dequeue modernizr script from base theme, we'll add our own version in child theme
function cc_dequeue_script() {
   wp_dequeue_script( 'modernizr-script' );
    wp_dequeue_script('bootstrap-script');
}
add_action( 'wp_print_scripts', 'cc_dequeue_script', 100 );


function cc_scripts_enqueue_scripts() {
if (!is_admin()) {
    // add the scripts
        wp_enqueue_script('modernizr_script', get_stylesheet_directory_uri() . '/js/lib/modernizr/modernizr.min.js','3.5.0', TRUE);
	    wp_register_script('cc_script', get_stylesheet_directory_uri() . '/js/cc_scripts.js','jquery', '1.0.0', TRUE);
		
 
    // enqueue the script:
	wp_enqueue_script( 'cc_script' );
}	
}

add_action( 'wp_enqueue_scripts', 'cc_scripts_enqueue_scripts', 99);

/**
 * Custom dropdown menu and navbar in walker class
 */


require_once( get_stylesheet_directory() . '/inc/BootstrapCCMyWalkerNavMenu.php');

//Add custom image sizes 

add_action( 'after_setup_theme', 'cc_imagesize_theme_setup' );
function cc_imagesize_theme_setup() {
    add_image_size( 'post-thumbnail', 320, 240, array( 'left', 'top' ) ); 
    add_image_size( 'banner-size-full', 1920, 512, true ); 
    add_image_size( 'banner-size-normal', 900, 445 ); 
    add_image_size( 'slide-size', 1920, 805, true ); 
    add_image_size( 'ins-logo-size', 250, 100); 
}


// Add header top menu location
function cc_child_register_my_menu() {
    register_nav_menu('header-top-menu',__( 'Header Top Menu' ));
    register_nav_menu('footer-menu',__( 'Footer Menu' ));
}

add_action( 'init', 'cc_child_register_my_menu' );



function cc_child_custom_init_2() {
    $args = array(
      'public' => true,
      'label'  => 'Testimonials'
    );
    register_post_type( 'testimonials', $args );
}
add_action( 'init', 'cc_child_custom_init_2' );

add_action( 'init', 'cc_testimonials_init' );
/**
 * Register a team member post type.
 */
function cc_testimonials_init() {
	$labels = array(
		'name'               => _x( 'Testimonials', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Testimonial', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Testimonials', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'team_member', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Testimonial', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Testimonial', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Testimonial', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Testimonial', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Testimonials', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Testimonials', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Testimonials:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Testimonials found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Testimonials found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'testimonials' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author' )
	);

	register_post_type( 'testimonials', $args );
}

// Insurance companies logos
function cc_child_custom_init3() {
    $args = array(
      'public' => true,
      'label'  => 'Insurance companies'
    );
    register_post_type( 'insurance_company', $args );
}
add_action( 'init', 'cc_child_custom_init3' );

add_action( 'init', 'insurance_companies_init' );
/*
 * Register a team member post type.
 */
function insurance_companies_init() {
	$labels = array(
		'name'               => _x( 'Insurance companies', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Insurance company', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Insurance companies', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Insurance company', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'insurance_company', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Insurance company', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Insurance company', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Insurance company', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Insurance company', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Insurance companies', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Insurance companies', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Insurance companies:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Insurance companies found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Insurance companies found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'insurance-companies' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' )
	);

	register_post_type( 'insurance_company', $args );
}

// Job posts
function cc_child_custom_init4() {
    $args = array(
      'public' => true,
      'label'  => 'Job posts'
    );
    register_post_type( 'jobs', $args );
}
add_action( 'init', 'cc_child_custom_init4' );

add_action( 'init', 'job_posts_init' );
/*
 * Register a team member post type.
 */
function job_posts_init() {
	$labels = array(
		'name'               => _x( 'Job positions', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Job position', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Job positions', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Job position', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'job_position', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Job position', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Job position', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Job position', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Job position', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Job positions', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Job positions', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Job positions:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Job positions found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Job positions found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'jobs' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'excerpt' )
	);

	register_post_type( 'jobs', $args );
}

//Jobs taxonomy
function jobs_taxonomy() {  
    register_taxonomy(  
        'jobs_categories',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
        'jobs',        //post type name
        array(  
            'hierarchical' => true,  
            'label' => 'Job categories',  //Display name
            'query_var' => true,
            'rewrite' => array(
             'slug' => 'jobs-categories', // This controls the base slug that will display before each term
             'with_front' => false // Don't display the category base before 
            )
        )  
    );  
}  
add_action( 'init', 'jobs_taxonomy');


function cc_child_widgets_init() {

	register_sidebar( array(

		'name' => 'Footer Middle',
		'id' => 'footer-middle',
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="title">',
		'after_title' => '</h2>',
	) );
    
    register_sidebar( array(
		'name' => 'Footer Contact',
		'id' => 'footer-contact',
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="title">',
		'after_title' => '</h2>',
	) );
    
    register_sidebar( array(
		'name' => 'Content bottom',
		'id' => 'content-bottom',
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="title">',
		'after_title' => '</h2>',
	) );

    register_sidebar( array(
		'name' => 'Sidebar Right Pages Navigation',
		'id' => 'sidebar-right-nav',
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="title">',
		'after_title' => '</h2>',
	) );
}

add_action( 'widgets_init', 'cc_child_widgets_init' );



// Add logo and mobile logo theme upload settings

function cc_themeslug_theme_customizer( $wp_customize ) {
    
    $wp_customize->add_section( 'cc_logo_section' , array(
    'title'       => __( 'Logo', 'cc_bootstrap' ),
    'priority'    => 30,
    'description' => 'Upload a logo to replace the default site name and description in the header',
    ) );
    
    $wp_customize->add_setting( 'cc_logo' );
    
    
    $wp_customize->add_control ( 
        
        new WP_Customize_Image_Control( $wp_customize, 'themeslug_logo', array (
        
        'label'    => __( 'Logo', 'cc_bootstrap' ),
        'section'  => 'cc_logo_section',
        'settings' => 'cc_logo',
        ) 
        ) 
    );
    
    $wp_customize->add_section( 'cc_mobile_logo_section' , array(
    'title'       => __( 'Mobile logo', 'cc_bootstrap' ),
    'priority'    => 31,
    'description' => 'Upload a logo to be used on small screen devices',
    ) );
    
    $wp_customize->add_setting( 'cc_mobile_logo' );
    
    
    $wp_customize->add_control ( 
        
        new WP_Customize_Image_Control( $wp_customize, 'themeslug_mobile_logo', array (
        
        'label'    => __( 'Mobile logo', 'cc_bootstrap' ),
        'section'  => 'cc_mobile_logo_section',
        'settings' => 'cc_mobile_logo',
        ) 
        ) 
    );
    
}

add_action( 'customize_register', 'cc_themeslug_theme_customizer' );


// Breadcrumbs
function custom_breadcrumbs() {
       
    // Settings
    $separator          = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs clearfix';
    $home_title         = '<i class="fa fa-home" aria-hidden="true"></i>';
      
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';
       
    // Get the query & post information
    global $post,$wp_query;
       
    // Do not display on the homepage
    if ( !is_front_page() ) {
       
        // Build the breadcrums
        echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';
           
        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="Homepage">' . $home_title . '</a></li>';
        echo '<li class="separator separator-home"> ' . $separator . ' </li>';
           
        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
              
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title() . '</strong></li>';
              
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';
              
        } else if ( is_single() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            /* Get post category info
            $category = get_the_category();
             
            if(!empty($category)) {
              
                // Get last category post is in
                $last_category = end(array_values($category));
                  
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'.$parents.'</li>';
                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }
             
            }
             */ 
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                   
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
               
            }
              
            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                  
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                  
                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
              
            } else {
                  
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                  
            }
              
        } else if ( is_category() ) {
               
            // Category page
            echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';
               
        } else if ( is_page() ) {
               
            // Standard page
            if( $post->post_parent ){
                   
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
                // Parent page loop
                if ( !isset( $parents ) ) $parents = null;
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }
                   
                // Display parent pages
                echo $parents;
                   
                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
                   
            } else {
                   
                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
                   
            }
               
        } else if ( is_tag() ) {
               
            // Tag page
               
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            // Display the tag name
            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';
           
        } elseif ( is_day() ) {
               
            // Day archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
               
            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
               
        } else if ( is_month() ) {
               
            // Month Archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
               
        } else if ( is_year() ) {
               
            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
               
        } else if ( is_author() ) {
               
            // Auhor archive
               
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
               
            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
           
        } else if ( get_query_var('paged') ) {
               
            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';
               
        } else if ( is_search() ) {
           
            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';
           
        } elseif ( is_404() ) {
               
            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        } 
        echo '</ul>';      
    }      
}

//Customize the excerpt lenght
//Read More Button For Excerpt


// Customize read more link on posts list

add_filter('excerpt_more', 'bootstrapBasicExcerptMore');

function cc_boostrap_excerpt_read_more_link( $output ) {
	global $post;
	return $output . ' <a href="' . get_permalink( $post->ID ) . '" class="more-link" title="Read More">Read More</a>';
}
add_filter( 'the_excerpt', 'cc_boostrap_excerpt_read_more_link' );

// Related pages list in Sidebar Right

function cc_related_pages() { 
global $post;
$orig_post = $post;
$tags = wp_get_post_tags($post->ID);
if ($tags) {
$tag_ids = array();
foreach($tags as $individual_tag)
$tag_ids[] = $individual_tag->term_id;
$args=array(
'post_type' => 'page',
'tag__in' => $tag_ids,
'post__not_in' => array($post->ID),
'posts_per_page'=>5
);
$my_query = new WP_Query( $args );
if( $my_query->have_posts() ) {
echo '<div id="relatedpages"><h3>Related Pages</h3><ul>';
while( $my_query->have_posts() ) {
$my_query->the_post(); ?>
<li>
<a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
</li>
<?php }
echo '</ul></div>';
} 
}
$post = $orig_post;
wp_reset_query(); 
}


// Register and load sidebar navigation widget
function cc_load_widget() {
	register_widget( 'cc_widget' );
}
add_action( 'widgets_init', 'cc_load_widget' );

// Creating the widget 
class cc_widget extends WP_Widget {

function __construct() {
parent::__construct(

// Base ID of your widget
'cc_widget', 

// Widget name will appear in UI
__('CC Sidebar Navigation Widget', 'cc_widget_domain'), 

// Widget description
array( 'description' => __( 'Custom Sidebar navigation widget for Castle Craig theme', 'cc_widget_domain' ), ) 
);
}

// Widget's front-end

public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );

// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];
//Widget code
    global $post;
    $parents = get_post($post->post_parent);
    $parent = $post->post_parent;
    $parent_title = get_the_title($parent);
    $grandparent_check = get_post_ancestors($post->ID);
    $grandparent = $parents->post_parent;
    $grandparent_title = get_the_title($grandparent);
    $children = get_pages( array( 'child_of' => $post->ID ) );
    
    $current_post = $post->ID;
    $current_title = get_the_title($current_post);
    if( count( $children ) == 0 && !empty($parents) ) {
        echo '<div class="sidebar-menu clearfix">';
        echo '<h3>' . $parent_title . '</h3><ul class="child-sidebar-menu parents">';
        wp_list_pages(array (
            'child_of'=>$parent,
            'post_type' => 'page',
            'sort_column'=>'menu_order', 
            'title_li'=> '',
            'depth' => 1 , 
       ));
        echo '</ul>';
        echo '</div>';
    } 
    elseif( count( $children ) == 0 && empty($parents) ) {
    echo '<div class="sidebar-menu clearfix">';
    echo '<h3>' . $parent_title . '</h3><ul class="child-sidebar-menu parent">';
        wp_list_pages(array (
            'child_of'=>$parent,
            'post_type' => 'page',
            'sort_column'=>'menu_order', 
            'title_li'=> '',
            'depth' => 1 , 
       )); 
    echo '</ul>';
    echo '</div>';
    }
    
    else {
    echo '<div class="sidebar-menu clearfix">';
    echo '<h3>' . $current_title . '</h3><ul class="child-sidebar-menu children">';
        wp_list_pages(array (
            'child_of'=>$current_post,
            'post_type' => 'page',
            'sort_column'=>'menu_order', 
            'title_li'=> '',
            'depth' => 1 , 
       )); 
    echo '</ul>';
    echo '</div>';
    }
    
echo $args['after_widget'];
}
		
// Widget's Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( '', 'cc_widget_domain' );
}
// Widget's admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} // Class cc_widget ends here

//Bootstrap child main column size
if (!function_exists('bootstrapCCGetMainColumnSize')) {
	/**
	 * Determine main column size from actived sidebar
	 * 
	 * For theme designer:
	 * By using this column size, Bootstrap grid size is 12. 
	 * You may change grid size of sidebar column to number you want; example sidebar-left.php grid 2, sidebar-right.php grid 3.
	 * Get Bootstrap grid size minus total sidebar grid size as conditions below this line.
	 * Both sidebar active. (12-2-3) = 7. Main column size is 7.
	 * Only left sidebar active. (12-2) = 10. Main column size is 10.
	 * Only right sidebar active. (12-3) = 9. Main column size is 9.
	 * No sidebar active. Main column is 12.
	 * Now, you write the condition above into the function below and return column size value.
	 * 
	 * @return integer return column size.
	 */
	function bootstrapCCGetMainColumnSize() 
	{
		if (is_active_sidebar('sidebar-left') && is_active_sidebar('sidebar-right')) {
			// if both sidebar actived.
			$main_column_size = 6;
		} 
        elseif (is_active_sidebar('sidebar-left') && is_active_sidebar('sidebar-right-nav')) {
			// if both sidebar actived.
			$main_column_size = 6;
		} 
        elseif (
				(is_active_sidebar('sidebar-left') && !is_active_sidebar('sidebar-right')) || 
				(is_active_sidebar('sidebar-right') && !is_active_sidebar('sidebar-left')) ||
                (is_active_sidebar('sidebar-right-nav') && !is_active_sidebar('sidebar-left'))
		          ) 
        {
			// if only one sidebar actived.
			$main_column_size = 9;
		} 
        else {
			// if no sidebar actived.
			$main_column_size = 12;
		}

		return $main_column_size;
	}// bootstrapCCGetMainColumnSize
}

// Add custom styles to TinyMCE
function cc_mce_buttons_2($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons', 'cc_mce_buttons_2');


function cc_add_editor_styles() {
    add_editor_style( get_stylesheet_directory_uri() . '/css/cc_editor_styles.css' );
}
add_action( 'init', 'cc_add_editor_styles' );

function cc_mce_before_init_insert_formats( $init_array ) {
    $style_formats = array(
        array(
            'title' => 'Inline list', // Title to show in dropdown
            'selector' => 'ul', // Element to add class to
            'classes' => 'inlineBlock' // CSS class to add
        ),
        array(
            'title' => 'Success Values List', // Title to show in dropdown
            'selector' => 'ul', // Element to add class to
            'classes' => 'successList clearfix' // CSS class to add
        ),
        array(
            'title' => 'Priorities List', // Title to show in dropdown
            'selector' => 'ul', // Element to add class to
            'classes' => 'prio1List' // CSS class to add
        ),
        array(
            'title' => 'Yellow Dots List', // Title to show in dropdown
            'selector' => 'ul', // Element to add class to
            'classes' => 'yellowdList' // CSS class to add
        ),
        array(
            'title' => 'Yellow Dots Rose Background List', // Title to show in dropdown
            'selector' => 'ul', // Element to add class to
            'classes' => 'yellowdList roseBackground' // CSS class to add
        ),
        array(
            'title' => 'Drugs List', // Title to show in dropdown
            'selector' => 'ul', // Element to add class to
            'classes' => 'drugsList' // CSS class to add
        ),
        array(
            'title' => 'Violet Spheres List', // Title to show in dropdown
            'selector' => 'ul', // Element to add class to
            'classes' => 'violetsList clearfix' // CSS class to add
        ),
        array(
            'title' => 'Angle Right Violet Dot List', // Title to show in dropdown
            'selector' => 'ul', // Element to add class to
            'classes' => 'anglerightVdotList' // CSS class to add
        ),
        array(
            'title' => 'Callout Header H2', // Title to show in dropdown
            'selector' => 'h2', // Element to add class to
            'classes' => 'Callout' // CSS class to add
        ),
        array(
            'title' => 'Angle-Right link', // Title to show in dropdown
            'selector' => 'a', // Element to add class to
            'classes' => 'angleRight' // CSS class to add
        ),
        array(
            'title' => 'Yellow button', // Title to show in dropdown
            'selector' => 'a', // Element to add class to
            'classes' => 'btn btn-primary' // CSS class to add
        ),
        array(
            'title' => 'Grey description text', // Title to show in dropdown
            'selector' => 'p', // Element to add class to
            'classes' => 'greyText' // CSS class to add
        ),
    );
    $init_array['style_formats'] = json_encode( $style_formats );
    return $init_array;
}
add_filter( 'tiny_mce_before_init', 'cc_mce_before_init_insert_formats' );

// Pagination with links
function cc_numeric_posts_nav() {
 
    if( is_singular() )
        return;
 
    global $wp_query;
 
    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;
 
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
 
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
 
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
 
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
 
    echo '<div class="navigation"><ul>' . "\n";
 
    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
 
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
 
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
 
        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }
 
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
 
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";
 
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
 
    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link() );
 
    echo '</ul></div>' . "\n";
 
}

// Add Custom Shortcodes
add_shortcode('team_members', 'display_team_members');
function display_team_members($attr) {
        extract(shortcode_atts(array(
        'ids' => ''
        ), $attr));
        $ids_array = explode(',', $ids);        
        $args = array(
            'post_type' => 'amo-team',
            'post_status' => 'publish',
            'ignore_sticky_posts' => '1',
            'orderby' => 'post__in',
            'post__in'=> $ids_array
        );
        global $post;
        $output = '';
        $tm_loop = new WP_Query($args);
$the_query = new WP_Query( $args );
// The Loop
if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		$output .= '<div class="teamImage col-xs-6 col-sm-3 col-md-2">'.get_the_post_thumbnail($post->ID, 'thumbnail').'</div>';
	}
	   wp_reset_postdata();        
        return $output;
} else {
	// no posts found
}

}

add_shortcode( 'testimonial', 'display_testimonial' );

    function display_testimonial($atts){
        global $post;        
        $output = '';
        extract(shortcode_atts(array(
        'id' => ''
        ), $atts));

        $id_array = explode(',', $id); 
        
        $args = array(
            'post_type' => 'testimonials',
            'post_status' => 'publish',
            'ignore_sticky_posts' => '1',
            'post__in' => $id_array
            
        );
        
        $query = new WP_Query( $args );  
        if( $query->have_posts() ){
            
            while( $query->have_posts() ){
                $query->the_post();
                $output = '<div class="testimonialWrapper"><div class="testimonalText">'.get_the_content().'</div><h6><span>-&nbsp;'. get_the_title($post->ID).'</span> <a href="/experience-castle-craig/testimonials">'.esc_html__( 'More Patient Voices', 'my-text-domain' ).'</a></h6>';
                $output .='</div>';
            }
        wp_reset_postdata();
        return $output;
        }
        
    }

add_shortcode('insurance_companies', 'display_insurance_companies');

    function display_insurance_companies() {
        $args = array(
            'post_type' => 'insurance_company',
            'post_status' => 'publish',
            'orderby' => 'updated_date',
            'order' => 'ASC',
        );
        global $post; 
        $output = '';
        $ic_loop = new WP_Query($args);
            if ( $ic_loop->have_posts() ) {
            $output .= '<ul class="listInsCompanies clearfix">';
        while ( $ic_loop->have_posts() ) {
            $ic_loop->the_post(); 
            
            $output .= '<li class="icImage">'.get_the_post_thumbnail($post->ID, 'ins-logo-size').'</li>';    
        }
        $output .= '</ul>';
        wp_reset_postdata();        
        return $output;

            } else {
	// no posts found
            }
}

function hook_cf7tyGoal() {
	?>
	<script>
		document.addEventListener( 'wpcf7mailsent', function ( event ) {
           location = '/thank-you/';
		}, false );

	</script>
	<?php
}
add_action( 'wp_head', 'hook_cf7tyGoal' );




add_shortcode('testimonials_list', 'display_testimonials_list');


function display_testimonials_list($atts) {
	extract( shortcode_atts( array(
		'expand' => '',
	), $atts) );
    global $post, $paged;
    
    if ( get_query_var('paged') ) {
    $paged = get_query_var('paged');
    } else if ( get_query_var('page') ) {
    $paged = get_query_var('page');
    } else {
    $paged = 1;
    }
    $posts_per_page = 8;
    $settings = array(
        'showposts' => $posts_per_page, 
        'post_type' => 'testimonials', 
            'post_status' => 'publish',
            'orderby' => 'updated_date',
            'order' => 'ASC',
            'paged' => $paged
    );
	
    $post_query = new WP_Query( $settings );	
    
    $total_found_posts = $post_query->found_posts;
    $total_page = ceil($total_found_posts / $posts_per_page);
		
	$list = '';
    $list .= '<div class="listTestimonials clearfix">';
	while ( $post_query->have_posts() ) {
        
		$post_query->the_post();
        $list .= '<div class="testimonialWrapper"><div class="testimonalText">'.get_the_content().'</div><h6><span>-&nbsp;'. get_the_title($post->ID).'</span></h6></div>';
	}
    
    
	$list .= '</div>';
    
    wp_reset_postdata();
    
    if(function_exists('wp_pagenavi')) {
        $list .='<div class="page-navigation">'.wp_pagenavi(array('query' => $post_query, 'echo' => false)).'</div>';
    } else {
        $list.='
        <div class="testimonialPager">
        <span class="prev-posts-links">'.get_previous_posts_link('Previous Page ').'</span>
        <span class="next-posts-links">'.get_next_posts_link(' Next Page', $total_page).'</span>
        </div>
        ';
    }
    
	return $list;
   }

add_shortcode('jobs_list', 'display_jobs');

    function display_jobs() {
        $args = array(
            'post_type' => 'jobs',
            'post_status' => 'publish',
            'orderby' => 'updated_date',
            'order' => 'DESC',
        );
        global $post;
        $output = '';
        $jobs_loop = new WP_Query($args);
        if ( $jobs_loop->have_posts() ) {
             $output .= '<ul class="listJobs clearfix">';
            while ( $jobs_loop->have_posts() ) {
            $jobs_loop->the_post();

            $output .= '<li class="jobItem">';
            $output .= '<a href="'.get_permalink($post->ID).'">';
            $taxonomy = 'jobs_categories';
            // Get the term IDs assigned to posts
            $post_terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );

            $term_ids = implode( ',' , $post_terms );
              $args = array(
                 'orderby' => 'name',
                 'parent' => 0,
                  'include'  => $term_ids,
                 'taxonomy' => $taxonomy
              );
              $categories = get_categories( $args, $post->ID );
              foreach ( $categories as $category ) {
                 $output .= '<span>'.$category->name . '</span>';
              }
            $output .= ': '.get_the_title($post->ID). ' | '.get_the_date('d/m/Y').'</a></li>';

        }
            $output .= '</ul>';
        /* Restore original Post Data */
        wp_reset_postdata();
            return $output;
    } else {}       
}

/** 
 * Use GD instead of Imagemagick
 */
add_filter('wp_image_editors', 'disable_imagemagick');
function disable_imagemagick($editor) {
  return array('WP_Image_Editor_GD');
}

//Register Sidebar for Parent and child
register_sidebar( array(
        'name' => __( 'Parent Menu Sidebar', 'theme-slug' ),
        'id' => 'parentChild',
        'description' => __( 'It will display the parent and child page.', 'theme-slug' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
    'after_widget'  => '</li>',
    'before_title'  => '<h2 class="widgettitle">',
    'after_title'   => '</h2>',
    ) );
?>