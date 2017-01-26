<?php

/**
 * Menu icon for Backwpup
 */
function backwpup_menu_icon(){

	print '<style type="text/css">';
	print '#adminmenu #toplevel_page_backwpup .dashicons-before img{display:none}';
	print '#adminmenu #toplevel_page_backwpup .wp-has-submenu div.wp-menu-image:before {';
	print ' content: "\f468" !important;';
	print ' font-family: "dashicons" !important;';
	print '}';
	print '</style>';
}
add_action( 'admin_head', 'backwpup_menu_icon',30 );

/*
 * Rename BackWPup menu
 */
function godspeed_backwpup_rename_menu()
{
    global $menu;

    // Pinpoint menu item
    $backwpup = recursive_array_search( 'BackWPup', $menu );

    // Validate
    if( !$backwpup )
        return;

    $menu[$backwpup][0] = __('Backups', 'backwpup');
}
add_action( 'admin_menu', 'godspeed_backwpup_rename_menu', 999 );