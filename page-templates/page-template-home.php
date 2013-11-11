<?php
/**
 * Custom template page home.
 *
 * This is the template wich displays the home template.
 * The data are coded in the page-template-home.php file.
 *
 * @package WordPress
 * @subpackage yatta
 * @since 1.0.0
 */

/*
Template Name: Home
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

/* HOME : Fit the zone_cpt with the right template_home's hook */
if ( array_key_exists('home_zones', $smof_data) ) {
	$layout_template_home = $smof_data['home_zones']['enabled'];
	if ( $layout_template_home ):
	(int)$yatta_template_home_count = 0;
	foreach ( $layout_template_home as $key_template_home => $value_template_home ) {
		$key_template_home_crop = $helper->remove_number_from_string( $key_template_home );
	    switch( $key_template_home_crop ) {
		    case 'zone_cpt_':
		    	$yatta_zones_cpt_title = $yatta_zones_cpt_array['yatta_zones_cpt_title_array'][ $key_template_home ];
		    	$yatta_zone_cpt_arg[ (string)$yatta_template_home_count ]   = array( 'yatta_cpt_title' 	=> $helper->prepare_post_title_for_class_name( $yatta_zones_cpt_title ) , 
		    																	'yatta_cpt_content' => $yatta_zones_cpt_array['yatta_zones_cpt_content_array'][ $key_template_home ] );
		    	// Set the zone_cpt with the corresponding page hook
		    	add_action( 'yatta_hook_page_template_home_' . (string)$yatta_template_home_count , 'yatta_zone_cpt' , 10, 1 );
		    break;
		}
		(int)$yatta_template_home_count++;
	}
	endif;
}

unset( $helper );


do_action('yatta_hook_page_template_home_1',$yatta_zone_cpt_arg['1']);
do_action('yatta_hook_page_template_home_2',$yatta_zone_cpt_arg['2']);
do_action('yatta_hook_page_template_home_3',$yatta_zone_cpt_arg['3']);
do_action('yatta_hook_page_template_home_4',$yatta_zone_cpt_arg['4']);
do_action('yatta_hook_page_template_home_5',$yatta_zone_cpt_arg['5']);
do_action('yatta_hook_page_template_home_6',$yatta_zone_cpt_arg['6']);
do_action('yatta_hook_page_template_home_7',$yatta_zone_cpt_arg['7']);
do_action('yatta_hook_page_template_home_8',$yatta_zone_cpt_arg['8']);
do_action('yatta_hook_page_template_home_9',$yatta_zone_cpt_arg['9']);
do_action('yatta_hook_page_template_home_10',$yatta_zone_cpt_arg['10']);
do_action('yatta_hook_page_template_home_11',$yatta_zone_cpt_arg['11']);
do_action('yatta_hook_page_template_home_12',$yatta_zone_cpt_arg['12']);
do_action('yatta_hook_page_template_home_13',$yatta_zone_cpt_arg['13']);
do_action('yatta_hook_page_template_home_14',$yatta_zone_cpt_arg['14']);
do_action('yatta_hook_page_template_home_15',$yatta_zone_cpt_arg['15']);
do_action('yatta_hook_page_template_home_16',$yatta_zone_cpt_arg['16']);
do_action('yatta_hook_page_template_home_17',$yatta_zone_cpt_arg['17']);
do_action('yatta_hook_page_template_home_18',$yatta_zone_cpt_arg['18']);
do_action('yatta_hook_page_template_home_19',$yatta_zone_cpt_arg['19']);
do_action('yatta_hook_page_template_home_20',$yatta_zone_cpt_arg['20']);
do_action('yatta_hook_page_template_home_21',$yatta_zone_cpt_arg['21']);
do_action('yatta_hook_page_template_home_22',$yatta_zone_cpt_arg['22']);
do_action('yatta_hook_page_template_home_23',$yatta_zone_cpt_arg['23']);
do_action('yatta_hook_page_template_home_24',$yatta_zone_cpt_arg['24']);
do_action('yatta_hook_page_template_home_25',$yatta_zone_cpt_arg['25']);
do_action('yatta_hook_page_template_home_26',$yatta_zone_cpt_arg['26']);
do_action('yatta_hook_page_template_home_27',$yatta_zone_cpt_arg['27']);
do_action('yatta_hook_page_template_home_28',$yatta_zone_cpt_arg['28']);
do_action('yatta_hook_page_template_home_29',$yatta_zone_cpt_arg['29']);
do_action('yatta_hook_page_template_home_30',$yatta_zone_cpt_arg['30']);
do_action('yatta_hook_page_template_home_31',$yatta_zone_cpt_arg['31']);
do_action('yatta_hook_page_template_home_32',$yatta_zone_cpt_arg['32']);
do_action('yatta_hook_page_template_home_33',$yatta_zone_cpt_arg['33']);
do_action('yatta_hook_page_template_home_34',$yatta_zone_cpt_arg['34']);
do_action('yatta_hook_page_template_home_35',$yatta_zone_cpt_arg['35']);
do_action('yatta_hook_page_template_home_36',$yatta_zone_cpt_arg['36']);
do_action('yatta_hook_page_template_home_37',$yatta_zone_cpt_arg['37']);
do_action('yatta_hook_page_template_home_38',$yatta_zone_cpt_arg['38']);
do_action('yatta_hook_page_template_home_39',$yatta_zone_cpt_arg['39']);
do_action('yatta_hook_page_template_home_40',$yatta_zone_cpt_arg['40']);
do_action('yatta_hook_page_template_home_41',$yatta_zone_cpt_arg['41']);
do_action('yatta_hook_page_template_home_42',$yatta_zone_cpt_arg['42']);
do_action('yatta_hook_page_template_home_43',$yatta_zone_cpt_arg['43']);
do_action('yatta_hook_page_template_home_44',$yatta_zone_cpt_arg['44']);
do_action('yatta_hook_page_template_home_45',$yatta_zone_cpt_arg['45']);
do_action('yatta_hook_page_template_home_46',$yatta_zone_cpt_arg['46']);
do_action('yatta_hook_page_template_home_47',$yatta_zone_cpt_arg['47']);
do_action('yatta_hook_page_template_home_48',$yatta_zone_cpt_arg['48']);
do_action('yatta_hook_page_template_home_49',$yatta_zone_cpt_arg['49']);
do_action('yatta_hook_page_template_home_50',$yatta_zone_cpt_arg['50']);


get_footer();

