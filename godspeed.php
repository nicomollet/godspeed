<?php
/**
 * Plugin Name:       Godspeed optimizations
 * Description:       A handy little plugin to contain your theme customisation snippets.
 * Plugin URI:        http://github.com/nicomollet/godspeed
 * Version:           1.0.0
 * Author:            Nicolas Mollet
 * Author URI:        https://github.com/nicomollet/
 * Requires at least: 3.0.0
 * Tested up to:      4.4.2
 *
 * @package godspeed_optimizations
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Main godspeed_optimizations Class
 *
 * @class godspeed_optimizations
 * @version	1.0.0
 * @since 1.0.0
 * @package	godspeed_optimizations
 */
final class godspeed_optimizations {

    /**
     * Set up the plugin
     */
    public function __construct() {

        require_once( 'inc/front/support.php');
        require_once( 'inc/plugins/jetpack.php');
        require_once( 'inc/front/thumbnails.php');       // Thumbnails for Bootstrap
        require_once( 'inc/admin/customizer.php');       // Customizer
        require_once( 'inc/front/owlcarousel.php');    // Load OwlCarousel shortcode

        // Admin only
        if ( is_admin() ) {
            require_once( 'inc/admin/cleanup.php');        // Clean admin
            require_once( 'inc/admin/humility.php');       // Menu Humility: reorders admin menus
        }

        // Front only
        if ( ! is_admin() ) {
            require_once( 'inc/front/carousel.php');       // Load Carousel shortcode
            require_once( 'inc/front/cleanup.php');        // Cleanup frontend
            require_once( 'inc/front/bodyclass.php');      // Body classes
            require_once( 'inc/front/favicon.php');        // Favicon
            require_once( 'inc/front/webfonts.php');
            require_once( 'inc/front/addthis.php');
            require_once( 'inc/front/shortcodes.php');     // Shortcodes for Bootstrap: alert, badge, label, button, gallery
            require_once( 'inc/front/widgets.php');        // Widgets cleanup
            require_once( 'inc/front/styles.php');
            require_once( 'inc/front/scripts.php');
        }

        // Plugins
        if ( class_exists( 'RGForms' ) ) {// Gravity Forms compatibility with Boostrap
            //require_once( 'inc/plugins/gravityforms.php');
        }
        if ( function_exists( 'icl_object_id' ) ) {// WPML switcher for Boostrap + cleanup styles
            require_once( 'inc/plugins/wpml.php');
        }
        if ( class_exists( 'Theme_My_Login' ) ) {// Theme My Login custom titles and custom pages
            //require_once( 'inc/plugins/thememylogin.php');
        }
        //if (current_theme_supports('woocommerce')) {// Woocommerce custom titles and custom pages
            require_once( 'inc/plugins/woocommerce.php');
        //}
        if (class_exists( 'JetPack' )) {// Jetpack cleanup
            require_once( 'inc/plugins/jetpack.php');
        }
        if (class_exists( 'BackWPup' )) {// Backwpup cleanup
            require_once( 'inc/plugins/backwpup.php');
        }
        if (class_exists( 'ITSEC_Core' )) {// iThemes Security cleanup
            require_once( 'inc/plugins/security.php');
        }
        if (class_exists( 'WPSEO_Admin' )) {// SEO cleanup
            require_once( 'inc/plugins/seo.php');
        }

        require_once( 'inc/plugins/performance.php');

        if (class_exists( 'SearchAutocomplete' )) {// Searchautocomplete cleanup
            require_once( 'inc/plugins/searchautocomplete.php');
        }
        if (class_exists( 'WP_Mailjet_Api' )) {// Mailjet cleanup
            require_once( 'inc/plugins/mailjet.php');
        }
    }

} // End Class

/**
 * The 'main' function
 *
 * @return void
 */
function godspeed_optimizations_main() {
    new godspeed_optimizations();
}

/**
 * Initialise the plugin
 */
add_action( 'plugins_loaded', 'godspeed_optimizations_main' );

// Recursive array search
function recursive_array_search( $needle, $haystack )
{
    foreach( $haystack as $key => $value )
    {
        $current_key = $key;
        if(
            $needle === $value
            OR (
                is_array( $value )
                && recursive_array_search( $needle, $value ) !== false
            )
        )
        {
            return $current_key;
        }
    }
    return false;
}