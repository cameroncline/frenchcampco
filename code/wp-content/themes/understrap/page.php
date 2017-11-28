<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
$banner_image = get_field('banner_image');
$banner_size = 'banner';
$text_overlay = get_field('text_over_banner');
$color_theme = get_field('light_or_dark');

if ($banner_image) {
	echo '<div class="container-fluid">';
	echo '<div class="row">';
	echo wp_get_attachment_image( $banner_image, $banner_size );
	
		if($text_overlay) {
			echo '<div class="banner-text">';
			echo '<div class="text-background ' . $color_theme . '">';
			echo $text_overlay;
			echo '</div>';
			echo '</div>';
		}

	echo '</div>';
	echo '</div>';
}

?>

<div class="wrapper" id="page-wrapper">
<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">
<!-- <div class="row"> -->
<main class="site-main" id="main">

				
<?php
	// How It Works Columns
	$how_columns = get_field('how_columns');
	$how_count = 0;

	if($how_columns) {
					
		echo '<div class="container">';
		echo '<div class="row">';
		foreach($how_columns as $how_column) {
			echo '<div class="col">';
			echo '<div class="how-columns">';
			echo $how_column['link'] ? '<a href="' . $how_column['link'] . '">' : '';
			echo '<p class="how-icons">' . $how_column['icon'] . '</p>';
			echo '<h3 class="how-header">' . $how_column['title'] . '</h3>';
			echo '<p>' . $how_column['description'] . '</p>';
			echo $how_column['link'] ? '</a>' : '';
			echo '</div>';
			echo '</div>';
		}
					
		echo '</div>';
		echo '</div>';
	}
						
?>

<div class="container-fluid">
	<div class="row">
	<p>hello</p>
</div>

	<?php while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'loop-templates/content', 'page' ); ?>
	<?php endwhile; // end of the loop. ?>

</main><!-- #main -->
</div><!-- #primary -->
<!-- </div> .row -->
</div><!-- Container end -->
</div><!-- Wrapper end -->

<?php get_footer(); ?>
