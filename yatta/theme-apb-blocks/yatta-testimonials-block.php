<?php
/** Testimonial Block **/

if( !class_exists( 'AQ_Testimonials_Block' ) ) {
	class AQ_Testimonials_Block extends AQ_Block {
		function __construct() {
			$block_options = array(
								'name' => __( 'Testimonials' , 'yatta' ),
								'size' => 'span6',
			);
			
			parent::__construct( 'aq_testimonials_block', $block_options );
			
			add_action( 'wp_ajax_aq_block_testimonial_add_new', array( $this, 'add_testimonial' ) );
		}
		
		function form( $instance ) {
			$defaults = array(
				'title'  => '',
				'testimonials'	=> array(
					1 => array(
							'author'     => __( 'Testimonial author' , 'yatta' ),
							'occupation' => '',
							'link'       => '',
							'company'    => '',
							'text'       => ''
						)
				)
			);
			$instance = wp_parse_args( $instance, $defaults );
			extract( $instance );
			
			?>
			<p class="description">
		        <label for="<?php echo $this->get_field_id('title') ?>">
		        <?php _e( 'Title (optional)' , 'yatta' ) ?>
		        <?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
		        </label>
		    </p>
			<p class="description cf">
				<label>
		        <?php _e( 'Testimonial(s)' , 'yatta' ) ?>
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$testimonials = is_array( $testimonials ) ? $testimonials : $defaults[ 'testimonials' ];
					$count = 1;
					foreach( $testimonials as $testimonial ) {	
						$this->testimonial( $testimonial, $count );
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="testimonial" class="aq-sortable-add-new button"><?php _e( 'Add New' , 'yatta' ) ?></a>
				<p></p>
				</label>
			</p>
			<?php
		}
		
		function testimonial( $testimonial = array(), $count = 0 ) {
			
			$defaults = array (
								'author'     => __( 'Testimonial author' , 'yatta' ),
								'occupation' => '',
								'link'       => '',
								'company'    => '',
								'text'       => ''
			);
			$testimonial = wp_parse_args( $testimonial, $defaults );
			
			?>
			<li id="<?php echo $this->get_field_id('testimonials') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $testimonial[ 'author' ] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#"><?php _e( 'Open / Close' , 'yatta' ) ?></a>
					</div>
				</div>
				
				<div class="sortable-body">
					<p class="description">
						<label for="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-author">
							<?php _e( 'Author' , 'yatta' ) ?><br/>
							<input type="text" id="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-author" class="input-full" name="<?php echo $this->get_field_name('testimonials') ?>[<?php echo $count ?>][author]" value="<?php echo $testimonial['author'] ?>" />
						</label>
					</p>

					<p class="description">
						<label for="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-occupation">
							<?php _e( 'Occupation' , 'yatta' ) ?><br/>
							<input type="text" id="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-occupation" class="input-full" name="<?php echo $this->get_field_name('testimonials') ?>[<?php echo $count ?>][occupation]" value="<?php echo $testimonial['occupation'] ?>" />
						</label>
					</p>
					
					<p class="description">
						<label for="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-company">
							<?php _e( 'Company name' , 'yatta' ) ?><br/>
							<input type="text" id="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-company" class="input-full" name="<?php echo $this->get_field_name('testimonials') ?>[<?php echo $count ?>][company]" value="<?php echo $testimonial['company'] ?>" />
						</label>
					</p>
					<p class="description">
						<label for="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-link">
							<?php _e( 'Company website (ex: www.mywebsite.com)' , 'yatta' ) ?><br/>
							<input type="text" id="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-link" class="input-full" name="<?php echo $this->get_field_name('testimonials') ?>[<?php echo $count ?>][link]" value="<?php echo $testimonial['link'] ?>" />
						</label>
					</p>
					<p class="description">
						<label for="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-text">
							<?php _e( 'Testimonial text' , 'yatta' ) ?><br/>
							<textarea id="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-text" class="textarea-full" name="<?php echo $this->get_field_name('testimonials') ?>[<?php echo $count ?>][text]" rows="5"><?php echo $testimonial[ 'text' ] ?></textarea>
						</label>
					</p>
					<p class="description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>
				
			</li>
			<?php
		}
		
		function add_testimonial() {
			$nonce = $_POST[ 'security' ];	
			if ( !wp_verify_nonce( $nonce, 'aqpb-settings-page-nonce' ) ) die( '-1' );
			
			$count = isset( $_POST[ 'count' ] ) ? absint( $_POST[ 'count' ] ) : false;
			$this->block_id = isset( $_POST[ 'block_id' ] ) ? $_POST[ 'block_id' ] : 'aq-block-9999';
			
			//default key/value for the tab
			$testimonial = array(
								'author'     => __( 'Testimonial author' , 'yatta' ),
								'occupation' => '',
								'link'       => '',
								'company'    => '',
								'text'       => ''
			);
			
			if($count) {
				$this->testimonial($testimonial, $count);
			} else {
				die(-1);
			}
			
			die();
		}
		
		function block( $instance ) {
		

			extract( $instance );
			
			$count = count( $testimonials );
			$i = 1;
			
			if( $title ) echo '<div class="yatta-block-header yatta-news-block-header">' . strip_tags( $title ) . '</div>';
			?>

				<ul class="yatta-block-ul">
				
				<?php foreach ( $testimonials as $testimonial ) {	
					
					$defaults = array (
										'author'     => __( 'Testimonial author' , 'yatta' ),
										'occupation' => '',
										'link'       => '',
										'company'    => '',
										'text'       => ''
					);
					$testimonial = wp_parse_args($testimonial, $defaults);
					
					
					if ( !empty( $testimonial[ 'author' ] ) && !empty( $testimonial[ 'text' ] ) ) {

						?>
					
						<li class="yatta-block-li yatta-block-thelist-li">

							<blockquote class="yatta-testimonial-block-text">
								<?php echo wpautop( htmlspecialchars( stripslashes( $testimonial[ 'text' ] ) ) ) ?>
							</blockquote>
						
							<div class="yatta-testimonial-block-data">
								<span class="yatta-testimonial-block-author">
									<?php echo htmlspecialchars( stripslashes( $testimonial[ 'author' ] ) ); ?>
								</span>

								<?php
								if ( !empty( $testimonial[ 'occupation' ] ) ) {
										echo '<span class="yatta-testimonial-block-occupation"> - ' . htmlspecialchars( stripslashes( $testimonial[ 'occupation' ] ) ) . '</span>';
								}
								if ( !empty( $testimonial[ 'link' ] ) || !empty( $testimonial[ 'company' ] ) ) {
									if ( !empty( $testimonial[ 'link' ] ) ) {
									$yatta_url_protocols = array( 'http', 'https' );
										echo ' - <a href="' . esc_url( $testimonial[ 'link' ], $yatta_url_protocols ) .'" target="_blank"><span class="yatta-testimonial-block-company">' . htmlspecialchars( stripslashes( $testimonial[ 'company' ] ) ) . '</span></a>';
									} else {
										echo '<span class="yatta-testimonial-block-company"> - ' . htmlspecialchars( stripslashes( $testimonial[ 'company' ] ) ) . '</span>';
									}
								}
								?>
							</div>

							
							
						</li>
						
						<?php
					} // End if
				} // End foreach
				?>
				
				</ul>
			
			<?php
			
		}
		
		function update( $new_instance, $old_instance ) {
			return $new_instance;
		}
		
	}
}