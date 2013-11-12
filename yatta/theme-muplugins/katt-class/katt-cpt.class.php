<?php

/**
 * Class KattCPT
 *
 * This class is used to create a Custom Post Type with Taxonomies and Metaboxes.
 * PHP 5.3+ requires! > cause we use use() function.
 *
 * This class come from this tutorial: 
 * http://wp.tutsplus.com/tutorials/creative-coding/custom-post-type-helper-class/
 * http://wp.tutsplus.com/tutorials/reusable-custom-meta-boxes-part-1-intro-and-basic-fields/
 *
 * @package Kattagami
 * @version 1.0.0
 * @author Gilles Vauvarin
 * @copyright Gilles Vauvarin (gillesvauvarin@gmail.com)
 * @link http://kattagami.com
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */


/* Define CONSTANTS */
define( 'KATT_CPT_CLASS_URL', content_url( '/themes/yatta/yatta/themes-muplugins/katt-class/' ) );
define( 'KATT_CPT_CLASS_IMG', KATT_CPT_CLASS_URL . 'img' );


class KattCPT   {  

    // Properties
    public $cpt_name;  
    public $cpt_args;  
    public $cpt_labels;  

    /**
     * Class constructor.
     *
     * @since 1.0.0
     */
    public function __construct( $name, $args = array(), $labels = array() ) {
        // Set the class's properties by arguments
        $this->cpt_name       = strtolower( str_replace( ' ', '_', $name ) ); // e.g Cartoon movie > cartoon_movie
        $this->cpt_args       = $args;
        $this->cpt_labels     = $labels;

        // Add action to register the post type, if the post type does not already exist
        if ( !post_type_exists( $this->cpt_name ) ) {
            add_action( 'init' , array( &$this, 'register_cpt' ) );
        }
            
        // Listen for the save post hook
        $this->save();
    }  


    /**
     * Method which registers the custom post type.
     *
     * @since 1.0.0
     */
    public function register_cpt() {
        // Capitilize the first letter of each words
        $name       = ucwords( str_replace( '_', ' ', $this->cpt_name ) ); // e.g cartoon_movie > Cartoon Movie
        // ... and make the name plural
        $plural     = $name . 's'; // e.g Cartoon Movie > Cartoon Movies
        // We set the default labels based on the custom post type name and plural. We overwrite them with the given labels.
        $labels     = array_merge(
            // Default
            array(
                'name'                  => _x( $plural, 'custom post type general name' ),
                'singular_name'         => _x( $name, 'custom post type singular name' ),
                'add_new'               => _x( 'Add New', strtolower( $name ) ),
                'add_new_item'          => __( 'Add New ' . $name ),
                'edit_item'             => __( 'Edit ' . $name ),
                'new_item'              => __( 'New ' . $name ),
                'all_items'             => __( 'All ' . $plural ),
                'view_item'             => __( 'View ' . $name ),
                'search_items'          => __( 'Search ' . $plural ),
                'not_found'             => __( 'No ' . strtolower( $plural ) . ' found'),
                'not_found_in_trash'    => __( 'No ' . strtolower( $plural ) . ' found in Trash'),
                'parent_item_colon'     => '',
                'menu_name'             => $plural
            ),
            // Given labels
            $this->cpt_labels
        );
        // Same principle as the labels. We set some defaults and overwrite them with the given arguments.
        $args = array_merge(
            // Default
            array(
                'label'                 => $plural,
                'labels'                => $labels,
                'public'                => true,
                'show_ui'               => true,
                'supports'              => array( 'title', 'editor' ),
                'show_in_nav_menus'     => true,
                '_builtin'              => false,
            ),
            // Given args
            $this->cpt_args
        );
        // Register the custom post type
        register_post_type( $this->cpt_name, $args );
    }
 

    /**
     * Method to attach the taxonomy to the custom post type.
     *
     * @since 1.0.0
     */
    public function add_taxonomy( $name, $args = array(), $labels = array() ) {
        if ( !empty( $name ) ) {         
            // We need to know the custom post type name, so the new taxonomy can be attached to it.
            $cpt_name = $this->cpt_name;

            // Taxonomy properties
            $taxonomy_name      = strtolower( str_replace( ' ', '_', $name ) );
            $taxonomy_args      = $args;
            $taxonomy_labels    = $labels;

            // If the taxonomy doesn’t exist, we register it.  
            // Create taxonomy and attach it to the object type (custom post type).
            if ( !taxonomy_exists( $taxonomy_name ) ) { 
            // Capitilize the words and make it plural
                $name       = ucwords( str_replace( '_', ' ', $name ) );
                $plural     = $name . 's';

                // Default labels, overwrite them with the given labels.
                $labels = array_merge(

                    // Default
                    array(
                        'name'                  => _x( $plural, 'taxonomy general name' ),
                        'singular_name'         => _x( $name, 'taxonomy singular name' ),
                        'search_items'          => __( 'Search ' . $plural ),
                        'all_items'             => __( 'All ' . $plural ),
                        'parent_item'           => __( 'Parent ' . $name ),
                        'parent_item_colon'     => __( 'Parent ' . $name . ':' ),
                        'edit_item'             => __( 'Edit ' . $name ), 
                        'update_item'           => __( 'Update ' . $name ),
                        'add_new_item'          => __( 'Add New ' . $name ),
                        'new_item_name'         => __( 'New ' . $name . ' Name' ),
                        'menu_name'             => __( $name ),
                    ),

                    // Given labels
                    $taxonomy_labels

                );

                // Default arguments, overwitten with the given arguments
                $args = array_merge(

                    // Default
                    array(
                        'label'                 => $plural,
                        'labels'                => $labels,
                        'public'                => true,
                        'show_ui'               => true,
                        'show_in_nav_menus'     => true,
                        '_builtin'              => false,
                    ),

                    // Given
                    $taxonomy_args

                );

                // Since we use different parameters each time, we are going to pass a nameless function (Note: this feature requires PHP 5.3+) and use the use() function. With the use() function we can pass variables to the nameless function.

                // Add the taxonomy to the post type
                add_action( 'init',
                                    function() use( $taxonomy_name, $cpt_name, $args ) {                       
                                        register_taxonomy( $taxonomy_name, $cpt_name, $args );
                                    }
                );


            } else { // The taxonomy already exists. We are going to attach the existing taxonomy to the object type (custom post type) 

                // When the taxonomy exist, we only attach it to our custom post type. 
                add_action( 'init',
                                    function() use( $taxonomy_name, $cpt_name ) {               
                                        register_taxonomy_for_object_type( $taxonomy_name, $cpt_name );
                                    }
                );
            }
        }
    }


     /**
     * Methode to attache meta boxes to the custom post type.
     *
     * @since 1.0.0
     */
    public function add_metabox( $title, $fields = array(), $context = 'normal', $priority = 'default' ) {
        if ( !empty( $title ) ) {       
            // We need to know the Post Type name again
            $cpt_name = $this->cpt_name;

            // Meta variables   
            $box_id         = str_replace( "'", '_', strtolower( str_replace( ' ', '_', $title ) ) ); // format = my_field
            $box_title      = ucwords( str_replace( '_', ' ', $title ) ); // format = My Field
            $box_page       = $cpt_name;
            $box_context    = $context;
            $box_priority   = $priority;

            // Make the fields global so we can access them in the save hook.
            global $custom_fields;
            $custom_fields[$title] = $fields;

            add_action( 
                'add_meta_boxes', 
                function() use( $box_id, $box_title, $box_page, $box_context, $box_priority, $fields ) {
                    add_meta_box(
                        $box_id, // This is a unique ID assigned to the meta box. It should have a unique prefix and be valid HTML.
                        $box_title, // The title of the meta box. Remember to internationalize this for translators.
                        function( $post, $data ) { // The callback function that displays the output of your meta box. 
                            // $post is an object containing the current post (as a $post object)
                            global $post;

                            // Pass cpt ID in a variable to script.js > Media upload
                            wp_localize_script(
                                                'script-back', 
                                                'katt_script_media_upload', 
                                                array(
                                                'cpt_id'        => $post->ID,
                                                'default_image' => KATT_CPT_CLASS_IMG . '/default-image.png', // The image must be in the theme folder
                                                )
                            );

                            // Nonce field for some validation.
                            wp_nonce_field( 'katt_cpt_nonce' . $this->cpt_name, 'katt_cpt_nonce' );

                            // Get all inputs from $data which comes from array( $fields ) > see the latest argument.
                            $custom_fields = $data['args'][0];

                            // Get the saved values. get_post_custom() returns a multidimensional array with all custom fields of a particular post or page.
                            $meta = get_post_custom( $post->ID ); // Arg: The post ID whose custom fields will be retrieved.

                            // Check the array and loop through it
                            $i = 0;
                            if ( !empty( $custom_fields ) ) {
                                echo '<table class="katt-backend-table">';
                                // Loop through $custom_fields
                                foreach ( $custom_fields as $key => $field ) {

                                    if ( !empty( $field['id'] ) ) {
                                    $field_id_name  = strtolower( str_replace( '-', '_', $field['id'] ) );
                                    }

                                    // Validate values with strip_tags() and stripslashes()
                                    ( !empty( $meta[$field_id_name][0] ) ) ? $meta[$field_id_name][0] = strip_tags( stripslashes( $meta[$field_id_name][0] ) ) : $meta[$field_id_name][0] = '';

                                    switch ( $field['type'] ) {

                                        // Text informations
                                        case 'info':
                                            $this->display_infos_field_metabox( $field['type'], 
                                                                                $field['id'], 
                                                                                $field['label'], 
                                                                                $field['desc'], 
                                                                                $field_id_name,
                                                                                '',
                                                                                $i );

                                            break;

                                        // Input text
                                        case 'text':
                                            $this->display_text_field_metabox(  $field['type'], 
                                                                                $field['id'], 
                                                                                $field['label'], 
                                                                                $field['desc'], 
                                                                                $field_id_name,
                                                                                '',
                                                                                $meta[$field_id_name][0], 
                                                                                $i );
                                            break;

                                        // Double Input text begin
                                        case 'double-text-begin':
                                            $this->display_double_text_begin_field_metabox(   $field['type'], 
                                                                                $field['id'], 
                                                                                $field['label'], 
                                                                                $field['desc'], 
                                                                                $field_id_name,
                                                                                '',
                                                                                $meta[$field_id_name][0], 
                                                                                $i );
                                            break;

                                        // Input mail
                                        case 'mail':
                                            $this->display_mail_field_metabox(  $field['type'], 
                                                                                $field['id'], 
                                                                                $field['label'], 
                                                                                $field['desc'], 
                                                                                $field_id_name,
                                                                                '',
                                                                                $meta[$field_id_name][0], 
                                                                                $i );
                                            break;

                                        // Input url
                                        case 'url':
                                            $this->display_url_field_metabox(  $field['type'], 
                                                                                $field['id'], 
                                                                                $field['label'], 
                                                                                $field['desc'], 
                                                                                $field_id_name,
                                                                                '',
                                                                                $meta[$field_id_name][0], 
                                                                                $i );
                                            break;

                                        // Double Input text end
                                        case 'double-text-end':
                                            $this->display_double_text_end_field_metabox(   $field['type'], 
                                                                                $field['id'], 
                                                                                $field['label'], 
                                                                                $field['desc'], 
                                                                                $field_id_name,
                                                                                '',
                                                                                $meta[$field_id_name][0], 
                                                                                $i );
                                            break;

                                        // Textarea
                                        case 'textarea':
                                            $this->display_textarea_field_metabox(  $field['type'], 
                                                                                    $field['id'], 
                                                                                    $field['label'], 
                                                                                    $field['desc'], 
                                                                                    $field_id_name,
                                                                                    '',
                                                                                    $meta[$field_id_name][0], 
                                                                                    $i );
                                            break;

                                        // Select
                                        case 'select':
                                            $this->display_select_field_metabox(    $field['type'], 
                                                                                    $field['id'], 
                                                                                    $field['label'],
                                                                                    $field['desc'],
                                                                                    $field_id_name,
                                                                                    '',  
                                                                                    $meta[$field_id_name][0],
                                                                                    $i, 
                                                                                    $field['options'] );
                                            break;

                                        // Media upload
                                        case 'image':
                                            $this->display_image_field_metabox( $field['type'], 
                                                                                $field['id'], 
                                                                                $field['label'],
                                                                                $field['desc'], 
                                                                                $field_id_name,
                                                                                '',
                                                                                $meta[$field_id_name][0],
                                                                                $i );
                                            break;

                                        // Select with a list of posts
                                        case 'post_list':
                                            $this->display_postlist_field_metabox(  $field['type'], 
                                                                                    $field['id'], 
                                                                                    $field['label'],
                                                                                    $field['desc'], 
                                                                                    $field_id_name, 
                                                                                    '',
                                                                                    $meta[$field_id_name][0], 
                                                                                    $i, 
                                                                                    $field['post_type'] );
                                            break;

                                        // Repeatable
                                        case 'repeatable':
                                           

                                            // If there are some data in repeatable's field        
                                            if ( !empty( $meta[$field_id_name][0] ) ) { 

                                              

                                                echo '
                                                    
                                                    <tr>
                                                    <td colspan="2">
                                                    <ul class="katt-backend-groups">
                                                    ';

                                                // Get repeatable value = array()
                                                $repeatable = get_post_meta( $post->ID, $field_id_name, false );

                                                foreach( $repeatable as $group ) {

                                                    $i = 0;
                                                    // Loop on groups
                                                    foreach( $group as $fields_in_group ) {
                                                        echo '
                                                            <li id="' . $field['id'] . '-repeatable" class="katt-backend-repeatable">
                                                            <table class="katt-backend-table-groups-container">
                                                            <tr>
                                                            <td>
                                                            <table class="katt-backend-table-groups">
                                                            ';

                                                        // Loop on fields present in a repeatable group
                                                        foreach( $field['fields'] as $repeatable_field ) {
                                                            
                                                            if ( !empty( $repeatable_field['id'] ) ) {
                                                            $field_id_subname = $field_id_name . '_' . strtolower( str_replace( '-', '_', $repeatable_field['id'] ) );
                                                            }

                                                            // Validate values with strip_tags() and stripslashes()
                                                            ( !empty( $fields_in_group[$field_id_subname] ) ) ? $fields_in_group[$field_id_subname] = strip_tags( stripslashes( $fields_in_group[$field_id_subname] ) ) : $fields_in_group[$field_id_subname] = '';

                                                            // Check the type to display the right field
                                                            switch ( $repeatable_field['type'] ) {


                                                            // Text informations
                                                            case 'info':
                                                                $this->display_infos_field_metabox( $field['type'], 
                                                                                                    $repeatable_field['id'], 
                                                                                                    $repeatable_field['label'], 
                                                                                                    $repeatable_field['desc'], 
                                                                                                    $field_id_name,
                                                                                                    $field_id_subname,
                                                                                                    $i );
                                                                break;

                                                            // Input text
                                                            case 'text':
                                                                $this->display_text_field_metabox(  $field['type'], // type = repeatable
                                                                                                    $repeatable_field['id'], 
                                                                                                    $repeatable_field['label'], 
                                                                                                    $repeatable_field['desc'], 
                                                                                                    $field_id_name,
                                                                                                    $field_id_subname,
                                                                                                    $fields_in_group[$field_id_subname], // value
                                                                                                    $i );                                                              
                                                                break;

                                                            // Input text begin
                                                            case 'double-text-begin':
                                                                $this->display_double_text_begin_field_metabox(  $field['type'], // type = repeatable
                                                                                                    $repeatable_field['id'], 
                                                                                                    $repeatable_field['label'], 
                                                                                                    $repeatable_field['desc'], 
                                                                                                    $field_id_name,
                                                                                                    $field_id_subname,
                                                                                                    $fields_in_group[$field_id_subname], // value
                                                                                                    $i );                                                              
                                                                break;

                                                            // Input text end
                                                            case 'double-text-end':
                                                                $this->display_double_text_end_field_metabox(  $field['type'], // type = repeatable
                                                                                                    $repeatable_field['id'], 
                                                                                                    $repeatable_field['label'], 
                                                                                                    $repeatable_field['desc'], 
                                                                                                    $field_id_name,
                                                                                                    $field_id_subname,
                                                                                                    $fields_in_group[$field_id_subname], // value
                                                                                                    $i );                                                              
                                                                break;


                                                            // Input mail
                                                            case 'mail':
                                                                $this->display_mail_field_metabox(  $field['type'], // type = repeatable
                                                                                                    $repeatable_field['id'], 
                                                                                                    $repeatable_field['label'], 
                                                                                                    $repeatable_field['desc'], 
                                                                                                    $field_id_name,
                                                                                                    $field_id_subname,
                                                                                                    $fields_in_group[$field_id_subname], // value
                                                                                                    $i );                                                              
                                                                break;


                                                            // Input url
                                                            case 'url':
                                                                $this->display_url_field_metabox(  $field['type'], // type = repeatable
                                                                                                    $repeatable_field['id'], 
                                                                                                    $repeatable_field['label'], 
                                                                                                    $repeatable_field['desc'], 
                                                                                                    $field_id_name,
                                                                                                    $field_id_subname,
                                                                                                    $fields_in_group[$field_id_subname], // value
                                                                                                    $i );                                                              
                                                                break;


                                                            // Textarea
                                                            case 'textarea':
                                                                $this->display_textarea_field_metabox(  $field['type'], 
                                                                                                        $repeatable_field['id'], 
                                                                                                        $repeatable_field['label'], 
                                                                                                        $repeatable_field['desc'],
                                                                                                        $field_id_name,
                                                                                                        $field_id_subname,
                                                                                                        $fields_in_group[$field_id_subname], 
                                                                                                        $i );                                                                
                                                                break;

                                                            // Select
                                                            case 'select':
                                                                $this->display_select_field_metabox(    $field['type'], 
                                                                                                        $repeatable_field['id'], 
                                                                                                        $repeatable_field['label'],
                                                                                                        $repeatable_field['desc'],
                                                                                                        $field_id_name,  
                                                                                                        $field_id_subname,
                                                                                                        $fields_in_group[$field_id_subname], 
                                                                                                        $i, 
                                                                                                        $repeatable_field['options'] );
                                                                break;

                                                            // Media upload
                                                            case 'image':
                                                                $this->display_image_field_metabox( $field['type'], 
                                                                                                    $repeatable_field['id'], 
                                                                                                    $repeatable_field['label'],
                                                                                                    $repeatable_field['desc'], 
                                                                                                    $field_id_name,  
                                                                                                    $field_id_subname,
                                                                                                    $fields_in_group[$field_id_subname],  
                                                                                                    $i );
                                                                break;

                                                            // Select with a list of posts
                                                            case 'post_list':
                                                                $this->display_postlist_field_metabox(  $field['type'], 
                                                                                                        $repeatable_field['id'], 
                                                                                                        $repeatable_field['label'],
                                                                                                        $repeatable_field['desc'],
                                                                                                        $field_id_name,
                                                                                                        $field_id_subname,
                                                                                                        $fields_in_group[$field_id_subname], 
                                                                                                        $i, 
                                                                                                        $repeatable_field['post_type'] );
                                                                break;
                                                            }

                                                        }
                                                        echo   '
                                                                </table>
                                                                </td>
                                                                <td>
                                                                <div class="katt-backend-group-handle sort hndle">Drag and Drop</div>
                                                                <div class="katt-backend-group-description">'.$field['desc'].'</div>
                                                                <div class="katt-backend-repeatable-remove-container">
                                                                <a class="katt-backend-repeatable-remove button" href="#">Remove</a>
                                                                </div>
                                                                </td>
                                                                </tr>
                                                                </table>
                                                                </li>'; 
                                                        $i ++; 
                                                    }
                                                    
                                                }    
                                                echo '</ul></td></tr>
                                                    <tr>
                                                    <td colspan="2">
                                                    <a class="katt-backend-repeatable-add button" href="#">Add a new ' . $field['label'] . '</a>
                                                    </td>
                                                    </tr>';
                                            } else {
                                                echo '
                                                    
                                                    <tr>
                                                    <td colspan="2">
                                                    <ul class="katt-backend-groups">
                                                    ';

                                                    $i = 0;

                                                        echo '
                                                            <li id="' . $field['id'] . '-repeatable" class="katt-backend-repeatable">
                                                            <table class="katt-backend-table-groups-container">
                                                            <tr>
                                                            <td>
                                                            <table class="katt-backend-table-groups">
                                                            ';

                                                        // Loop on fields present in a repeatable group
                                                        foreach( $field['fields'] as $repeatable_field ) {
                                                            
                                                            if ( !empty( $repeatable_field['id'] ) ) {
                                                            $field_id_subname = $field_id_name . '_' . strtolower( str_replace( '-', '_', $repeatable_field['id'] ) );
                                                            }

                                                            // Check the type to display the right field
                                                            switch ( $repeatable_field['type'] ) {


                                                            // Text informations
                                                            case 'info':
                                                                $this->display_infos_field_metabox( $field['type'], 
                                                                                                    $repeatable_field['id'], 
                                                                                                    $repeatable_field['label'], 
                                                                                                    $repeatable_field['desc'], 
                                                                                                    $field_id_name,
                                                                                                    $field_id_subname,
                                                                                                    $i );
                                                                break;

                                                            // Input text
                                                            case 'text':
                                                                $this->display_text_field_metabox(  $field['type'], // type = repeatable
                                                                                                    $repeatable_field['id'], 
                                                                                                    $repeatable_field['label'], 
                                                                                                    $repeatable_field['desc'], 
                                                                                                    $field_id_name,
                                                                                                    $field_id_subname,
                                                                                                    '', // value
                                                                                                    $i );                                                              
                                                                break;

                                                            // Input text begin
                                                            case 'double-text-begin':
                                                                $this->display_double_text_begin_field_metabox(  $field['type'], // type = repeatable
                                                                                                    $repeatable_field['id'], 
                                                                                                    $repeatable_field['label'], 
                                                                                                    $repeatable_field['desc'], 
                                                                                                    $field_id_name,
                                                                                                    $field_id_subname,
                                                                                                    '', // value
                                                                                                    $i );                                                              
                                                                break;

                                                            // Input text end
                                                            case 'double-text-end':
                                                                $this->display_double_text_end_field_metabox(  $field['type'], // type = repeatable
                                                                                                    $repeatable_field['id'], 
                                                                                                    $repeatable_field['label'], 
                                                                                                    $repeatable_field['desc'], 
                                                                                                    $field_id_name,
                                                                                                    $field_id_subname,
                                                                                                    '', // value
                                                                                                    $i );                                                              
                                                                break;

                                                            // Input mail
                                                            case 'mail':
                                                                $this->display_mail_field_metabox(  $field['type'], // type = repeatable
                                                                                                    $repeatable_field['id'], 
                                                                                                    $repeatable_field['label'], 
                                                                                                    $repeatable_field['desc'], 
                                                                                                    $field_id_name,
                                                                                                    $field_id_subname,
                                                                                                    '', // value
                                                                                                    $i );                                                              
                                                                break;


                                                            // Input url
                                                            case 'url':
                                                                $this->display_url_field_metabox(  $field['type'], // type = repeatable
                                                                                                    $repeatable_field['id'], 
                                                                                                    $repeatable_field['label'], 
                                                                                                    $repeatable_field['desc'], 
                                                                                                    $field_id_name,
                                                                                                    $field_id_subname,
                                                                                                    '', // value
                                                                                                    $i );                                                              
                                                                break;


                                                            // Textarea
                                                            case 'textarea':
                                                                $this->display_textarea_field_metabox(  $field['type'], 
                                                                                                        $repeatable_field['id'], 
                                                                                                        $repeatable_field['label'], 
                                                                                                        $repeatable_field['desc'],
                                                                                                        $field_id_name,
                                                                                                        $field_id_subname,
                                                                                                        '', 
                                                                                                        $i );                                                                
                                                                break;

                                                            // Select
                                                            case 'select':
                                                                $this->display_select_field_metabox(    $field['type'], 
                                                                                                        $repeatable_field['id'], 
                                                                                                        $repeatable_field['label'],
                                                                                                        $repeatable_field['desc'],
                                                                                                        $field_id_name,  
                                                                                                        $field_id_subname,
                                                                                                        '', 
                                                                                                        $i, 
                                                                                                        $repeatable_field['options'] );
                                                                break;

                                                            // Media upload
                                                            case 'image':
                                                                $this->display_image_field_metabox( $field['type'], 
                                                                                                    $repeatable_field['id'], 
                                                                                                    $repeatable_field['label'],
                                                                                                    $repeatable_field['desc'], 
                                                                                                    $field_id_name,  
                                                                                                    $field_id_subname,
                                                                                                    '',  
                                                                                                    $i, 
                                                                                                    $post->ID );
                                                                break;

                                                            // Select with a list of posts
                                                            case 'post_list':
                                                                $this->display_postlist_field_metabox(  $field['type'], 
                                                                                                        $repeatable_field['id'], 
                                                                                                        $repeatable_field['label'],
                                                                                                        $repeatable_field['desc'],
                                                                                                        $field_id_name,
                                                                                                        $field_id_subname,
                                                                                                        '', 
                                                                                                        $i, 
                                                                                                        $repeatable_field['post_type'] );
                                                                break;
                                                            }

                                                        }
                                                        echo   '
                                                                </table>
                                                                </td>
                                                                <td>
                                                                <div class="katt-backend-group-handle sort hndle">Drag and Drop</div>
                                                                <div class="katt-backend-group-description">'.$field['desc'].'</div>
                                                                <div class="katt-backend-repeatable-remove-container">
                                                                <a class="katt-backend-repeatable-remove button" href="#">Remove</a>
                                                                </div>
                                                                </td>
                                                                </tr>
                                                                </table>
                                                                </li>'; 
  
                                                echo '</ul></td></tr>
                                                    <tr>
                                                    <td colspan="2">
                                                    <a class="katt-backend-repeatable-add button" href="#">Add a new ' . $field['label'] . '</a>
                                                    </td>
                                                    </tr>';

                                            }
                                        break;
                                    }
                                }
                                echo '</table>';
                            }

                        },
                        $box_page, // The admin page to display the meta box on. This would be the name of the post type (post, page, or a custom post type). Here we use the custom post type name.
                        $box_context, // Where on the page the meta box should be shown. The available options are normal, advanced, and side.
                        $box_priority, // How high/low the meta box should be prioritized. The available options are default, core, high, and low.
                        array( $fields ) // An array of custom arguments you can pass to your $callback function as the second parameter.
                    );
                }
            );
        }
    }


    /**
     * Method to listen for when the custom post type being saved.
     *
     * @since 1.0.0
     */
    public function save() {
        // Need the post type name again
        $cpt_name = $this->cpt_name;

        // Save hook
        add_action( 'save_post',
                                function() use( $cpt_name ) {
                                    // Deny the wordpress autosave function
                                    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;

                                    // Check the form with Nonce
                                    if ( !wp_verify_nonce( isset( $_POST['katt_cpt_nonce'] ), $cpt_name ) ) return;

                                    global $post;

                                    if ( isset( $_POST ) && isset( $post->ID ) && get_post_type( $post->ID ) == $cpt_name ) {
                                        global $custom_fields;

                                        

                                        // Loop through each meta box
                                        foreach( $custom_fields as $title => $fields ) {
                                            // Loop through all fields
                                           
                                            foreach( $fields as $key => $field ) {

                                                $field_id_name  = strtolower( str_replace( '-', '_', $field['id'] ) );

                                                $options_value = '';

                                                if ( !empty( $_POST['custom_meta'][$field_id_name] ) ) {
                                                    $options_value = $_POST['custom_meta'][$field_id_name];
                                                }

                                                // Validate string options before to save it in the data base
                                                if ( is_string( $options_value )  || is_int( $options_value ) && !is_array( $options_value ) ) {
                                                    $options_value = strip_tags( stripslashes( $options_value ) );
                                                }

                                                // Validate array of options for repeatable data before to save it in the data base
                                               if ( is_array( $options_value ) ) {
                                                    foreach( $options_value as $key_repeatable => $value_repeatable ) {
                                                        if ( is_array( $value_repeatable ) ) {
                                                            $options_value[ $key_repeatable ] = $this->cpt_options_array_validation( $value_repeatable );
                                                        }
                                                    }
                                                }

                                                update_post_meta( 
                                                    $post->ID, // The ID of the post which contains the field you will edit.
                                                    $field_id_name, // The key of the custom field you will edit.
                                                    $options_value // The new value of the custom field. A passed array will be serialized into a string.   
                                                );
                                                 
                                            }

                                        }
                                    }
                                }
        );
    } 


    /**
    * Functions to validate an array of options
    *
    * @param array $settings_options_input unvalidated set of options that WordPress is sending to this function from the options page
    */
    function cpt_options_array_validation( $settings_options_input ) {

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
        return apply_filters( 'cpt_options_array_validation', $settings_options_output, $settings_options_input ); 
    }


    /**
     * Display Info field.
     *
     * @since 1.0.0
     */
    private function display_infos_field_metabox( $type, $id, $label, $desc, $name, $subname, $i ) {
        ( $type == 'repeatable' ) ? $custom_meta_name = 'custom_meta[' . $name . '][' . $i . '][' . $subname . ']' : $custom_meta_name = 'custom_meta[' . $name . ']';
        $desc = esc_attr( $desc );
        echo   '<tr class="katt-backend-info-link">
                <td><label for="' . $id . '">' . $label . '</label></td>
                <td>
                <div id="' . $id . '" class="katt-backend-info" >' . $desc . '<span>&times;</span></div>
                <input name="' . $custom_meta_name . '" id="' . $id . '" type="hidden" value="' . ( !empty( $desc ) ? $desc : '' ) . '" />
                </td>
                </tr>';
    }

    /**
     * Display Text field.
     *
     * @since 1.0.0
     */
    private function display_text_field_metabox( $type, $id, $label, $desc, $name, $subname, $value, $i ) {
        ( $type == 'repeatable' ) ? $custom_meta_name = 'custom_meta[' . $name . '][' . $i . '][' . $subname . ']' : $custom_meta_name = 'custom_meta[' . $name . ']';
        echo    '<tr>
                <td><label for="' . $id . '">' . $label . '</label></td>
                <td>
                <input type="text" class="katt-backend-field" name="' . $custom_meta_name . '"  id="' . $id . '" value="' . esc_attr( $value ) . '" /><br />
                <div class="katt-backend-description">' . $desc . '</div>
                </td>
                </tr>';
    }


    /**
     * Display Double Text field begin.
     *
     * @since 1.0.0
     */
    private function display_double_text_begin_field_metabox( $type, $id, $label, $desc, $name, $subname, $value, $i ) {
        ( $type == 'repeatable' ) ? $custom_meta_name = 'custom_meta[' . $name . '][' . $i . '][' . $subname . ']' : $custom_meta_name = 'custom_meta[' . $name . ']';
        echo    '<tr>
                <td><label for="' . $id . '">' . $label . '</label></td>
                <td>
                <span class="katt-backend-description">' . $desc . '</span>&nbsp;&nbsp;
                <input type="text" class="katt-backend-field katt-backend-field-small" name="' . $custom_meta_name . '"  id="' . $id . '" value="' . esc_attr( $value ) . '" />
                
                ';
    }

    /**
     * Display Double Text field.
     *
     * @since 1.0.0
     */
    private function display_double_text_end_field_metabox( $type, $id, $label, $desc, $name, $subname, $value, $i ) {
        ( $type == 'repeatable' ) ? $custom_meta_name = 'custom_meta[' . $name . '][' . $i . '][' . $subname . ']' : $custom_meta_name = 'custom_meta[' . $name . ']';
        echo    '
                <span class="katt-backend-description">' . $desc . '</span>&nbsp;&nbsp;
                <input type="text" class="katt-backend-field katt-backend-field-medium" name="' . $custom_meta_name . '"  id="' . $id . '" value="' . esc_attr( $value ) . '" /><br />
                </td>
                </tr>';
    }

    /**
     * Display Text field > validate email format
     *
     * @since 1.0.0
     */
    private function display_mail_field_metabox( $type, $id, $label, $desc, $name, $subname, $value, $i ) {
        ( $type == 'repeatable' ) ? $custom_meta_name = 'custom_meta[' . $name . '][' . $i . '][' . $subname . ']' : $custom_meta_name = 'custom_meta[' . $name . ']';
        if ( !empty( $value ) && !is_email( $value ) ) {
            echo    '<tr>
                <td><label for="' . $id . '">' . $label . '</label></td>
                <td>
                <input type="text" class="katt-backend-field" name="' . $custom_meta_name . '"  id="' . $id . '" value="' . $value . '" /><br />
                <span class="katt-backend-validation-error">BE CAREFUL "' . $value . '" is not a valid email adress</span>
                <div class="katt-backend-description">' . $desc . '</div>   
                
                </td>
                </tr>';

        } else {
            echo    '<tr>
                <td><label for="' . $id . '">' . $label . '</label></td>
                <td>
                <input type="text" class="katt-backend-field" name="' . $custom_meta_name . '"  id="' . $id . '" value="' . sanitize_email( $value ) . '" /><br />
                <div class="katt-backend-description">' . $desc . '</div>
                </td>
                </tr>';

        }
        
    }


    /**
     * Display Text field > validate url format
     *
     * @since 1.0.0
     */
    private function display_url_field_metabox( $type, $id, $label, $desc, $name, $subname, $value, $i ) {
        ( $type == 'repeatable' ) ? $custom_meta_name = 'custom_meta[' . $name . '][' . $i . '][' . $subname . ']' : $custom_meta_name = 'custom_meta[' . $name . ']';
        if ( !empty( $value ) &&  !filter_var( $value, FILTER_VALIDATE_URL ) ) {
            echo    '<tr>
                <td><label for="' . $id . '">' . $label . '</label></td>
                <td>
                <input type="text" class="katt-backend-field" name="' . $custom_meta_name . '"  id="' . $id . '" value="' . $value . '" /><br />
                <span class="katt-backend-validation-error">BE CAREFUL "' . $value . '" is not a valid website adress (URL)</span>
                <div class="katt-backend-description">' . $desc . '</div>   
                
                </td>
                </tr>';

        } else {
            $protocols = array( 'http', 'https' );
            echo    '<tr>
                <td><label for="' . $id . '">' . $label . '</label></td>
                <td>
                <input type="text" class="katt-backend-field" name="' . $custom_meta_name . '"  id="' . $id . '" value="' . esc_url( $value, $protocols ) . '" /><br />
                <div class="katt-backend-description">' . $desc . '</div>
                </td>
                </tr>';

        }
        
    }


    /**
     * Display Textarea field.
     *
     * @since 1.0.0
     */
    private function display_textarea_field_metabox( $type, $id, $label, $desc, $name, $subname, $value, $i ) {
        ( $type == 'repeatable' ) ? $custom_meta_name = 'custom_meta[' . $name . '][' . $i . '][' . $subname . ']' : $custom_meta_name = 'custom_meta[' . $name . ']';
        echo    '<tr>
                <td><label for="' . $id . '">' . $label . '</label></td>
                <td>
                <textarea name="' . $custom_meta_name . '" class="katt-backend-field" id="' . $id . '" cols="60" rows="4">' . esc_textarea( $value ) . '</textarea>
                <br />
                <div class="katt-backend-description">' . $desc . '</div>
                </td>
                </tr>';
    }

    /**
     * Display Select field.
     *
     * @since 1.0.0
     */
    private function display_select_field_metabox( $type, $id, $label, $desc, $name, $subname, $value, $i, $options = array() ) {
        ( $type == 'repeatable' ) ? $custom_meta_name = 'custom_meta[' . $name . '][' . $i . '][' . $subname . ']' : $custom_meta_name = 'custom_meta[' . $name . ']';
        echo    '<tr>
                <td><label for="' . $id . '">' . $label . '</label></td>
                <td>
                <select name="' . $custom_meta_name . '" class="katt-backend-field" id="' . $id . '">';
        // Tableau dans un tableau > deux éléments dont la clé est 'label' et 'value'
        /*foreach ( $options as $option ) {
            echo '<option', $value == $option['value'] ? ' selected="selected"' : '', ' value="' . esc_attr( $option['value'] ) . '">' . $option['label'] . '</option>';
        }*/
        foreach ( $options as $key => $option ) {
            echo '<option', $value == $key ? ' selected="selected"' : '', ' value="' . esc_attr( $key ) . '">' . $option . '</option>';
        }
        echo '  </select><br />
                <div class="katt-backend-description">' . $desc . '</div>
                </td>
                </tr>';    
    }

    /**
     * Display Image field.
     *
     * @since 1.0.0
     */
    private function display_image_field_metabox( $type, $id, $label, $desc, $name, $subname, $value, $i ) {

        $image = KATT_CPT_CLASS_IMG . '/default-image.png';
        $value = esc_attr( $value );
        ( $type == 'repeatable' ) ? $custom_meta_name = 'custom_meta[' . $name . '][' . $i . '][' . $subname . ']' : $custom_meta_name = 'custom_meta[' . $name . ']';
        echo '  <tr>
                <td><label for="' . $id . '">' . $label . '</label></td>
                <td>
                <div class="katt-backend-media-upload katt-backend-field">
                <span class="katt-backend-media-upload-default-image" style="display:none">' . $image . '</span>';
        if ( !empty( $value ) ) { $image = wp_get_attachment_image_src($value, 'medium'); $image = $image[0]; }
        echo    '<input name="' . $custom_meta_name . '" id="' . $id . '" type="hidden" class="katt-backend-media-upload-image katt-cpt-metabox" value="' . ( !empty( $value ) ? $value : '' ) . '" />
                <img src="' . $image . '" class="katt-backend-media-upload-preview-image" alt="thumbnail" /><br />
                <a class="katt-backend-media-upload-choose-image-button button" src="#" >Choose an image</a>
                <a class="katt-backend-media-upload-remove-image-button button" src="#" >Remove</a>
                <div class="katt-backend-description">' . $desc . '</div>
                </div>
                </td>
                </tr>';    
    }

    /**
     * Display Post list field.
     *
     * @since 1.0.0
     */
    private function display_postlist_field_metabox( $type, $id,  $label, $desc, $name, $subname, $value, $i, $cpt_name ) {
        switch ( $cpt_name ) {
            // CPT "Presentation"
            case 'presentation':
                $items = get_posts( array (
                'post_type'      => $cpt_name,
                'posts_per_page' => -1,
            ));
                break;
            default: 
                $items = get_posts( array (
                'post_type'      => $cpt_name,
                'posts_per_page' => -1,
                'orderby'        => 'title', 
                'order'          => 'ASC',
            ));
        }
        
        
        ( $type == 'repeatable' ) ? $custom_meta_name = 'custom_meta[' . $name . '][' . $i . '][' . $subname . ']' : $custom_meta_name = 'custom_meta[' . $name . ']';
            echo '  <tr>
                    <td><label for="' . $id . '">' . $label . '</label></td>
                    <td>
                    <select name="' . $custom_meta_name . '" class="katt-backend-field" id="' . $id . '">
                    <option value="">No ' . $cpt_name . ' selected</option>'; // Select One
                    if ( !empty( $items ) ) {
                        foreach( $items as $item ) {
                            switch ( $cpt_name ) {
                                // CPT "Presentation"
                                case 'presentation':
                                
                                    $katt_presentations_date = get_post_meta( $item->ID, 'katt_presentation_date', true );
                                    $katt_presentations_hour = get_post_meta( $item->ID, 'katt_presentation_hour', true );

                                    ( !empty( $katt_presentations_date ) ) ? $katt_presentations_date = $katt_presentations_date . ' - '  : $katt_presentations_date = '';
                                    ( !empty( $katt_presentations_hour ) ) ? $katt_presentations_hour = $katt_presentations_hour . ' - ' : $katt_presentations_hour = '';
                                    $option_display = $katt_presentations_date . $katt_presentations_hour . $item->post_title;
                                    break;
                                default: 
                                    $option_display = $item->post_title;
                            }
                            
                            echo '<option value="' . esc_attr( $item->ID ) . '"', ( !empty( $value ) && $value == $item->ID ) ? ' selected="selected"' : '','>'  . $option_display . '</option>';
                        } // end foreach
                    }
            echo '  </select>
                    <div class="katt-backend-description">' . $desc . '</div>
                    </td>
                    </tr>';    
    }




}  