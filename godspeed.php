<?php
/**
 * Plugin Name:       Godspeed optimizations
 * Description:       A handy little plugin to contain your theme customisation snippets.
 * Plugin URI:        http://github.com/nicomollet/godspeed
 * Version:           1.0.2
 * Author:            Nicolas Mollet
 * Author URI:        https://github.com/nicomollet/
 * Requires at least: 3.0.0
 * Tested up to:      4.7.3
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
 * @version	1.0.1
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

        // Admin only
        if ( is_admin() ) {
            require_once( 'inc/admin/cleanup.php');        // Clean admin
            require_once( 'inc/admin/humility.php');       // Menu Humility: reorders admin menus
            require_once( 'inc/admin/profile.php');        // Profile fields
            require_once( 'inc/admin/htmleditor.php');     // HTML Editor
        }

        // Front only
        if ( ! is_admin() ) {
            require_once( 'inc/front/cleanup.php');        // Cleanup frontend
            require_once( 'inc/front/widgets.php');        // Widgets cleanup
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
        if (defined( 'GTM4WP_VERSION' )) {// GTM 4 WP
            require_once( 'inc/plugins/gtm4wp.php');
        }

        require_once( 'inc/plugins/performance.php');

        if (class_exists( 'SearchAutocomplete' )) {// Searchautocomplete cleanup
            require_once( 'inc/plugins/searchautocomplete.php');
        }

        if (function_exists( 'custom_post_widget_plugin_init' )) {// Custom Post Widget compatibility
            require_once( 'inc/plugins/custompostwidget.php');
        }

        if (class_exists( 'WP_Mailjet_Api' )) {// Mailjet cleanup
            require_once( 'inc/plugins/mailjet.php');
        }

	    require_once( 'inc/library/wp-simple-asset-optimizer/wp-simple-asset-optimizer.php' );
	    add_filter( 'wpsao_move', function () {
		    return array(
			    'jquery',
			    'jquery-migrate',
			    'jquery-core',
			    'jquery_json',
			    'gform_json',
			    'bootstrap',
			    'gform_placeholder',
			    'gform_gravityforms',
			    'gform_conditional_logic',
			    //'optin-monster-api-script',
			    //'wp-mediaelement',
			    //'visualizer-google-jsapi',
			    //'visualizer-render'
		    );
	    } );
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

if(!function_exists('recursive_array_search')):
    /**
     * Recursive array search
     *
     * @param $needle
     * @param $haystack
     *
     * @return bool|int|string
     */
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
endif;
