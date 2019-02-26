<?php
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();

    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'popper-scripts', get_template_directory_uri() . '/js/popper.min.js', array(), false);
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
}

add_action( 'after_setup_theme', 'custom_image_sizes' );
function custom_image_sizes () {
	add_image_size( 'rental-gallery', 445, 550, true ); // (cropped)
    add_image_size( 'term-header', 1070, 580, true ); // (cropped)
    add_image_size( 'rental-image', 900, 800, true ); // (cropped)
    add_image_size( 'half-fold', 1920, 500, true ); // (cropped)
}


function create_post_type() {
    register_post_type( 'rental',
      array(
        'labels' => array(
          'name'                => __( 'Rentals' ),
          'singular_name'       => __( 'Rental' ),
          'menu_name'           => __( 'Rentals', 'understrap' ),
          'parent_item_colon'   => __( 'Parent Rental', 'understrap' ),
          'all_items'           => __( 'All Rentals', 'understrap' ),
          'view_item'           => __( 'View Rental', 'understrap' ),
          'add_new_item'        => __( 'Add New Rental', 'understrap' ),
          'add_new'             => __( 'Add New', 'understrap' ),
          'edit_item'           => __( 'Edit Rental', 'understrap' ),
          'update_item'         => __( 'Update Rental', 'understrap' ),
          'search_items'        => __( 'Search Rental', 'understrap' ),
          'not_found'           => __( 'Not Found', 'understrap' ),
          'not_found_in_trash'  => __( 'Not found in Trash', 'understrap' ),
        ),
            'public'            => true,
            'has_archive'       => true,
            'supports'          => array( 'title', 'revisions', 'custom-fields', 'thumbnail' ),
            'taxonomies'        => array( 'style', 'type', 'tablescape' ),
      )
    );
}

function style_init() {
	// create a new taxonomy
    $labels = array(
		'name'              => _x( 'Style', 'taxonomy general name', 'frenchcampco' ),
		'singular_name'     => _x( 'Style', 'taxonomy singular name', 'frenchcampco' ),
		'search_items'      => __( 'Search Styles', 'frenchcampco' ),
		'all_items'         => __( 'All Styles', 'frenchcampco' ),
		'parent_item'       => __( 'Parent Style', 'frenchcampco' ),
		'parent_item_colon' => __( 'Parent Style:', 'frenchcampco' ),
		'edit_item'         => __( 'Edit Style', 'frenchcampco' ),
		'update_item'       => __( 'Update Style', 'frenchcampco' ),
		'add_new_item'      => __( 'Add New Style', 'frenchcampco' ),
		'new_item_name'     => __( 'New Style Name', 'frenchcampco' ),
		'menu_name'         => __( 'Styles', 'frenchcampco' ),
	);

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'styles' ),
	);

	register_taxonomy( 'style', array( 'rental' ), $args );
}

function type_init() {
	// create a new taxonomy
    $labels = array(
		'name'              => _x( 'Rental Type', 'taxonomy general name', 'frenchcampco' ),
		'singular_name'     => _x( 'Rental Type', 'taxonomy singular name', 'frenchcampco' ),
		'search_items'      => __( 'Search Types', 'frenchcampco' ),
		'all_items'         => __( 'All Types', 'frenchcampco' ),
		'parent_item'       => __( 'Parent Type', 'frenchcampco' ),
		'parent_item_colon' => __( 'Parent Type:', 'frenchcampco' ),
		'edit_item'         => __( 'Edit Type', 'frenchcampco' ),
		'update_item'       => __( 'Update Type', 'frenchcampco' ),
		'add_new_item'      => __( 'Add New Type', 'frenchcampco' ),
		'new_item_name'     => __( 'New Type Name', 'frenchcampco' ),
		'menu_name'         => __( 'Types', 'frenchcampco' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
        'rewrite'           => array( 'slug' => 'types' ),
        'args'              => array( 'orderby' => 'term_order' ),
        'sort'              => true,
	);

	register_taxonomy( 'type', array( 'rental' ), $args );
}

function tablescape_init() {
	// create a new taxonomy
    $labels = array(
		'name'              => _x( 'Tablescapes', 'taxonomy general name', 'frenchcampco' ),
		'singular_name'     => _x( 'Tablescape', 'taxonomy singular name', 'frenchcampco' ),
		'search_items'      => __( 'Search Tablescapes', 'frenchcampco' ),
		'all_items'         => __( 'All Tablescapes', 'frenchcampco' ),
		'parent_item'       => __( 'Parent Tablescape', 'frenchcampco' ),
		'parent_item_colon' => __( 'Parent Tablescape:', 'frenchcampco' ),
		'edit_item'         => __( 'Edit Tablescape', 'frenchcampco' ),
		'update_item'       => __( 'Update Tablescape', 'frenchcampco' ),
		'add_new_item'      => __( 'Add New Tablescape', 'frenchcampco' ),
		'new_item_name'     => __( 'New Tablescape Name', 'frenchcampco' ),
		'menu_name'         => __( 'Tablescapes', 'frenchcampco' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'tablescapes' ),
	);

	register_taxonomy( 'tablescape', array( 'rental' ), $args );
}

add_action( 'init', 'type_init' );
add_action( 'init', 'style_init' );
add_action( 'init', 'tablescape_init' );
add_action( 'init', 'create_post_type' );

/* Custom Menus */

function wpb_custom_new_menu() {
  register_nav_menus(
    array(
      'footer-menu-one' => __( 'Footer Menu One' ),
      'footer-menu-two' => __( 'Footer Menu Two' ),
      'footer-menu-three' => __( 'Footer Menu Three' )
    )
  );
}
add_action( 'init', 'wpb_custom_new_menu' );

/* Adding Options Page */

if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Header Settings',
        'menu_title'    => 'Header',
        'parent_slug'   => 'theme-general-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Footer Settings',
        'menu_title'    => 'Footer',
        'parent_slug'   => 'theme-general-settings',
    ));
    
}

// Removing Before and After from Archive Titles
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_tax() ) {
			$title = single_tag_title( '', false );
		}
    return $title;
});