<?php

/* Define CONSTANTS */

define( 'KATT_CUSTOMIZER_DIR', trailingslashit( KATT_DIR ) . basename( dirname( __FILE__ ) ) ); // Kattagami directory.
define( 'KATT_CUSTOMIZER_INC', KATT_CUSTOMIZER_DIR . '/incl/' );
define( 'KATT_CUSTOMIZER_CLASS', KATT_CUSTOMIZER_DIR . '/class/' );
define( 'KATT_CUSTOMIZER_TRANSLATIONS', KATT_CUSTOMIZER_DIR . '/languages' );

/* include Class */
// Customizer Boilerplate
  include_once( KATT_CUSTOMIZER_INC . '/customizer-boilerplate/customizer.php' );
// Backend
  include_once( KATT_CUSTOMIZER_CLASS . 'backend/katt-customizer-view.class.php' );
// Frontend
  include_once( KATT_CUSTOMIZER_CLASS . 'frontend/katt-customizer-view.class.php' );



class KattCustomizer extends SingletonPlugin {

  // Poperties
  private $katt_helper;
  private $view_backend;
  private $view_frontend;

  // Methods
  /* Init function use as a constructor */
	function init() {

    /* Class instantiation */
    $this->katt_helper = new KattHelper;
    $this->view_backend = KattCustomizerViewBackend::get_instance();
    $this->view_frontend = KattCustomizerViewFrontend::get_instance();

    /* Load Text Domain For translations */
    load_plugin_textdomain( 'katt-plugin', false, KATT_CUSTOMIZER_TRANSLATIONS );


    /* Deactivation hook  */
    register_deactivation_hook( __FILE__, array( &$this, 'deactivate' ) );



        
  } // End init()

    
    /**
     * Fired when the plugin is deactivated.
     *
     * @param  $network_wide   True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual customizer 
     */
    public function deactivate( $network_wide ) {
      
      // Remove instance class
      unset($this->katt_helper);
      unset($this->view_backend);
      unset($this->view_frontend);

    } // end deactivate


}

/* Instantiation call */
$katt_customizer_plugin = KattCustomizer::get_instance();
