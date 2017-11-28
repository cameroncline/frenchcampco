<?php
/**
 * Partial template for content in page.php
 *
 * @package understrap
 */

$page_title = get_field('hide_page_title');

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php !$page_title ? the_title( '<h1 class="entry-title">', '</h1>' ) : ''; ?>

	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content">

		<?php the_content(); ?>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
			'after'  => '</div>',
		) );
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
