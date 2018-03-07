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
            'supports'          => array( 'title', 'revisions', 'custom-fields', ),
            'taxonomies'        => array( 'category' ),
      )
    );

    register_post_type( 'tablescape',
      array(
        'labels' => array(
          'name'                => __( 'Tablescapes' ),
          'singular_name'       => __( 'Tablescape' ),
          'menu_name'           => __( 'Tablescapes', 'understrap' ),
          'parent_item_colon'   => __( 'Parent Tablescape', 'understrap' ),
          'all_items'           => __( 'All Tablescapes', 'understrap' ),
          'view_item'           => __( 'View Tablescape', 'understrap' ),
          'add_new_item'        => __( 'Add New Tablescape', 'understrap' ),
          'add_new'             => __( 'Add New', 'understrap' ),
          'edit_item'           => __( 'Edit Tablescape', 'understrap' ),
          'update_item'         => __( 'Update Tablescape', 'understrap' ),
          'search_items'        => __( 'Search Tablescapes', 'understrap' ),
          'not_found'           => __( 'Not Found', 'understrap' ),
          'not_found_in_trash'  => __( 'Not found in Trash', 'understrap' ),
        ),
            'public'            => true,
            'has_archive'       => true,
            'supports'          => array( 'title', 'revisions', 'custom-fields', ),
            'taxonomies'        => array( 'style' ),
      )
    );
}

add_action( 'init', 'create_post_type' );

function style_init() {
	// create a new taxonomy
    $labels = array(
		'name'              => _x( 'Styles', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Style', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Styles', 'textdomain' ),
		'all_items'         => __( 'All Styles', 'textdomain' ),
		'parent_item'       => __( 'Parent Style', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Style:', 'textdomain' ),
		'edit_item'         => __( 'Edit Style', 'textdomain' ),
		'update_item'       => __( 'Update Style', 'textdomain' ),
		'add_new_item'      => __( 'Add New Style', 'textdomain' ),
		'new_item_name'     => __( 'New Style Name', 'textdomain' ),
		'menu_name'         => __( 'Style', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'style' ),
	);

	register_taxonomy( 'style', array( 'tablescape' ), $args );
}
add_action( 'init', 'style_init' );

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