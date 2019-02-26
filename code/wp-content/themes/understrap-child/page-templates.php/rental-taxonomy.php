<?php
/**
 * Template Name: Taxononmy Template
 *
 * @package understrap
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );
$taxonomy = get_field('taxonomy');

?>

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

                <header class="page-header short">
						<?php
						the_title( '<h1 class="entry-title">', '</h1>' );
						the_content();
						?>
					</header><!-- .page-header -->

				<?php while ( have_posts() ) : the_post(); ?>

                    <?php 
                    
                    $terms = get_terms( $taxonomy );
 
                        echo '<div class="row">';
                        
                        foreach ( $terms as $term ) {
                            $term_link = get_term_link( $term );
                            $term_image = get_field('featured_image', $term);
                            
                            echo '<div class="col-md-3">';
                                echo '<div><a href="' . esc_url( $term_link ) . '">' . wp_get_attachment_image( $term_image, 'rental-gallery' ) . '</a></div>';
                                echo '<a href="' . esc_url( $term_link ) . '">' . $term->name . '</a>';
                            echo '</div>';
                        }
                        
                        echo '</div>';

                    ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->

		</div><!-- #primary -->

		<!-- Do the right sidebar check -->
		<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

	</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
