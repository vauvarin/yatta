<?php

// Buttons BLOCK
class AQ_Button_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Button',
			'size' => 'span3',
		);
		
		//create the block
		parent::__construct( 'aq_button_block', $block_options );
	}
	
	function form( $instance ) {
		
		$defaults = array(
			'yatta_button_block_color' => __( 'blue' , 'yatta' ),
			'yatta_button_block_align' => __( 'center' , 'yatta' ),
			'title'  				  => '',
			'yatta_button_block_url'   => ''
		);

		$instance = wp_parse_args( $instance, $defaults );
		extract( $instance );
		
		$yatta_button_block_colors = array(
			'#2BBDCC' => __( 'Blue' , 'yatta' ),
			'#D7193E' => __( 'Red' , 'yatta' ),
			'#2AB881' => __( 'Green' , 'yatta' ),
			'#BE9C5B' => __( 'Brown' , 'yatta' ),
			'#A6A6A6' => __( 'Grey' , 'yatta' ),
			'#F05BC8' => __( 'Pink' , 'yatta' ),
			'#951F9F' => __( 'Purple' , 'yatta' ),
		);

		$yatta_button_block_position = array(
			'center' => __( 'Center' , 'yatta' ),
			'left'   => __( 'Left' , 'yatta' ),
			'right'  => __( 'Right' , 'yatta' ),
		);
		
		?>
        <p class="description">
            <label for="<?php echo $this->get_field_id('title') ?>">
                <?php _e( 'Color' , 'yatta' ) ?><br/>
                <?php echo aq_field_select( 'yatta_button_block_color', $block_id, $yatta_button_block_colors, $yatta_button_block_color ) ?>
            </label>
        </p>
        <p class="description">
            <label for="<?php echo $this->get_field_id('yatta_button_block_align') ?>">
                <?php _e( 'Position' , 'yatta' ) ?><br/>
                <?php echo aq_field_select( 'yatta_button_block_align', $block_id, $yatta_button_block_position, $yatta_button_block_align ) ?>
            </label>
        </p>
        <p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				<?php _e( 'Label (required)' , 'yatta' ) ?>
				<?php echo aq_field_input( 'title', $block_id, $title, $size = 'full' ) ?>
			</label>
		</p>
        <p class="description">
			<label for="<?php echo $this->get_field_id('yatta_button_block_url') ?>">
				<?php _e( 'URL (required)' , 'yatta' ) ?>
				<?php echo aq_field_input( 'yatta_button_block_url', $block_id, $yatta_button_block_url, $size = 'full' ) ?>
			</label>
		</p>
		<?php
	}

	function block( $instance ) {
        extract( $instance );

        $yatta_button_display ='';

        if ( !empty ( $yatta_button_block_url ) && !empty ( $title ) ) {

	        $yatta_button_display .= '<div class="yatta-button-block-container" style="text-align: ' . $yatta_button_block_align . ';"><a href="' . $yatta_button_block_url .  '" class="yatta-button-block-link"><div class="yatta-button-block" style="background: ' . $yatta_button_block_color . ';">' . $title . '</div></a></div>';

	        echo $yatta_button_display;

        }

    }

}