<?php
/**
 * The pagetitle zone.
 *
 *
 * @package WordPress
 * @subpackage yatta
 * @since 1.0.0
 */




/**
 * yatta_zone_pagetitle( $args = array() )
 *
 * Display (or return) the zone_pagetitle
 *
 * @param array $args Arguments for how to load and display the zone_pagetitle.
 * @return string|array The HTML code to display the zone_pagetitle | zone_pagetitle attributes in an array.
 * @since 1.0.0
 */
function yatta_zone_pagetitle( $args = array() ) {

	/* Hook */
	yatta_hook_zone_pagetitle_before();

	/* Set the default arguments. */
	$defaults = array(
	              'echo' => true,
    			);

	/* Allow plugins/themes to filter the arguments. */
	$args = apply_filters( 'yatta_filter_zone_pagetitle_args', $args );

	/* Merge the input arguments and the defaults. */
	$args = wp_parse_args( $args, $defaults );

	$yatta_zone_pagetitle_display = '';


	// BEGIN HTML/PHP ------------------------------------------------------------------------------






	$yatta_zone_pagetitle_display .= '
		<div id="yatta-zone-bg-pagetitle" class="yatta-zone-bg yatta-zone-bg-pagetitle">
			<div id="yatta-zone-container-pagetitle" class="yatta-zone-container yatta-zone-container-pagetitle">
	';

	while ( have_posts() ) : the_post(); 

		$yatta_zone_pagetitle_display .= '<h1>' . get_the_title() . '</h1>';
	
	endwhile; // end of the loop. 
				
	$yatta_zone_pagetitle_display .= '
			</div>
		</div>
	';






	// END HTML/PHP -------------------------------------------------------------------------------

	/* Allow developers to filter the HTML pageorganizers. */
	$yatta_zone_pagetitle_display = apply_filters( 'yatta_filter_zone_pagetitle_display', $yatta_zone_pagetitle_display, $args );

	/* If $echo is setted to true, display $yatta_zone_pagetitle_display. */
	if ( $args[ 'echo' ] )
	echo $yatta_zone_pagetitle_display;
	/* Else return the $yatta_zone_pagetitle_display */
	else
	return $yatta_zone_pagetitle_display;

	/* Hook */
	yatta_hook_zone_pagetitle_after();

} // End function



?>
