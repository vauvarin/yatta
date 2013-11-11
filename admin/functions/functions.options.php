<?php

add_action( 'init' , 'of_options' );

if ( !function_exists('of_options') )
{
	function of_options()
	{
		
		/* LAYOUT MANAGER - SORTER ZONES */ 

		$yatta_zones_cpt_title_array = array (
									"placebo" 				=> "placebo", //REQUIRED!
									"zone_header"			=> "Header",
									"zone_menu"				=> "Menu",
									"zone_pagetitle"		=> "Page title",
									"zone_pageeditor"		=> "Page editor",
									"zone_footer"			=> "Footer",
									);

		$yatta_zones_cpt_title_array_default = array (
									"placebo" 				=> "placebo", //REQUIRED!
									);

		$yatta_zones_cpt_content_array = array();
		$yatta_zones_cpt_array = array();


		// Get the "zone" CPT
		$args_zones = array(
			'post_type' => 'zone',
		);
		$query_zones = new WP_Query( $args_zones );

		if ( $query_zones->have_posts() ) : 
			while ( $query_zones->have_posts() ) : $query_zones->the_post();
			$cpt_content = get_the_content();
			$cpt_content = apply_filters( 'the_content', $cpt_content );
			$cpt_content = str_replace( ']]>', ']]&gt;', $cpt_content );

			// Add cpt zone in the zones array ($yatta_zones_cpt_title_array)
				$yatta_zones_cpt_title_array[ 'zone_cpt_' . get_the_ID() ] = get_the_title();
				$yatta_zones_cpt_title_array_default[ 'zone_cpt_' . get_the_ID() ] = get_the_title();
				$yatta_zones_cpt_content_array[ 'zone_cpt_' . get_the_ID() ] = $cpt_content;
				$yatta_zones_cpt_content_array_default[ 'zone_cpt_' . get_the_ID() ] = $cpt_content;
		  	endwhile;
			wp_reset_postdata();
			$yatta_zones_cpt_array = array( 'yatta_zones_cpt_title_array' 	=> $yatta_zones_cpt_title_array, 
											'yatta_zones_cpt_content_array' => $yatta_zones_cpt_content_array,
											'yatta_zones_cpt_title_array_default' 	=> $yatta_zones_cpt_title_array_default, 
											'yatta_zones_cpt_content_array_default' => $yatta_zones_cpt_content_array_default,
											);
		 	
		endif;


		// Store cpt zone in the options table
		$yatta_zones_cpt_array_option = get_option( 'yatta_zones_cpt_array' );
		if ( empty( $yatta_zones_cpt_array_option) ) {
			delete_option( 'yatta_zones_cpt_array' );
			add_option( 'yatta_zones_cpt_array' , $yatta_zones_cpt_array , '' , 'yes' );
		} else {
			update_option( 'yatta_zones_cpt_array' , $yatta_zones_cpt_array );
		}



		// Zones for the layout manager (sorter)
		$of_options_zones = array
		( 
			"disabled" 	=> $yatta_zones_cpt_title_array, 
			"enabled" 	=> array (
										"placebo" => "placebo", //REQUIRED!
									),
		);

		// Zones for the layout manager (sorter) > Default Page
		$of_options_zones_default = array
		( 
			"disabled" 	=> $yatta_zones_cpt_title_array_default, 
			"enabled" 	=> array (
										"placebo" 				=> "placebo", //REQUIRED!
										"zone_header"			=> "Header",
										"zone_menu"				=> "Menu",
										"zone_pagetitle"		=> "Page title",
										"zone_pageeditor"		=> "Page editor",
										"zone_footer"			=> "Footer",
									),
		);




/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();



$of_options[] = array( 	"name" 		=> "Default",
						"type" 		=> "heading"
				);
												
$of_options[] = array( 	"name" 		=> "Default Template Layout",
						"desc" 		=> "Organize how you want the layout to appear on the homepage",
						"id" 		=> "default_zones",
						"std" 		=> $of_options_zones_default,
						"type" 		=> "sorter"
				);

$of_options[] = array( 	"name" 		=> "Home",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Home Template Layout",
						"desc" 		=> "Organize how you want the layout to appear on the homepage",
						"id" 		=> "home_zones",
						"std" 		=> $of_options_zones,
						"type" 		=> "sorter"
				);

$of_options[] = array( 	"name" 		=> "Template_01",
						"type" 		=> "heading"
				);
								
				
$of_options[] = array( 	"name" 		=> "Template_01 Layout",
						"desc" 		=> "Organize how you want the layout to appear on the page template_01",
						"id" 		=> "template_1_zones",
						"std" 		=> $of_options_zones,
						"type" 		=> "sorter"
				);


$of_options[] = array( 	"name" 		=> "Template_02",
						"type" 		=> "heading"
				);
								
				
$of_options[] = array( 	"name" 		=> "Template_02 Layout",
						"desc" 		=> "Organize how you want the layout to appear on the page template_02",
						"id" 		=> "template_2_zones",
						"std" 		=> $of_options_zones,
						"type" 		=> "sorter"
				);


$of_options[] = array( 	"name" 		=> "Template_03",
						"type" 		=> "heading"
				);
								
				
$of_options[] = array( 	"name" 		=> "Template_03 Layout",
						"desc" 		=> "Organize how you want the layout to appear on the page template_03",
						"id" 		=> "template_3_zones",
						"std" 		=> $of_options_zones,
						"type" 		=> "sorter"
				);


$of_options[] = array( 	"name" 		=> "Template_04",
						"type" 		=> "heading"
				);
								
				
$of_options[] = array( 	"name" 		=> "Template_04 Layout",
						"desc" 		=> "Organize how you want the layout to appear on the page template_04",
						"id" 		=> "template_4_zones",
						"std" 		=> $of_options_zones,
						"type" 		=> "sorter"
				);


$of_options[] = array( 	"name" 		=> "Template_05",
						"type" 		=> "heading"
				);
								
				
$of_options[] = array( 	"name" 		=> "Template_05 Layout",
						"desc" 		=> "Organize how you want the layout to appear on the page template_05",
						"id" 		=> "template_5_zones",
						"std" 		=> $of_options_zones,
						"type" 		=> "sorter"
				);


$of_options[] = array( 	"name" 		=> "Template_06",
						"type" 		=> "heading"
				);
								
				
$of_options[] = array( 	"name" 		=> "Template_06 Layout",
						"desc" 		=> "Organize how you want the layout to appear on the page template_06",
						"id" 		=> "template_6_zones",
						"std" 		=> $of_options_zones,
						"type" 		=> "sorter"
				);


$of_options[] = array( 	"name" 		=> "Template_07",
						"type" 		=> "heading"
				);
								
				
$of_options[] = array( 	"name" 		=> "Template_07 Layout",
						"desc" 		=> "Organize how you want the layout to appear on the page template_07",
						"id" 		=> "template_7_zones",
						"std" 		=> $of_options_zones,
						"type" 		=> "sorter"
				);


$of_options[] = array( 	"name" 		=> "Template_08",
						"type" 		=> "heading"
				);
								
				
$of_options[] = array( 	"name" 		=> "Template_08 Layout",
						"desc" 		=> "Organize how you want the layout to appear on the page template_08",
						"id" 		=> "template_8_zones",
						"std" 		=> $of_options_zones,
						"type" 		=> "sorter"
				);


$of_options[] = array( 	"name" 		=> "Template_09",
						"type" 		=> "heading"
				);
								
				
$of_options[] = array( 	"name" 		=> "Template_09 Layout",
						"desc" 		=> "Organize how you want the layout to appear on the page template_09",
						"id" 		=> "template_9_zones",
						"std" 		=> $of_options_zones,
						"type" 		=> "sorter"
				);


$of_options[] = array( 	"name" 		=> "Template_10",
						"type" 		=> "heading"
				);
								
				
$of_options[] = array( 	"name" 		=> "Template_10 Layout",
						"desc" 		=> "Organize how you want the layout to appear on the page template_10",
						"id" 		=> "template_10_zones",
						"std" 		=> $of_options_zones,
						"type" 		=> "sorter"
				);


$of_options[] = array( 	"name" 		=> "Template_11",
						"type" 		=> "heading"
				);
								
				
$of_options[] = array( 	"name" 		=> "Template_11 Layout",
						"desc" 		=> "Organize how you want the layout to appear on the page template_11",
						"id" 		=> "template_11_zones",
						"std" 		=> $of_options_zones,
						"type" 		=> "sorter"
				);


$of_options[] = array( 	"name" 		=> "Template_12",
						"type" 		=> "heading"
				);
								
				
$of_options[] = array( 	"name" 		=> "Template_12 Layout",
						"desc" 		=> "Organize how you want the layout to appear on the page template_12",
						"id" 		=> "template_12_zones",
						"std" 		=> $of_options_zones,
						"type" 		=> "sorter"
				);



					








				
	}//End function: of_options()
}//End chack if function exists: of_options()
?>
