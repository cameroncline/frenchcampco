<?php 

function wpbootstrap_scripts_with_jquery()
{
	// Register the script like this for a theme:
	wp_register_script( 'bootstrap', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array( 'jquery' ) );
	// For either a plugin or a theme, you can then enqueue the script:
	wp_enqueue_script( 'bootstrap' );
}

// Load styles
function frenchcampco_styles() {
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css', false, '2.3.2', 'all' );
    wp_enqueue_style( 'frenchcampco', get_template_directory_uri() . '/style.css', false, '1.9', 'all' );
    wp_enqueue_style( 'bootstrap_responsive', get_template_directory_uri() . '/bootstrap/css/bootstrap-responsive.css', false, '1.9', 'all' );

}

// Widgetizing the Sidebar
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));


// Navigation Menus
function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'footer-menu' => __( 'Footer Menu' )
    )
  );
}

add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );
add_action('wp_enqueue_scripts', 'frenchcampco_styles'); // Add Theme Stylesheet
add_action( 'init', 'register_my_menus' );



?>