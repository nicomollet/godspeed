<?php

function godspeed_config() {

	echo '<script type="text/javascript">' . "\n";
	$godspeed_config = [
		'AJAXURL'              => admin_url( 'admin-ajax.php' ),
		'THEME_LANG'           => get_theme_mod( 'lang' ),
		'STYLESHEET_DIRECTORY' => get_bloginfo( 'stylesheet_directory' ),
		'WPURL'                => get_bloginfo( 'wpurl' ),
		'URL'                  => get_bloginfo( 'url' ),
		'LANGUAGE'             => get_bloginfo( 'language' ),
		'STYLESHEET_URL'       => get_bloginfo( 'stylesheet_url' ),
		'TEMPLATE_URL'         => get_bloginfo( 'template_url' ),
		'ENV'                  => current_user_can( 'administrator' ) ? 'development' : 'production',
	];
	echo 'var godspeed_config = ' . json_encode( $godspeed_config, JSON_PRETTY_PRINT ) . ";\n";
	echo '</script>' . "\n";
}
add_action( 'wp_footer', 'godspeed_config', -100 );

function godspeed_inframe() {
	echo '<script type="text/javascript">' . "\n";
	echo 'if(self !== top){' . "\n";
	echo 'document.documentElement.className ="in-frame";' . "\n";
	echo '}' . "\n";
	echo '</script>' . "\n";
}
add_action( 'wp_head', 'godspeed_inframe', 100 );
