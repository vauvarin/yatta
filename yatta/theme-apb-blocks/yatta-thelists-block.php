<?php
/** Thelist Block **/

if( !class_exists( 'AQ_Thelists_Block' ) ) {
	class AQ_Thelists_Block extends AQ_Block {
		function __construct() {
			$block_options = array(
				'name'			=> __( 'List' , 'yatta' ),
				'size'			=> 'span6',
			);
			
			parent::__construct( 'aq_thelists_block', $block_options );
			
			add_action( 'wp_ajax_aq_block_thelist_add_new', array( $this, 'add_thelist' ) );
		}
		
		function form( $instance ) {
			$defaults = array(
				'title'                     => '',
				'yatta_thelists_block_style' => 'none',
				'thelists'                  => array(
												1 => array(
														'header' => 'Item',
														'text'   => '',
													)
				)
			);
			$instance = wp_parse_args( $instance, $defaults );
			extract( $instance );


			$thelists_block_style = array(
									'none'                 => __( 'None' , 'yatta' ),
									'circle'               => __( 'Circle' , 'yatta' ),
									'disc'                 => __( 'Disc' , 'yatta' ),
									'square'               => __( 'Square' , 'yatta' ),
									'decimal'              => __( 'Decimal' , 'yatta' ),
									'decimal-leading-zero' => __( 'Decimal-leading-zero' , 'yatta' ),
									'lower-alpha'          => __( 'Lower-alpha' , 'yatta' ),
									'lower-roman'          => __( 'Lower-roman' , 'yatta' ),
									'upper-alpha'          => __( 'Upper-alpha' , 'yatta' ),
									'upper-roman'          => __( 'Upper-roman' , 'yatta' ),
                                );
			
			?>

		    <p class="description">
		        <label for="<?php echo $this->get_field_id('title') ?>">
		        <?php _e( 'Title (optional)' , 'yatta' ) ?>
		        <?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
		        </label>
		    </p>
		    
		    <p class="description">
		        <label for="<?php echo $this->get_field_id('yatta_thelists_block_style') ?>">
		        <?php _e( 'Marker style' , 'yatta' ) ?>
		        <?php echo aq_field_select( 'yatta_thelists_block_style', $block_id, $thelists_block_style, $yatta_thelists_block_style ) ?>
		        </label>
		    </p>

			<p class="description cf">
				<label>
		        <?php _e( 'Item(s)' , 'yatta' ) ?>
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$thelists = is_array( $thelists ) ? $thelists : $defaults[ 'thelists' ];
					$count = 1;
					foreach( $thelists as $thelist ) {	
						$this->thelist( $thelist, $count );
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="thelist" class="aq-sortable-add-new button"><?php _e( 'Add New' , 'yatta' ) ?></a>
				<p></p>
				</label>
			</p>
			<?php
		}
		
		function thelist( $thelist = array(), $count = 0 ) {
			
			$defaults = array (
								'header' => 'Item',
								'text'   => '',
			);
			$thelist = wp_parse_args( $thelist, $defaults );

			
			
			?>
			<li id="<?php echo $this->get_field_id('thelists') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $thelist[ 'header' ] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">__( 'Open / Close' , 'yatta' )</a>
					</div>
				</div>
				
				<div class="sortable-body">
					
					<p class="description">
						<label for="<?php echo $this->get_field_id('thelists') ?>-<?php echo $count ?>-header">
							<?php _e( 'Title' , 'yatta' ) ?><br/>
							<input type="text" id="<?php echo $this->get_field_id('thelists') ?>-<?php echo $count ?>-header" class="input-full" name="<?php echo $this->get_field_name('thelists') ?>[<?php echo $count ?>][header]" value="<?php echo $thelist['header'] ?>" />
						</label>
					</p>
					<p class="description">
						<label for="<?php echo $this->get_field_id('thelists') ?>-<?php echo $count ?>-text">
							<?php _e( 'Text' , 'yatta' ) ?><br/>
							<textarea id="<?php echo $this->get_field_id('thelists') ?>-<?php echo $count ?>-text" class="textarea-full" name="<?php echo $this->get_field_name('thelists') ?>[<?php echo $count ?>][text]" rows="5"><?php echo $thelist[ 'text' ] ?></textarea>
						</label>
					</p>
					<p class="description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>
				
			</li>
			<?php
		}
		
		function add_thelist() {
			$nonce = $_POST[ 'security' ];	
			if ( !wp_verify_nonce( $nonce, 'aqpb-settings-page-nonce' ) ) die( '-1' );
			
			$count = isset( $_POST[ 'count' ] ) ? absint( $_POST[ 'count' ] ) : false;
			$this->block_id = isset( $_POST[ 'block_id' ] ) ? $_POST[ 'block_id' ] : 'aq-block-9999';
			
			//default key/value for the tab
			$thelist = array(
								'header' => 'Item',
								'text'   => '',
			);
			
			if($count) {
				$this->thelist($thelist, $count);
			} else {
				die(-1);
			}
			
			die();
		}
		
		function block( $instance ) {
		

			extract( $instance );
			
			$count = count( $thelists );
			$i = 1;
			
			if( $title ) echo '<h2 class="yatta-block-header yatta-thelists-block-header">' . strip_tags( $title ) . '</h2>';
			?>
				<ul class="yatta-block-ul yatta-thelist-block-ul" style="list-style-type: <?php echo $yatta_thelists_block_style ?>" >
				
				<?php foreach ( $thelists as $thelist ) {	
					
					$defaults = array (
									'header' => 'Item',
									'text'   => '',
					);
					$thelist = wp_parse_args($thelist, $defaults);
					
					if ( !empty( $thelist[ 'header' ] ) || !empty( $thelist[ 'text' ] ) ) {
					?>

						<li class="yatta-thelist-block-li">

							<?php if ( !empty( $thelist[ 'header' ] ) ) { ?>
							<span class="yatta-thelist-block-header">
								<?php echo htmlspecialchars( stripslashes( $thelist[ 'header' ] ) ) ?>
							</span>
							<?php } ?>
						
							<?php if ( !empty( $thelist[ 'text' ] ) ) { ?>
								<?php if ( !empty( $thelist[ 'header' ] ) ) { ?>
								<br />
								<?php } ?>
								<span class="yatta-thelist-block-text">
									<?php echo htmlspecialchars( stripslashes( $thelist[ 'text' ] ) ) ?>
								</span>
							<?php } ?>
							
						</li>
						
						<?php
					} // End if
				} // Enf foreach
				?> 
				
				</ul>
				
			
			<?php
			
		}
		
		function update( $new_instance, $old_instance ) {
			return $new_instance;
		}
		
	}
}