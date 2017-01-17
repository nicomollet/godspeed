<?php

// Support
function godspeed_support() {

    add_theme_support( 'automatic-feed-links' );               // RSS feeds
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );

    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
        add_theme_support( 'woocommerce' );
    }
}
add_action( 'after_setup_theme', 'godspeed_support' );