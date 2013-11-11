<?php

/*
*
* Customize WordPress backend
*
*/

/**
 * Show the all options screen by default in the menu page
 * 
 *
 * @since 1.0.0
 */
function yatta_menu_page_show_all_metaboxes_by_default( $user_id = NULL ) {
    // These are the metakeys we will need to update
    $meta_key['hidden'] = 'metaboxhidden_nav-menus';

    // So this can be used without hooking into user_register
    if ( !$user_id )
        $user_id = get_current_user_id(); 

    // Set the default hiddens if it has not been set yet
    if ( get_user_meta( $user_id, $meta_key['hidden'], true) ) {
        $meta_value = array('');
        update_user_meta( $user_id, $meta_key['hidden'], $meta_value );
    }
}


/**
 * Remove the SMOF Options Framework from the menu (Used to change his position afterward)
 *
 * @since 1.0.0
 */
function yatta_remove_optionsframework_add_page() {
    remove_action( 'admin_menu', 'optionsframework_add_admin', 10 );
}


/**
 * Rename in the Apperance menu "Themes Options" to "Templates Layout" and "Page Builder" to "Blocks Layout"
 *
 * @since 1.0.0
 */
function yatta_edit_appearance_admin_menus() {   
    global $submenu; 
    /*
    echo '<pre>';
    var_dump ( $submenu['themes.php'] );
    echo '</pre>';
    */

    $submenu['themes.php'][11][0] = 'Templates Layout';  
    //$submenu['themes.php'][7][3] = '';  
    //$submenu['themes.php'][8][0] = 'Blocks Layout';   
    //$submenu['themes.php'][8][3] = '';      
}  








/**
 * Enable "styles" select in TinyMCE
 *
 * @since 1.0.0
 */
function yatta_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}



/**
 * Customize the "styles" select in TinyMCE
 *
 * @since 1.0.0
 */
function yatta_tiny_mce_before_init( $settings ) {
    $settings[ 'theme_advanced_blockformats' ] = 'p, blockquote';

    // From http://tinymce.moxiecode.com/examples/example_24.php
    $style_formats = array(

        array('title' => 'Header 2', 'block' => 'h2', 'classes' => 'h2'),
        array('title' => 'Header 3', 'block' => 'h3', 'classes' => 'h3'),
        array('title' => 'Header 4', 'block' => 'h4', 'classes' => 'h4'),

    );
    // Before 3.1 you needed a special trick to send this array to the configuration.
    // See this post history for previous versions.
    $settings[ 'style_formats' ] = json_encode( $style_formats );

    return $settings;
}




/**
 * Change "Posts" label to "News" in the admin menu
 * 
 *
 * @since 1.0.0
 */
function yatta_edit_admin_menus() {  
  global $menu;  
  // Change Posts to News 
  $menu[5][0] = 'News'; 
}



/**
 * Remove some metabox from Appearance > Menu:
 * - Theme Location
 * - Categories
 *
 * @since 1.0.0
 */
function yatta_remove_metabox_from_menu_page( $columns ) {
  remove_meta_box( 'nav-menu-theme-locations', 'nav-menus', 'side' );
  remove_meta_box( 'add-category', 'nav-menus', 'side' );
  remove_meta_box( 'add-post', 'nav-menus', 'side' );
  remove_meta_box( 'add-post_tag', 'nav-menus', 'side' );
  remove_meta_box( 'add-level', 'nav-menus', 'side' );
  return $columns;
}



/**
 * Remove some sub menu item from Appearance menu:
 * - Widgets
 * - Editor
 *
 * @since 1.0.0
 */
function yatta_remove_menus_from_backend() {
  remove_submenu_page( 'themes.php', 'widgets.php' );
  remove_submenu_page( 'themes.php', 'theme-editor.php' );
  remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
  remove_menu_page( 'edit-comments.php' );
  if ( ! is_admin() ) {
    remove_menu_page( 'options-general.php' );
    remove_menu_page( 'tools.php' );
    remove_menu_page( 'upload.php' );
  }
}






/**
 * Change the footer message
 *
 * @since 1.0.0
 */
function yatta_custom_footer_text() {
  echo '';
}





/**
 * Remove the editor field from the pages
 *
 *
 * @since 1.0.0
 */
function yatta_page_hide_editor() {
  remove_post_type_support('page', 'editor');
}






/**
 * Customize the Dashboard
 * Remove the default widgets
 * For the Network Admin dashboard use the hook 'wp_network_dashboard_setup'
 *
 * @since 1.0.0
 */
function yatta_remove_dashboard_widgets() {
  // Main column
  remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); // Right Now (pointillées)
  remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' ); // Recent comments
  remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' ); // Incoming links
  remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' ); // Plugins
  // Side Column
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // Quick press
  remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' ); // Recent drafts
  remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); // WordPress blog
  remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' ); // Other WordPress news (pointillées)
} 


/**
 * Customize the Dashboard
 * Remove the Welcome Dashboard widget
 *
 * @since 1.0.0
 */
function yatta_remove_dashboard_widget_welcome() {
    remove_action('welcome_panel', 'wp_welcome_panel');
    $user_id = get_current_user_id();
    if (0 !== get_user_meta( $user_id, 'show_welcome_panel', true ) ) {
        update_user_meta( $user_id, 'show_welcome_panel', 0 );
    }
}


/**
 * Customize the Dashboard
 * Add a custom widget > test
 *
 * @since 1.0.0
 */
add_action( 'wp_dashboard_setup', 'yatta_add_dashboard_widget_test' );
function yatta_add_dashboard_widget_test() {
    wp_add_dashboard_widget(
        'yatta-dashboard-widget-test', // Id's widget
        'Welcome', // Name your widget will display in its heading. 
        'yatta_dashboard_widget_test_display', // The name of a function you create that will display the actual contents of your widget.
        $control_callback = null // The name of a function you create that will handle submission of widget options forms, and will also display the form elements. 
    );
}

function yatta_dashboard_widget_test_display() {
    echo 'Kattagami, a turnkey website to promote your conference.';
}





/**
 * Remove standard image sizes so that these sizes are not
 * created during the Media Upload process
 *
 * Hooked to intermediate_image_sizes_advanced filter
 * See wp_generate_attachment_metadata( $attachment_id, $file ) in wp-admin/includes/image.php
 *
 * @param $sizes, array of default and added image sizes
 * @return $sizes, modified array of image sizes
 * @since 1.0.0
 */
function yatta_remove_default_image_sizes( $sizes) {
  unset( $sizes['thumbnail'] );
  unset( $sizes['medium'] );
  unset( $sizes['large'] );
  return $sizes;
}


/**
 * Deregister default AQ Page Builder styles
 * 
 *
 * @since 1.0.0
 */
function yatta_tweak_aqua_view_enqueue() {
  // Make it sure if class exist first
  if ( class_exists( 'AQ_Page_Builder' ) ) {
      // Deregister default AQ Page Builder styles
      wp_dequeue_style( 'aqpb-view-css' );
  }
}


/**
 * Deregister default SMOF Options Theme styles
 * 
 *
 * @since 1.0.0
 */
function yatta_tweak_smof_view_enqueue() {
  // Make it sure if class exist first
  if ( class_exists( 'Options_Machine' ) ) {
      // Deregister default admin SMOF styles
      wp_dequeue_style( 'admin-style' );
  }
}


/**
 * Unregister AQ Page Builder default blocks
 * 
 *
 * @since 1.0.0
 */
function yatta_apb_unregister_block() {
  aq_unregister_block('AQ_Widgets_Block');
  aq_unregister_block('AQ_Column_Block');
  aq_unregister_block('AQ_Text_Block');
}



 /**
 * Register generic blocks - Aqua Page Builder
 *
 */
function yatta_apb_block_generic() {
  aq_register_block('AQ_image_Block');
  aq_register_block('AQ_places_Block');
  aq_register_block('AQ_news_Block');
  aq_register_block('AQ_testimonials_Block');
  aq_register_block('AQ_map_Block');
  aq_register_block('AQ_thelists_Block');
  aq_register_block('AQ_button_Block');
  aq_register_block('AQ_yatta_text_Block');
  aq_register_block('AQ_yatta_icon_text_Block');
}


 /**
 * Disable AutoSave (for WP > 3.0 )
 *
 */
function yatta_disable_auto_save(){
  wp_deregister_script( 'autosave' );
}


/**
 * Disable posts révisions
 *
 */
function yatta_disable_revisions() {
  remove_post_type_support( 'post', 'revisions' );
}


/**
 * Customize admin bar
 *
 */
function yatta_customize_admin_bar() {
    global $wp_admin_bar;
    // Remove the WordPress logo
    $wp_admin_bar->remove_menu('wp-logo');
    // Remove comments
    $wp_admin_bar->remove_node('comments');
    // Remove my-sites
    $wp_admin_bar->remove_node('my-sites');
    //Remove new-content
    $wp_admin_bar->remove_node('new-content');
    // Remove search
    $wp_admin_bar->remove_node('search');
}


/**
 * Customize the logo on the login page
 *
 */
function Katt_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_bloginfo( 'template_directory' ) ?>/images/login-logo.png);
            padding-bottom: 30px;
        }
    </style>
<?php }


/**
 * Customize the link on the logo on the login page
 *
 */
function yatta_login_logo_url() {
    return get_bloginfo( 'url' );
}


/**
 * Hide some plugins from the list of plugins displayed on the plugins page
 * Scebo = ticketing support plugin
 *
 */
function yatta_hide_plugins_from_plugins_page() {
    global $wp_list_table;
    $hidearr = array( 
      'simple-page-ordering/simple-page-ordering.php',
      'wpms-site-maintenance-mode/wpms-site-maintenance-mode.php',
      );
    $hidearr = apply_filters( 'yatta_hide_plugins_from_plugins_page', $hidearr, $hidearr );
    $myplugins = $wp_list_table->items;
    foreach ( $myplugins as $key => $val ) {
        if ( in_array( $key, $hidearr ) ) {
            unset( $wp_list_table->items[$key] );
        }
    }
}


/*
 * Remove column in page list
 */
function yatta_remove_page_columns( $defaults ) {
    unset( $defaults[ 'author' ] );
    unset( $defaults[ 'comments' ] );
    return $defaults;
}


/**
 * Remove some columns in post admin page
 * 1
 *
 */
function yatta_remove_post_columns( $defaults ) {
    unset( $defaults[ 'categories' ] );
    unset( $defaults[ 'tags' ] );
    unset( $defaults[ 'comments' ] );
    return $defaults;
}

/**
 * Remove some columns in post admin page
 * 2
 *
 */
function yatta_remove_post_columns_init() {
  add_filter( 'manage_posts_columns' , 'yatta_remove_post_columns' );
}


/**
 * Remove wp version param from any enqueued scripts
 * 
 *
 */
function yatta_remove_wp_version_front_css_js( $src ) {
    if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}







 
