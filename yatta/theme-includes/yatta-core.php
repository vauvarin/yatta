<?php
/*
*
* Core functions used in functions.php
*
*/

// --------------------------------------------------------------------- Admin menu customization



// --------------------------------------------------------------------- Title, Favicon, RSS

/**
 * Display the <title> markup.
 *
 * @since 1.0.0
 */
function yatta_head_title_markup() {
    $yatta_wp_title = wp_title( '|', false, 'right' );
    $title_output = '';
    $title_output .= '<title>';
  /*
   * Print the <title> tag based on what is being viewed.
   */
  global $page, $paged;

  if ( strpos( $yatta_wp_title, 'Page not found' ) === false ) {
    $title_output .= $yatta_wp_title;
  } 


  // Add the blog name.
  $title_output .= get_bloginfo( 'name' );

  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) )
    $title_output .= " | $site_description";

  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 )
    $title_output .= ' | ' . sprintf( __( 'Page %s', 'yatta' ), max( $paged, $page ) );

    $title_output .= '</title>';
    $title_output .= "\n\t";

echo $title_output;
}







/**
 * Set your own favicon in the Theme options.
 *
 * @since 1.0.0
 */
function yatta_head_favicon() {

    $link_favicon = '';
    if ( false ) {
        // PNG favicon 
        if ( of_get_option('faviconPNG' , 0 ) && !of_get_option('faviconICO' , 0 ) )
            $link_favicon  = '<link rel="icon" type="image/png" href="' . of_get_option('faviconPNG' , 0 ) . '">';
            $link_favicon .= "\n";

        // ICO favicon (ie) 
        if ( of_get_option('faviconICO' , 0 ) && !of_get_option('faviconPNG' , 0 ) )
            $link_favicon  = '<link rel="shortcut icon" type="image/x-icon" href="' . of_get_option('faviconICO') . '">';
            $link_favicon .= "\n";

        // Default PNG favicon 
        if ( !of_get_option('faviconICO' , 0 ) && !of_get_option('faviconPNG' , 0 ) )
            $link_favicon  = '<link rel="icon" type="image/png" href="' . get_template_directory_uri() . '/images/favicon.png" />';
            $link_favicon .= "\n";
    }
    else {
        $link_favicon  = '<link href="data:image/x-icon;base64,data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAbklEQVQ4jaWTUQ7AIAhDZdn9r9x9LCYM22oGiV/QR0ENjIHRiMtmgff8AmShgXAAEwjILdEzImz660B1zrsoNW0He0DuSGB8iayrcKKvMQvMGLG8REALSG4FzMKdKwuoIDOC/wsH0f4LfIkuyjgP1WkwCmdtKSwAAAAASUVORK5CYII=" rel="icon" type="image/x-icon" />';
        $link_favicon .= "\n";
    }

    echo $link_favicon;
}


/**
 * RSS & Pingbacks
 *
 * @since 1.0.0
 */
function yatta_head_rss() {
    /*
    $link_rss = '';
    $rssURL = '';
    $rssURL = of_get_option('rssUrl' , 0);
    (!empty( $rssURL )) ? $rssURL = of_get_option('rssUrl') : $rssURL = get_bloginfo( 'rss2_url' );
    //RSS & Pingbacks
    $link_rss  = '<link rel="alternate" type="application/rss+xml" title="' . get_bloginfo( 'name' ) . ' RSS Feed" href="' . $rssURL . '" />';
    $link_rss .= "\n";
    $link_rss .= '<link rel="pingback" href="' . get_bloginfo( 'pingback_url' ) . '" />';
    $link_rss .= "\n";

echo $link_rss;
*/
}



// --------------------------------------------------------------------- Enqueue CSS, JS


/**
 * Enqueueing front-end stylesheets in the header ("wp_enqueue_scripts" hook).
 *
 * @since 1.0.0
 */
function yatta_head_css() {
    if ( !is_admin() ) {
        /* Class instantiation */
        $yatta_helper = new KattHelper;
        // stylesheets/style-large.css (tablets and desktop styles).
        wp_register_style( 'style-css', PARENT_THEME_URI . '/css/style.css' );
        wp_enqueue_style('style-css');
        unset( $yatta_helper );
        // Don't load stylesheets/style-large.css for IE mobile.
        /*
        wp_register_style('ie-css', PARENT_THEME_URI . '/style-large.css');
        wp_enqueue_style('ie-css');
        global $wp_styles;
        $wp_styles->add_data( 'ie-css', 'conditional', '!IEMobile' );
        */
    }
}


/**
 * Enqueueing front-end javascripts (Modernizr) in the header ("wp_enqueue_scripts" hook).
 *
 * @since 1.0.0
 */
function yatta_head_js() {
    if ( !is_admin() ) {
        wp_register_script('modernizr', YATTA_JAVASCRIPTS . '/library/modernizr-2.6.2.min.js');
        wp_enqueue_script('modernizr');
        wp_register_script('leaflet', YATTA_JAVASCRIPTS . '/library/leaflet-0.5.1.min.js');

    }
}


/**
 * Enqueueing other front-end javascripts in the footer ("wp_footer" hook).
 *
 * @since 1.0.0
 */
function yatta_foot_js() {
    if ( !is_admin() ) {
        if ( is_page( 'price' ) || is_page( 'pricing' ) ) {
          wp_register_script('price_slide', YATTA_JAVASCRIPTS . '/library/jquery-ui-1.10.2.custom.min.js', array('jquery'), 1.0 , true);
          wp_enqueue_script('price_slide');
        }
        wp_register_script('plugins', YATTA_JAVASCRIPTS . '/plugins.js', array('jquery'), 1.0 , true);
        wp_enqueue_script('plugins');
        wp_register_script('script', YATTA_JAVASCRIPTS . '/script.js', array('jquery'), 1.0 , true);
        wp_enqueue_script('script');
        wp_localize_script(
                'script',
                'ThemeJSPath',
                array(
                    'theme_js_path'  => YATTA_JAVASCRIPTS ,
                    )
            );
    }
}


// --------------------------------------------------------------------- Menu

/**
 * Register menu and set the home page
 *
 * @since 1.0.0
 */
function yatta_register_primarymenu() {

  // Register Custom Menus
  register_nav_menu( 'primary', _x( 'Primary', 'Main navigation menu', 'yatta' ) );

}













