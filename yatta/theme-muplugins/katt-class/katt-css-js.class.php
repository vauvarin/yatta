<?php

/*

Plugin Name: ActivationStylesScripts
Description: Generic Scripts and Styles for katt-cpt and katt-dettings classes

*/

/* Define CONSTANTS */
define( 'KATT_MU_CLASS_URL', content_url( '/themes/yatta/yatta/theme-muplugins/katt-class/' ) );
define( 'KATT_MU_CLASS_CSS', KATT_MU_CLASS_URL . 'css' );
define( 'KATT_MU_CLASS_JS', KATT_MU_CLASS_URL . 'js' );


class KattStylesScripts extends SingletonPlugin {  


	// Methods
    /* Init function use as a constructor */
    function init() {

	    if ( is_admin() ) {
	        // Load backend javascripts. 
	        add_action('admin_enqueue_scripts' , array( &$this, 'backend_js' ) , 10);
	        // Load backend stylesheets.
	        add_action('admin_enqueue_scripts' , array( &$this, 'backend_css' ) , 10);
	    }

    }

	

    /**
     * Enqueueing back-end javascripts ("admin_enqueue_scripts" hook).
     *
     * @since 1.0.0
     */
    function backend_js() {
            wp_enqueue_script( 'jquery-ui-sortable' );
            wp_register_script( 'script-back', KATT_MU_CLASS_JS . '/backend-script.js', array('jquery'), 1.0 , true );
            wp_enqueue_script( 'script-back' );
            wp_enqueue_media();
            wp_enqueue_script('thickbox');  
            wp_enqueue_script('media-upload');  
    }

    /**
     * Enqueueing back-end stylesheets ("wp_enqueue_styles" hook).
     *
     * @since 1.0.0
     */
    function backend_css() {
            wp_register_style('backend-style', KATT_MU_CLASS_CSS . '/backend-style.css');
            wp_enqueue_style('backend-style');
            wp_enqueue_style('thickbox');
    }


}

/* Instantiation call */
$katt_styles_scripts = KattStylesScripts::get_instance();