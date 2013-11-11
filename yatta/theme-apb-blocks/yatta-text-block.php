<?php
/** A simple text block **/
class AQ_Yatta_Text_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => __( 'Text' , 'yatta' ),
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct( 'aq_yatta_text_block', $block_options );
	}
	
	function form( $instance ) {
		
		$defaults = array(
			'text' => '',
			'img' => '',
		);
		$instance = wp_parse_args( $instance, $defaults );
		extract( $instance );
		
		?>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id( 'title' ) ?>">
				<?php _e( 'Title (optional)' , 'yatta' ) ?>
				<?php echo aq_field_input( 'title', $block_id, $title, $size = 'full' ) ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id( 'text' ) ?>">
				<?php _e( 'Text (required)' , 'yatta' ) ?>
				<?php echo aq_field_textarea( 'text', $block_id, $text, $size = 'full' ) ?>
			</label>
		</p>
		
		<?php
	}
	
	function block( $instance ) {
		extract( $instance );
		
		if( $title ) echo '<h2 class="yatta-block-header yatta-text-block-header">'.strip_tags( $title ).'</h2>';
		echo wpautop( do_shortcode( htmlspecialchars_decode( $text ) ) );
	}
	
}