<?php
/**
 * The cpt zone.
 *
 *
 * @package WordPress
 * @subpackage yatta
 * @since 1.0.0
 */





/**
 * yatta_zone_cpt( $args = array() )
 *
 * Display (or return) the zone_cpt
 *
 * @param array $args Arguments for how to load and display the zone_cpt.
 * @return string|array The HTML code to display the zone_cpt | zone_cpt attributes in an array.
 * @since 1.0.0
 */
function yatta_zone_cpt( $args = array() ) {

	/* Hook */
	yatta_hook_zone_cpt_before();

	/* Set the default arguments. */
	$defaults = array(
	              'echo' 				=> true,
	              'yatta_cpt_title' 	=> '',
	              'yatta_cpt_content' 	=> '',
    			);

	/* Allow plugins/themes to filter the arguments. */
	$args = apply_filters( 'yatta_filter_zone_cpt_args', $args );

	/* Merge the input arguments and the defaults. */
	$args = wp_parse_args( $args, $defaults );

	$yatta_zone_cpt_display = '';


	// BEGIN HTML ------------------------------------------------------------------------------



	$yatta_zone_cpt_display .= '<div id="yatta-zone-bg-cpt-' . $args['yatta_cpt_title'] . '" class="yatta-zone-bg yatta-zone-bg-cpt-' . $args['yatta_cpt_title'] . ' ">';
	
	$yatta_zone_cpt_display .=	'<div id="yatta-zone-container-cpt-' . $args['yatta_cpt_title'] . '" class="yatta-zone-container yatta-zone-container-cpt-' . $args['yatta_cpt_title'] . ' ">'
										. $args['yatta_cpt_content'] .
									'</div>
								</div>';



	// END HTML -------------------------------------------------------------------------------


	/* Allow developers to filter the HTML pageorganizers. */
	$yatta_zone_cpt_display = apply_filters( 'yatta_filter_zone_cpt_display', $yatta_zone_cpt_display, $args );

	/* If $echo is setted to true, display $yatta_zone_cpt_display. */
	if ( $args[ 'echo' ] )
	echo $yatta_zone_cpt_display;
	/* Else return the $yatta_zone_cpt_display */
	else
	return $yatta_zone_cpt_display;

	/* Hook */
	yatta_hook_zone_cpt_after();

} // End function








?>
