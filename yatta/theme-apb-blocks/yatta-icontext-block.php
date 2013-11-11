<?php
/** A simple icon + text block **/
class AQ_Yatta_Icon_Text_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => __( 'Icon - Text' , 'yatta' ),
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct( 'aq_yatta_icon_text_block', $block_options );
	}
	
	function form( $instance ) {
		
		$defaults = array(
			'text'               => '',
			'img'                => '',
			'yatta_icontext_icon' => 'none',
		);
		$instance = wp_parse_args( $instance, $defaults );
		extract( $instance );

		$icontext_icon = array(
								'yatta-icon-no'                                                   => __( 'No icon' , 'yatta' ),
								'yatta-icon-mobile yatta-icontext icon-mobile'                     => __( 'Mobile' , 'yatta' ),
								'yatta-icon-support yatta-icontext icon-support'                   => __( 'Support' , 'yatta' ),
								'yatta-icon-eye yatta-icontext icon-eye'                           => __( 'Eye' , 'yatta' ),
								'yatta-icon-earth yatta-icontext icon-earth'                       => __( 'Earth' , 'yatta' ),
								'yatta-icon-users yatta-icontext icon-users'                       => __( 'Users' , 'yatta' ),
								'yatta-icon-pushpin yatta-icontext icon-pushpin'                   => __( 'Pushpin' , 'yatta' ),
								'yatta-icon-map yatta-icontext icon-map'                           => __( 'Map' , 'yatta' ),
								'yatta-icon-file yatta-icontext icon-file'                         => __( 'File' , 'yatta' ),
								'yatta-icon-cog yatta-icontext icon-cog'                           => __( 'Cog' , 'yatta' ),
								'yatta-icon-signup yatta-icontext icon-signup'                     => __( 'Signup' , 'yatta' ),
								'yatta-icon-power-cord yatta-icontext icon-power-cord'             => __( 'Power Cord' , 'yatta' ),
								'yatta-icon-image yatta-icontext icon-image'                       => __( 'Image' , 'yatta' ),
								'yatta-icon-compass yatta-icontext icon-compass'                   => __( 'Compass' , 'yatta' ),
								'yatta-icon-calendar-2 yatta-icontext icon-calendar-2'             => __( 'Calendar' , 'yatta' ),
								'yatta-icon-key yatta-icontext icon-key'                           => __( 'Key' , 'yatta' ),
								'yatta-icon-attachment yatta-icontext icon-attachment'             => __( 'Attachment' , 'yatta' ),
								'yatta-icon-point-right  yatta-icontext icon-point-right '         => __( 'Point Right ' , 'yatta' ),
								'yatta-icon-warning  yatta-icontext icon-warning '                 => __( 'Warning ' , 'yatta' ),
								'yatta-icon-radio-checked  yatta-icontext icon-radio-checked '     => __( 'Target' , 'yatta' ),
								'yatta-icon-file-pdf  yatta-icontext icon-file-pdf '               => __( 'PDF' , 'yatta' ),
								'yatta-icon-gift yatta-icontext icon-gift'                         => __( 'Gift' , 'yatta' ),
								'yatta-icon-credit yatta-icontext icon-credit'                     => __( 'Credit Card' , 'yatta' ),
								'yatta-icon-tags yatta-icontext icon-tags'                         => __( 'Tags' , 'yatta' ),
								'yatta-icon-gift yatta-icontext icon-rocket'                       => __( 'Rocket' , 'yatta' ),
								'yatta-icon-microphone yatta-icontext icon-microphone'             => __( 'Conferences, Workshops ...' , 'yatta' ),
								'yatta-icon-food yatta-icontext icon-food'                         => __( 'Restaurant' , 'yatta' ),
								'yatta-icon-lodging yatta-icontext icon-lodging'                   => __( 'Hotel' , 'yatta' ),
								'yatta-icon-mug yatta-icontext icon-mug'                           => __( 'Bar - Pub' , 'yatta' ),
								'yatta-icon-drink-2 yatta-icontext icon-drink-2'                   => __( 'Cafe' , 'yatta' ),
								'yatta-icon-fast-food yatta-icontext icon-fast-food'               => __( 'Snack' , 'yatta' ),
								'yatta-icon-drink yatta-icontext icon-drink'                       => __( 'Party' , 'yatta' ),
								'yatta-icon-parking yatta-icontext icon-parking'                   => __( 'Parking' , 'yatta' ),
								'yatta-icon-airplane yatta-icontext icon-airplane'                 => __( 'Airport' , 'yatta' ),
								'yatta-icon-heliport yatta-icontext icon-heliport'                 => __( 'Heliport' , 'yatta' ),
								'yatta-icon-subway yatta-icontext icon-subway'                     => __( 'Train Station' , 'yatta' ),
								'yatta-icon-bus yatta-icontext icon-bus'                           => __( 'Bus Station' , 'yatta' ),
								'yatta-icon-belowground-rail yatta-icontext icon-belowground-rail'  => __( 'Tram Station' , 'yatta' ),
								'yatta-icon-aboveground-rail yatta-icontext icon-aboveground-rail' => __( 'Subway Station' , 'yatta' ),
								'yatta-icon-ferry yatta-icontext icon-ferry'                       => __( 'Ferry' , 'yatta' ),
                        );
		
		?>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id( 'title' ) ?>">
				<?php _e( 'Title (optional)' , 'yatta' ) ?>
				<?php echo aq_field_input( 'title', $block_id, $title, $size = 'full' ) ?>
			</label>
		</p>

		<p class="description">
		    <label for="<?php echo $this->get_field_id('yatta_icontext_icon') ?>">
		        <?php _e( 'Icon (required)' , 'yatta' ) ?>
		        <?php echo aq_field_select( 'yatta_icontext_icon', $block_id, $icontext_icon, $yatta_icontext_icon ) ?>
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

		$yatta_icontext_display = '';

		if ( $title || $text || $yatta_icontext_icon ) {

			$yatta_icontext_display .= '<div class="yatta-icontext-block-container">';

			if ( $yatta_icontext_icon )
				$yatta_icontext_display .= '<i class="' . $yatta_icontext_icon . '"></i>';

			if ( $title || $text ) {

				$yatta_icontext_display .= '<div class="yatta-icontext-block-content-container">';
				if ( $title ) 
				$yatta_icontext_display .= '<span class="yatta-icontext-block-title">' . strip_tags( $title ) . '</span>';
				if ( $text ) 
				$yatta_icontext_display .= '<span class="yatta-icontext-block-text">' . wpautop( do_shortcode( htmlspecialchars_decode( $text ) ) ) . '</span>';
				$yatta_icontext_display .= '</div>';
			}

			$yatta_icontext_display .= '</div>';

		}

		echo $yatta_icontext_display;
	}
	
}