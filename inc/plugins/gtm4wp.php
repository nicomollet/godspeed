<?php

// gtm4wp_
// GTM4WP_VERSION

function godspeed_gtm4wp_fix() {
    if(!is_admin()){
        add_filter('gtm4wp_event-outbound', '__return_true');
        add_filter('gtm4wp_event-form-move', '__return_true');
        add_filter('gtm4wp_event-social', '__return_true');
        add_filter('gtm4wp_event-email-clicks', '__return_true');
        add_filter('gtm4wp_event-downloads', '__return_true');
	    add_filter('gtm4wp_scroller-enabled', '__return_true');
    }
}
add_action('init', 'godspeed_gtm4wp_fix');