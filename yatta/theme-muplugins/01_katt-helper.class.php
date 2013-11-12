<?php
/**
 * Class KattHelper
 *
 * Provide helper functions.
 *
 * @package Kattagami
 * @version 1.0.0
 * @author Gilles Vauvarin
 * @copyright
 * @link http://kattagami.com
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */





class KattHelper {





	function __construct() {

	}



    /**
	* Get the post ID from his slug.
	*
	* @since 1.0.0
	* @param String $page_slug Page slug.
	* @return string The page id.
	*/
	function get_id_by_slug( $page_slug ) {
	    $page = get_page_by_path( $page_slug );
	    if ( $page ) {
	        return $page->ID;
	    } else {
	        return null;
	    }
	}


	/**
	 * Prepare a string for different uses: remove accented or special characters and change to lowercase.
	 * 
	 *
	 * @since 1.0.0
	 * @param String $string_title The string to format.
	 * @return string The new string format.
	 */
	function prepare_string( $string_title ) {
	  /* Remove the wptexturize function filter from the_title, see http://codex.wordpress.org/Function_Reference/wptexturize */
	  remove_filter ('the_title', 'wptexturize');
	  /* List all accented characters and their non-accented equivalant characters in an array */
	  $accent = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
	  $without_accent = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
	  /* Convert accented characters to their non-accented equivalant */
	  $string_title = str_replace($accent, $without_accent, $string_title);
	  /* Remove some special characters */
	  $string_title = preg_replace("/[^a-zA-Z0-9\s]/", '' , $string_title);
	  /* Change string to lowercase*/
	  $string_title = strtolower($string_title);

	  return $string_title;
	}


	/**
	 * Format a post title field to be used in an URL.
	 * e.g.: Bob O'neill > boboneill
	 *
	 * @since 1.0.0
	 * @param String $string_title The string to format.
	 * @return string The new string format.
	 */
	function string_to_url( $string_title ) {
	  /* Remove accented or special characters and change to lowercase */
	  $string_title = $this -> prepare_string( $string_title );
	  /* Remove multiple spaces */
	  $string_title = preg_replace('/\s+/', '' , $string_title);

	  return $string_title;
	}

	/**
	 * Format a post title field: remove numbers
	 *
	 * @since 1.0.0
	 * @param String $string_title The string to format.
	 * @return string The new string format.
	 */
	function remove_number_from_string( $string_title ) {
	  /* Remove the wptexturize function filter from the_title, see http://codex.wordpress.org/Function_Reference/wptexturize */
	  remove_filter ('the_title', 'wptexturize');
	  /* Remove all the numbers from the string */
	  $string_title = preg_replace( '`[0-9]`sm', '', $string_title ); 

		return $string_title;
	}

	/**
	 * Format a post title field to be used for a ccs class's name. Format: class='my-class-without-number'
	 *
	 * @since 1.0.0
	 * @param String $string_title The string to format.
	 * @return string The new string format.
	 */
	function prepare_post_title_for_class_name( $string_title ) {
	  /* Remove accented or special characters and change to lowercase */
	  $string_title = $this -> prepare_string( $string_title );
	  /* Remove all the numbers from the string */
	  $string_title = preg_replace( '`[0-9]`sm', '', $string_title ); 
	  /* Remove multiple spaces */
	  $string_title = preg_replace('/\s+/', '' , $string_title);

		return $string_title;
	}

	/**
	* Conditional function to check if post belongs to term in a custom taxonomy.
	*
	* This function come from http://alex.leonard.ie/2011/06/30/wordpress-check-if-post-is-in-custom-taxonomy/
	*
	* @param tax    string              taxonomy to which the term belons
	* @param term   int|string|array    attributes of shortcode
	* @param _post  int                 post id to be checked
	* @return BOOL  True                if term is matched, false otherwise
	*/
	function post_in_taxonomy( $taxonomy, $term, $_post = NULL ) {
	    // if neither tax nor term are specified, return false
	    if ( !$taxonomy || !$term ) { return FALSE; }
	    // if post parameter is given, get it, otherwise use $GLOBALS to get post
	    if ( $_post ) {
	        $_post = get_post( $_post );
	    } else {
	        $_post =& $GLOBALS['post'];
	    }
	    // if no post return false
	    if ( !$_post ) { return FALSE; }
	    // check whether post matches term belongin to tax
	    $return = is_object_in_term( $_post->ID, $taxonomy, $term );
	    // if error returned, then return false
	    if ( is_wp_error( $return ) ) { return FALSE; }
	return $return;
	}


	/**
	 * Check if a sidebar is active that is check for widgets in widget areas.
	 *
	 * This function comes from Justin Tadlock
	 *
	 * @since 1.0.0
	 * @param integer|string $index Argument: the sidebar name.
	 * @return boolean True if the sidebar is active, False if inactive.
	 */
	function is_sidebar_active( $index = 1 ) {
	  global $wp_registered_sidebars;

	  if ( is_int( $index ) ) :
	    $index = "sidebar-$index";
	  else :
	    $index = sanitize_title( $index );
	    foreach ( (array) $wp_registered_sidebars as $key => $value ) :
	      if ( sanitize_title( $value['name'] ) == $index ) :
	        $index = $key;
	        break;
	      endif;
	    endforeach;
	  endif;

	  $sidebars_widgets = wp_get_sidebars_widgets();

	  if ( empty( $wp_registered_sidebars[$index] ) || !array_key_exists( $index, $sidebars_widgets ) || !is_array( $sidebars_widgets[$index] ) || empty( $sidebars_widgets[$index] ) )
	    return false;
	  else
	    return true;
	}


	/**
	 * Add Theme Editor to Admin Bar (to save time!)
	 *
	 *
	 * @since 1.0.0
	 */
	function admin_bar_theme_editor_option() {
	    global $wp_admin_bar;
	        if ( !is_super_admin() || !is_admin_bar_showing() )
	        return;
	        $wp_admin_bar->add_menu(
	            array( 'id' => 'edit-theme',
	            'title' => __('Edit Theme', 'katt'),
	                        'href' => admin_url( 'theme-editor.php')
	                )
	        );
	}





	/**
	 * Retrieves the attachment ID from the file URL
	 *
	 * This function comes from Pippin Williamson
	 * http://pippinsplugins.com/retrieve-attachment-id-from-image-url/
	 *
	 * @since 1.0.0
	 */
	function katt_get_image_id( $image_url ) {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM " . $prefix . "posts" . " WHERE guid='%s';", $image_url )); 
		if ( !empty( $attachment ) ) {
	        return $attachment[0]; 
	    }
	}


	/**
	 * Convert color hexadecimal < > RGB
	 *
	 * This function comes from ??
	 * http://logiciels.meteo-mc.fr/php-convertir-couleur.php
	 *
	 * @param String $rgb_color or Array($array_rgb_values) or String $hexadecimal_color  
	 * @since 1.0.0
	 */
	function katt_convert_color( $color ) {
		// convert hexadecimal to RGB
		if( !is_array( $color ) && preg_match("/^[#]([0-9a-fA-F]{6})$/", $color ) ) {

			$hex_R = substr( $color, 1, 2 );
			$hex_G = substr( $color, 3, 2 );
			$hex_B = substr( $color, 5, 2 );
			$RGB = hexdec( $hex_R ) . "," . hexdec( $hex_G ) . "," . hexdec( $hex_B );

			return $RGB;
		}
		// convert RGB to hexadecimal
		else{
			if( !is_array( $color ) ) { $color = explode( "," ,$color ) ; }

			foreach( $color as $value ) {
				$hex_value = dechex( $value ); 
				if( strlen( $hex_value ) <2 ) { $hex_value = "0" . $hex_value; }
				$hex_RGB.= $hex_value;
			}

			return "#" . $hex_RGB;
		}

	}


} // End Class