<?php

/**
 * Menu icon for W3TC
 */
function godspeed_w3tc_menu_icon(){

	print '<style type="text/css">';
	print '#adminmenu #toplevel_page_w3tc_dashboard .dashicons-before img{display:none}';
	print '#adminmenu #toplevel_page_w3tc_dashboard .wp-menu-image:before {';
	print ' content: "\f308" !important;';
	print '}';
	print '#adminmenu #toplevel_page_w3tc_dashboard .wp-menu-image {';
	print ' background: none !important;';
	print '}';
	print '</style>';
}
add_action( 'admin_head', 'godspeed_w3tc_menu_icon',30 );

if ( defined( 'WP_ROCKET_VERSION' ) ):

	/**
	 * WP Rocket defered scripts are too low in the wp_footer queue
	 */
	function godspeed_rocket_footer() {
		if(function_exists('__rocket_insert_minify_js_in_footer')){
			remove_action( 'wp_footer', '__rocket_insert_minify_js_in_footer', PHP_INT_MAX );
			add_action( 'wp_footer', '__rocket_insert_minify_js_in_footer', 20 );
			//apply_filters( 'rocket_minify_debug', '__return_true' );
		}
	}
	add_action( 'after_setup_theme', 'godspeed_rocket_footer', 0 );
	apply_filters( 'rocket_minify_debug', '__return_true' );

	/**
	 * @return string
	 */
	function godspeed_rocket_name(){
		return __( 'Cache', 'godspeed' );
	}
	add_filter( 'get_rocket_option_wl_plugin_name', 'godspeed_rocket_name' );


endif;
