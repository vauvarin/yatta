<?php
/** Googlemap block **/

if(!class_exists('AQ_Googlemap_Block')) {
	class AQ_Googlemap_Block extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Googlemap',
				'size' => 'span6',
			);
			
			//create the block
			parent::__construct('aq_googlemap_block', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(
				'text'        => '',
				'address'     => '',
				'coordinates' => '',
				'height'      => '',
				'zoom'        => 8,
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>
			
			<p class="description half">
				<label for="<?php echo $this->get_field_id('title') ?>">
					<?php echo __( 'Title (optional)' , 'yatta' ) ?><br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</p>
			<p class="description half last">
				<label for="<?php echo $this->get_field_id('address') ?>">
					<?php echo __( 'Address (required)' , 'yatta' ) ?><br/>
					<?php echo aq_field_input('address', $block_id, $address) ?>
				</label>
			</p>
			<p class="description half">
				<label for="<?php echo $this->get_field_id('coordinates') ?>">
					<?php echo __( 'Coordinates (optional) e.g. "3.82497,103.32390"' , 'yatta' ) ?><br/>
					<?php echo aq_field_input('coordinates', $block_id, $coordinates) ?>
				</label>
			</p>
			<p class="description fourth">
				<label for="<?php echo $this->get_field_id('coordinates') ?>">
					<?php echo __( 'Zoom Level' , 'yatta' ) ?><br/>
					<?php echo aq_field_input('zoom', $block_id, $zoom, 'min', 'number') ?>
				</label>
			</p>
			<p class="description fourth last">
				<label for="<?php echo $this->get_field_id('height') ?>">
					<?php echo __( 'Map height, in pixels' , 'yatta' ) ?><br/>
					<?php echo aq_field_input('height', $block_id, $height, 'min', 'number') ?> &nbsp; px
				</label>
			</p>
			
			<?php
			
		}
		
		function block($instance) {
			$defaults = array(
				'text'        => '',
				'address'     => '',
				'coordinates' => '',
				'height'      => 350,
				'zoom'        => 8,
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			wp_enqueue_script('googlemap');
			
			if(!$address) {
				_e('Address was not specified', 'framework');
				return false;
			}
			
			if(!$coordinates) {
				$coordinates = aq_get_map_coordinates($address);
				if(is_array($coordinates)) {
					$coordinates = $coordinates['lat'] .','. $coordinates['lng'];
				} else {
					echo $coordinates;
					return false;
				}
			}
			
			$output = '<div id="map_canvas_'.rand(1, 100).'" class="googlemap" style="height:'.$height.'px;">';
				$output .= (!empty($title)) ? '<input class="title" type="hidden" value="'.$title.'" />' : '';
				$output .= '<input class="location" type="hidden" value="'.$address.'" />';
				$output .= '<input class="coordinates" type="hidden" value="'.$coordinates.'" />';
				$output .= '<input class="zoom" type="hidden" value="'.$zoom.'" />';
				$output .= '<div class="map_canvas"></div>';
			$output .= '</div>';
			
			echo $output;
		}
		
	}
}