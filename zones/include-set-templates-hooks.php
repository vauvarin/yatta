<?php

/* Get the SMOF datas and loop on the different enabled zones in each pages/templates */



require_once( trailingslashit( get_template_directory() ) . 'zones/zone-header.php' );
require_once( trailingslashit( get_template_directory() ) . 'zones/zone-menu.php' );
require_once( trailingslashit( get_template_directory() ) . 'zones/zone-pagetitle.php' );
require_once( trailingslashit( get_template_directory() ) . 'zones/zone-pageeditor.php' );
require_once( trailingslashit( get_template_directory() ) . 'zones/zone-footer.php' );


/**
 * yatta_set_templates_hooks( $yatta_template_function = '' )
 *
 * Set the right function to the right Action
 *
 * @param String $yatta_template_function.
 * @return Nothing.
 * @since 1.0.0
 */
function yatta_set_templates_hooks( $yatta_template_function = '' ) {

	global $smof_data; // Fetch options stored in $smof_data

	/* DEFAULT : Fit the zone with the right default's hook */
	if ( array_key_exists('default_zones', $smof_data) ) {
		$layout_default = $smof_data['default_zones']['enabled'];
		if ( $layout_default ):
		(int)$yatta_default_count = 0;
		foreach ( $layout_default as $key_default => $value_default ) {
		    switch( $key_default ) {
		    	case 'zone_header':
			    	// Set the zone_header with the corresponding page hook
			    	add_action( 'yatta_hook_page_default_' . (string)$yatta_default_count , 'yatta_zone_header' , 10 );
			    break;
			    case 'zone_menu':
			    	// Set the zone_menu with the corresponding page hook
			    	add_action( 'yatta_hook_page_default_' . (string)$yatta_default_count , 'yatta_zone_menu' , 10 );
			    break;
			    case 'zone_pagetitle':
			    	// Set the zone_pagetitle with the corresponding page hook
			    	add_action( 'yatta_hook_page_default_' . (string)$yatta_default_count , 'yatta_zone_pagetitle' , 10 );
			    break;
			    case 'zone_pageeditor':
			    	// Set the zone_pageeditor with the corresponding page hook
			    	add_action( 'yatta_hook_page_default_' . (string)$yatta_default_count , 'yatta_zone_pageeditor' , 10 );
			    break;
			    case 'zone_footer':
			    	// Set the zone_footer with the corresponding page hook
			    	add_action( 'yatta_hook_page_default_' . (string)$yatta_default_count , 'yatta_zone_footer' , 10 );
			    break;
			}
			(int)$yatta_default_count++;
		}
		endif;
	}

	/* HOMEPAGE : Fit the zone with the right home's hook */
	if ( array_key_exists('home_zones', $smof_data) ) {
		$layout_home = $smof_data['home_zones']['enabled'];
		if ( $layout_home ):
		(int)$yatta_home_count = 0;
		foreach ( $layout_home as $key_home => $value_home ) {
		    switch( $key_home ) {
		    	case 'zone_header':
			    	// Set the zone_header with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_home_' . (string)$yatta_home_count , 'yatta_zone_header' , 10 );
			    break;
			    case 'zone_menu':
			    	// Set the zone_menu with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_home_' . (string)$yatta_home_count , 'yatta_zone_menu' , 10 );
			    break;
			    case 'zone_pagetitle':
			    	// Set the zone_pagetitle with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_home_' . (string)$yatta_home_count , 'yatta_zone_pagetitle' , 10 );
			    break;
			    case 'zone_pageeditor':
			    	// Set the zone_pageeditor with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_home_' . (string)$yatta_home_count , 'yatta_zone_pageeditor' , 10 );
			    break;
			    case 'zone_footer':
			    	// Set the zone_footer with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_home_' . (string)$yatta_home_count , 'yatta_zone_footer' , 10 );
			    break;
			}
			(int)$yatta_home_count++;
		}
		endif;
	}

	/* TEMPLATE_1 : Fit the zone with the right template_1's hook */
	if ( array_key_exists('template_1_zones', $smof_data) ) {
		$layout_template_1 = $smof_data['template_1_zones']['enabled'];
		
		if ( $layout_template_1 ):
		(int)$yatta_template_1_count = 0;
		foreach ( $layout_template_1 as $key_template_1 => $value_template_1 ) {
		    switch( $key_template_1 ) {
		    	case 'zone_header':
			    	// Set the zone_header with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_1_' . (string)$yatta_template_1_count , 'yatta_zone_header' , 10 );
			    break;
			    case 'zone_menu':
			    	// Set the zone_menu with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_1_' . (string)$yatta_template_1_count , 'yatta_zone_menu' , 10 );
			    break;
			    case 'zone_pagetitle':
			    	// Set the zone_pagetitle with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_1_' . (string)$yatta_home_count , 'yatta_zone_pagetitle' , 10 );
			    break;
			    case 'zone_pageeditor':
			    	// Set the zone_pageeditor with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_1_' . (string)$yatta_template_1_count , 'yatta_zone_pageeditor' , 10 );
			    break;
			    case 'zone_footer':
			    	// Set the zone_footer with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_1_' . (string)$yatta_template_1_count , 'yatta_zone_footer' , 10 );
			    break;
			}
			(int)$yatta_template_1_count++;
		}
		endif;
	}

	/* TEMPLATE_2 : Fit the zone with the right template_2's hook */
	if ( array_key_exists('template_2_zones', $smof_data) ) {
		$layout_template_2 = $smof_data['template_2_zones']['enabled'];
		if ( $layout_template_2 ):
		(int)$yatta_template_2_count = 0;
		foreach ( $layout_template_2 as $key_template_2 => $value_template_2 ) {
		    switch( $key_template_2 ) {
		    	case 'zone_header':
			    	// Set the zone_header with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_2_' . (string)$yatta_template_2_count , 'yatta_zone_header' , 10 );
			    break;
			    case 'zone_menu':
			    	// Set the zone_menu with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_2_' . (string)$yatta_template_2_count , 'yatta_zone_menu' , 10 );
			    break;
			    case 'zone_pagetitle':
			    	// Set the zone_pagetitle with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_2_' . (string)$yatta_home_count , 'yatta_zone_pagetitle' , 10 );
			    break;
			    case 'zone_pageeditor':
			    	// Set the zone_pageeditor with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_2_' . (string)$yatta_template_2_count , 'yatta_zone_pageeditor' , 10 );
			    break;
			    case 'zone_footer':
			    	// Set the zone_footer with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_2_' . (string)$yatta_template_2_count , 'yatta_zone_footer' , 10 );
			    break;
			}
			(int)$yatta_template_2_count++;
		}
		endif;
	}

	/* TEMPLATE_3 : Fit the zone with the right template_3's hook */
	if ( array_key_exists('template_3_zones', $smof_data) ) {
		$layout_template_3 = $smof_data['template_3_zones']['enabled'];
		if ( $layout_template_3 ):
		(int)$yatta_template_3_count = 0;
		foreach ( $layout_template_3 as $key_template_3 => $value_template_3 ) {
		    switch( $key_template_3 ) {
			    case 'zone_header':
			    	// Set the zone_header with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_3_' . (string)$yatta_template_3_count , 'yatta_zone_header' , 10 );
			    break;
			    case 'zone_menu':
			    	// Set the zone_menu with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_3_' . (string)$yatta_template_3_count , 'yatta_zone_menu' , 10 );
			    break;
			    case 'zone_pagetitle':
			    	// Set the zone_pagetitle with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_3_' . (string)$yatta_home_count , 'yatta_zone_pagetitle' , 10 );
			    break;
			    case 'zone_pageeditor':
			    	// Set the zone_pageeditor with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_3_' . (string)$yatta_template_3_count , 'yatta_zone_pageeditor' , 10 );
			    break;
			    case 'zone_footer':
			    	// Set the zone_footer with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_3_' . (string)$yatta_template_3_count , 'yatta_zone_footer' , 10 );
			    break;
			}
			(int)$yatta_template_3_count++;
		}
		endif;
	}



	/* TEMPLATE_4 : Fit the zone with the right template_4's hook */
	if ( array_key_exists('template_4_zones', $smof_data) ) {
		$layout_template_4 = $smof_data['template_4_zones']['enabled'];
		if ( $layout_template_4 ):
		(int)$yatta_template_4_count = 0;
		foreach ( $layout_template_4 as $key_template_4 => $value_template_4 ) {
		    switch( $key_template_4 ) {
			    case 'zone_header':
			    	// Set the zone_header with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_4_' . (string)$yatta_template_4_count , 'yatta_zone_header' , 10 );
			    break;
			    case 'zone_menu':
			    	// Set the zone_menu with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_4_' . (string)$yatta_template_4_count , 'yatta_zone_menu' , 10 );
			    break;
			    case 'zone_pagetitle':
			    	// Set the zone_pagetitle with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_4_' . (string)$yatta_home_count , 'yatta_zone_pagetitle' , 10 );
			    break;
			    case 'zone_pageeditor':
			    	// Set the zone_pageeditor with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_4_' . (string)$yatta_template_4_count , 'yatta_zone_pageeditor' , 10 );
			    break;
			    case 'zone_footer':
			    	// Set the zone_footer with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_4_' . (string)$yatta_template_4_count , 'yatta_zone_footer' , 10 );
			    break;
			}
			(int)$yatta_template_4_count++;
		}
		endif;
	}

	/* TEMPLATE_5 : Fit the zone with the right template_5's hook */
	if ( array_key_exists('template_5_zones', $smof_data) ) {
		$layout_template_5 = $smof_data['template_5_zones']['enabled'];
		if ( $layout_template_5 ):
		(int)$yatta_template_5_count = 0;
		foreach ( $layout_template_5 as $key_template_5 => $value_template_5 ) {
		    switch( $key_template_5 ) {
			    case 'zone_header':
			    	// Set the zone_header with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_5_' . (string)$yatta_template_5_count , 'yatta_zone_header' , 10 );
			    break;
			    case 'zone_menu':
			    	// Set the zone_menu with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_5_' . (string)$yatta_template_5_count , 'yatta_zone_menu' , 10 );
			    break;
			    case 'zone_pagetitle':
			    	// Set the zone_pagetitle with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_5_' . (string)$yatta_home_count , 'yatta_zone_pagetitle' , 10 );
			    break;
			    case 'zone_pageeditor':
			    	// Set the zone_pageeditor with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_5_' . (string)$yatta_template_5_count , 'yatta_zone_pageeditor' , 10 );
			    break;
			    case 'zone_footer':
			    	// Set the zone_footer with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_5_' . (string)$yatta_template_5_count , 'yatta_zone_footer' , 10 );
			    break;
			}
			(int)$yatta_template_5_count++;
		}
		endif;
	}

	/* TEMPLATE_6 : Fit the zone with the right template_6's hook */
	if ( array_key_exists('template_6_zones', $smof_data) ) {
		$layout_template_6 = $smof_data['template_6_zones']['enabled'];
		if ( $layout_template_6 ):
		(int)$yatta_template_6_count = 0;
		foreach ( $layout_template_6 as $key_template_6 => $value_template_6 ) {
		    switch( $key_template_6 ) {
			    case 'zone_header':
			    	// Set the zone_header with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_6_' . (string)$yatta_template_6_count , 'yatta_zone_header' , 10 );
			    break;
			    case 'zone_menu':
			    	// Set the zone_menu with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_6_' . (string)$yatta_template_6_count , 'yatta_zone_menu' , 10 );
			    break;
			    case 'zone_pagetitle':
			    	// Set the zone_pagetitle with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_6_' . (string)$yatta_home_count , 'yatta_zone_pagetitle' , 10 );
			    break;
			    case 'zone_pageeditor':
			    	// Set the zone_pageeditor with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_6_' . (string)$yatta_template_6_count , 'yatta_zone_pageeditor' , 10 );
			    break;
			    case 'zone_footer':
			    	// Set the zone_footer with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_6_' . (string)$yatta_template_6_count , 'yatta_zone_footer' , 10 );
			    break;
			}
			(int)$yatta_template_6_count++;
		}
		endif;
	}

	/* TEMPLATE_7 : Fit the zone with the right template_7's hook */
	if ( array_key_exists('template_7_zones', $smof_data) ) {
		$layout_template_7 = $smof_data['template_7_zones']['enabled'];
		if ( $layout_template_7 ):
		(int)$yatta_template_7_count = 0;
		foreach ( $layout_template_7 as $key_template_7 => $value_template_7 ) {
		    switch( $key_template_7 ) {
			    case 'zone_header':
			    	// Set the zone_header with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_7_' . (string)$yatta_template_7_count , 'yatta_zone_header' , 10 );
			    break;
			    case 'zone_menu':
			    	// Set the zone_menu with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_7_' . (string)$yatta_template_7_count , 'yatta_zone_menu' , 10 );
			    break;
			    case 'zone_pagetitle':
			    	// Set the zone_pagetitle with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_7_' . (string)$yatta_home_count , 'yatta_zone_pagetitle' , 10 );
			    break;
			    case 'zone_pageeditor':
			    	// Set the zone_pageeditor with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_7_' . (string)$yatta_template_7_count , 'yatta_zone_pageeditor' , 10 );
			    break;
			    case 'zone_footer':
			    	// Set the zone_footer with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_7_' . (string)$yatta_template_7_count , 'yatta_zone_footer' , 10 );
			    break;
			}
			(int)$yatta_template_7_count++;
		}
		endif;
	}

	/* TEMPLATE_8 : Fit the zone with the right template_8's hook */
	if ( array_key_exists('template_8_zones', $smof_data) ) {
		$layout_template_8 = $smof_data['template_8_zones']['enabled'];
		if ( $layout_template_8 ):
		(int)$yatta_template_8_count = 0;
		foreach ( $layout_template_8 as $key_template_8 => $value_template_8 ) {
		    switch( $key_template_8 ) {
			    case 'zone_header':
			    	// Set the zone_header with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_8_' . (string)$yatta_template_8_count , 'yatta_zone_header' , 10 );
			    break;
			    case 'zone_menu':
			    	// Set the zone_menu with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_8_' . (string)$yatta_template_8_count , 'yatta_zone_menu' , 10 );
			    break;
			    case 'zone_pagetitle':
			    	// Set the zone_pagetitle with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_8_' . (string)$yatta_home_count , 'yatta_zone_pagetitle' , 10 );
			    break;
			    case 'zone_pageeditor':
			    	// Set the zone_pageeditor with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_8_' . (string)$yatta_template_8_count , 'yatta_zone_pageeditor' , 10 );
			    break;
			    case 'zone_footer':
			    	// Set the zone_footer with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_8_' . (string)$yatta_template_8_count , 'yatta_zone_footer' , 10 );
			    break;
			}
			(int)$yatta_template_8_count++;
		}
		endif;
	}

	/* TEMPLATE_9 : Fit the zone with the right template_9's hook */
	if ( array_key_exists('template_9_zones', $smof_data) ) {
		$layout_template_9 = $smof_data['template_9_zones']['enabled'];
		if ( $layout_template_9 ):
		(int)$yatta_template_9_count = 0;
		foreach ( $layout_template_9 as $key_template_9 => $value_template_9 ) {
		    switch( $key_template_9 ) {
			    case 'zone_header':
			    	// Set the zone_header with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_9_' . (string)$yatta_template_9_count , 'yatta_zone_header' , 10 );
			    break;
			    case 'zone_menu':
			    	// Set the zone_menu with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_9_' . (string)$yatta_template_9_count , 'yatta_zone_menu' , 10 );
			    break;
			    case 'zone_pagetitle':
			    	// Set the zone_pagetitle with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_9_' . (string)$yatta_home_count , 'yatta_zone_pagetitle' , 10 );
			    break;
			    case 'zone_pageeditor':
			    	// Set the zone_pageeditor with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_9_' . (string)$yatta_template_9_count , 'yatta_zone_pageeditor' , 10 );
			    break;
			    case 'zone_footer':
			    	// Set the zone_footer with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_9_' . (string)$yatta_template_9_count , 'yatta_zone_footer' , 10 );
			    break;
			}
			(int)$yatta_template_9_count++;
		}
		endif;
	}

	/* TEMPLATE_10 : Fit the zone with the right template_10's hook */
	if ( array_key_exists('template_10_zones', $smof_data) ) {
		$layout_template_10 = $smof_data['template_10_zones']['enabled'];
		if ( $layout_template_10 ):
		(int)$yatta_template_10_count = 0;
		foreach ( $layout_template_10 as $key_template_10 => $value_template_10 ) {
		    switch( $key_template_10 ) {
			    case 'zone_header':
			    	// Set the zone_header with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_10_' . (string)$yatta_template_10_count , 'yatta_zone_header' , 10 );
			    break;
			    case 'zone_menu':
			    	// Set the zone_menu with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_10_' . (string)$yatta_template_10_count , 'yatta_zone_menu' , 10 );
			    break;
			    case 'zone_pagetitle':
			    	// Set the zone_pagetitle with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_10_' . (string)$yatta_home_count , 'yatta_zone_pagetitle' , 10 );
			    break;
			    case 'zone_pageeditor':
			    	// Set the zone_pageeditor with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_10_' . (string)$yatta_template_10_count , 'yatta_zone_pageeditor' , 10 );
			    break;
			    case 'zone_footer':
			    	// Set the zone_footer with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_10_' . (string)$yatta_template_10_count , 'yatta_zone_footer' , 10 );
			    break;
			}
			(int)$yatta_template_10_count++;
		}
		endif;
	}

	/* TEMPLATE_11 : Fit the zone with the right template_11's hook */
	if ( array_key_exists('template_11_zones', $smof_data) ) {
		$layout_template_11 = $smof_data['template_11_zones']['enabled'];
		if ( $layout_template_11 ):
		(int)$yatta_template_11_count = 0;
		foreach ( $layout_template_11 as $key_template_11 => $value_template_11 ) {
		    switch( $key_template_11 ) {
			    case 'zone_header':
			    	// Set the zone_header with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_11_' . (string)$yatta_template_11_count , 'yatta_zone_header' , 10 );
			    break;
			    case 'zone_menu':
			    	// Set the zone_menu with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_11_' . (string)$yatta_template_11_count , 'yatta_zone_menu' , 10 );
			    break;
			    case 'zone_pagetitle':
			    	// Set the zone_pagetitle with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_11_' . (string)$yatta_home_count , 'yatta_zone_pagetitle' , 10 );
			    break;
			    case 'zone_pageeditor':
			    	// Set the zone_pageeditor with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_11_' . (string)$yatta_template_11_count , 'yatta_zone_pageeditor' , 10 );
			    break;
			    case 'zone_footer':
			    	// Set the zone_footer with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_11_' . (string)$yatta_template_11_count , 'yatta_zone_footer' , 10 );
			    break;
			}
			(int)$yatta_template_11_count++;
		}
		endif;
	}

	/* TEMPLATE_12 : Fit the zone with the right template_12's hook */
	if ( array_key_exists('template_12_zones', $smof_data) ) {
		$layout_template_12 = $smof_data['template_12_zones']['enabled'];
		if ( $layout_template_12 ):
		(int)$yatta_template_12_count = 0;
		foreach ( $layout_template_12 as $key_template_12 => $value_template_12 ) {
		    switch( $key_template_12 ) {
			    case 'zone_header':
			    	// Set the zone_header with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_12_' . (string)$yatta_template_12_count , 'yatta_zone_header' , 10 );
			    break;
			    case 'zone_menu':
			    	// Set the zone_menu with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_12_' . (string)$yatta_template_12_count , 'yatta_zone_menu' , 10 );
			    break;
			    case 'zone_pagetitle':
			    	// Set the zone_pagetitle with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_12_' . (string)$yatta_home_count , 'yatta_zone_pagetitle' , 10 );
			    break;
			    case 'zone_pageeditor':
			    	// Set the zone_pageeditor with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_12_' . (string)$yatta_template_12_count , 'yatta_zone_pageeditor' , 10 );
			    break;
			    case 'zone_footer':
			    	// Set the zone_footer with the corresponding page hook
			    	add_action( 'yatta_hook_page_template_12_' . (string)$yatta_template_12_count , 'yatta_zone_footer' , 10 );
			    break;
			}
			(int)$yatta_template_12_count++;
		}
		endif;
	}

} // END function



