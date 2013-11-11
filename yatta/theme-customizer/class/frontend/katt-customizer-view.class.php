<?php
/**
 * Class KattCustomizerViewFrontend
 *
 * This class gets and displays the data from the Customizer options page.
 *
 * @package Kattagami
 * @version 1.0.0
 * @author Gilles Vauvarin
 * @copyright Gilles Vauvarin (gillesvauvarin@gmail.com)
 * @link http://kattagami.com
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */



class KattCustomizerViewFrontend extends SingletonPlugin {

	// Poperties
  	private $katt_helper;


    // Init function use as a constructor
	function init() { 

		/* Class instantiation */
    	$this->katt_helper = new KattHelper;

		add_action( 'katt_header' , array( &$this, 'get_view_header' ) , 10, 1 );
		add_action( 'katt_event' , array( &$this, 'get_view_event' ) , 10, 1 );
		
		add_action( 'wp_head' , array( &$this, 'header_output' ) );

		add_action( 'wp_footer' , array( &$this, 'sticky_event' ) , 11 );


	} // End init()


	/**
	 * Pass a variable to script.js 
	 * This variable tests if the event's informations must stick to the top or not
	 *
	 * @since 1.0.0
	 */
	public function sticky_event() {
		$katt_event_sticky = true;
		$thsp_cbp_theme_options = get_option( 'thsp_cbp_theme_options' );
		$katt_event_sticky      = $thsp_cbp_theme_options[ 'event_content_sticky' ];
		wp_localize_script(
                        'script', 
                        'katt_event_sticky', 
                        array(
                        'event_sticky'  => $katt_event_sticky,
                        )
      	);
	}


	/**
	 * Display the header content (logo, baseline).
	 *
	 *
	 * @since 1.0.0
	 * @param array $args Arguments for how to load and display the event.
	 * @return string|array The HTML code to display the event. | event attributes in an array.
	 */
	public function get_view_header( $args = array() ) {

		// Hook 
		katt_view_header_before();

		// Create an empty variable for the event.
		$header = '';

		// Set the default arguments.
		$defaults = array(
		              'wrap_before'            => '<div class="katt-header-wrap">',
		              'wrap_after'             => '</div>',
		              'title_markup_primary'   => 'h1',
		              'title_markup_secondary' => 'h2',
		              'width'                  => false,
		              'height'                 => false,
		              'empty_option'           => __('Header content ...','katt'),
		              'echo'                   => true,
		    );

		// Allow plugins/themes to filter the arguments.
		$args = apply_filters( 'katt_view_header_args', $args );

		// Merge the input arguments and the defaults.
		$args = wp_parse_args( $args, $defaults );

		$thsp_cbp_theme_options = get_option( ' thsp_cbp_theme_options ' );

		$katt_header_logo_url = $thsp_cbp_theme_options[ 'header_content_logo' ];
		$katt_header_logo_id  = $this->katt_helper->katt_get_image_id( $katt_header_logo_url );
		unset( $this->katt_helper );
		$katt_header_logotext = $thsp_cbp_theme_options[ 'header_content_logo_text' ];
		$katt_header_baseline = $thsp_cbp_theme_options[ 'header_content_baseline' ];



		if ( !empty( $katt_header_logo_id ) || !empty( $katt_header_logotext ) || !empty( $katt_header_baseline ) ) {


			if ( !empty( $katt_header_logo_id ) && is_numeric( $katt_header_logo_id ) || $katt_header_logotext ) {
				$logo_attr = array(
					'class'	=> "katt-header-logo",
					'alt'   => trim( strip_tags( get_post_meta( $katt_header_logo_id, '_wp_attachment_image_alt', true) ) ),
				);
				$header .= wp_get_attachment_image( esc_attr( $katt_header_logo_id ), 'full', false, $logo_attr );
				$header .= "<h2 class='katt-header-logotext'>" . sanitize_text_field( $katt_header_logotext ) . "</h2>";;
			}

			if ( !empty( $katt_header_baseline ) ) {
				$header .= "<h2 class='katt-header-baseline'>" . sanitize_text_field( $katt_header_baseline ) . "</h2>";
			}

		}
		else {
		$header .= "<div class='katt-notice'><h4 class='katt-notice-title'>" . __( 'NOTICE - Header' , 'katt' ) . "</h4><p>" . __( 'No content found. Have you already added some content for the header area (logo, baseline)? Go to Appearance > Customizer > Header Content.' , 'katt' ) . "</p></div>";
		}


		// Allow developers to filter the HTML $header.
		$header = apply_filters( 'katt_view_header_output', $header, $args );

		// If $echo is setted to true, display $header.
		if ( $args['echo'] )
		echo $header;
		// Else return the $header.
		else
		return $header;

		// Hook 
		katt_view_header_after();

	}




	/**
	 * Display the main left content (location, date, description).
	 *
	 *
	 * @since 1.0.0
	 * @param array $args Arguments for how to load and display the event.
	 * @return string|array The HTML code to display the event. | event attributes in an array.
	 */
	public function get_view_event( $args = array() ) {

		// Hook
		katt_view_event_before();

		// Create an empty variable for the event.
		$event = '';

		// Set the default arguments.
		$defaults = array(
		              'wrap_before'            => '<div class="katt-event-wrap">',
		              'wrap_after'             => '</div>',
		              'title_markup_primary'   => 'h1',
		              'title_markup_secondary' => 'h2',
		              'width'                  => false,
		              'height'                 => false,
		              'empty_option'           => __( 'Header content ...' , 'katt' ),
		              'echo'                   => true,
		    );

		// Allow plugins/themes to filter the arguments.
		$args = apply_filters( 'katt_view_event_args', $args );

		// Merge the input arguments and the defaults.
		$args = wp_parse_args( $args, $defaults );

		$thsp_cbp_theme_options = get_option( ' thsp_cbp_theme_options ' );

		$katt_event_name    	= $thsp_cbp_theme_options[ 'event_content_name' ];
		$katt_event_location    = $thsp_cbp_theme_options[ 'event_content_location' ];
		$katt_event_date        = $thsp_cbp_theme_options[ 'event_content_date' ];
		$katt_event_description = $thsp_cbp_theme_options[ 'event_content_description' ];


		if ( !empty( $katt_event_name ) || !empty( $katt_event_location ) || !empty( $katt_event_date ) || !empty( $katt_event_description ) ) {

			//$event .= $args['wrap_before']; 

			
			
			if ( !empty( $katt_event_name ) ) {
				$event .= "<h1 class='katt-event-name'>" . sanitize_text_field( $katt_event_name ) . "</h1><br/>";
			} 
			if ( !empty( $katt_event_description ) ) {
				$event .= "<h2 class='katt-event-description'>" . sanitize_text_field( $katt_event_description ) . "</h2><br/>";
			}
			if ( !empty( $katt_event_location ) ) {
				$event .= "<h2 class='katt-event-location'>" . sanitize_text_field( $katt_event_location ) . "</h2><br/>";
			} 
			if ( $katt_event_date ) {
				$event .= "<span class='katt-event-date'>" . sanitize_text_field( $katt_event_date ) . "</span><br/>";
			}

			//$event .= $args['wrap_after'];

		}
		else {
		$event .= "<br /><div class='katt-notice'><h4 class='katt-notice-title'>" . __( 'NOTICE - Event' , 'katt' ) . "</h4><p> " . __('No content found. Have you already added some content for the event (location, date, description)? Go to Appearance > Customizer > Event Content','katt') . "</p></div>";
		}


		// Allow developers to filter the HTML $event.
		$event = apply_filters( 'katt_view_event_output', $event, $args );

		// If $echo is setted to true, display $event.
		if ( $args['echo'] )
		echo $event;
		// Else return the $event.
		else
		return $event;

		// Hook
		katt_view_event_after();

	}

	/**
     * This will generate a line of CSS for use in header output. If the setting
     * ($options) has no defined value, the CSS will not be output.
     * 
     * @uses get_option()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $option_name The name of the option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since MyTheme 1.0
     */
    public function generate_css_1( $selector, $style, $option_name, $prefix='',$echo=true ) {
		$return = '';
		$thsp_cbp_theme_options = get_option( ' thsp_cbp_theme_options ' );

		$option = $thsp_cbp_theme_options[ $option_name ];
		if ( !empty( $option ) ) {
			$return = sprintf(	'%s { %s:%s; }',
								$selector,
								$style,
								$prefix . ' ' . $option
							);
			if ( $echo ) {
				echo $return;
			}
		}
		return $return;
    }


    /**
     * This will generate a line of CSS for use in header output. If the setting
     * ($options) has no defined value, the CSS will not be output.
     * 
     * @uses get_option()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $option_name The name of the option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since MyTheme 1.0
     */
    public function generate_css_event_padding_margin( $selector, $echo=true ) {
		$return = '';
		$return = sprintf(	'%s { padding: 10px; margin-bottom: 5px; }',
								$selector
							);
		if ( $echo ) {
			echo $return;
		}
		return $return;
    }

    /**
     * This will generate a line of CSS for use in header output. If the setting
     * ($options) has no defined value, the CSS will not be output.
     * 
     * @uses get_option()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $option_name The name of the option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since MyTheme 1.0
     */
    public function generate_css_event_font_size( $selector, $option_name_1, $echo=true ) {
		$return = '';
		$thsp_cbp_theme_options = get_option( ' thsp_cbp_theme_options ' );

		if ( !empty( $option_name_1 ) )
		$option_1 = $thsp_cbp_theme_options[ $option_name_1 ];
		$return = sprintf(	'%s { font-size: %s; } ',
								$selector,
								$option_1
							);
		if ( $echo ) {
			echo $return;
		}
		return $return;
    }


	/**
     * This will generate a line of CSS for use in header output. If the setting
     * ($option_1 and $option_2) has no defined value, the CSS will not be output.
     * 
     * @uses get_option()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $option_name The name of the option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since MyTheme 1.0
     */
    public function generate_css_event(  
    								$selector, 
    								$style_1, 
    								$option_name_1, 
    								$prefix_1='', 
    								$style_2, 
    								$option_name_2, 
    								$prefix_2='', 
    								$postfix_2='', 
    								$style_4, 
    								$option_name_4, 
    								$prefix_4='',
    								$option_name_5,    
    								$echo=true ) {
		$return = '';
		$thsp_cbp_theme_options = get_option( ' thsp_cbp_theme_options ' );

		if ( !empty( $option_name_1 ) )
		$option_1 = $thsp_cbp_theme_options[ $option_name_1 ];
		if ( !empty( $option_name_2 ) )
		$option_2 = $thsp_cbp_theme_options[ $option_name_2 ];
		if ( !empty( $option_name_4 ) )
		$option_4 = $thsp_cbp_theme_options[ $option_name_4 ];
		if ( !empty( $option_name_5 ) )
		$option_5 = $thsp_cbp_theme_options[ $option_name_5 ];
		if ( !empty( $option_1 ) || !empty( $option_2 ) || !empty( $option_4 ) || !empty( $option_5 ) ) {
			$return = sprintf(	'%s { %s:%s; %s:%s; %s:%s; }',
								$selector,
								$style_1,
								$prefix_1 . ' ' . $option_1,
								$style_2,
								$prefix_2 . ' ' . $option_2 . ' ' . $postfix_2,
								$style_4,
								$prefix_4 . ' rgba( ' . $this->katt_helper->katt_convert_color( $option_4 ) . ', ' . $option_5 . ')'
							);
			if ( $echo ) {
				echo $return;
			}
		}
		return $return;
    }


    /**
     * This will generate a line of CSS for use in header output. If the setting
     * ($options) has no defined value, the CSS will not be output.
     * 
     * @uses get_option()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $option_color The name of the color option to fetch
     * @param string $option_url The url of the color option to fetch
     * @param string $option_repeat The name of the repeat option to fetch
     * @param string $option_position The name of the position option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since MyTheme 1.0
     */
    public function generate_css_background( $selector, $style, $option_color, $option_url, $option_repeat, $option_position_h, $option_position_v, $option_attachment, $echo = true ) {
		$return = '';
		$thsp_cbp_theme_options = get_option( ' thsp_cbp_theme_options ' );

		$option_color      = $thsp_cbp_theme_options[ $option_color ];
		$option_url        = $thsp_cbp_theme_options[ $option_url ];
		$option_repeat     = $thsp_cbp_theme_options[ $option_repeat ];
		$option_position_h = $thsp_cbp_theme_options[ $option_position_h ];
		$option_position_v = $thsp_cbp_theme_options[ $option_position_v ];
		$option_attachment = $thsp_cbp_theme_options[ $option_attachment ];

		if ( !empty( $option_color ) || !empty( $option_url ) || !empty( $option_repeat ) || !empty( $option_position_h ) || !empty( $option_position_v ) || !empty( $option_attachment ) ) {
			$return = sprintf('%s { %s:%s; }',
			$selector,
			$style,
			$option_color . ' url("' . $option_url . '") ' . $option_repeat . ' ' . $option_position_h . ' ' . $option_position_v . ' ' . $option_attachment
			);
			if ( $echo ) {
				echo $return;
			}
		}
		return $return;
    }


    /**
    * This will output the custom WordPress settings to the live theme's WP head.
    * 
    * Used by hook: 'wp_head'
    * 
    * @see add_action('wp_head',$func)
    * @since MyTheme 1.0
    */
   public function header_output() {
   		$thsp_cbp_theme_options = get_option( ' thsp_cbp_theme_options ' );

   		if ( !empty ( $thsp_cbp_theme_options ) ) {
			?>
			<!--Customizer CSS--> 
			<style type="text/css">
				<?php 
					if ( !($thsp_cbp_theme_options[ 'event_design_name_transparency' ] == '0') )
						$this->generate_css_event_padding_margin( '.katt-event-name' );
					if ( !($thsp_cbp_theme_options[ 'event_design_description_transparency' ] == '0') )
						$this->generate_css_event_padding_margin( '.katt-event-description' );
					if ( !($thsp_cbp_theme_options[ 'event_design_location_transparency' ] == '0') )
						$this->generate_css_event_padding_margin( '.katt-event-location' );
					if ( !($thsp_cbp_theme_options[ 'event_design_date_transparency' ] == '0') )
						$this->generate_css_event_padding_margin( '.katt-event-date' );
				?>
				<?php 
					$this->generate_css_background( '.katt-header', 
													'background', 
													'header_design_background_color', 
													'header_design_background_url', 
													'header_design_background_repeat', 
													'header_design_background_position_h' ,
													'header_design_background_position_v', 
													'header_design_background_attachment' ); 
				?> 
				<?php 
					$this->generate_css_1( 	'.katt-header', 
											'background-color', 
											'header_design_background_color', 
											'' ); 
				?> 
			   	<?php 
			   		$this->generate_css_1( 	'.katt-header-logotext', 
			   								'color', 
			   								'header_design_logotext_color', 
			   								'' ); 
			   	?> 
			   	<?php 
			   		$this->generate_css_1( 	'.katt-header-baseline', 
			   								'color', 
			   								'header_design_baseline_color', 
			   								'' ); 
			   	?> 
			   	<?php 
			   		$this->generate_css_background( '.katt-event', 
			   										'background', 
			   										'event_design_background_color', 
			   										'event_design_background_url', 
			   										'event_design_background_repeat', 
			   										'event_design_background_position_h' ,
			   										'event_design_background_position_v', 
			   										'event_design_background_attachment' ); 
			   	?> 
			   	<?php 
			   		$this->generate_css_1( 	'.katt-event', 
			   								'background-color', 
			   								'event_design_background_color', 
			   								'' ); 
			   	?> 
			   	<?php 
			   		$this->generate_css_event( '.katt-event-name', 
			   								'color', 
			   								'event_design_name_color', 
			   								'', 
			   								'text-shadow', 
			   								'event_design_name_color_shadow', 
			   								'', 
			   								'0 1px 0',
			   								'background-color',
			   								'event_design_name_bgcolor',
			   								'',
			   								'event_design_name_transparency'
			   								); 
			   	?> 
			   	<?php 
			   		$this->generate_css_event( 	'.katt-event-description', 
			   								'color', 
			   								'event_design_description_color', 
			   								'', 
			   								'text-shadow', 
			   								'event_design_description_color_shadow', 
			   								'', 
			   								'0 1px 0',
											'background-color',
			   								'event_design_description_bgcolor',
			   								'',
			   								'event_design_description_transparency'
			   								); 
			   	?> 
			   	<?php 
			   		$this->generate_css_event( 	'.katt-event-location', 
			   								'color', 
			   								'event_design_location_color', 
			   								'', 
			   								'text-shadow', 
			   								'event_design_location_color_shadow', 
			   								'', 
			   								'0 1px 0',
			   								'background-color',
			   								'event_design_location_bgcolor',
			   								'',
			   								'event_design_location_transparency'
			   								);
			   	?> 
			   	<?php 
			   		$this->generate_css_event( 	'.katt-event-date', 
			   								'color', 
			   								'event_design_date_color', 
			   								'', 
			   								'text-shadow', 
			   								'event_design_date_color_shadow', 
			   								'', 
			   								'0 1px 0',
			   								'background-color',
			   								'event_design_date_bgcolor',
			   								'',
			   								'event_design_date_transparency'
			   								);
			   	?> 
			   	<?php 
			   		echo '@media screen and (min-width: 381px) { ';
					$this->generate_css_event_font_size( '.katt-event-name', 
													'event_design_name_size' ); 
					$this->generate_css_event_font_size( '.katt-event-location', 
													'event_design_location_size' ); 
					$this->generate_css_event_font_size( '.katt-event-description', 
													'event_design_description_size' ); 
					echo ' }';
				?> 
			   	<?php 
			   		$this->generate_css_1( 	'	.katt-news-block-title, 
			   									.katt-pagenews-block-title, 
			   									.katt-testimonial-block-author,
			   									.katt-icon-mail, 
			   									.katt-icon-screen, 
			   									.katt-icon-pencil, 
			   									.katt-icon-twitter, 
			   									.katt-icon-map-marker, 
			   									.katt-icon-clock, 
			   									.katt-icon-calendar, 
			   									.katt-icon-bubbles,
			   									.katt-speakers-block-name,
			   									.katt-organizer-name,
			   									.katt-pagepresentations-presentation-title,
			   									.katt-pagepresentations-speaker-name,
			   									.katt-schedule-presentation-title,
			   									.katt-schedule-day,
			   									.katt-block-header,
			   									.katt-news-block-title a,
			   									.katt-thelist-block-header,
			   									.katt-organizer-email,
			   									.katt-organizer-twitter,
			   									.katt-organizer-website,
			   									.katt-organizer-twitter a,
			   									.katt-organizer-website a,
			   									.katt-pagepresentations-presentation-type,
			   									.katt-pagepresentations-presentation-date,
			   									.katt-pagepresentations-presentation-hour,
			   									.katt-pagepresentations-presentation-location,
			   									.katt-pagespeakers-presentation-type,
			   									.katt-pagespeakers-presentation-date,
			   									.katt-pagespeakers-presentation-hour,
			   									.katt-pagespeakers-presentation-location,
			   									.katt-pagespeakers-presentation-title a,
			   									.katt-pagepresentations-speaker-name a,
			   									.katt-pagespeakers-speaker-email,
			   									.katt-pagespeakers-speaker-twitter,
			   									.katt-pagespeakers-speaker-website,
			   									.katt-pagespeakers-speaker-twitter a,
			   									.katt-pagespeakers-speaker-website a,
			   									.katt-pagespeakers-speaker-name,
			   									.katt-schedule-presentation-td1,
			   									.katt-schedule-break-time-td,
			   									.katt-schedule-presentation-title a,
			   									.katt-schedule-day-date,
			   									.katt-schedule-presentation-type,
			   									.katt-schedule-presentation-location,
			   									.katt-icontext-block-title,
			   									.katt-page-header,
			   									.h2
			   								', 
			   								'color', 
			   								'page_design_primary_color', 
			   								'' ); 
			   	?> 
			   	<?php 
			   		$this->generate_css_1( 	'	.katt-news-block-date, 
			   									.katt-pagenews-block-date, 
			   									.katt-testimonial-block-text:before,
			   									.katt-pagespeakers-speaker-occupation,
			   									.katt-speakers-block-occupation,
			   									.katt-organizer-duties,
			   									.katt-schedule-speaker-name a,
			   									.katt-icontext
			   								', 
			   								'color', 
			   								'page_design_secondary_color', 
			   								'' ); 
			   	?> 
			   	
			   	<?php 
			   		$this->generate_css_1( 	'	.katt-testimonial-block-text,  
			   									.katt-testimonial-block-data a,
			   									.katt-icontext-block-text,
			   									.katt-thelist-block-text
			   								', 
			   								'color', 
			   								'page_design_tertiary_color', 
			   								'' ); 
			   	?> 
			   	<?php 
			   		$this->generate_css_1( 	'body', 
			   								'color', 
			   								'page_design_general_color', 
			   								'' ); 
			   	?> 
			</style> 
			<!--/Customizer CSS-->
			<?php
		}
   }





} // End Class