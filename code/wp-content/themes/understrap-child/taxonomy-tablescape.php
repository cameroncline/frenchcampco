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
$term = get_queried_object();

$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
$banner_image = get_field('banner_image', $term);
$banner_size = 'banner';
$text_overlay = get_field('text_over_banner', $term);

?>

<div class="wrapper" id="page-wrapper">
<div class="container-fluid add-gutter" id="content" tabindex="-1">
<!-- <div class="row"> -->
<main class="site-main" id="main">

<?php

if( have_rows('content_sections', $term) ):

	while( have_rows('content_sections', $term) ): the_row(); 

		echo '<div class="row content-sections">';

			if(have_rows('columns', $term)):  
				
				while( have_rows('columns', $term)): the_row();
					
					$text  = get_sub_field('text', $term);
					$span_two = get_sub_field('span_two', $term);
					$image = get_sub_field('image', $term);
					$mobile_image = get_sub_field('mobile_image', $term);
					$field_type = get_sub_field('field_type', $term);
					$text_placement = get_sub_field('text_placement', $term);
					
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

?>


<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'loop-templates/content', get_post_format() ); ?>
<?php endwhile; // end of the loop. ?>

</main><!-- #main -->
</div><!-- #primary -->
<!-- </div> .row -->
</div><!-- Container end -->
</div><!-- Wrapper end -->

<?php get_footer(); ?>
