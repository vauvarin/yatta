<?php
/**
 * The pageeditor zone.
 *
 *
 * @package WordPress
 * @subpackage yatta
 * @since 1.0.0
 */




/**
 * yatta_zone_pageeditor( $args = array() )
 *
 * Display (or return) the zone_pageeditor
 *
 * @param array $args Arguments for how to load and display the zone_pageeditor.
 * @return string|array The HTML code to display the zone_pageeditor | zone_pageeditor attributes in an array.
 * @since 1.0.0
 */
function yatta_zone_pageeditor( $args = array() ) {

	/* Hook */
	yatta_hook_zone_pageeditor_before();

	/* Set the default arguments. */
	$defaults = array(
	              'echo' => true,
    			);

	/* Allow plugins/themes to filter the arguments. */
	$args = apply_filters( 'yatta_filter_zone_pageeditor_args', $args );

	/* Merge the input arguments and the defaults. */
	$args = wp_parse_args( $args, $defaults );

	$yatta_zone_pageeditor_display = '';


	// BEGIN HTML/PHP ------------------------------------------------------------------------------






	$yatta_zone_pageeditor_display .= '
		<div id="yatta-zone-bg-pageeditor" class="yatta-zone-bg yatta-zone-bg-pageeditor">
			<div id="yatta-zone-container-pageeditor" class="yatta-zone-container yatta-zone-container-pageeditor">
	';

	while ( have_posts() ) : the_post(); 

		$content = get_the_content();
		$content = apply_filters( 'the_content', $content );
		$content = str_replace( ']]>', ']]&gt;', $content );

		$yatta_zone_pageeditor_display .= $content;
	
	endwhile; // end of the loop. 
				
	$yatta_zone_pageeditor_display .= '
			</div>
		</div>
	';






	// END HTML/PHP -------------------------------------------------------------------------------

	/* Allow developers to filter the HTML pageorganizers. */
	$yatta_zone_pageeditor_display = apply_filters( 'yatta_filter_zone_pageeditor_display', $yatta_zone_pageeditor_display, $args );

	/* If $echo is setted to true, display $yatta_zone_pageeditor_display. */
	if ( $args[ 'echo' ] )
	echo $yatta_zone_pageeditor_display;
	/* Else return the $yatta_zone_pageeditor_display */
	else
	return $yatta_zone_pageeditor_display;

	/* Hook */
	yatta_hook_zone_pageeditor_after();

} // End function



?>
