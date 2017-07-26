<?php

// inheriting style of parent theme
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}


// registering custom post type
add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'dish',
    array(
      'labels' => array(
        'name' => __( 'Dishes' ),
        'singular_name' => __( 'Dish' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}

// creating dining group custom taxonomy
//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_dining_group_hierarchical_taxonomy', 0 );

//create a custom taxonomy name it topics for your posts

function create_dining_group_hierarchical_taxonomy() {

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

  $labels = array(
    'name' => _x( 'Dining Groups', 'taxonomy general name' ),
    'singular_name' => _x( 'Dining Group', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Dining Groups' ),
    'all_items' => __( 'All Dining Groups' ),
    'parent_item' => __( 'Parent Dining Group' ),
    'parent_item_colon' => __( 'Parent Dining Group:' ),
    'edit_item' => __( 'Edit Dining Group' ), 
    'update_item' => __( 'Update Dining Group' ),
    'add_new_item' => __( 'Add New Dining Group' ),
    'new_item_name' => __( 'New Dining Group Name' ),
    'menu_name' => __( 'Dining Groups' ),
  ); 	

// Now register the taxonomy

  register_taxonomy('dining_groups',array('dish'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'dining-group' ),
  ));

}

// creating collection custom taxonomy
//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_collections_hierarchical_taxonomy', 0 );

//create a custom taxonomy name it topics for your posts

function create_collections_hierarchical_taxonomy() {

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

  $labels = array(
    'name' => _x( 'Collections', 'taxonomy general name' ),
    'singular_name' => _x( 'Collection', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Collections' ),
    'all_items' => __( 'All Collections' ),
    'parent_item' => __( 'Parent Collection' ),
    'parent_item_colon' => __( 'Parent Collection:' ),
    'edit_item' => __( 'Edit Collection' ), 
    'update_item' => __( 'Update Collection' ),
    'add_new_item' => __( 'Add New Collection' ),
    'new_item_name' => __( 'New Collection Name' ),
    'menu_name' => __( 'Collections' ),
  ); 	

// Now register the taxonomy

  register_taxonomy('collections',array('dish'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'collection' ),
  ));

}