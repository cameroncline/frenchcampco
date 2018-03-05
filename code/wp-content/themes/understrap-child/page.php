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

if ($banner_image) {
	echo '<div class="container-fluid add-gutter">';
	echo '<div class="page-banner">';
	echo wp_get_attachment_image( $banner_image, $banner_size );
	
		if($text_overlay) {
			echo '<div class="banner-text">';
			echo '<div class="text-background">';
			echo $text_overlay;
			echo '</div>';
			echo '</div>';
		}

	echo '</div>';
	echo '</div>';
}

?>

<div class="wrapper" id="page-wrapper">
<div class="container-fluid add-gutter" id="content" tabindex="-1">
<!-- <div class="row"> -->
<main class="site-main" id="main">

<?php

if( have_rows('content_sections') ):

	while( have_rows('content_sections') ): the_row(); 

		echo '<div class="row content-sections">';

			if(have_rows('columns')):  
				
				while( have_rows('columns')): the_row();
					
					$text  = get_sub_field('text');
					$span_two = get_sub_field('span_two');
					$image = get_sub_field('image');
					$mobile_image = get_sub_field('mobile_image');
					$field_type = get_sub_field('field_type');
					$text_placement = get_sub_field('text_placement');
					
					echo '<div class="' . ( $span_two ? 'col-lg-8' : 'col-lg' ) . '">';
						if($field_type == 'text') {
							echo '<div class="content-section">';
							echo '<div class="inner-content">';
							echo $text;
							echo '</div>';
							echo '</div>';
						} elseif ($field_type == 'image') {
							echo '<div class="image-area">';
								echo wp_get_attachment_image( $image, $banner_size );
							echo '</div>';
						} elseif($field_type == 'full' ) {
							echo '<div class="full-banner">';
								if($mobile_image) {
								echo wp_get_attachment_image( $image, $banner_size, "", ["class" => "desktop-image"] );
								echo wp_get_attachment_image( $mobile_image, $banner_size, "", ["class" => "mobile-image"]  );
							} else {
								echo wp_get_attachment_image( $image, $banner_size );
							}
								echo '<div class="text-overlay dark-bg ' . $text_placement . '">';
								echo $text;
								echo '</div>';
							echo '</div>';

						}
						
					echo '</div>';
				
				endwhile;
				
			endif;

		echo '</div>';
	
	endwhile;

endif;

if(is_front_page()) {
	echo do_shortcode('[instashow columns="5" arrows_control="false" speed="1400" auto="6500"]');
}

?>


<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'loop-templates/content', 'page' ); ?>
<?php endwhile; // end of the loop. ?>

</main><!-- #main -->
</div><!-- #primary -->
<!-- </div> .row -->
</div><!-- Container end -->
</div><!-- Wrapper end -->

<?php get_footer(); ?>
