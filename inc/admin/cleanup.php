<?php

/**
 * Remove unnecessary dashboard widgets
 */
function godspeed_remove_dashboard_widgets()
{
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
    remove_meta_box('dashboard_primary', 'dashboard', 'normal');
    remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
    // Remove  WordPress Welcome Panel
    remove_action('welcome_panel', 'wp_welcome_panel');
}

add_action('admin_init', 'godspeed_remove_dashboard_widgets');


/**
 * Remove WP menu in admin toolbar
 */
function godspeed_remove_wp_logo_from_admin_bar()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
}

add_action('wp_before_admin_bar_render', 'godspeed_remove_wp_logo_from_admin_bar', 7);


/**
 * Filter Medias
 *
 * @link http://code.tutsplus.com/articles/quick-tip-add-extra-media-type-filters-to-the-wordpress-media-manager--wp-25998
 */
function godspeed_post_mime_types( $post_mime_types ) {
    $post_mime_types['application/pdf'] = array( __( 'PDFs' ), __( 'Manage PDFs' ), _n_noop( 'PDF <span class="count">(%s)</span>', 'PDFs <span class="count">(%s)</span>' ) );
    return $post_mime_types;
}
add_filter( 'post_mime_types', 'godspeed_post_mime_types' );
