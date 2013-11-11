<?php
/* Image Block */
if(!class_exists('AQ_Image_Block')) {
	class AQ_Image_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name' => __( 'Image' , 'yatta' ),
				'size' => 'span6',
			);
			
			//create the widget
			parent::__construct('AQ_Image_Block', $block_options);
		}
		
		function form($instance) {
			$defaults = array(
				'img'    => '',
				'height' => '',
				'crop'   => 0,
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>
			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					<?php _e( 'Title (optional)' , 'yatta' ) ?><br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('img') ?>">
					<?php _e( 'Upload an image' , 'yatta' ) ?><br/>
					<?php echo aq_field_upload('img', $block_id, $img, $media_type = 'img') ?>
					
				</label>
				<?php if($img) { ?>
				<div>
					<img style="width:50%" src="<?php echo $img ?>" />
				</div>
				<?php } ?>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('height') ?>">
					<?php _e( 'Height (optional)' , 'yatta' ) ?><br/>
					<?php echo aq_field_input('height', $block_id, $height, 'min', 'number') ?> px
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('crop') ?>">
					<?php echo aq_field_checkbox('crop', $block_id, $crop); ?>
					<?php echo __( 'Crop Image?' , 'yatta' ) ?>
				</label>
			</p>
			<?php
		}
		
		function block($instance) {
			extract($instance);
			$width = aq_get_column_width($size);
			$crop = $crop ? true : false;
			$image = aq_resize($img, $width, $height, $crop);
			
			if($title) echo '<h2 class="yatta-block-header yatta-image-block-header">'.strip_tags($title).'</h2>';
			echo '<img class="yatta-image-block-img" src="'.$image.'" />';
		}
		
		
	}
}