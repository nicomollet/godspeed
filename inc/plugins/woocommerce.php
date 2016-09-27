<?php

// Menu icon for Woocommerce
add_action( 'admin_head', 'woocommerce_menu_icon',40 );
function woocommerce_menu_icon(){

    print '<style type="text/css">';
    print '#adminmenu #toplevel_page_woocommerce .menu-icon-generic div.wp-menu-image:before{content: "\f174" !important;font-family: "dashicons" !important;}';
    print '</style>';
}

// Rename woocommerce menu
add_action( 'admin_menu', 'rename_woocoomerce', 999 );
function rename_woocoomerce()
{
    global $menu;

    // Pinpoint menu item
    $woo = recursive_array_search( 'WooCommerce', $menu );

    // Validate
    if( !$woo )
        return;

    $menu[$woo][0] = __('Orders', 'woocommerce');
}


// Put Woocommerce Javascript at the end of the footer
remove_action('wp_footer', 'wc_print_js', 25);
add_action('wp_footer', 'wc_print_js', PHP_INT_MAX);

// Remove Woocommerce styles
define('WOOCOMMERCE_USE_CSS',false); // until Woocommerce 2.1
add_filter( 'woocommerce_enqueue_styles', '__return_false' ); // after Woocommerce 2.1
