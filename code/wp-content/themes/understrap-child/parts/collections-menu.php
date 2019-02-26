<?php

$type_img = get_field('type_image', 'options');
$style_image = get_field('style_image', 'options');
$tablescape_image = get_field('tablescape_image', 'options');
$size = 'term-header';
?>

<div class="row rental-menu">
    <div class="col-md-4">    
        <div class="position-relative">
        <a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Rental Types' ) ) ); ?>">
        <?php echo wp_get_attachment_image($type_img, $size); ?>
        <div class="rental-menu-overlay"></div>
        <h3 class="menu-text text-center">Browse By Type</h3>
        </a>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="position-relative">
        <a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Rental Styles' ) ) ); ?>">
        <?php echo wp_get_attachment_image($style_image, $size); ?>
        <div class="rental-menu-overlay"></div>
        <h3 class="menu-text text-center">Browse By Styles</h3>
        </a>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="position-relative">
        <a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Tablescapes' ) ) ); ?>">
        <?php echo wp_get_attachment_image($tablescape_image, $size); ?>
        <div class="rental-menu-overlay"></div>
        <h3 class="menu-text text-center">View Tablescapes</h3>
        </a>
        </div>
    </div>
</div>