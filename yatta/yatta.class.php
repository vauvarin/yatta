<?php
/**
 * Class Yatta - A WordPress parent theme.
 *
 * This class initialize different thinks for the theme like Constants, Modules Load support,
 * Filter/Action Hooks ans provide various useful functions.
 *
 * This code is hightly inspired from the Hybrid class (Hybrid Core framework, (c) Justin Tadlock <justin@justintadlock.com>)
 * and released under the GNU GPL.
 *
 * @package Yatta
 * @version 1.0.0
 * @author Gilles Vauvarin
 * @copyright
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
class Yatta extends SingletonPlugin {

	/**
	 * Init (constructor) method for the Yatta class.
	 *
	 * @since 1.0.0
	 */
	function init() {


		/* Define yatta, parent theme and child theme constants. */
		add_action( 'after_setup_theme', array( &$this, 'constants' ), 1 );

		/* Load yatta muplugins files. */
		add_action( 'after_setup_theme', array( &$this, 'yatta_muplugins' ), 2 );

		/* Load some core functions. */
		add_action( 'after_setup_theme', array( &$this, 'yatta_core' ), 2 );

		/* Custom WordPress backoffice. */
		add_action( 'after_setup_theme', array( &$this, 'yatta_custom_backoffice' ), 3 );

		/* Custom Aqua Page Builder blocks. */
		add_action( 'after_setup_theme', array( &$this, 'yatta_apb_blocks' ), 4 );

		/* Load Aqua resizer. */
		add_action( 'after_setup_theme', array( &$this, 'yatta_img_resizer' ), 5 );

		/* Load SMOF. */
		add_action( 'after_setup_theme', array( &$this, 'yatta_smof' ), 6 );

		/* Load Zones. */
		add_action( 'after_setup_theme', array( &$this, 'yatta_zones' ), 7 );

		/* Load custom post type. */
		add_action( 'after_setup_theme', array( &$this, 'yatta_cpt' ), 8 );

		/* Initialize the Yatta's default action hooks. */
		add_action( 'after_setup_theme', array( &$this, 'yatta_actions' ), 9 );

		/* Load the theme customizer options. */
		//add_action( 'after_setup_theme', array( &$this, 'yatta_theme_customizer' ), 8 );

		/* Load the conference menu page. */
		//add_action( 'after_setup_theme', array( &$this, 'yatta_conference_menu_page' ), 9 );

		/* Load the Yatta views. */
		//add_action( 'after_setup_theme', array( &$this, 'yatta_views' ), 20 );

	}


	/**
	 * Defines the constant paths for use within the Yatta parent theme and child theme.
	 *
	 * @since 1.0.0
	 */
	public function constants() {

		/* Sets the path to the parent theme directory. */
		define( 'PARENT_THEME_DIR', get_template_directory() );

		/* Sets the path to the parent theme directory URI. */
		define( 'PARENT_THEME_URI', get_template_directory_uri() );

		/* Sets the path to the child theme directory. */
		define( 'CHILD_THEME_DIR', get_stylesheet_directory() );

		/* Sets the path to the child theme directory URI. */
		define( 'CHILD_THEME_URI', get_stylesheet_directory_uri() );

		/* Sets the path to the Yatta directory. */
		define( 'YATTA_DIR', trailingslashit( PARENT_THEME_DIR ) . basename( dirname( __FILE__ ) ) );

		/* Sets the path to the Yatta directory URI. */
		define( 'YATTA_URI', trailingslashit( PARENT_THEME_URI ) . basename( dirname( __FILE__ ) ) );

		/* Sets the path to the yatta views directory. */
		//define( 'YATTA_THEME_VIEWS', trailingslashit( YATTA_DIR ) . 'theme-views' );

		/* Sets the path to the Yatta smof directory. */
		define( 'YATTA_MUPLUGINS', trailingslashit( YATTA_DIR ) . 'theme-muplugins' );

		/* Sets the path to the Yatta plugins directory. */
		define( 'YATTA_THEME_PLUGINS', trailingslashit( YATTA_DIR ) . 'theme-plugins' );

		/* Sets the path to the Yatta includes directory. */
		define( 'YATTA_THEME_INCLUDES', trailingslashit( YATTA_DIR ) . 'theme-includes' );

		/* Sets the path to the Yatta smof directory. */
		define( 'YATTA_SMOF', trailingslashit( PARENT_THEME_DIR ) . 'admin' );

		/* Sets the path to the Yatta zones directory. */
		define( 'YATTA_ZONES', trailingslashit( PARENT_THEME_DIR ) . 'zones' );

		/* Sets the path to the Yatta includes directory. */
		//define( 'YATTA_THEME_CUSTOMIZER', trailingslashit( YATTA_DIR ) . 'theme-customizer' );

		/* Sets the path to the Yatta Aqua Page Builder blocks directory. */
		define( 'YATTA_BLOCKS', trailingslashit( YATTA_DIR ) . 'theme-apb-blocks' );

		/* Sets the path to the Yatta images directory URI. */
		define( 'YATTA_IMAGES', trailingslashit( YATTA_URI ) . 'images' );

		/* Sets the path to the Yatta stylesheets directory URI. */
		define( 'YATTA_STYLESHEETS', trailingslashit( PARENT_THEME_URI ) . 'css' );

		/* Sets the path to the Yatta JavaScript directory URI. */
		define( 'YATTA_JAVASCRIPTS', trailingslashit( PARENT_THEME_URI ) . 'js' );

		
	}



	/**
	 * Adds some core functions.
	 *
	 * @since 1.0.0
	 */
	public function yatta_muplugins() {

		/* Load the Yatta muplugins files. */
		require_once( trailingslashit( YATTA_MUPLUGINS ) . '/katt-class/katt-css-js.class.php' );
		require_once( trailingslashit( YATTA_MUPLUGINS ) . '/katt-class/katt-settings.class.php' );
		require_once( trailingslashit( YATTA_MUPLUGINS ) . '/katt-class/katt-cpt.class.php' );
		require_once( trailingslashit( YATTA_MUPLUGINS ) . '/apb/aq-page-builder.php' );

	}


	/**
	 * Adds some core functions.
	 *
	 * @since 1.0.0
	 */
	public function yatta_core() {

		/* Load the Yatta action hooks. */
		require_once( trailingslashit( YATTA_THEME_INCLUDES ) . 'yatta-core.php' );

	}


	/**
	 * Custom WordPress backoffice.
	 *
	 * @since 1.0.0
	 */
	public function yatta_custom_backoffice() {

		/* Load the Yatta action hooks. */
		require_once( trailingslashit( YATTA_THEME_INCLUDES ) . 'yatta-custom-backend.php' );

	}





	/**
	 * Custom Aqua Page Builder blocks
	 *
	 * @since 1.0.0
	 */
	public function yatta_apb_blocks() {

		/* Load the apb blocks. */
		require_once( trailingslashit( YATTA_BLOCKS ) . 'yatta-news-block.php' );
		require_once( trailingslashit( YATTA_BLOCKS ) . 'yatta-image-block.php' );
		require_once( trailingslashit( YATTA_BLOCKS ) . 'yatta-places-block.php' );
		require_once( trailingslashit( YATTA_BLOCKS ) . 'yatta-testimonials-block.php' );
		require_once( trailingslashit( YATTA_BLOCKS ) . 'yatta-map-block.php' );
		require_once( trailingslashit( YATTA_BLOCKS ) . 'yatta-thelists-block.php' );
		require_once( trailingslashit( YATTA_BLOCKS ) . 'yatta-button-block.php' );
		require_once( trailingslashit( YATTA_BLOCKS ) . 'yatta-text-block.php' );
		require_once( trailingslashit( YATTA_BLOCKS ) . 'yatta-icontext-block.php' );
		
	}




	/**
	 * Yatta zones
	 *
	 * @since 1.0.0
	 */
	public function yatta_zones() {

		/* Load the zones. */
		require_once( trailingslashit( YATTA_ZONES ) . 'include-set-templates-hooks.php' );
		require_once( trailingslashit( YATTA_ZONES ) . 'zone-cpt.php' );

	}





	/**
	 * Loads the views functions. Many of these functions are needed to properly run the
	 * theme.  Some components are only loaded if the theme supports them.
	 *
	 * @since 1.0.0
	 */
	public function yatta_views() {

		/* Load views functions if supported. */
		require_if_theme_supports( 'yatta-menus', trailingslashit( YATTA_THEME_VIEWS ) . 'view-primarymenu.php' );

	}




	/**
	 * Loads the yatta custom post type.
	 *
	 * @since 1.0.0
	 */
	public function yatta_cpt() {

		/* Load the yatta custom post type. */
		require_once( trailingslashit( YATTA_THEME_INCLUDES ) . 'yatta-cpt.php' );

	}




	/**
	 * Adds the default Yatta action hooks.
	 *
	 * @since 1.0.0
	 */
	public function yatta_actions() {

		/* Load the Yatta action hooks. */
		require_once( trailingslashit( YATTA_THEME_INCLUDES ) . 'yatta-action-hooks.php' );

	}



	/**
	 * Display yatta-notice only for Sponsor edit.php page.
	 *
	 * @since 1.0.0
	 */
	public function yatta_sponsor_yatta_notice() {
	    global $pagenow;
	    if ( $pagenow == 'edit.php' && 'sponsor' == get_post_type() ) {
	         echo '<div class="updated themeoptions-yatta-notice">
	         <p>' . __('On this page, the drag and drop ordering feature haven\'t any consequence on front-end display.','yatta') . '<br>' . __('Indeed, the Conference theme always forces the sponsors to be displayed in this order: 1. Gold / 2. Silver / 3. Bronze / 4. No taxonomy','yatta') . '</p>
	         </div>';
	    }
	}

	/**
	 * Adds the Theme Customizer options.
	 *
	 * @since 1.0.0
	 */
	public function yatta_theme_customizer() {

		/* Load the Theme Customizer options. */
		require_once( trailingslashit( YATTA_THEME_CUSTOMIZER ) . 'yatta-customizer.class.php' );

	}

	/**
	 * Adds the Conference menu page.
	 *
	 * @since 1.0.0
	 */
	public function yatta_conference_menu_page() {

		/* Load the the Conference menu page. */
		require_once( trailingslashit( YATTA_THEME_INCLUDES ) . 'yatta-conference-menu-page.php' );

	}


	/**
	 * Resizes WordPress images on the fly
	 * Author : Syamil MJ
	 * Version	: 1.1.3
	 *
	 * @since 1.0.0
	 */
	public function yatta_img_resizer() {

		/* Load the aq_resizer php files. */
		require_once( trailingslashit( YATTA_THEME_INCLUDES ) . 'aq-resizer.php' );

	}


	/**
	 * SMOF - Slightly Modded Options Framework
	 * Author : Syamil MJ
	 * Version	: 1.5.2
	 *
	 * @since 1.0.0
	 */
	public function yatta_smof() {

		/* Load the smof php files. */
		require_once( trailingslashit( YATTA_SMOF ) . 'index.php' );

	}





}

/* Instantiation call */
$yatta = Yatta::get_instance();

?>
