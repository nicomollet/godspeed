<?php

/**
 * Google Tag Manager for WordPress: Scripts in footer
 */
function godspeed_gtm4wp_fix() {
	if(!is_admin()){
		add_filter('gtm4wp_event-outbound', '__return_true');
		add_filter('gtm4wp_event-form-move', '__return_true');
		add_filter('gtm4wp_event-social', '__return_true');
		add_filter('gtm4wp_event-email-clicks', '__return_true');
		add_filter('gtm4wp_event-downloads', '__return_true');
		add_filter('gtm4wp_scroller-enabled', '__return_true');

		if(function_exists('gtm4wp_wp_footer')){
			remove_action( 'wp_footer', 'gtm4wp_wp_footer' );
			add_action( 'wp_footer', 'gtm4wp_wp_footer', 999 );
		}

		if(function_exists('gtm4wp_woocommerce_wp_footer')){
			remove_action( 'wp_footer', 'gtm4wp_woocommerce_wp_footer' );
			add_action( 'wp_footer', 'gtm4wp_woocommerce_wp_footer',500 );
		}
	}

}
add_action('init', 'godspeed_gtm4wp_fix');