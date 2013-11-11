<?php
/**
 * Set the Custom Post Type for Yatta theme
 *
 * Depend on /katt-class/katt-cpt.class.php
 *
 *
 * @package WordPress
 * @subpackage yatta
 * @since 1.0.0
 */


/* Generate some static content zones */
$katt_cpt = new KattCPT( 'Zone' , array(
                                            'show_in_nav_menus' => false,
                                            'hierarchical'      => true,
                                            )
);