<?php
/**
 * Theme's function file.
 *
 * The functions.php file is used to enable Theme Features such as Sidebars, Navigation Menus, Post Thumbnails,
 * Post Formats, Custom Headers, Custom Backgrounds ...
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation. You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * General Public Licence for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package yatta
 * @subpackage Functions
 * @version 1.0.0
 * @since 1.0.0
 * @author Gilles Vauvarin
 * @copyright Yatta WordPress theme, Copyright (c) 2012, Gilles Vauvarin
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* ----------------------------------------------------------------------------------------------------------------------
*
*                       ////////////////      YATTA PARENT THEME      ////////////////
*
------------------------------------------------------------------------------------------------------------------------- */

require_once( trailingslashit( get_template_directory() ) . 'yatta/theme-muplugins/00_katt-singleton-plugin.class.php' );
require_once( trailingslashit( get_template_directory() ) . 'yatta/theme-muplugins/01_katt-helper.class.php' );



/* Load the Yatta Class. */
require_once( trailingslashit( get_template_directory() ) . 'yatta/yatta.class.php' );


/* The "after_setup_theme" WordPress hook is fired once both the parent and child themes functions files are loaded. */
add_action( 'after_setup_theme' , 'yatta_theme_setup' , 10 );

/**
 * Theme setup function.
 *
 * "after_setup_theme" WordPress hook is fired once both the parent and child themes
 * functions files are loaded. (Priority 10 in the parent theme, 11 in the child theme).
 *
 * @since 1.0.0
 */
function yatta_theme_setup() {


    /* Load the stylesheets in the header. */
    add_action('wp_enqueue_scripts','yatta_head_css', 7);
    /* Load the Modernizr script in the header. */
    add_action('wp_enqueue_scripts','yatta_head_js', 9);
    /* Load other javascripts in the footer. */
    add_action('wp_footer','yatta_foot_js', 10);


    /* Load the <title> markup in the header. */
    add_action('yatta_head','yatta_head_title_markup', 7);
    /* Load the <link type="image/x-icon"> markup in the header. */
    add_action('yatta_head','yatta_head_favicon', 8);
    /* Load the <link type="application/rss+xml"> markup in the header. */
    add_action('yatta_head','yatta_head_rss', 9);

      

    /* Enable menus. */
    add_theme_support( 'yatta-menus', array( 'primary', 'secondary', 'subsidiary' ) );
    /* Register Custom Menus, see: yatta_register_primarymenu() > yatta-core.php */
    add_action( 'init', 'yatta_register_primarymenu', 10 );


   
    /* Enable post and comment RSS feed links to head. */
    add_theme_support( 'automatic-feed-links' );
    /* This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images. */
    add_theme_support( 'post-thumbnails' );
    /* Needed by Simple Page Ordering plugin */
    add_post_type_support( 'post', 'page-attributes' );
    /* This theme styles the visual editor with editor-style.css to match the theme style. */
    add_editor_style();



    /* CUSTOM ADMIN */

    /* Remove sub-menu items from the Appearance menu */
    add_action( 'admin_menu', 'yatta_remove_menus_from_backend', 999 );

    /* Remove some default blocks from Aqua Page Builder */
    yatta_aqpb_unregister_block();
    /* Load AQPB blocks. */
    yatta_aqpb_block_generic();
    /* Deregister default AQ Page Builder styles and scripts */
    add_action( 'init', 'yatta_tweak_aqpb_view_enqueue' );
    add_action( 'admin_print_styles' , 'yatta_tweak_aqpb_css_enqueue' , 10 );
    add_action( 'admin_print_styles' , 'yatta_tweak_aqpb_js_enqueue' , 10 );
    add_action( 'init' , 'yatta_tweak_aqpb_jsview_enqueue' , 10 );
    /* Register default AQ Page Builder styles and scripts for an "in theme" integration */
    add_action( 'admin_enqueue_scripts' , 'yatta_aqpb_css_enqueue' , 10 );
    add_action( 'admin_enqueue_scripts' , 'yatta_aqpb_js_enqueue' , 10 );
    add_action( 'init' , 'yatta_aqpb_jsview_enqueue' , 10 );
    
    /* Deregister default SMOF styles */
    add_action( 'admin_print_styles', 'yatta_tweak_smof_view_enqueue', 10 );

    /* Change "Posts" label to "News" in the admin menu if the News plugin is activated */
    add_action( 'admin_menu', 'yatta_edit_admin_menus', 999 );
    

    /* Remove unwanted WordPress header elements. */
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'noindex',1);
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'feed_links_extra',3 );

    /* Change the position of SMOF in the admin menu */
    add_action( 'init', 'yatta_remove_optionsframework_add_page', 11 );
    add_action( 'admin_menu', 'optionsframework_add_admin', 9 );

    /* Rename in the Apperance menu "Themes Options" to "Templates Layout" and "Page Builder" to "Blocks Layout" */
    add_action( 'admin_menu', 'yatta_edit_appearance_admin_menus', 10 ); 


   

} /* END yatta_theme_setup(). */

?>