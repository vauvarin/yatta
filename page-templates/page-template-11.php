<?php
/**
 * Custom template page 11.
 *
 * This is the template wich displays the template_11.
 * The data are coded in the page-template-11.php file.
 *
 * @package WordPress
 * @subpackage yatta
 * @since 1.0.0
 */

/*
Template Name: template_11
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

/* TEMPLATE_11 : Fit the zone_cpt with the right template_11's hook */
if ( array_key_exists('template_11_zones', $smof_data) ) {
	$layout_template_11 = $smof_data['template_11_zones']['enabled'];
	if ( $layout_template_11 ):
	(int)$yatta_template_11_count = 0;
	foreach ( $layout_template_11 as $key_template_11 => $value_template_11 ) {
		$key_template_11_crop = $helper->remove_number_from_string( $key_template_11 );
	    switch( $key_template_11_crop ) {
		    case 'zone_cpt_':
		    	$yatta_zones_cpt_title = $yatta_zones_cpt_array['yatta_zones_cpt_title_array'][ $key_template_11 ];
		    	$yatta_zone_cpt_arg[ (string)$yatta_template_11_count ]   = array( 'yatta_cpt_title' 	=> $helper->prepare_post_title_for_class_name( $yatta_zones_cpt_title ) , 
		    																	'yatta_cpt_content' => $yatta_zones_cpt_array['yatta_zones_cpt_content_array'][ $key_template_11 ] );
		    	// Set the zone_cpt with the corresponding page hook
		    	add_action( 'yatta_hook_page_template_11_' . (string)$yatta_template_11_count , 'yatta_zone_cpt' , 10, 1 );
		    break;
		}
		(int)$yatta_template_11_count++;
	}
	endif;
}

unset( $helper );


do_action('yatta_hook_page_template_11_1',$yatta_zone_cpt_arg['1']);
do_action('yatta_hook_page_template_11_2',$yatta_zone_cpt_arg['2']);
do_action('yatta_hook_page_template_11_3',$yatta_zone_cpt_arg['3']);
do_action('yatta_hook_page_template_11_4',$yatta_zone_cpt_arg['4']);
do_action('yatta_hook_page_template_11_5',$yatta_zone_cpt_arg['5']);
do_action('yatta_hook_page_template_11_6',$yatta_zone_cpt_arg['6']);
do_action('yatta_hook_page_template_11_7',$yatta_zone_cpt_arg['7']);
do_action('yatta_hook_page_template_11_8',$yatta_zone_cpt_arg['8']);
do_action('yatta_hook_page_template_11_9',$yatta_zone_cpt_arg['9']);
do_action('yatta_hook_page_template_11_10',$yatta_zone_cpt_arg['10']);
do_action('yatta_hook_page_template_11_11',$yatta_zone_cpt_arg['11']);
do_action('yatta_hook_page_template_11_12',$yatta_zone_cpt_arg['12']);
do_action('yatta_hook_page_template_11_13',$yatta_zone_cpt_arg['13']);
do_action('yatta_hook_page_template_11_14',$yatta_zone_cpt_arg['14']);
do_action('yatta_hook_page_template_11_15',$yatta_zone_cpt_arg['15']);
do_action('yatta_hook_page_template_11_16',$yatta_zone_cpt_arg['16']);
do_action('yatta_hook_page_template_11_17',$yatta_zone_cpt_arg['17']);
do_action('yatta_hook_page_template_11_18',$yatta_zone_cpt_arg['18']);
do_action('yatta_hook_page_template_11_19',$yatta_zone_cpt_arg['19']);
do_action('yatta_hook_page_template_11_20',$yatta_zone_cpt_arg['20']);
do_action('yatta_hook_page_template_11_21',$yatta_zone_cpt_arg['21']);
do_action('yatta_hook_page_template_11_22',$yatta_zone_cpt_arg['22']);
do_action('yatta_hook_page_template_11_23',$yatta_zone_cpt_arg['23']);
do_action('yatta_hook_page_template_11_24',$yatta_zone_cpt_arg['24']);
do_action('yatta_hook_page_template_11_25',$yatta_zone_cpt_arg['25']);
do_action('yatta_hook_page_template_11_26',$yatta_zone_cpt_arg['26']);
do_action('yatta_hook_page_template_11_27',$yatta_zone_cpt_arg['27']);
do_action('yatta_hook_page_template_11_28',$yatta_zone_cpt_arg['28']);
do_action('yatta_hook_page_template_11_29',$yatta_zone_cpt_arg['29']);
do_action('yatta_hook_page_template_11_30',$yatta_zone_cpt_arg['30']);
do_action('yatta_hook_page_template_11_31',$yatta_zone_cpt_arg['31']);
do_action('yatta_hook_page_template_11_32',$yatta_zone_cpt_arg['32']);
do_action('yatta_hook_page_template_11_33',$yatta_zone_cpt_arg['33']);
do_action('yatta_hook_page_template_11_34',$yatta_zone_cpt_arg['34']);
do_action('yatta_hook_page_template_11_35',$yatta_zone_cpt_arg['35']);
do_action('yatta_hook_page_template_11_36',$yatta_zone_cpt_arg['36']);
do_action('yatta_hook_page_template_11_37',$yatta_zone_cpt_arg['37']);
do_action('yatta_hook_page_template_11_38',$yatta_zone_cpt_arg['38']);
do_action('yatta_hook_page_template_11_39',$yatta_zone_cpt_arg['39']);
do_action('yatta_hook_page_template_11_40',$yatta_zone_cpt_arg['40']);
do_action('yatta_hook_page_template_11_41',$yatta_zone_cpt_arg['41']);
do_action('yatta_hook_page_template_11_42',$yatta_zone_cpt_arg['42']);
do_action('yatta_hook_page_template_11_43',$yatta_zone_cpt_arg['43']);
do_action('yatta_hook_page_template_11_44',$yatta_zone_cpt_arg['44']);
do_action('yatta_hook_page_template_11_45',$yatta_zone_cpt_arg['45']);
do_action('yatta_hook_page_template_11_46',$yatta_zone_cpt_arg['46']);
do_action('yatta_hook_page_template_11_47',$yatta_zone_cpt_arg['47']);
do_action('yatta_hook_page_template_11_48',$yatta_zone_cpt_arg['48']);
do_action('yatta_hook_page_template_11_49',$yatta_zone_cpt_arg['49']);
do_action('yatta_hook_page_template_11_50',$yatta_zone_cpt_arg['50']);


get_footer();

