<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

$the_theme = wp_get_theme();
$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_sidebar( 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="container-fluid add-gutter">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">
					<div class="footer-menus">
					<div class="row">
						<div class="col-sm">
						<h4 class="footer-header">Inventory</h4>
						<?php
							wp_nav_menu( array( 
    							'theme_location' => 'footer-menu-one', 
    							'container_class' => 'footer-menu' ) ); 
						?>
						</div>
						<div class="col-sm">
						<h4 class="footer-header">Services</h4>
						<?php
							wp_nav_menu( array( 
    							'theme_location' => 'footer-menu-one', 
    							'container_class' => 'custom-menu-class' ) ); 
						?>
						</div>
						<div class="col-sm">
						<h4 class="footer-header">Contact</h4>
						<?php
							wp_nav_menu( array( 
    							'theme_location' => 'footer-menu-one', 
    							'container_class' => 'custom-menu-class' ) ); 
						?>
						</div>
						<div class="col-sm">
						<h4 class="footer-header">Find Inspiration</h4>						

						<?php if( have_rows('social_links', 'option') ): ?>

							    <ul class="social-menu">

								    <?php while( have_rows('social_links', 'option') ): the_row(); ?>


								        <li><a href="<?php the_sub_field('link'); ?>"><?php the_sub_field('icon'); ?></a></li>

								    <?php endwhile; ?>

							    </ul>

						<?php endif; ?>

						</div>
					</div>
				</div>

					<div class="site-info">

						<?php the_custom_logo(); ?>
						<p>© 2017 French Camp Co.</p>

							
					</div><!-- .site-info -->

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

