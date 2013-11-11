<?php
/** Features Block 
 * A simple block that output the "features" HTML */
if(!class_exists( 'AQ_Places_Block' ) ) {
	class AQ_Places_Block extends AQ_Block {
		
		// set and create block
		function __construct() {
			$block_options = array(
				'name' => __( 'Places' , 'yatta' ),
				'size' => 'span4'
			);
			
			// create the block
			parent::__construct( 'aq_places_block', $block_options ) ;
		}
		
		function form( $instance ) {
			$defaults = array(
				'title'                  => '',
				'sub_title'              => '',
				'yatta_places_block_icon' => __( 'No icon' , 'yatta' ),
				'yatta_places_block_text' => '',
			);
			$instance = wp_parse_args( $instance, $defaults );
			extract( $instance );

			$places_block_icons = array(
										'yatta-icon-no'                                     => __( 'No icon' , 'yatta' ),
										'yatta-icon-microphone icon-microphone'             => __( 'Conferences, Workshops ...' , 'yatta' ),
										'yatta-icon-food icon-food'                         => __( 'Restaurant' , 'yatta' ),
										'yatta-icon-lodging icon-lodging'                   => __( 'Hotel' , 'yatta' ),
										'yatta-icon-mug icon-mug'                           => __( 'Bar - Pub' , 'yatta' ),
										'yatta-icon-drink-2 icon-drink-2'                   => __( 'Cafe' , 'yatta' ),
										'yatta-icon-fast-food icon-fast-food'               => __( 'Snack' , 'yatta' ),
										'yatta-icon-drink icon-drink'                       => __( 'Party' , 'yatta' ),
										'yatta-icon-parking icon-parking'                   => __( 'Parking' , 'yatta' ),
										'yatta-icon-airplane icon-airplane'                 => __( 'Airport' , 'yatta' ),
										'yatta-icon-heliport icon-heliport'                 => __( 'Heliport' , 'yatta' ),
										'yatta-icon-subway icon-subway'                     => __( 'Train Station' , 'yatta' ),
										'yatta-icon-bus icon-bus'                           => __( 'Bus Station' , 'yatta' ),
										'yatta-icon-belowground-rail icon-belowground-rail' => __( 'Tram Station' , 'yatta' ),
										'yatta-icon-aboveground-rail icon-aboveground-rail' => __( 'Subway Station' , 'yatta' ),
										'yatta-icon-ferry icon-ferry'                       => __( 'Ferry' , 'yatta' ),
                                );
			
			?>
			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					<?php _e( 'Title (required)' , 'yatta' ) ?><br/>
					<?php echo aq_field_input( 'title', $block_id, $title ) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('sub_title') ?>">
					<?php _e( 'Sub-title (optional)' , 'yatta' ) ?><br/>
					<?php echo aq_field_input( 'sub_title', $block_id, $sub_title ) ?>
			</p>

			<p class="description">
		        <label for="<?php echo $this->get_field_id('yatta_places_block_icon') ?>">
		        <?php _e( 'Choose an icon (required)' , 'yatta' ) ?>
		        <?php echo aq_field_select( 'yatta_places_block_icon', $block_id, $places_block_icons, $yatta_places_block_icon ) ?>
		        </label>
		    </p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('yatta_places_block_text') ?>">
					<?php _e( 'Text (required)' , 'yatta' ) ?>
					<?php echo aq_field_textarea( 'yatta_places_block_text', $block_id, $yatta_places_block_text, $size = 'full' ) ?>
				</label>
			</p>
			<?php
			
		}
		
		function block( $instance ) {
			extract( $instance );

			// Build the css class for yatta-places-block-container-title
			$yatta_places_icon_array = array();
			$yatta_places_icon_array = explode( " ", $yatta_places_block_icon );
			$yatta_places_icon = str_replace( "-icon", "", $yatta_places_icon_array[0] );

			$yatta_places_display = '';
			if ( !empty( $title ) || !empty( $sub_title ) || !empty( $yatta_places_block_content ) ) {
				$yatta_places_display .= "<div class='yatta-places-block-container'>";
				if ( !empty( $title ) ) {
					$yatta_places_display .= "<div class='yatta-places-block-container-title " . $yatta_places_icon . "'>";
					$yatta_places_display .= "<div class='yatta-places-block-title'>" . sanitize_text_field( $title ) . "</div>";
					if ( $yatta_places_block_icon != 'yatta-icon-no' ) {
						$yatta_places_display .= "<div class='yatta-places-block-container-icon'>";
						$yatta_places_display .= "<div class='yatta-places-block-container-circle'>";
						$yatta_places_display .= "<i class='" . $yatta_places_block_icon . "'></i>";
						$yatta_places_display .= "</div>";
						$yatta_places_display .= "</div>";
					}
					$yatta_places_display .= "</div>";
				}
				if ( !empty( $yatta_places_block_text ) ) {
					$yatta_places_display .= "<div class='yatta-places-block-container-text'>";
					if ( !empty( $sub_title ) ) {
						$yatta_places_display .= "<div class='yatta-places-block-subtitle'>" . sanitize_text_field( $sub_title ) . "</div>";
					}
					$yatta_places_display .= "<div class='yatta-places-block-text'>" . wpautop( do_shortcode( htmlspecialchars_decode( $yatta_places_block_text ) ) ) . "</div>";
					$yatta_places_display .= "</div>";
				}
				$yatta_places_display .= "</div>";

				echo $yatta_places_display;
			}
			
		}
		
	}
}

