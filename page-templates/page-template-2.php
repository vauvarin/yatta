<?php
/**
 * Custom template page 2.
 *
 * This is the template wich displays the template_2.
 * The data are coded in the page-template-2.php file.
 *
 * @package WordPress
 * @subpackage yatta
 * @since 1.0.0
 */

/*
Template Name: template_02
*/


get_header();


$yatta_zone_cpt_arg = array('1'=>'','2'=>'','3'=>'','4'=>'','5'=>'','6'=>'','7'=>'','8'=>'','9'=>'','10'=>'','11'=>'','12'=>'','13'=>'','14'=>'','15'=>'','16'=>'','17'=>'','18'=>'','19'=>'','20'=>'','21'=>'','22'=>'','23'=>'','24'=>'','25'=>'','26'=>'','27'=>'','28'=>'','29'=>'','30'=>'','31'=>'','32'=>'','33'=>'','34'=>'','35'=>'','36'=>'','37'=>'','38'=>'','39'=>'','40'=>'','41'=>'','42'=>'','43'=>'','44'=>'','45'=>'','46'=>'','47'=>'','48'=>'','49'=>'','50'=>'',);

/* The functions below comes from include-set-templates-hooks.php */
yatta_set_templates_hooks();

// Fetch options stored in $smof_data
global $smof_data; 

// CPT "zone" content
$yatta_zones_cpt_array = get_option( 'yatta_zones_cpt_array' , false );
if ( ! $yatta_zones_cpt_array ) $yatta_zones_cpt_array = array();
$helper = new KattHelper();

/* TEMPLATE_2 : Fit the zone_cpt with the right template_2's hook */
if ( array_key_exists('template_2_zones', $smof_data) ) {
	$layout_template_2 = $smof_data['template_2_zones']['enabled'];
	if ( $layout_template_2 ):
	(int)$yatta_template_2_count = 0;
	foreach ( $layout_template_2 as $key_template_2 => $value_template_2 ) {
		$key_template_2_crop = $helper->remove_number_from_string( $key_template_2 );
	    switch( $key_template_2_crop ) {
		    case 'zone_cpt_':
		    	$yatta_zones_cpt_title = $yatta_zones_cpt_array['yatta_zones_cpt_title_array'][ $key_template_2 ];
		    	$yatta_zone_cpt_arg[ (string)$yatta_template_2_count ]   = array( 'yatta_cpt_title' 	=> $helper->prepare_post_title_for_class_name( $yatta_zones_cpt_title ) , 
		    																	'yatta_cpt_content' => $yatta_zones_cpt_array['yatta_zones_cpt_content_array'][ $key_template_2 ] );
		    	// Set the zone_cpt with the corresponding page hook
		    	add_action( 'yatta_hook_page_template_2_' . (string)$yatta_template_2_count , 'yatta_zone_cpt' , 10, 1 );
		    break;
		}
		(int)$yatta_template_2_count++;
	}
	endif;
}

unset( $helper );


do_action('yatta_hook_page_template_2_1',$yatta_zone_cpt_arg['1']);
do_action('yatta_hook_page_template_2_2',$yatta_zone_cpt_arg['2']);
do_action('yatta_hook_page_template_2_3',$yatta_zone_cpt_arg['3']);
do_action('yatta_hook_page_template_2_4',$yatta_zone_cpt_arg['4']);
do_action('yatta_hook_page_template_2_5',$yatta_zone_cpt_arg['5']);
do_action('yatta_hook_page_template_2_6',$yatta_zone_cpt_arg['6']);
do_action('yatta_hook_page_template_2_7',$yatta_zone_cpt_arg['7']);
do_action('yatta_hook_page_template_2_8',$yatta_zone_cpt_arg['8']);
do_action('yatta_hook_page_template_2_9',$yatta_zone_cpt_arg['9']);
do_action('yatta_hook_page_template_2_10',$yatta_zone_cpt_arg['10']);
do_action('yatta_hook_page_template_2_11',$yatta_zone_cpt_arg['11']);
do_action('yatta_hook_page_template_2_12',$yatta_zone_cpt_arg['12']);
do_action('yatta_hook_page_template_2_13',$yatta_zone_cpt_arg['13']);
do_action('yatta_hook_page_template_2_14',$yatta_zone_cpt_arg['14']);
do_action('yatta_hook_page_template_2_15',$yatta_zone_cpt_arg['15']);
do_action('yatta_hook_page_template_2_16',$yatta_zone_cpt_arg['16']);
do_action('yatta_hook_page_template_2_17',$yatta_zone_cpt_arg['17']);
do_action('yatta_hook_page_template_2_18',$yatta_zone_cpt_arg['18']);
do_action('yatta_hook_page_template_2_19',$yatta_zone_cpt_arg['19']);
do_action('yatta_hook_page_template_2_20',$yatta_zone_cpt_arg['20']);
do_action('yatta_hook_page_template_2_21',$yatta_zone_cpt_arg['21']);
do_action('yatta_hook_page_template_2_22',$yatta_zone_cpt_arg['22']);
do_action('yatta_hook_page_template_2_23',$yatta_zone_cpt_arg['23']);
do_action('yatta_hook_page_template_2_24',$yatta_zone_cpt_arg['24']);
do_action('yatta_hook_page_template_2_25',$yatta_zone_cpt_arg['25']);
do_action('yatta_hook_page_template_2_26',$yatta_zone_cpt_arg['26']);
do_action('yatta_hook_page_template_2_27',$yatta_zone_cpt_arg['27']);
do_action('yatta_hook_page_template_2_28',$yatta_zone_cpt_arg['28']);
do_action('yatta_hook_page_template_2_29',$yatta_zone_cpt_arg['29']);
do_action('yatta_hook_page_template_2_30',$yatta_zone_cpt_arg['30']);
do_action('yatta_hook_page_template_2_31',$yatta_zone_cpt_arg['31']);
do_action('yatta_hook_page_template_2_32',$yatta_zone_cpt_arg['32']);
do_action('yatta_hook_page_template_2_33',$yatta_zone_cpt_arg['33']);
do_action('yatta_hook_page_template_2_34',$yatta_zone_cpt_arg['34']);
do_action('yatta_hook_page_template_2_35',$yatta_zone_cpt_arg['35']);
do_action('yatta_hook_page_template_2_36',$yatta_zone_cpt_arg['36']);
do_action('yatta_hook_page_template_2_37',$yatta_zone_cpt_arg['37']);
do_action('yatta_hook_page_template_2_38',$yatta_zone_cpt_arg['38']);
do_action('yatta_hook_page_template_2_39',$yatta_zone_cpt_arg['39']);
do_action('yatta_hook_page_template_2_40',$yatta_zone_cpt_arg['40']);
do_action('yatta_hook_page_template_2_41',$yatta_zone_cpt_arg['41']);
do_action('yatta_hook_page_template_2_42',$yatta_zone_cpt_arg['42']);
do_action('yatta_hook_page_template_2_43',$yatta_zone_cpt_arg['43']);
do_action('yatta_hook_page_template_2_44',$yatta_zone_cpt_arg['44']);
do_action('yatta_hook_page_template_2_45',$yatta_zone_cpt_arg['45']);
do_action('yatta_hook_page_template_2_46',$yatta_zone_cpt_arg['46']);
do_action('yatta_hook_page_template_2_47',$yatta_zone_cpt_arg['47']);
do_action('yatta_hook_page_template_2_48',$yatta_zone_cpt_arg['48']);
do_action('yatta_hook_page_template_2_49',$yatta_zone_cpt_arg['49']);
do_action('yatta_hook_page_template_2_50',$yatta_zone_cpt_arg['50']);


get_footer();

