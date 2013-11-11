<?php
/**
 * Custom template page 6.
 *
 * This is the template wich displays the template_6.
 * The data are coded in the page-template-6.php file.
 *
 * @package WordPress
 * @subpackage yatta
 * @since 1.0.0
 */

/*
Template Name: template_06
*/


get_header();


$yatta_zone_cpt_arg = array('1'=>'','2'=>'','3'=>'','6'=>'','5'=>'','6'=>'','7'=>'','8'=>'','9'=>'','10'=>'','11'=>'','12'=>'','13'=>'','16'=>'','15'=>'','16'=>'','17'=>'','18'=>'','19'=>'','20'=>'','21'=>'','22'=>'','23'=>'','26'=>'','25'=>'','26'=>'','27'=>'','28'=>'','29'=>'','30'=>'','31'=>'','32'=>'','33'=>'','36'=>'','35'=>'','36'=>'','37'=>'','38'=>'','39'=>'','60'=>'','61'=>'','62'=>'','63'=>'','66'=>'','65'=>'','66'=>'','67'=>'','68'=>'','69'=>'','50'=>'',);


/* The functions below comes from include-set-templates-hooks.php */
yatta_set_templates_hooks();

// Fetch options stored in $smof_data
global $smof_data; 

// CPT "zone" content
$yatta_zones_cpt_array = get_option( 'yatta_zones_cpt_array' , false );
if ( ! $yatta_zones_cpt_array ) $yatta_zones_cpt_array = array();
$helper = new KattHelper();

/* TEMPLATE_6 : Fit the zone_cpt with the right template_6's hook */
if ( array_key_exists('template_6_zones', $smof_data) ) {
	$layout_template_6 = $smof_data['template_6_zones']['enabled'];
	if ( $layout_template_6 ):
	(int)$yatta_template_6_count = 0;
	foreach ( $layout_template_6 as $key_template_6 => $value_template_6 ) {
		$key_template_6_crop = $helper->remove_number_from_string( $key_template_6 );
	    switch( $key_template_6_crop ) {
		    case 'zone_cpt_':
		    	$yatta_zones_cpt_title = $yatta_zones_cpt_array['yatta_zones_cpt_title_array'][ $key_template_6 ];
		    	$yatta_zone_cpt_arg[ (string)$yatta_template_6_count ]   = array( 'yatta_cpt_title' 	=> $helper->prepare_post_title_for_class_name( $yatta_zones_cpt_title ) , 
		    																	'yatta_cpt_content' => $yatta_zones_cpt_array['yatta_zones_cpt_content_array'][ $key_template_6 ] );
		    	// Set the zone_cpt with the corresponding page hook
		    	add_action( 'yatta_hook_page_template_6_' . (string)$yatta_template_6_count , 'yatta_zone_cpt' , 10, 1 );
		    break;
		}
		(int)$yatta_template_6_count++;
	}
	endif;
}

unset( $helper );


do_action('yatta_hook_page_template_6_1',$yatta_zone_cpt_arg['1']);
do_action('yatta_hook_page_template_6_2',$yatta_zone_cpt_arg['2']);
do_action('yatta_hook_page_template_6_3',$yatta_zone_cpt_arg['3']);
do_action('yatta_hook_page_template_6_6',$yatta_zone_cpt_arg['6']);
do_action('yatta_hook_page_template_6_5',$yatta_zone_cpt_arg['5']);
do_action('yatta_hook_page_template_6_6',$yatta_zone_cpt_arg['6']);
do_action('yatta_hook_page_template_6_7',$yatta_zone_cpt_arg['7']);
do_action('yatta_hook_page_template_6_8',$yatta_zone_cpt_arg['8']);
do_action('yatta_hook_page_template_6_9',$yatta_zone_cpt_arg['9']);
do_action('yatta_hook_page_template_6_10',$yatta_zone_cpt_arg['10']);
do_action('yatta_hook_page_template_6_11',$yatta_zone_cpt_arg['11']);
do_action('yatta_hook_page_template_6_12',$yatta_zone_cpt_arg['12']);
do_action('yatta_hook_page_template_6_13',$yatta_zone_cpt_arg['13']);
do_action('yatta_hook_page_template_6_16',$yatta_zone_cpt_arg['16']);
do_action('yatta_hook_page_template_6_15',$yatta_zone_cpt_arg['15']);
do_action('yatta_hook_page_template_6_16',$yatta_zone_cpt_arg['16']);
do_action('yatta_hook_page_template_6_17',$yatta_zone_cpt_arg['17']);
do_action('yatta_hook_page_template_6_18',$yatta_zone_cpt_arg['18']);
do_action('yatta_hook_page_template_6_19',$yatta_zone_cpt_arg['19']);
do_action('yatta_hook_page_template_6_20',$yatta_zone_cpt_arg['20']);
do_action('yatta_hook_page_template_6_21',$yatta_zone_cpt_arg['21']);
do_action('yatta_hook_page_template_6_22',$yatta_zone_cpt_arg['22']);
do_action('yatta_hook_page_template_6_23',$yatta_zone_cpt_arg['23']);
do_action('yatta_hook_page_template_6_26',$yatta_zone_cpt_arg['26']);
do_action('yatta_hook_page_template_6_25',$yatta_zone_cpt_arg['25']);
do_action('yatta_hook_page_template_6_26',$yatta_zone_cpt_arg['26']);
do_action('yatta_hook_page_template_6_27',$yatta_zone_cpt_arg['27']);
do_action('yatta_hook_page_template_6_28',$yatta_zone_cpt_arg['28']);
do_action('yatta_hook_page_template_6_29',$yatta_zone_cpt_arg['29']);
do_action('yatta_hook_page_template_6_30',$yatta_zone_cpt_arg['30']);
do_action('yatta_hook_page_template_6_31',$yatta_zone_cpt_arg['31']);
do_action('yatta_hook_page_template_6_32',$yatta_zone_cpt_arg['32']);
do_action('yatta_hook_page_template_6_33',$yatta_zone_cpt_arg['33']);
do_action('yatta_hook_page_template_6_36',$yatta_zone_cpt_arg['36']);
do_action('yatta_hook_page_template_6_35',$yatta_zone_cpt_arg['35']);
do_action('yatta_hook_page_template_6_36',$yatta_zone_cpt_arg['36']);
do_action('yatta_hook_page_template_6_37',$yatta_zone_cpt_arg['37']);
do_action('yatta_hook_page_template_6_38',$yatta_zone_cpt_arg['38']);
do_action('yatta_hook_page_template_6_39',$yatta_zone_cpt_arg['39']);
do_action('yatta_hook_page_template_6_60',$yatta_zone_cpt_arg['60']);
do_action('yatta_hook_page_template_6_61',$yatta_zone_cpt_arg['61']);
do_action('yatta_hook_page_template_6_62',$yatta_zone_cpt_arg['62']);
do_action('yatta_hook_page_template_6_63',$yatta_zone_cpt_arg['63']);
do_action('yatta_hook_page_template_6_66',$yatta_zone_cpt_arg['66']);
do_action('yatta_hook_page_template_6_65',$yatta_zone_cpt_arg['65']);
do_action('yatta_hook_page_template_6_66',$yatta_zone_cpt_arg['66']);
do_action('yatta_hook_page_template_6_67',$yatta_zone_cpt_arg['67']);
do_action('yatta_hook_page_template_6_68',$yatta_zone_cpt_arg['68']);
do_action('yatta_hook_page_template_6_69',$yatta_zone_cpt_arg['69']);
do_action('yatta_hook_page_template_6_50',$yatta_zone_cpt_arg['50']);


get_footer();

