<?php


/**
 * Disable Storefront CSS
 */
function godspeed_remove_storefront_standard_functionality() {
    set_theme_mod('storefront_styles', '');
    set_theme_mod('storefront_woocommerce_styles', '');
    remove_theme_support( 'custom-background');
}

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

/**
 * Remove Woocommerce footer credit on Storefront
 */
function godspeed_remove_footer_credit () {
    remove_action( 'storefront_footer', 'storefront_credit', 20 );
}
add_action( 'init', 'godspeed_remove_footer_credit', 10 );

// Remove WooCommerce Updater
remove_action('admin_notices', 'woothemes_updater_notice');


