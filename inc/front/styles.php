<?php

// Disable Storefront CSS
function godspeed_remove_storefront_style() {
    wp_dequeue_style( 'storefront-style' );
    //wp_dequeue_style( 'storefront-woocommerce-style' );
}
add_action( 'wp_enqueue_scripts', 'godspeed_remove_storefront_style', 999 );

// Disable Storefront customizer inline CSS
add_filter('storefront_customizer_css', '__return_false');
add_filter('storefront_customizer_woocommerce_css', '__return_false');

function godspeed_remove_storefront_standard_functionality() {
    set_theme_mod('storefront_styles', '');
    set_theme_mod('storefront_woocommerce_styles', '');

    remove_theme_support( 'custom-background');
}

add_filter( 'storefront_custom_background_args', '__return_false' );

add_action( 'init', 'godspeed_remove_storefront_standard_functionality' );