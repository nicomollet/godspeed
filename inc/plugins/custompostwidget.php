<?php

/**
 * Custom Post Widget: allow translations by Polylang
 */
function godspeed_content_block_public()
{
    $content_block_public = true;
    return $content_block_public;
}
add_filter('content_block_post_type','godspeed_content_block_public');

/**
 * Custom Post Widget: exclude from sitemap XML from Yoast SEO
 *
 * @param $retval
 * @param $post_type
 *
 * @return bool
 */
function godspeed_content_block_exclude( $retval, $post_type ) {
    if ( 'content_block' === $post_type ) {
        $retval = false;
    }

    return $retval;
}
//add_filter( 'wpseo_sitemap_exclude_post_type', 'godspeed_content_block_exclude', 10, 2);

