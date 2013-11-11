<?php
/** map Block **/

if( !class_exists( 'AQ_Map_Block' ) ) {
	class AQ_Map_Block extends AQ_Block {

		private $localize_data = array();
		private $localize_map_data = array();
		private $localize_address_data = array();


		function __construct() {
			$block_options = array(
				'name'			=> __( 'Map' , 'yatta'),
				'size'			=> 'span12',
			);
			
			parent::__construct( 'aq_map_block', $block_options );
			
			add_action( 'wp_ajax_aq_block_map_add_new', array( $this, 'add_map' ) );
			//add_action( 'wp_footer', function() { wp_localize_script('script', 'yatta_map', $this->localize_data	); }, 11 );
			add_action( 'wp_footer', array( $this, 'yatta_localize_data' ), 11 );
			
		}

		function yatta_localize_data() {
			wp_localize_script('script', 'yatta_map', $this->localize_data );
		}
		
		function form( $instance ) {
			$defaults = array(
				'title'  => '',
				'yatta_map_block_height' => '450',
				'yatta_map_block_zoom'   => '10',
				'map'                   => array(
											1 => array(
													'address'      => __( 'Address' , 'yatta'),
													'icon'         => __( 'Conferences, Workshops ...' , 'yatta'),
													'bubble_title' => '',
													'bubble-text'  => '',
												)
				)
			);
			$instance = wp_parse_args( $instance, $defaults );
			extract( $instance );

			$map_block_zoom = array(
										'5'  => '5',
										'6'  => '6',
										'7'  => '7',
										'8'  => '8',
										'9'  => '9',
										'10' => '10',
										'11' => '11',
										'12' => '12',
										'13' => '13',
										'14' => '14',
										'15' => '15',
										'16' => '16',
										'17' => '17',
										'18' => '18',
                                );

			
			
			?>
			<p class="description">
		        <label for="<?php echo $this->get_field_id('title') ?>">
		        <?php _e( 'Title (optional)' , 'yatta' ) ?>
		        <?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
		        </label>
		    </p>
		    <p class="description">
		        <label for="<?php echo $this->get_field_id('yatta_map_block_height') ?>">
		        <?php _e( 'Height in px (optional)' , 'yatta' ) ?>
		        <?php echo aq_field_input('yatta_map_block_height', $block_id, $yatta_map_block_height, $size = 'full') ?>
		        </label>
		    </p>
		    <p class="description">
		        <label for="<?php echo $this->get_field_id('yatta_map_block_zoom') ?>">
		        <?php _e( 'Zoom' , 'yatta' ) ?>
		        <?php echo aq_field_select( 'yatta_map_block_zoom', $block_id, $map_block_zoom, $yatta_map_block_zoom ) ?>
		        </label>
		    </p>
			<p class="description cf">
				<label>
				<?php _e( 'Places' , 'yatta' ) ?>
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$map = is_array( $map ) ? $map : $defaults[ 'map' ];
					$count = 1;
					foreach( $map as $map ) {	
						$this->map( $map, $count );
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="map" class="aq-sortable-add-new button"><?php _e( 'Add New' , 'yatta' ) ?></a>
				<p></p>
			</label>
			</p>
			<?php
		}
		
		function map( $map = array(), $count = 0 ) {
			
			$defaults = array (
								'address'      => __( 'Address', 'yatta' ),
								'icon'         => __( 'Conferences, Workshops ...' , 'yatta' ),
								'bubble_title' => '',
								'bubble_text'  => '',
			);
			$map = wp_parse_args( $map, $defaults );

			$map_block_icon = array(
									'presentation' => __( 'Conferences, Workshops ...' , 'yatta' ),
									'lodging'      => __( 'Hotel' , 'yatta' ),
									'restaurant'   => __( 'Restaurant' , 'yatta' ),
									'bar'          => __( 'Bar - Pub' , 'yatta' ),
									'cafe'         => __( 'Cafe' , 'yatta' ),
									'snack'        => __( 'Snack' , 'yatta' ),
									'party'        => __( 'Party' , 'yatta' ),
									'parking'      => __( 'Parking' , 'yatta' ),
									'airport'      => __( 'Airport' , 'yatta' ),
									'heliport'     => __( 'Heliport' , 'yatta' ),
									'bus'          => __( 'Bus Station' , 'yatta' ),
									'tram'         => __( 'Tramway Station' , 'yatta' ),
									'subway'       => __( 'Subway Station' , 'yatta' ),
									'ferry'        => __( 'Ferry' , 'yatta' ),
                                );
			
			?>
			<li id="<?php echo $this->get_field_id('map') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $map[ 'address' ] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#"><?php __( 'Open / Close' , 'yatta' ) ?></a>
					</div>
				</div>
				
				<div class="sortable-body">
					<p class="description">
						<label for="<?php echo $this->get_field_id('map') ?>-<?php echo $count ?>-address">
							<?php _e( 'Address (required)' , 'yatta' ) ?><br/>
							<input type="text" id="<?php echo $this->get_field_id('map') ?>-<?php echo $count ?>-address" class="input-full" name="<?php echo $this->get_field_name('map') ?>[<?php echo $count ?>][address]" value="<?php echo $map['address'] ?>" />
						</label>
					</p>
					<p class="description">
						<label for="<?php echo $this->get_field_id('map') ?>-<?php echo $count ?>-icon">
							<?php _e( 'Marker - Icon (required)' , 'yatta' ) ?><br/>
							<select id="<?php echo $this->get_field_id('map') ?>-<?php echo $count ?>-icon" class="textarea-full" name="<?php echo $this->get_field_name('map') ?>[<?php echo $count ?>][icon]" >
								"<?php
								foreach ( $map_block_icon as $key => $label ) {
                					$html = sprintf( '<option value="%s"%s>%s </option>', $key, selected( $map['icon'], $key, false ), $label );
                					echo $html;
            					}
            					?>"
							</select>
						</label>
					</p>
					<p class="description">
						<label for="<?php echo $this->get_field_id('map') ?>-<?php echo $count ?>-bubble-title">
							<?php _e( 'Bubble - Title (optional)' , 'yatta' ) ?><br/>
							<input type="text" id="<?php echo $this->get_field_id('map') ?>-<?php echo $count ?>-bubble-title" class="input-full" name="<?php echo $this->get_field_name('map') ?>[<?php echo $count ?>][bubble_title]" value="<?php echo $map['bubble_title'] ?>" />
						</label>
					</p>
					<p class="description">
						<label for="<?php echo $this->get_field_id('map') ?>-<?php echo $count ?>-bubble-text">
							<?php _e( 'Bubble - Text (optional)' , 'yatta' ) ?><br/>
							<textarea id="<?php echo $this->get_field_id('map') ?>-<?php echo $count ?>-bubble-text" class="textarea-full" name="<?php echo $this->get_field_name('map') ?>[<?php echo $count ?>][bubble_text]" rows="5"><?php echo $map['bubble_text'] ?></textarea>
						</label>
					</p>
					
					
					<p class="description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>
				
			</li>
			<?php
		}
		
		function add_map() {
			$nonce = $_POST[ 'security' ];	
			if ( !wp_verify_nonce( $nonce, 'aqpb-settings-page-nonce' ) ) die( '-1' );
			
			$count = isset( $_POST[ 'count' ] ) ? absint( $_POST[ 'count' ] ) : false;
			$this->block_id = isset( $_POST[ 'block_id' ] ) ? $_POST[ 'block_id' ] : 'aq-block-9999';
			
			//default key/value for the tab
			$map = array(
						'address'      => __( 'Address' , 'yatta'),
						'icon'         => __( 'Conferences, Workshops ...' , 'yatta'),
						'bubble_title' => '',
						'bubble_text'  => '',
								
			);
			
			if($count) {
				$this->map($map, $count);
			} else {
				die(-1);
			}
			
			die();
		}

		
		function block( $instance ) {

		wp_enqueue_script('leaflet');

		extract( $instance );
			
			
			if ( !empty( $title ) ) {
				$title = htmlspecialchars( stripslashes( $title ) );
			}

			if ( !empty( $yatta_map_block_height ) ) {
				$yatta_map_block_height = preg_replace( "/[^0-9]/", '', $yatta_map_block_height );
			} else {
				$yatta_map_block_height = '450';
			}

			if ( !empty( $yatta_map_block_zoom ) ) {
				$yatta_map_block_zoom = strip_tags( $yatta_map_block_zoom );
				$this->localize_map_data[ 'zoom' ] = $yatta_map_block_zoom;
			}

			$count = count( $map );
			$i = 0;

			foreach ( $map as $map ) {	
				
				$defaults = array (
								'address'      => __( 'Places' , 'yatta' ),
								'icon'         => __( 'Conferences, Workshops ...' , 'yatta' ),
								'bubble_title' => '',
								'bubble_text'  => '',
				);
				$map = wp_parse_args($map, $defaults);
				
				

				if ( !empty( $map[ 'address' ] ) ) {
					$this->localize_address_data[ $i ][ 'address' ] = $this->yatta_get_coords( htmlspecialchars( stripslashes( $map[ 'address' ] ) ) );
				}

				if ( !empty( $map[ 'icon' ] ) ) {
					$this->localize_address_data[ $i ][ 'icon' ] = htmlspecialchars( stripslashes( $map[ 'icon' ] ) );
				}

				if ( !empty( $map[ 'bubble_title' ] ) ) {
					$this->localize_address_data[ $i ][ 'bubble_title' ] = htmlspecialchars( stripslashes( $map[ 'bubble_title' ] ) );
				} else {
					$this->localize_address_data[ $i ][ 'bubble_title' ] = '';
				}

				if ( !empty( $map[ 'bubble_text' ] ) ) {
					$this->localize_address_data[ $i ][ 'bubble_text' ] = stripslashes( wpautop ( esc_textarea( $map[ 'bubble_text' ] ) ) );
				} else {
					$this->localize_address_data[ $i ][ 'bubble_text' ] = '';
				}

				$i++;

			} // Enf foreach

			$this->localize_data = array(
										'map_data'     => $this->localize_map_data[ 'zoom' ],
										'images_uri'   => get_template_directory_uri() . '/images/',			
										'address_data' => $this->localize_address_data,			
			);

			

			// Display the block title and the map
			if ( !empty( $title ) ) {
			?>
			<h2 class="yatta-block-header yatta-map-block-header"><?php echo $title ?></h2>
			<?php } ?>
			<div id="map" style="height: <?php echo $yatta_map_block_height ?>px; margin: 20px 0 20px 0;"></div>
			<?php 
		}
		


		function update( $new_instance, $old_instance ) {
			return $new_instance;
		}


		/**
		* Get Lat/Long from an address
		*
		* Author: Willy Bahuaud
		* Author URI: http://wabeo.fr
		* This code come from his Nearby Map plugin
		* 
		* @param $address String - Address
		* 
		*/
		function yatta_get_coords( $address ) {
			$map_url = 'http://nominatim.openstreetmap.org/search?format=json&q=' . urlencode( $address );
			$request = wp_remote_get( $map_url );
			$json    = wp_remote_retrieve_body( $request );

			$tryosm = apply_filters( 'nbm_try_to_find_with_openstreetmap', true );

			if ( $json != '[]' && $tryosm ) {
				$json = json_decode( $json );

				$long = $json[0]->lon;
				$lat  = $json[0]->lat;

				return compact( 'lat', 'long' );

			} else { // If there are no results with openstreetmap... let's try on google maps
				$map_url = 'http://maps.google.com/maps/api/geocode/json?address=' . urlencode( $address ) . '&sensor=false';
				$request = wp_remote_get( $map_url );
				$json    = wp_remote_retrieve_body( $request );

				if ( empty( $json ) )
					return false;

				$json = json_decode( $json );
				
				$status = $json->status;
				
				if ( $status == 'OK' ) {
					$lat = $json->results[0]->geometry->location->lat;
					$long = $json->results[0]->geometry->location->lng;

					return compact( 'lat', 'long' );
				} else {
					return false;
				}
			}
		}



		
	} // Class
} // If