<?php

/**
 * Class KattSettings
 *
 * This class is used to create page options in the backend using the Settings API.
 * 
 *
 * @author Tareq Hasan <tareq@weDevs.com>
 * @link http://tareq.weDevs.com Tareq's Planet
 * http://tareq.wedevs.com/2012/06/wordpress-settings-api-php-class/
 * https://github.com/tareq1988/wordpress-settings-api-class
 *
 * 
 * Modified/adapted by Gilles Vauvarin for the Kattagami project.
 *
 * @package Kattagami
 * @version 1.0.0
 * @link http://kattagami.com
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */


/* Define CONSTANTS */
define( 'KATT_SETTINGS_CLASS_URL', content_url( '/themes/yatta/yatta/theme-muplugins/katt-class/' ) );
define( 'KATT_SETTINGS_CLASS_IMG', KATT_SETTINGS_CLASS_URL . 'img' );


class KattSettings  {  

    private $settings_sections = array();
    private $settings_fields = array();

    // Methods
    /* Constructor */
    function __construct() {

    }


    /**
    * Set settings sections
    *
    * @param array $sections setting sections array
    */
    function set_sections( $sections ) {
        $this->settings_sections = $sections;
    }

    /**
    * Add a single section
    *
    * @param array $section
    */
    function add_section( $section ) {
        $this->settings_sections[] = $section;
    }

    /**
    * Set settings fields
    *
    * @param array $fields settings fields array
    */
    function set_fields( $fields ) {
        $this->settings_fields = $fields;
    }

    /**
    * Add field
    *
    * @param $section, $field settings fields array
    */
    function add_field( $section, $field ) {
        $defaults = array(
            'name'  => '',
            'label' => '',
            'desc'  => '',
            'type'  => 'text'
        );

        $arg = wp_parse_args( $field, $defaults );
        $this->settings_fields[$section][] = $arg;
    }


    /**
    * Initialize and registers the settings sections and fileds to WordPress
    *
    * Usually this should be called at `admin_init` hook.
    *
    * This function gets the initiated settings sections and fields. Then
    * registers them to WordPress and ready for use.
    */
    function admin_init() {

        // register settings sections
        foreach ( $this->settings_sections as $section ) {
            if ( false == get_option( $section['id'] ) ) {
                add_option( $section['id'] );
            }

            add_settings_section( 
                                    $section['id'], 
                                    $section['title'], 
                                    '__return_false', 
                                    $section['id'] 
            );
        }

        // register settings fields
        foreach ( $this->settings_fields as $section => $field ) {
            foreach ( $field as $option ) {

                $type = isset( $option['type'] ) ? $option['type'] : 'text';

                $args = array(
                    'id'      => $option['name'],
                    'desc'    => isset( $option['desc'] ) ? $option['desc'] : '',
                    'name'    => $option['label'],
                    'section' => $section,
                    'size'    => isset( $option['size'] ) ? $option['size'] : null,
                    'options' => isset( $option['options'] ) ? $option['options'] : '',
                    'std'     => isset( $option['default'] ) ? $option['default'] : ''
                );

                add_settings_field( 
                                    $section . '[' . $option['name'] . ']', 
                                    $option['label'], 
                                    array( $this, 'callback_' . $type ), 
                                    $section, 
                                    $section, 
                                    $args 
                );
            }
        }

        // creates our settings in the options table
        foreach ( $this->settings_sections as $section ) {
            register_setting( 
                            $section['id'], 
                            $section['id'],
                            array( $this, 'settings_validation_callback' ) 
            );
        }
    }


    /**
    * Callback functions to validate the different options
    *
    * @param array $settings_options_input unvalidated set of options that WordPress is sending to this function from the options page
    */
    function settings_validation_callback( $settings_options_input ) {

        // Create our array for storing the validated options  
        $settings_options_output = array();  
        // Loop through each of the incoming options  
        foreach( $settings_options_input as $key => $value ) {  
            // Check to see if the current option has a value. If so, process it.  
            if( isset( $settings_options_input[ $key ] ) ) {  
                // Strip all HTML and PHP tags (strip_tags) and properly handle quoted strings (stripslashes)
                $settings_options_output[ $key ] = strip_tags( stripslashes( $settings_options_input[ $key ] ) );        
            } // end if    
        } // end foreach  
      
        // Return the array processing any additional functions filtered by this action  
        return apply_filters( 'settings_validation_callback', $settings_options_output, $settings_options_input ); 
    }



    /*
    * 
    * Callback functions to display the different options:
    *
    */

    /**
    * Displays a text field for a settings field
    *
    * @param array $args settings field args
    */
    function callback_text( $args ) {

        $value = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
        $size = isset( $args['size'] ) && !is_null( $args['size'] ) ? $args['size'] : 'regular';

        $html = sprintf( '<input type="text" class="%1$s-text" id="%2$s[%3$s]" name="%2$s[%3$s]" value="%4$s"/>', $size, $args['section'], $args['id'], $value );
        $html .= sprintf( '<br /><span class="description"> %s </span>', $args['desc'] );

        echo $html;
    }

    /**
    * Displays a checkbox for a settings field
    *
    * @param array $args settings field args
    */
    function callback_checkbox( $args ) {

        $value = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );

        $html = sprintf( '<input type="checkbox" class="checkbox" id="%1$s[%2$s]" name="%1$s[%2$s]" value="1"%4$s />', $args['section'], $args['id'], $value, checked( $value, '1', false ) );
        $html .= sprintf( '&nbsp;&nbsp; <label for="%1$s[%2$s]" class="description"> %3$s </label>', $args['section'], $args['id'], $args['desc'] );

        echo $html;
    }

    /**
    * Displays a multicheckbox for a settings field
    *
    * @param array $args settings field args
    */
    function callback_multicheck( $args ) {

        $value = $this->get_option( $args['id'], $args['section'], $args['std'] );

        $html = '';
        foreach ( $args['options'] as $key => $label ) {
            $checked = isset( $value[$key] ) ? $value[$key] : '0';
            $html .= sprintf( '<input type="checkbox" class="checkbox" id="%1$s[%2$s][%3$s]" name="%1$s[%2$s][%3$s]" value="%3$s"%4$s />', $args['section'], $args['id'], $key, checked( $checked, $key, false ) );
            $html .= sprintf( '<label for="%1$s[%2$s][%4$s]"> %3$s </label><br>', $args['section'], $args['id'], $label, $key );
        }
        $html .= sprintf( '<span class="description"> %s</label>', $args['desc'] );

        echo $html;
    }

    /**
    * Displays a radio button for a settings field
    *
    * @param array $args settings field args
    */
    function callback_radio( $args ) {

        $value = $this->get_option( $args['id'], $args['section'], $args['std'] );

        $html = '';
        foreach ( $args['options'] as $key => $label ) {
            $html .= sprintf( '<input type="radio" class="radio" id="%1$s[%2$s][%3$s]" name="%1$s[%2$s]" value="%3$s"%4$s />', $args['section'], $args['id'], $key, checked( $value, $key, false ) );
            $html .= sprintf( '<label for="%1$s[%2$s][%4$s]"> %3$s </label><br>', $args['section'], $args['id'], $label, $key );
        }
        $html .= sprintf( '<span class="description"> %s</label>', $args['desc'] );

        echo $html;
    }

    /**
    * Displays a selectbox for a settings field
    *
    * @param array $args settings field args
    */
        function callback_select( $args ) {

            $value = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
            $size = isset( $args['size'] ) && !is_null( $args['size'] ) ? $args['size'] : 'regular';

            $html = sprintf( '<select class="%1$s" name="%2$s[%3$s]" id="%2$s[%3$s]">', $size, $args['section'], $args['id'] );
            foreach ( $args['options'] as $key => $label ) {
                $html .= sprintf( '<option value="%s"%s>%s </option>', $key, selected( $value, $key, false ), $label );
            }
            $html .= sprintf( '</select>' );
            $html .= sprintf( '<span class="description"> %s </span>', $args['desc'] );

            echo $html;
        }

    /**
    * Displays a textarea for a settings field
    *
    * @param array $args settings field args
    */
    function callback_textarea( $args ) {

        $value = esc_textarea( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
        $size = isset( $args['size'] ) && !is_null( $args['size'] ) ? $args['size'] : 'regular';

        $html = sprintf( '<textarea rows="5" cols="55" class="%1$s-text" id="%2$s[%3$s]" name="%2$s[%3$s]">%4$s</textarea>', $size, $args['section'], $args['id'], $value );
        $html .= sprintf( '<br><span class="description"> %s </span>', $args['desc'] );

        echo $html;
    }

    /**
    * Displays a description for a settings field
    *
    * @param array $args settings field args
    */
    function callback_html( $args ) {
        echo $args['desc'];
    }

    /**
    * Displays a rich text textarea for a settings field
    *
    * @param array $args settings field args
    */
    function callback_wysiwyg( $args ) {

        $value = wpautop( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
        $size = isset( $args['size'] ) && !is_null( $args['size'] ) ? $args['size'] : '500px';

        echo '<div style="width: ' . $size . ';">';

        wp_editor( $value, $args['section'] . '[' . $args['id'] . ']', array( 'teeny' => true, 'textarea_rows' => 10 ) );

        echo '</div>';

        echo sprintf( '<br><span class="description"> %s </span>', $args['desc'] );
    }

    /**
    * Displays an information to help the user
    *
    * @param array $args settings field args
    */
    function callback_info( $args ) {

        $html = sprintf( '<div class="katt-backend-info" > %s <span>&times;</span></div>', $args['desc'] );

        echo $html;
    }

    /**
    * Displays a media button to upload an image
    *
    * @param array $args settings field args
    */
    function callback_image( $args ) {

        $image = KATT_SETTINGS_CLASS_IMG . '/default-image.png';

        $value = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );

        $html = '
                <div class="katt-backend-media-upload katt-backend-field">
                <span class="katt-backend-media-upload-default-image" style="display:none">' . $image . '</span>';
                $value = ( !empty( $value ) ? $value : '' );
        if ( !empty( $value ) ) { $image = wp_get_attachment_image_src($value, 'medium'); $image = $image[0]; }
        $html .=  sprintf( '<input name="%1$s[%2$s]" id="%1$s[%2$s]" type="hidden" class="katt-backend-media-upload-image katt-settings" value="%3$s" />',$args['section'], $args['id'], $value );
        
        $html .= '
                <img src="' . $image . '" class="katt-backend-media-upload-preview-image" alt="thumbnail" /><br />
                <a class="katt-backend-media-upload-choose-image-button button" src="#" >Choose an image</a>
                <a class="katt-backend-media-upload-remove-image-button button" src="#" >Remove</a>
                <div class="katt-backend-description">' . $args['desc'] . '</div>
                </div>';  

        echo $html;
    }






    /**
    * Get the value of a settings field
    *
    * @param string $option settings field name
    * @param string $section the section name this field belongs to
    * @param string $default default text if it's not found
    * @return string
    */
    function get_option( $option, $section, $default = '' ) {

        $options = get_option( $section );

        if ( isset( $options[$option] ) ) {
            return $options[$option];
        }

        return $default;
    }

    /**
    * Show navigations as tab
    *
    * Shows all the settings section labels as tab
    */
    function display_navigation() {
        $html = '<h2 class="nav-tab-wrapper">';

        foreach ( $this->settings_sections as $tab ) {
            $html .= sprintf( '<a href="#%1$s" class="nav-tab" id="%1$s-tab">%2$s</a>', $tab['id'], $tab['title'] );
        }

        $html .= '</h2>';

        echo $html;
    }

    /**
    * Show the section settings forms
    *
    * This function displays every sections in a different form
    */
    function display_forms() {
    ?>
    <div class="metabox-holder">
    <div class="postbox">
    <?php foreach ( $this->settings_sections as $form ) { ?>
    <div id="<?php echo $form['id']; ?>" class="group">
    <form method="post" action="options.php">

    <?php settings_fields( $form['id'] ); ?>
    <?php do_settings_sections( $form['id'] ); ?>

    <div style="padding-left: 10px">
    <?php echo '<p class="submit"><input name="Submit" type="submit" class="button-primary" value="' . __( 'Save', 'katt' ) . '" /></p>'; ?>
    <?php //submit_button(); ?>
    </div>
    </form>
    </div>
    <?php } ?>
    </div>
    </div>
    <?php
            $this->script();
        }

    /**
    * Tabbable JavaScript codes
    *
    * This code uses localstorage for displaying active tabs
    */
    function script() {
    ?>
    <script>
    jQuery(document).ready(function($) {
    // Switches option sections
    $('.group').hide();
    var activetab = '';
    if (typeof(localStorage) != 'undefined' ) {
    activetab = localStorage.getItem("activetab");
    }
    if (activetab != '' && $(activetab).length ) {
    $(activetab).fadeIn();
    } else {
    $('.group:first').fadeIn();
    }
    $('.group .collapsed').each(function(){
    $(this).find('input:checked').parent().parent().parent().nextAll().each(
    function(){
    if ($(this).hasClass('last')) {
    $(this).removeClass('hidden');
    return false;
    }
    $(this).filter('.hidden').removeClass('hidden');
    });
    });

    if (activetab != '' && $(activetab + '-tab').length ) {
    $(activetab + '-tab').addClass('nav-tab-active');
    }
    else {
    $('.nav-tab-wrapper a:first').addClass('nav-tab-active');
    }
    $('.nav-tab-wrapper a').click(function(evt) {
    $('.nav-tab-wrapper a').removeClass('nav-tab-active');
    $(this).addClass('nav-tab-active').blur();
    var clicked_group = $(this).attr('href');
    if (typeof(localStorage) != 'undefined' ) {
    localStorage.setItem("activetab", $(this).attr('href'));
    }
    $('.group').hide();
    $(clicked_group).fadeIn();
    evt.preventDefault();
    });
    });
    </script>
    <?php
        }

    

} // End Class

