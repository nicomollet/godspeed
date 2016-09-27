<?php

// Support
function godspeed_support() {

    add_theme_support( 'automatic-feed-links' );               // RSS feeds
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'godspeed_support' );