<?php

/**
 * Cleaning up the Wordpress Head - Thanks to Roots Theme (Thanks to Roots Theme (http://www.rootstheme.com))
 */
function godspeed_head_cleanup() {

	add_action( 'wp_head', 'godspeed_staging_noindex' );
	add_action( 'wp_head', 'godspeed_remove_recent_comments_style', 1 );
	add_filter( 'use_default_gallery_style', '__return_false' );
	add_filter( 'the_category', 'godspeed_remove_rel_category' );
	add_filter( 'excerpt_length', 'godspeed_excerpt_length' );
	add_filter( 'excerpt_more', 'godspeed_auto_excerpt_more' );
	add_filter( 'get_the_excerpt', 'godspeed_excerpt_more', 500 );
	add_post_type_support( 'page', 'excerpt' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
}
add_action( 'init', 'godspeed_head_cleanup' );


// Staging: noindex
function godspeed_staging_noindex() {
	if ( get_option( 'blog_public' ) === '0' ) {
		echo '<meta name="robots" content="noindex,nofollow,noarchive,nosnippet">', "\n";
	}
}



// remove rel=category tag
function godspeed_remove_rel_category( $text ) {
	$text = str_replace( 'rel="category tag"', "", $text );
	return $text;
}


/**
 * Remove CSS from recent comments widget - Thanks to Roots Theme (http://www.rootstheme.com)
 */
function godspeed_remove_recent_comments_style() {
	global $wp_widget_factory;
	if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
		remove_action( 'wp_head', array(
				$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
				'recent_comments_style'
			) );
	}
}

/**
 * Excerpt length
 */
function godspeed_excerpt_length( $length ) {
	$excerpt_length = get_theme_mod('excerpt_length', 50);
	return $excerpt_length;
}


function godspeed_auto_excerpt_more( $more ) {
	return ' (&hellip;) ' . godspeed_more_link();
}


function godspeed_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output = '<p class="entry-excerpt">' . $output . godspeed_more_link() . '</p>';
	} else {
		$output = '<p class="entry-excerpt">' . $output . '</p>';
	}

	return $output;
}

function godspeed_more_link() {
	return ' <span class="excerpt-more"><a href="' . get_permalink() . '">' . __( 'Read&nbsp;more&hellip;', 'godspeed' ) . '</a></span>';
}





function is_element_empty( $element ) {
	$element = trim( $element );

	return empty( $element ) ? false : true;
}



function paragraph_to_unorderedlist( $text, $class = '', $multi = false ) {
	if ( $text == '' ) {
		return '';
	}
	$text = nl2br( $text );
	$lines = explode( '<br />', $text );
	$text = '<ul' . ( $class ? ' class="' . $class . '"' : '' ) . '>';
	$start = false;
	foreach ( $lines as $line ) :
		if ( $multi == true ) {
			if ( substr( trim( $line ), 0, 2 ) != '- ' ) {
				if ( $start == true ) {
					$text .= '</li>';
					$start = true;
				}
				$text .= '<li>' . '<span>' . $line . '</span>' . '';
			} else {
				$start = true;
				$text .= '<br/>' . $line . '';
			}

		} else {
			$text .= '<li>' . $line . '</li>';
		}

	endforeach;
	$text .= '</ul>';

	return $text;
}


/**
 * Wrap embedded media as suggested by Readability
 *
 * @link https://gist.github.com/965956
 * @link http://www.readability.com/publishers/guidelines#publisher
 */
function godspeed_embed_wrap( $cache, $url, $attr = '', $post_ID = '' ) {
	return '<div class="embed">' . $cache . '</div>';
}
add_filter( 'embed_oembed_html', 'godspeed_embed_wrap', 10, 4 );
add_filter( 'embed_googlevideo', 'godspeed_embed_wrap', 10, 2 );



function change_embed_size() {
	return array('width' => 600, 'height' => 300);
}
add_filter( 'embed_defaults', 'change_embed_size' );


// -------------------------------------------------------
// Other

function godspeed_viewport() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">' . "\n";
}

add_action( 'wp_head', 'godspeed_viewport', 1 );

function ietweaks() {
	echo '<meta http-equiv="imagetoolbar" content="no">' . "\n";
	echo '<meta name="MSSmartTagsPreventParsing" content="true">' . "\n";
}

//add_action('wp_head', 'ietweaks',100);

// show admin bar only for admins and editors
if ( ! current_user_can( 'edit_posts' ) ) {
	add_filter( 'show_admin_bar', '__return_false' );
}

// Disable the emoji's
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

// Filter function used to remove the tinymce emoji plugin
function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

// Remove category/tag term name in the title
function godspeed_the_archive_title($title){
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>' ;
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'godspeed_the_archive_title');


// Disable comments on attachment pages
function godspeed_media_comment_status( $open, $post_id ) {
    $post = get_post( $post_id );
    if( $post->post_type == 'attachment' ) {
        return false;
    }
    return $open;
}
add_filter( 'comments_open', 'godspeed_media_comment_status', 10 , 2 );