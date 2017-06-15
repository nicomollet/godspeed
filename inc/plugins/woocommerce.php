<?php


/**
 * Disable Storefront CSS
 */
function godspeed_remove_storefront_style() {
    //wp_dequeue_style( 'storefront-style' );
    //wp_dequeue_style( 'storefront-woocommerce-style' );
}
//add_action( 'wp_enqueue_scripts', 'godspeed_remove_storefront_style', 999 );

// Disable Storefront customizer inline CSS
//add_filter('storefront_customizer_css', '__return_false');
//add_filter('storefront_customizer_woocommerce_css', '__return_false');

function godspeed_remove_storefront_standard_functionality() {
    set_theme_mod('storefront_styles', '');
    set_theme_mod('storefront_woocommerce_styles', '');
    remove_theme_support( 'custom-background');
}

//add_filter( 'storefront_custom_background_args', '__return_false' );
//add_action( 'init', 'godspeed_remove_storefront_standard_functionality' );




// Put Woocommerce Javascript at the end of the footer
//remove_action('wp_footer', 'wc_print_js', 25);
//add_action('wp_footer', 'wc_print_js', PHP_INT_MAX);

// Remove Woocommerce styles
define('WOOCOMMERCE_USE_CSS',false); // until Woocommerce 2.1
add_filter( 'woocommerce_enqueue_styles', '__return_false' ); // after Woocommerce 2.1

/**
 * Remove Woocommerce Breadcrumb on Storefront
 */
function godspeed_remove_storefront_breadcrumb() {
    remove_action( 'storefront_content_top', 'woocommerce_breadcrumb', 	10 );
    add_action( 'storefront_content_top','godspeed_add_yoast_breadcrumb', 10, 0);
}

/**
 * Add Woocommerce Breadcrumb on Storefront
 */
function godspeed_add_yoast_breadcrumb()
{
    if (function_exists('yoast_breadcrumb') && ! is_front_page()) {
        yoast_breadcrumb('<nav class="breadcrumbs woocommerce-breadcrumb">', '</nav>');
    }
}
add_action( 'init', 'godspeed_remove_storefront_breadcrumb' );

// Remove Woocommerce footer credit on Storefront
function godspeed_remove_footer_credit () {
    remove_action( 'storefront_footer', 'storefront_credit', 20 );
}
add_action( 'init', 'godspeed_remove_footer_credit', 10 );


