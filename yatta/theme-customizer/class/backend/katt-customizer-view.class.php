<?php
/**
 * Class KattCustomizerViewFrontend
 *
 * This class displays the customizer on the frontend.
 *
 * @package Kattagami
 * @version 1.0.0
 * @author Gilles Vauvarin
 * @copyright
 * @link http://kattagami.com
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */



class KattCustomizerViewBackend extends SingletonPlugin {



    /* Init function use as a constructor */
	function init() { 



		// Change the "Theme Customizer" label
		add_filter( 'thsp_cbp_menu_link_text', array( &$this, 'set_customizer_menu_label' ) );

		// Remove default sections
		add_filter( 'tshp_cbp_remove_sections', array( &$this, 'remove_customizer_sections' ), 20, 1 );

		// Add some options to the customizer
		add_filter( 'thsp_cbp_options_array', array( &$this, 'add_customizer_options' ) );



	} // End init()





	/**
    * Change the "Theme Customizer" label
    *
 	* @since 1.0.0
    */
	public function set_customizer_menu_label() {
		return 'Customizer';
	}


	/**
    * Remove default sections
    *
 	* @since 1.0.0
    */
	public function remove_customizer_sections() {
		return $default_sections = array(
									'static_front_page',
									'nav',
									'title_tagline',
									'colors',
									'background_image'
								);
	}


	/**
    * Add some options to the customizer
    *
 	* @since 1.0.0
    */
	public function add_customizer_options() {

		/*
		* Using helper function to get default required capability
		*/
		$thsp_cbp_capability = thsp_cbp_capability();
		$katt_header_logotext = '';
		$katt_header_baseline = '';

		$options = array(

			// Section ID
			'customizer_section_header_content' => array(

				/*
				* We're checking if this is an existing section
				* or a new one that needs to be registered
				*/
				'existing_section' => false,
				/*
				* Section related arguments
				* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
				*/
				'args' => array(
								'title'       => __( 'HEADER - Content', 'katt' ),
								'description' => __( 'Customize your Header banner content', 'katt' ),
								'priority'    => 1
				),

				/*
				* This array contains all the fields that need to be
				* added to this section
				*/
				'fields' => array(

					/*
					* ============
					* ============
					* Image Upload
					* ============
					* ============
					*/
					// Field ID
					'header_content_logo' => array(
												'setting_args' => array(
																	'default'      => '',
																	'type'         => 'option',
																	'capability'   => $thsp_cbp_capability,
																	'transport'    => 'refresh',
												),	
																	'control_args' => array(
																	'label'        => __( 'Logo', 'katt' ),
																	'type'         => 'image', // Image upload field control
																	'priority'     => 1
												)
					),

					/*
					* ==========
					* ==========
					* Text field
					* ==========
					* ==========
					*/
					// Field ID
					'header_content_logo_text' => array(
											/*
											* Setting related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
											*/
											'setting_args' => array(
															'default'    => '',
															'type'       => 'option',
															'capability' => $thsp_cbp_capability,
															'transport'  => 'refresh',
											),	
											/*
											* Control related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
											*/
											'control_args' => array(
															'label'    => __( 'Logo text', 'katt' ),
															'type'     => 'text', // Text field control
															'priority' => 2
											)
					),	

					

					

					/*
					* ==============
					* ==============
					* Textarea Field
					* ==============
					* ==============
					*/
					'header_content_baseline' => array(
											'setting_args' => array(
																'default'    => '',
																'type'       => 'option',
																'capability' => $thsp_cbp_capability,
																'transport'  => 'refresh',
											),	
											'control_args' => array(
																'label'    => __( 'Baseline', 'katt' ),
																'type'     => 'textarea', // Textarea control
																'priority' => 3
											)
					),

					

			),

			),


			// Section ID
			'customizer_section_header_design_background' => array(

				/*
				* We're checking if this is an existing section
				* or a new one that needs to be registered
				*/
				'existing_section' => false,
				/*
				* Section related arguments
				* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
				*/
				'args' => array(
								'title'       => __( 'HEADER - Background', 'katt' ),
								'description' => __( 'Customize your Header banner background design', 'katt' ),
								'priority'    => 2
				),

				/*
				* This array contains all the fields that need to be
				* added to this section
				*/
				'fields' => array(

					
					/*
					* ===========
					* ===========
					* Colorpicker
					* ===========
					* ===========
					*/
					// Field ID
					'header_design_background_color' => array(
											/*
											* Setting related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
											*/
											'setting_args' => array(
															'default'    => '#BD0C0C',
															'type'       => 'option',
															'capability' => $thsp_cbp_capability,
															'transport'  => 'refresh',
											),	
											/*
											* Control related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
											*/
											'control_args' => array(
															'label'    => __( 'Background color', 'katt' ),
															'type'     => 'color', // Color field control
															'priority' => 3
											)
					),


					/*
					* ============
					* ============
					* Image Upload
					* ============
					* ============
					*/
					// Field ID
					'header_design_background_url' => array(
												'setting_args' => array(
																	'default'      => '',
																	'type'         => 'option',
																	'capability'   => $thsp_cbp_capability,
																	'transport'    => 'refresh',
												),	
																	'control_args' => array(
																	'label'        => __( 'Background image', 'katt' ),
																	'type'         => 'image', // Image upload field control
																	'priority'     => 4
												)
					),


					/*
					* ===========
					* ===========
					* Radio field
					* ===========
					* ===========
					*/
					// Field ID
					'header_design_background_repeat' => array(
											'setting_args' => array(
																'default'    => 'repeat',
																'type'       => 'option',
																'capability' => $thsp_cbp_capability,
																'transport'  => 'refresh',
											),	
											'control_args' => array(
																'label' => __( 'Repeat', 'katt' ),
																'type' => 'radio', // Radio control
																'choices' => array(
																			'no-repeat' => array(
																			'label' => __( 'No Repeat', 'katt' )
																			),
																			'repeat' => array(
																			'label' => __( 'Tile', 'katt' )
																			),
																			'repeat-x' => array(
																			'label' => __( 'Tile Horizontally', 'katt' )
																			),
																			'repeat-y' => array(
																			'label' => __( 'Tile Vertically', 'katt' )
																			)
																),	
																'priority' => 5
											)
					),


					/*
					* ===========
					* ===========
					* Radio field
					* ===========
					* ===========
					*/
					// Field ID
					'header_design_background_position_h' => array(
											'setting_args' => array(
																'default'    => 'left',
																'type'       => 'option',
																'capability' => $thsp_cbp_capability,
																'transport'  => 'refresh',
											),	
											'control_args' => array(
																'label' => __( 'Horizontal position ', 'katt' ),
																'type' => 'radio', // Radio control
																'choices' => array(
																			'left' => array(
																			'label' => __( 'Left', 'katt' )
																			),
																			'center' => array(
																			'label' => __( 'Center', 'katt' )
																			),
																			'right' => array(
																			'label' => __( 'Right', 'katt' )
																			)
																),	
																'priority' => 6
											)
					),


					/*
					* ===========
					* ===========
					* Radio field
					* ===========
					* ===========
					*/
					// Field ID
					'header_design_background_position_v' => array(
											'setting_args' => array(
																'default'    => 'top',
																'type'       => 'option',
																'capability' => $thsp_cbp_capability,
																'transport'  => 'refresh',
											),	
											'control_args' => array(
																'label' => __( 'Vertical position', 'katt' ),
																'type' => 'radio', // Radio control
																'choices' => array(
																			'top' => array(
																			'label' => __( 'Top', 'katt' )
																			),
																			'bottom' => array(
																			'label' => __( 'Bottom', 'katt' )
																			)
																),	
																'priority' => 7
											)
					),


					/*
					* ===========
					* ===========
					* Radio field
					* ===========
					* ===========
					*/
					// Field ID
					'header_design_background_attachment' => array(
											'setting_args' => array(
																'default'    => 'fixed',
																'type'       => 'option',
																'capability' => $thsp_cbp_capability,
																'transport'  => 'refresh',
											),	
											'control_args' => array(
																'label' => __( 'Attachment', 'katt' ),
																'type' => 'radio', // Radio control
																'choices' => array(
																			'fixed' => array(
																			'label' => __( 'Fixed', 'katt' )
																			),
																			'scroll' => array(
																			'label' => __( 'Scroll', 'katt' )
																			)
																),	
																'priority' => 8
											)
					),


			),

			),



			// Section ID
			'customizer_section_header_design_text' => array(

				/*
				* We're checking if this is an existing section
				* or a new one that needs to be registered
				*/
				'existing_section' => false,
				/*
				* Section related arguments
				* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
				*/
				'args' => array(
								'title'       => __( 'HEADER - Text', 'katt' ),
								'description' => __( 'Customize your Header banner design', 'katt' ),
								'priority'    => 3
				),

				/*
				* This array contains all the fields that need to be
				* added to this section
				*/
				'fields' => array(

					/*
					* ===========
					* ===========
					* Colorpicker
					* ===========
					* ===========
					*/
					// Field ID
					'header_design_logotext_color' => array(
											/*
											* Setting related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
											*/
											'setting_args' => array(
															'default'    => '#ffffff',
															'type'       => 'option',
															'capability' => $thsp_cbp_capability,
															'transport'  => 'refresh',
											),	
											/*
											* Control related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
											*/
											'control_args' => array(
															'label'    => __( 'Logo text', 'katt' ),
															'type'     => 'color', // Color field control
															'priority' => 1
											)
					),

					/*
					* ===========
					* ===========
					* Colorpicker
					* ===========
					* ===========
					*/
					// Field ID
					'header_design_baseline_color' => array(
											/*
											* Setting related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
											*/
											'setting_args' => array(
															'default'    => '#ffffff',
															'type'       => 'option',
															'capability' => $thsp_cbp_capability,
															'transport'  => 'refresh',
											),	
											/*
											* Control related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
											*/
											'control_args' => array(
															'label'    => __( 'Baseline', 'katt' ),
															'type'     => 'color', // Color field control
															'priority' => 2
											)
					),




			),

			),


			


			// Section ID
			'customizer_section_event_content' => array(

				/*
				* We're checking if this is an existing section
				* or a new one that needs to be registered
				*/
				'existing_section' => false,
				/*
				* Section related arguments
				* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
				*/
				'args' => array(
								'title'       => __( 'EVENT - Content', 'katt' ),
								'description' => __( 'Customize your Event content', 'katt' ),
								'priority'    => 4
				),

				/*
				* This array contains all the fields that need to be
				* added to this section
				*/
				'fields' => array(

					/*
					* ==========
					* ==========
					* Text field
					* ==========
					* ==========
					*/
					// Field ID
					'event_content_name' => array(
											/*
											* Setting related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
											*/
											'setting_args' => array(
															'default'    => '',
															'type'       => 'option',
															'capability' => $thsp_cbp_capability,
															'transport'  => 'refresh',
											),	
											/*
											* Control related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
											*/
											'control_args' => array(
															'label'    => __( 'Name', 'katt' ),
															'type'     => 'text', // Text field control
															'priority' => 1
											)
					),	

					/*
					* ==============
					* ==============
					* Textarea Field
					* ==============
					* ==============
					*/
					// Field ID
					'event_content_description' => array(
											'setting_args' => array(
																'default'    => '',
																'type'       => 'option',
																'capability' => $thsp_cbp_capability,
																'transport'  => 'refresh',
											),	
											'control_args' => array(
																'label'    => __( 'Description', 'katt' ),
																'type'     => 'textarea', // Textarea control
																'priority' => 2
											)
					),

					/*
					* ==========
					* ==========
					* Text field
					* ==========
					* ==========
					*/
					// Field ID
					'event_content_location' => array(
											/*
											* Setting related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
											*/
											'setting_args' => array(
															'default'    => '',
															'type'       => 'option',
															'capability' => $thsp_cbp_capability,
															'transport'  => 'refresh',
											),	
											/*
											* Control related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
											*/
											'control_args' => array(
															'label'    => __( 'Location', 'katt' ),
															'type'     => 'text', // Text field control
															'priority' => 3
											)
					),

					/*
					* ==========
					* ==========
					* Text field
					* ==========
					* ==========
					*/
					// Field ID
					'event_content_date' => array(
											/*
											* Setting related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
											*/
											'setting_args' => array(
															'default'    => '',
															'type'       => 'option',
															'capability' => $thsp_cbp_capability,
															'transport'  => 'refresh',
											),	
											/*
											* Control related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
											*/
											'control_args' => array(
															'label'    => __( 'Date', 'katt' ),
															'type'     => 'text', // Text field control
															'priority' => 4
											)
					),


					/*
					* ==============
					* ==============
					* Checkbox field
					* ==============
					* ==============
					*/
					'event_content_sticky' => array(
												'setting_args' => array(
																	'default'    => true,
																	'type'       => 'option',
																	'capability' => $thsp_cbp_capability,
																	'transport'  => 'refresh',
												),	
												'control_args' => array(
																	'label'    => __( 'Stick to the top', 'katt' ),
																	'type'     => 'checkbox', // Checkbox field control
																	'priority' => 5
												)
					),	


			),

			),

			// Section ID
			'customizer_section_event_design_background' => array(

				/*
				* We're checking if this is an existing section
				* or a new one that needs to be registered
				*/
				'existing_section' => false,
				/*
				* Section related arguments
				* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
				*/
				'args' => array(
								'title'       => __( 'EVENT - Background', 'katt' ),
								'description' => __( 'Customize your Event design', 'katt' ),
								'priority'    => 5
				),

				/*
				* This array contains all the fields that need to be
				* added to this section
				*/
				'fields' => array(

					/*
					* ===========
					* ===========
					* Colorpicker
					* ===========
					* ===========
					*/
					// Field ID
					'event_design_background_color' => array(
											/*
											* Setting related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
											*/
											'setting_args' => array(
															'default'    => '#f0f0f0',
															'type'       => 'option',
															'capability' => $thsp_cbp_capability,
															'transport'  => 'refresh',
											),	
											/*
											* Control related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
											*/
											'control_args' => array(
															'label'    => __( 'Background color', 'katt' ),
															'type'     => 'color', // Color field control
															'priority' => 1
											)
					),


					/*
					* ============
					* ============
					* Image Upload
					* ============
					* ============
					*/
					// Field ID
					'event_design_background_url' => array(
												'setting_args' => array(
																	'default'      => '',
																	'type'         => 'option',
																	'capability'   => $thsp_cbp_capability,
																	'transport'    => 'refresh',
												),	
																	'control_args' => array(
																	'label'        => __( 'Background image', 'katt' ),
																	'type'         => 'image', // Image upload field control
																	'priority'     => 2
												)
					),


					/*
					* ===========
					* ===========
					* Radio field
					* ===========
					* ===========
					*/
					// Field ID
					'event_design_background_repeat' => array(
											'setting_args' => array(
																'default'    => 'repeat',
																'type'       => 'option',
																'capability' => $thsp_cbp_capability,
																'transport'  => 'refresh',
											),	
											'control_args' => array(
																'label'   => __( 'Repeat', 'katt' ),
																'type'    => 'radio', // Radio control
																'choices' => array(
																			'no-repeat' => array(
																			'label'     => __( 'No Repeat', 'katt' )
																			),
																			'repeat' => array(
																			'label'  => __( 'Tile', 'katt' )
																			),
																			'repeat-x' => array(
																			'label'    => __( 'Tile Horizontally', 'katt' )
																			),
																			'repeat-y' => array(
																			'label'    => __( 'Tile Vertically', 'katt' )
																			)
																),	
																'priority' => 3
											)
					),


					/*
					* ===========
					* ===========
					* Radio field
					* ===========
					* ===========
					*/
					// Field ID
					'event_design_background_position_h' => array(
											'setting_args' => array(
																'default'    => 'left',
																'type'       => 'option',
																'capability' => $thsp_cbp_capability,
																'transport'  => 'refresh',
											),	
											'control_args' => array(
																'label'   => __( 'Horizontal position ', 'katt' ),
																'type'    => 'radio', // Radio control
																'choices' => array(
																			'left'  => array(
																			'label' => __( 'Left', 'katt' )
																			),
																			'center' => array(
																			'label'  => __( 'Center', 'katt' )
																			),
																			'right' => array(
																			'label' => __( 'Right', 'katt' )
																			)
																),	
																'priority' => 4
											)
					),


					/*
					* ===========
					* ===========
					* Radio field
					* ===========
					* ===========
					*/
					// Field ID
					'event_design_background_position_v' => array(
											'setting_args' => array(
																'default'    => 'top',
																'type'       => 'option',
																'capability' => $thsp_cbp_capability,
																'transport'  => 'refresh',
											),	
											'control_args' => array(
																'label' => __( 'Vertical position', 'katt' ),
																'type' => 'radio', // Radio control
																'choices' => array(
																			'top'   => array(
																			'label' => __( 'Top', 'katt' )
																			),
																			'bottom' => array(
																			'label'  => __( 'Bottom', 'katt' )
																			)
																),	
																'priority' => 5
											)
					),


					/*
					* ===========
					* ===========
					* Radio field
					* ===========
					* ===========
					*/
					// Field ID
					'event_design_background_attachment' => array(
											'setting_args' => array(
																'default'    => 'fixed',
																'type'       => 'option',
																'capability' => $thsp_cbp_capability,
																'transport'  => 'refresh',
											),	
											'control_args' => array(
																'label' => __( 'Attachment', 'katt' ),
																'type' => 'radio', // Radio control
																'choices' => array(
																			'fixed' => array(
																			'label' => __( 'Fixed', 'katt' )
																			),
																			'scroll' => array(
																			'label'  => __( 'Scroll', 'katt' )
																			)
																),	
																'priority' => 6
											)
					),


			),

			),



			// Section ID
			'customizer_section_event_design_text_name' => array(

				/*
				* We're checking if this is an existing section
				* or a new one that needs to be registered
				*/
				'existing_section' => false,
				/*
				* Section related arguments
				* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
				*/
				'args' => array(
								'title'       => __( 'EVENT - Text - Name', 'katt' ),
								'description' => __( 'Customize your Event design', 'katt' ),
								'priority'    => 6
				),

				/*
				* This array contains all the fields that need to be
				* added to this section
				*/
				'fields' => array(

					

					/*
					* ===========
					* ===========
					* Colorpicker
					* ===========
					* ===========
					*/
					// Field ID
					'event_design_name_color' => array(
											/*
											* Setting related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
											*/
											'setting_args' => array(
															'default'    => '#555555',
															'type'       => 'option',
															'capability' => $thsp_cbp_capability,
															'transport'  => 'refresh',
											),	
											/*
											* Control related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
											*/
											'control_args' => array(
															'label'    => __( 'Text color', 'katt' ),
															'type'     => 'color', // Color field control
															'priority' => 1
											)
					),

					

					/*
					* ===========
					* ===========
					* Colorpicker
					* ===========
					* ===========
					*/
					// Field ID
					'event_design_name_color_shadow' => array(
											/*
											* Setting related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
											*/
											'setting_args' => array(
															'default'    => '#ffffff',
															'type'       => 'option',
															'capability' => $thsp_cbp_capability,
															'transport'  => 'refresh',
											),	
											/*
											* Control related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
											*/
											'control_args' => array(
															'label'    => __( 'Text shadow', 'katt' ),
															'type'     => 'color', // Color field control
															'priority' => 2
											)
					),

					/*
					* ============
					* ============
					* Select field
					* ============
					* ============
					*/
					'event_design_name_size' => array(
										'setting_args' => array(
														'default'    => '4em',
														'type'       => 'option',
														'capability' => $thsp_cbp_capability,
														'transport'  => 'refresh',
										),	
										'control_args' => array(
															'label'        => __( 'Text size', 'katt' ),
															'type'         => 'select', // Select control
															'choices'      => array(
																			'2em' => array(
																			'label' => __( 'Small', 'katt' )
																			),
																			'3em' => array(
																			'label' => __( 'Medium', 'katt' )
																			),
																			'4em' => array(
																			'label' => __( 'Large', 'katt' )
																			)
															),	
															'priority' => 3
										)
					),


					/*
					* ===========
					* ===========
					* Colorpicker
					* ===========
					* ===========
					*/
					// Field ID
					'event_design_name_bgcolor' => array(
											/*
											* Setting related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
											*/
											'setting_args' => array(
															'default'    => '#ffffff',
															'type'       => 'option',
															'capability' => $thsp_cbp_capability,
															'transport'  => 'refresh',
											),	
											/*
											* Control related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
											*/
											'control_args' => array(
															'label'    => __( 'Background color', 'katt' ),
															'type'     => 'color', // Color field control
															'priority' => 4
											)
					),

					/*
					* ============
					* ============
					* Select field
					* ============
					* ============
					*/
					'event_design_name_transparency' => array(
										'setting_args' => array(
														'default'    => '0',
														'type'       => 'option',
														'capability' => $thsp_cbp_capability,
														'transport'  => 'refresh',
										),	
										'control_args' => array(
															'label'        => __( 'Background transparency', 'katt' ),
															'type'         => 'select', // Select control
															'choices'      => array(
																			'0' => array(
																			'label' => __( '0', 'katt' )
																			),
																			'0.1' => array(
																			'label' => __( '0.1', 'katt' )
																			),
																			'0.2' => array(
																			'label' => __( '0.2', 'katt' )
																			),
																			'0.3' => array(
																			'label' => __( '0.3', 'katt' )
																			),
																			'0.4' => array(
																			'label' => __( '0.4', 'katt' )
																			),
																			'0.5' => array(
																			'label' => __( '0.5', 'katt' )
																			),
																			'0.6' => array(
																			'label' => __( '0.6', 'katt' )
																			),
																			'0.7' => array(
																			'label' => __( '0.7', 'katt' )
																			),
																			'0.8' => array(
																			'label' => __( '0.8', 'katt' )
																			),
																			'0.9' => array(
																			'label' => __( '0.9', 'katt' )
																			),
																			'1' => array(
																			'label' => __( '1', 'katt' )
																			)
															),	
															'priority' => 5
										)
					),



			),

			),


			// Section ID
			'customizer_section_event_design_text_description' => array(

				/*
				* We're checking if this is an existing section
				* or a new one that needs to be registered
				*/
				'existing_section' => false,
				/*
				* Section related arguments
				* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
				*/
				'args' => array(
								'title'       => __( 'EVENT - Text - Description', 'katt' ),
								'description' => __( 'Customize your Event design', 'katt' ),
								'priority'    => 7
				),

				/*
				* This array contains all the fields that need to be
				* added to this section
				*/
				'fields' => array(

					/*
					* ===========
					* ===========
					* Colorpicker
					* ===========
					* ===========
					*/
					// Field ID
					'event_design_description_color' => array(
											/*
											* Setting related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
											*/
											'setting_args' => array(
															'default'    => '#808080',
															'type'       => 'option',
															'capability' => $thsp_cbp_capability,
															'transport'  => 'refresh',
											),	
											/*
											* Control related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
											*/
											'control_args' => array(
															'label'    => __( 'Text color', 'katt' ),
															'type'     => 'color', // Color field control
															'priority' => 6
											)
					),


					/*
					* ===========
					* ===========
					* Colorpicker
					* ===========
					* ===========
					*/
					// Field ID
					'event_design_description_color_shadow' => array(
											/*
											* Setting related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
											*/
											'setting_args' => array(
															'default'    => '#ffffff',
															'type'       => 'option',
															'capability' => $thsp_cbp_capability,
															'transport'  => 'refresh',
											),	
											/*
											* Control related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
											*/
											'control_args' => array(
															'label'    => __( 'Text shadow', 'katt' ),
															'type'     => 'color', // Color field control
															'priority' => 7
											)
					),

					/*
					* ============
					* ============
					* Select field
					* ============
					* ============
					*/
					'event_design_description_size' => array(
										'setting_args' => array(
														'default'    => '1.25em',
														'type'       => 'option',
														'capability' => $thsp_cbp_capability,
														'transport'  => 'refresh',
										),	
										'control_args' => array(
															'label'        => __( 'Text size', 'katt' ),
															'type'         => 'select', // Select control
															'choices'      => array(
																			'1.05em' => array(
																			'label' => __( 'Small', 'katt' )
																			),
																			'1.15em' => array(
																			'label' => __( 'Medium', 'katt' )
																			),
																			'1.25em' => array(
																			'label' => __( 'Large', 'katt' )
																			)
															),	
															'priority' => 8
										)
					),

					/*
					* ===========
					* ===========
					* Colorpicker
					* ===========
					* ===========
					*/
					// Field ID
					'event_design_description_bgcolor' => array(
											/*
											* Setting related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
											*/
											'setting_args' => array(
															'default'    => '#ffffff',
															'type'       => 'option',
															'capability' => $thsp_cbp_capability,
															'transport'  => 'refresh',
											),	
											/*
											* Control related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
											*/
											'control_args' => array(
															'label'    => __( 'Background color', 'katt' ),
															'type'     => 'color', // Color field control
															'priority' => 9
											)
					),

					/*
					* ============
					* ============
					* Select field
					* ============
					* ============
					*/
					'event_design_description_transparency' => array(
										'setting_args' => array(
														'default'    => '0',
														'type'       => 'option',
														'capability' => $thsp_cbp_capability,
														'transport'  => 'refresh',
										),	
										'control_args' => array(
															'label'        => __( 'Background transparency', 'katt' ),
															'type'         => 'select', // Select control
															'choices'      => array(
																			'0' => array(
																			'label' => __( '0', 'katt' )
																			),
																			'0.1' => array(
																			'label' => __( '0.1', 'katt' )
																			),
																			'0.2' => array(
																			'label' => __( '0.2', 'katt' )
																			),
																			'0.3' => array(
																			'label' => __( '0.3', 'katt' )
																			),
																			'0.4' => array(
																			'label' => __( '0.4', 'katt' )
																			),
																			'0.5' => array(
																			'label' => __( '0.5', 'katt' )
																			),
																			'0.6' => array(
																			'label' => __( '0.6', 'katt' )
																			),
																			'0.7' => array(
																			'label' => __( '0.7', 'katt' )
																			),
																			'0.8' => array(
																			'label' => __( '0.8', 'katt' )
																			),
																			'0.9' => array(
																			'label' => __( '0.9', 'katt' )
																			),
																			'1' => array(
																			'label' => __( '1', 'katt' )
																			)
															),	
															'priority' => 10
										)
					),


			),

			),



			// Section ID
			'customizer_section_event_design_text_location' => array(

				/*
				* We're checking if this is an existing section
				* or a new one that needs to be registered
				*/
				'existing_section' => false,
				/*
				* Section related arguments
				* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
				*/
				'args' => array(
								'title'       => __( 'EVENT - Text - Location', 'katt' ),
								'description' => __( 'Customize your Event design', 'katt' ),
								'priority'    => 8
				),

				/*
				* This array contains all the fields that need to be
				* added to this section
				*/
				'fields' => array(


					/*
					* ===========
					* ===========
					* Colorpicker
					* ===========
					* ===========
					*/
					// Field ID
					'event_design_location_color' => array(
											/*
											* Setting related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
											*/
											'setting_args' => array(
															'default'    => '#555555',
															'type'       => 'option',
															'capability' => $thsp_cbp_capability,
															'transport'  => 'refresh',
											),	
											/*
											* Control related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
											*/
											'control_args' => array(
															'label'    => __( 'Text color', 'katt' ),
															'type'     => 'color', // Color field control
															'priority' => 11
											)
					),


					/*
					* ===========
					* ===========
					* Colorpicker
					* ===========
					* ===========
					*/
					// Field ID
					'event_design_location_color_shadow' => array(
											/*
											* Setting related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
											*/
											'setting_args' => array(
															'default'    => '#ffffff',
															'type'       => 'option',
															'capability' => $thsp_cbp_capability,
															'transport'  => 'refresh',
											),	
											/*
											* Control related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
											*/
											'control_args' => array(
															'label'    => __( 'Text shadow', 'katt' ),
															'type'     => 'color', // Color field control
															'priority' => 12
											)
					),

					/*
					* ============
					* ============
					* Select field
					* ============
					* ============
					*/
					'event_design_location_size' => array(
										'setting_args' => array(
														'default'    => '2.5em',
														'type'       => 'option',
														'capability' => $thsp_cbp_capability,
														'transport'  => 'refresh',
										),	
										'control_args' => array(
															'label'        => __( 'Text size', 'katt' ),
															'type'         => 'select', // Select control
															'choices'      => array(
																			'2em' => array(
																			'label' => __( 'Small', 'katt' )
																			),
																			'2.25em' => array(
																			'label' => __( 'Medium', 'katt' )
																			),
																			'2.5em' => array(
																			'label' => __( 'Large', 'katt' )
																			)
															),	
															'priority' => 13
										)
					),

					/*
					* ===========
					* ===========
					* Colorpicker
					* ===========
					* ===========
					*/
					// Field ID
					'event_design_location_bgcolor' => array(
											/*
											* Setting related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
											*/
											'setting_args' => array(
															'default'    => '#ffffff',
															'type'       => 'option',
															'capability' => $thsp_cbp_capability,
															'transport'  => 'refresh',
											),	
											/*
											* Control related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
											*/
											'control_args' => array(
															'label'    => __( 'Background color', 'katt' ),
															'type'     => 'color', // Color field control
															'priority' => 14
											)
					),

					/*
					* ============
					* ============
					* Select field
					* ============
					* ============
					*/
					'event_design_location_transparency' => array(
										'setting_args' => array(
														'default'    => '0',
														'type'       => 'option',
														'capability' => $thsp_cbp_capability,
														'transport'  => 'refresh',
										),	
										'control_args' => array(
															'label'        => __( 'Background transparency', 'katt' ),
															'type'         => 'select', // Select control
															'choices'      => array(
																			'0' => array(
																			'label' => __( '0', 'katt' )
																			),
																			'0.1' => array(
																			'label' => __( '0.1', 'katt' )
																			),
																			'0.2' => array(
																			'label' => __( '0.2', 'katt' )
																			),
																			'0.3' => array(
																			'label' => __( '0.3', 'katt' )
																			),
																			'0.4' => array(
																			'label' => __( '0.4', 'katt' )
																			),
																			'0.5' => array(
																			'label' => __( '0.5', 'katt' )
																			),
																			'0.6' => array(
																			'label' => __( '0.6', 'katt' )
																			),
																			'0.7' => array(
																			'label' => __( '0.7', 'katt' )
																			),
																			'0.8' => array(
																			'label' => __( '0.8', 'katt' )
																			),
																			'0.9' => array(
																			'label' => __( '0.9', 'katt' )
																			),
																			'1' => array(
																			'label' => __( '1', 'katt' )
																			)
															),	
															'priority' => 15
										)
					),


			),

			),



			// Section ID
			'customizer_section_event_design_text_date' => array(

				/*
				* We're checking if this is an existing section
				* or a new one that needs to be registered
				*/
				'existing_section' => false,
				/*
				* Section related arguments
				* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
				*/
				'args' => array(
								'title'       => __( 'EVENT - Text - Date', 'katt' ),
								'description' => __( 'Customize your Event design', 'katt' ),
								'priority'    => 9
				),

				/*
				* This array contains all the fields that need to be
				* added to this section
				*/
				'fields' => array(

					/*
					* ===========
					* ===========
					* Colorpicker
					* ===========
					* ===========
					*/
					// Field ID
					'event_design_date_color' => array(
											/*
											* Setting related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
											*/
											'setting_args' => array(
															'default'    => '#555555',
															'type'       => 'option',
															'capability' => $thsp_cbp_capability,
															'transport'  => 'refresh',
											),	
											/*
											* Control related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
											*/
											'control_args' => array(
															'label'    => __( 'Text color', 'katt' ),
															'type'     => 'color', // Color field control
															'priority' => 16
											)
					),


					/*
					* ===========
					* ===========
					* Colorpicker
					* ===========
					* ===========
					*/
					// Field ID
					'event_design_date_color_shadow' => array(
											/*
											* Setting related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
											*/
											'setting_args' => array(
															'default'    => '#ffffff',
															'type'       => 'option',
															'capability' => $thsp_cbp_capability,
															'transport'  => 'refresh',
											),	
											/*
											* Control related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
											*/
											'control_args' => array(
															'label'    => __( 'Text shadow', 'katt' ),
															'type'     => 'color', // Color field control
															'priority' => 17
											)
					),

					/*
					* ============
					* ============
					* Select field
					* ============
					* ============
					*/
					'event_design_date_size' => array(
										'setting_args' => array(
														'default'    => '1.6em',
														'type'       => 'option',
														'capability' => $thsp_cbp_capability,
														'transport'  => 'refresh',
										),	
										'control_args' => array(
															'label'        => __( 'Text size', 'katt' ),
															'type'         => 'select', // Select control
															'choices'      => array(
																			'1.2em' => array(
																			'label' => __( 'Small', 'katt' )
																			),
																			'1.4em' => array(
																			'label' => __( 'Medium', 'katt' )
																			),
																			'1.6em' => array(
																			'label' => __( 'Large', 'katt' )
																			)
															),	
															'priority' => 18
										)
					),

					/*
					* ===========
					* ===========
					* Colorpicker
					* ===========
					* ===========
					*/
					// Field ID
					'event_design_date_bgcolor' => array(
											/*
											* Setting related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
											*/
											'setting_args' => array(
															'default'    => '#ffffff',
															'type'       => 'option',
															'capability' => $thsp_cbp_capability,
															'transport'  => 'refresh',
											),	
											/*
											* Control related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
											*/
											'control_args' => array(
															'label'    => __( 'Background color', 'katt' ),
															'type'     => 'color', // Color field control
															'priority' => 19
											)
					),

					/*
					* ============
					* ============
					* Select field
					* ============
					* ============
					*/
					'event_design_date_transparency' => array(
										'setting_args' => array(
														'default'    => '0',
														'type'       => 'option',
														'capability' => $thsp_cbp_capability,
														'transport'  => 'refresh',
										),	
										'control_args' => array(
															'label'        => __( 'Background transparency', 'katt' ),
															'type'         => 'select', // Select control
															'choices'      => array(
																			'0' => array(
																			'label' => __( '0', 'katt' )
																			),
																			'0.1' => array(
																			'label' => __( '0.1', 'katt' )
																			),
																			'0.2' => array(
																			'label' => __( '0.2', 'katt' )
																			),
																			'0.3' => array(
																			'label' => __( '0.3', 'katt' )
																			),
																			'0.4' => array(
																			'label' => __( '0.4', 'katt' )
																			),
																			'0.5' => array(
																			'label' => __( '0.5', 'katt' )
																			),
																			'0.6' => array(
																			'label' => __( '0.6', 'katt' )
																			),
																			'0.7' => array(
																			'label' => __( '0.7', 'katt' )
																			),
																			'0.8' => array(
																			'label' => __( '0.8', 'katt' )
																			),
																			'0.9' => array(
																			'label' => __( '0.9', 'katt' )
																			),
																			'1' => array(
																			'label' => __( '1', 'katt' )
																			)
															),	
															'priority' => 20
										)
					),


			),

			),


			// Section ID
			'customizer_section_page_design_text' => array(

				/*
				* We're checking if this is an existing section
				* or a new one that needs to be registered
				*/
				'existing_section' => false,
				/*
				* Section related arguments
				* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
				*/
				'args' => array(
								'title'       => __( 'PAGE - Text', 'katt' ),
								'description' => __( 'Customize your Page design', 'katt' ),
								'priority'    => 10
				),

				/*
				* This array contains all the fields that need to be
				* added to this section
				*/
				'fields' => array(

					/*
					* ===========
					* ===========
					* Colorpicker
					* ===========
					* ===========
					*/
					// Field ID
					'page_design_general_color' => array(
											/*
											* Setting related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
											*/
											'setting_args' => array(
															'default'    => '#555555',
															'type'       => 'option',
															'capability' => $thsp_cbp_capability,
															'transport'  => 'refresh',
											),	
											/*
											* Control related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
											*/
											'control_args' => array(
															'label'    => __( 'General color', 'katt' ),
															'type'     => 'color', // Color field control
															'priority' => 1
											)
					),


					/*
					* ===========
					* ===========
					* Colorpicker
					* ===========
					* ===========
					*/
					// Field ID
					'page_design_primary_color' => array(
											/*
											* Setting related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
											*/
											'setting_args' => array(
															'default'    => '#5e7860',
															'type'       => 'option',
															'capability' => $thsp_cbp_capability,
															'transport'  => 'refresh',
											),	
											/*
											* Control related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
											*/
											'control_args' => array(
															'label'    => __( 'Primary color', 'katt' ),
															'type'     => 'color', // Color field control
															'priority' => 2
											)
					),


					/*
					* ===========
					* ===========
					* Colorpicker
					* ===========
					* ===========
					*/
					// Field ID
					'page_design_secondary_color' => array(
											/*
											* Setting related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
											*/
											'setting_args' => array(
															'default'    => '#95c247',
															'type'       => 'option',
															'capability' => $thsp_cbp_capability,
															'transport'  => 'refresh',
											),	
											/*
											* Control related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
											*/
											'control_args' => array(
															'label'    => __( 'Secondary color', 'katt' ),
															'type'     => 'color', // Color field control
															'priority' => 3
											)
					),


					/*
					* ===========
					* ===========
					* Colorpicker
					* ===========
					* ===========
					*/
					// Field ID
					'page_design_tertiary_color' => array(
											/*
											* Setting related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
											*/
											'setting_args' => array(
															'default'    => '#808080',
															'type'       => 'option',
															'capability' => $thsp_cbp_capability,
															'transport'  => 'refresh',
											),	
											/*
											* Control related arguments
											* Codex - http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
											*/
											'control_args' => array(
															'label'    => __( 'Tertiary color', 'katt' ),
															'type'     => 'color', // Color field control
															'priority' => 4
											)
					),



			),

			),


			

				

		); // End $options[]

		return $options;
		
	}



} // End Class

