<?php

add_action( 'after_setup_theme', 'wpdocs_theme_setup' );
function wpdocs_theme_setup() {
    add_image_size( 'banner', 1960, 1080, true ); // (cropped)

}

?>