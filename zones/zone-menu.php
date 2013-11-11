<?php
/**
 * The menu zone.
 *
 *
 * @package WordPress
 * @subpackage yatta
 * @since 1.0.0
 */



/**
 * yatta_zone_menu( $args = array() )
 *
 * Display (or return) the zone_menu
 *
 * @param array $args Arguments for how to load and display the zone_menu.
 * @return string|array The HTML code to display the zone_menu | zone_menu attributes in an array.
 * @since 1.0.0
 */
function yatta_zone_menu( $args = array() ) {

	/* Hook */
	yatta_hook_zone_menu_before();

	/* Set the default arguments. */
	$defaults = array(
	              'echo' => true,
    			);

	/* Allow plugins/themes to filter the arguments. */
	$args = apply_filters( 'yatta_filter_zone_menu_args', $args );

	/* Merge the input arguments and the defaults. */
	$args = wp_parse_args( $args, $defaults );

	/* Menu arguments */
	$yatta_menu_primary_args = array(
		'theme_location'  => 'primary',
		'menu'            => 'primary',
		'container'       => 'nav',
		'container_class' => 'yatta-zone-nav-menu',
		'container_id'    => 'yatta-zone-nav-menu',
		'menu_class'      => 'yatta-zone-ul-menu',
		'menu_id'         => 'yatta-zone-ul-menu',
		'echo'            => 0,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
	);


	$yatta_zone_menu_display = '';


	// BEGIN HTML ------------------------------------------------------------------------------


	$yatta_zone_menu_display .= '<div id="yatta-zone-bg-menu" class="yatta-zone-bg yatta-zone-bg-menu">';
	$yatta_zone_menu_display .= '<div id="yatta-zone-container-menu" class="yatta-zone-container yatta-zone-container-menu">';
	$yatta_zone_menu_display .= '<a id="yatta-zone-menu-link" href="#menu">Menu</a>';

	$yatta_zone_menu_display .= wp_nav_menu( $yatta_menu_primary_args );

    $yatta_zone_menu_display .= '</div>';
    $yatta_zone_menu_display .= '</div>';





	// END HTML -------------------------------------------------------------------------------

	/* Allow developers to filter the HTML pageorganizers. */
	$yatta_zone_menu_display = apply_filters( 'yatta_filter_zone_menu_display', $yatta_zone_menu_display, $args );

	/* If $echo is setted to true, display $yatta_zone_menu_display. */
	if ( $args[ 'echo' ] )
	echo $yatta_zone_menu_display;
	/* Else return the $yatta_zone_menu_display */
	else
	return $yatta_zone_menu_display;

	/* Hook */
	yatta_hook_zone_menu_after();

} // End function






?>
