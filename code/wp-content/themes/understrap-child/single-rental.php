<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

get_header();
$container   = get_theme_mod( 'understrap_container_type' );
$dish_name = get_the_title();
$type = get_the_terms(get_the_ID(), 'type')[0];
$style = get_the_terms(get_the_ID(), 'style')[0];
$currentID = get_the_ID();

?>

<div class="wrapper" id="single-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

			<main class="site-main" id="main">

				<?php while ( have_posts() ) : the_post(); ?>
                        
                    <div id="rental-product">
                    <div class="row">
                    <div class="col-lg-6">    
                        <?php 

                            $images = get_field('image_gallery');
                            $image_count = 0;

                            if( $images ): ?>

                                <div id="rental-gallery" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <?php foreach( $images as $image ): ?>
                                        <li data-target="#rental-gallery" data-slide-to="<?php echo $image_count; ?>" class="active"></li>
                                        <?php $image_count++; ?>
                                    <?php endforeach; ?>
                                </ol>
                                
                                <?php $image_count = 0; ?>
                                <div class="carousel-inner">
                                    <?php foreach( $images as $image ): ?>
                                        <div class="carousel-item<?php echo $image_count == 0 ? ' active': ''; ?>">
                                            <?php echo wp_get_attachment_image( $image['ID'], 'rental-image', array( "class" => "d-block w-100" ) ); ?>
                                        </div>
                                    <?php $image_count++; ?>
                                    <?php endforeach; ?>
                                </div>
                                </div>
                
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-6">
                        <div class="rental-content">
                            <?php

                            $description = get_field('description');
                            $pricing = get_field('pricing');
                            
                            the_title('<h1>', '</h1>');
                            echo $description;
                            
                            if($pricing) {
                                echo '<h3>Pricing</h3>';
                                echo '<ul class="pricing-list">';
                                foreach( $pricing as $price ) {
                                    echo '<li>' . $price['pricepoint'] . '</li>';
                                }
                                echo '</ul>';
                            }

                            echo '<div class="btn-cont">';
                            echo '<a class="custom-underline-text" href="' . get_permalink( get_page_by_title( 'Contact' ) ) . '">Reserve</a>';
                            echo '</div>';
                            
                            ?>
                        </div>

                    </div>
                    </div>
                    </div>
                    
                    <?php 
                    // Tablescapes
                    $tablescapes = get_the_terms( get_the_ID(), 'tablescape'); 
                    
                    if ($tablescapes) {
                    ?>
                    
                        <div id="featured-tablescapes">
                        <div class="row">
                            <div class="col-md-12">
                                
                                <?php foreach($tablescapes as $tablescape) {
                                    $term_image = get_field('featured_image', $tablescape);
                                    echo '<div>';
                                    echo wp_get_attachment_image( $term_image, 'half-fold' );
                                    echo '</div>';
                                    
                                    echo '<div class="tablescape-info">';
                                        echo '<h4>See the ' . $dish_name . ' in</h4>';
                                        echo '<h2 class="tablescape-title">' . $tablescape->name . '</h2>';
                                        echo '<div class="btn-cont">';
                                        echo '<a class="custom-underline-text" href="' . get_tag_link( $tablescape->term_id ) . '">View Photos</a>';
                                        echo '</div>';
                                    echo '</div>';

                                    
                                }

                                ?>

                            </div>
                        </div>
                        </div>

                    <?php } // end tablescapes ?> 

                    <?php 
                    // Items We Love
                    $loved_items = get_field('items_we_love');

                    if ($loved_items) { ?>

                    <div id="loved-items">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="tile-title">
                            <div class="tile-content">
                            <p>Items We Love with the</p>
                            <h4><?php echo $dish_name; ?></h4>
                            </div>
                            </div>
                        </div>

                        <?php foreach($loved_items as $item ) {
                            echo '<div class="col-md-3">';
                            echo '<a href="' . get_permalink( $item->ID ) . '">';
                            echo get_the_post_thumbnail( $item->ID, 'rental-gallery' );
                            echo '<div class="rental-tile-name">';
                            echo get_the_title( $item->ID );
                            echo '</div>';
                            echo '</a>';
                            echo '</div>';
                        } ?>                    
                    
                    </div>
                    </div>

                    <?php } // end Items We Love ?>


                    <?php 
                    // View More Types
                    $args = array(
                        'posts_per_page' => '3',
                        'order_by' => 'date', // it's also default
                        'order' => 'DESC', // it's also default
                        'post__not_in' => array($currentID),
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'type',
                                    'field' => 'name',
                                    'terms' => $type->name
                                )
                            )
                        );
                    
                    $types_query = new WP_Query( $args );

                    if( $types_query->have_posts() ) { ?>

                        <div id="more-type">
                        <div class="row">
                        <div class="col-lg-3 col-sm-4">
                            <div class="tile-title">
                            <div class="tile-content">
                            <p>View More</p>
                            <h4><?php echo $type->name; ?></h4>
                            </div>
                            </div>
                        </div>

                        <?php while ( $types_query->have_posts() ) {
		                    $types_query->the_post();
                            echo '<div class="col-lg-3 col-md-4">';
                            echo '<a href="' . get_permalink() . '">';
                            echo get_the_post_thumbnail('', 'rental-gallery');
                            echo '<div class="rental-tile-name">';
                            echo get_the_title();
                            echo '</div>';
                            echo '</a>';
                            echo '</div>';
	                        }
                        ?>

                    </div>   
                    </div> 
                    
                    <?php } // end more types ?>

                    <?php 
                    // View More Styles
                    $args = array(
                        'posts_per_page' => '3',
                        'order_by' => 'date', // it's also default
                        'order' => 'DESC', // it's also default
                        'post__not_in' => array($currentID),
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'type',
                                    'field' => 'name',
                                    'terms' => $style->name
                                )
                            )
                        );
                    
                    $styles_query = new WP_Query( $args );

                    if( $types_query->have_posts() ) { ?>

                        <div id="more-style">
                        <div class="row">
                        <div class="col-md-3">
                            <div class="tile-title">
                            <div class="tile-content">
                            <p>View More</p>
                            <h4><?php echo $style->name; ?></h4>
                            </div>
                            </div>
                        </div>

                        <?php while ( $types_query->have_posts() ) {
		                    $types_query->the_post();
                            echo '<div class="col-md-3">';
                            echo '<a href="' . get_permalink() . '">';
                            echo get_the_post_thumbnail('', 'rental-gallery');
                            echo '<div class="rental-tile-name">';
                            echo get_the_title();
                            echo '</div>';
                            echo '</a>';
                            echo '</div>';
	                        }
                        ?>

                    </div>
                    </div>
                    
                    <?php } // end more styles ?>

                    <?php get_template_part( 'parts/collections', 'cta' ); ?>
    
                
                <?php endwhile; // end of the loop. ?>

			</main><!-- #main -->

		</div><!-- #primary -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
