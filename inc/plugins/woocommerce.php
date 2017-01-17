<?php


// Disable Storefront CSS
function godspeed_remove_storefront_style() {
    //wp_dequeue_style( 'storefront-style' );
    //wp_dequeue_style( 'storefront-woocommerce-style' );
}
add_action( 'wp_enqueue_scripts', 'godspeed_remove_storefront_style', 999 );

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


/********************************************/


// Woocommerce Shop Managers: redirect to orders
function godspeed_woocommerce_redirect_shopmanagers( $redirect_to, $request, $user ) {

    $redirect_to_orders = admin_url( 'edit.php?post_type=shop_order');

    //is there a user to check?
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        //check for admins
        if ( in_array( 'administrator', $user->roles ) ) {
            // redirect them to the default place
            return $redirect_to;
        } elseif ( in_array( 'shop_manager', $user->roles ) ) {
            //Redirect shop managers to the orders page
            return $redirect_to_orders;
        } else {
            return home_url();
        }
    } else {
        return $redirect_to;
    }
}
add_filter( 'login_redirect', 'godspeed_woocommerce_redirect_shopmanagers', 10, 3 );



// Menu icon for Woocommerce
add_action( 'admin_head', 'godspeed_woocommerce_menu_icon',40 );
function godspeed_woocommerce_menu_icon(){

    print '<style type="text/css">';
    print '#adminmenu #toplevel_page_woocommerce .menu-icon-generic div.wp-menu-image:before{content: "\f174" !important;font-family: "dashicons" !important;}';
    print '</style>';
}

// Rename woocommerce menu
add_action( 'admin_menu', 'godspeed_woocoomerce_rename_menu', 999 );
function godspeed_woocoomerce_rename_menu()
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

add_action( 'init', 'godspeed_remove_storefront_breadcrumb' );
function godspeed_remove_storefront_breadcrumb() {
    remove_action( 'storefront_content_top', 'woocommerce_breadcrumb', 	10 );
    add_action( 'storefront_content_top','godspeed_add_yoast_breadcrumb', 10, 0);
}

function godspeed_add_yoast_breadcrumb()
{
    if (function_exists('yoast_breadcrumb') && ! is_front_page()) {
        yoast_breadcrumb('<nav class="breadcrumbs woocommerce-breadcrumb">', '</nav>');
    }
}


// Remove Woocommerce footer credit
add_action( 'init', 'godspeed_remove_footer_credit', 10 );

function godspeed_remove_footer_credit () {
    remove_action( 'storefront_footer', 'storefront_credit', 20 );
}


