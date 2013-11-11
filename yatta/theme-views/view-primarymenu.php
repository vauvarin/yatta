<?php


/* The primarymenu first level is hooked to "yatta_header_primarymenu_first_level" with priority "10" by default */
//add_action('yatta_header_primarymenu_first_level' , 'yatta_get_view_primarymenu_first_level' , 10);
/* The primarymenu second level (sub-menu) is hooked to "yatta_sidebar_primarymenu_second_level" with priority "10" by default */
//add_action('yatta_sidebar_primarymenu_second_level' , 'yatta_get_view_primarymenu_second_level' , 10);


/**
 * Display the first level of the primarymenu.
 *
 * @since 1.0.0
 * @param array $args Arguments for how to load and display the primarymenu .
 * @return string|array The HTML code to display the primarymenu . | dates & location attributes in an array.
 */
function yatta_get_view_primarymenu_first_level( $args = array() ) {



  /* Create an empty variable for the primarymenu. */
  $primarymenu = '';

  /* Set the default arguments. */
  $defaults = array(
    'before'        => '',
    'after'         => '',
    'navigation_id' => 'id="menu-primary"',
    'anchor_class'  => 'class="menu-anchor"',
    'label_class'   => 'class="menu-label"',
    'echo'          => true,
  );

  /* Allow plugins/themes to filter the arguments. */
  $args = apply_filters( 'yatta_view_primarymenu_first_level_args', $args );

  /* Merge the input arguments and the defaults. */
  $args = wp_parse_args( $args, $defaults );

  if ( has_nav_menu( 'primary' ) ) {

    if ( !empty( $args['before'] ) && !empty( $args['after'] ) ) {
      /* Open the primary menu <div> container. */
      $primarymenu .= $args['before'];
    }

    $args_menu = array (
        'order'                  => 'ASC',
        'orderby'                => 'menu_order',
        'post_type'              => 'nav_menu_item',
        'post_status'            => 'publish',
        'output'                 => ARRAY_A,
        'output_key'             => 'menu_order',
        'nopaging'               => true,
        'update_post_term_cache' => false
      );

    $menu_items = wp_get_nav_menu_items( 'primary', $args_menu );

    if (!empty($menu_items)) {
      $primarymenu .= "<nav " . $args['navigation_id'] . ">";
      $primarymenu .= "<span class='yatta-menu-anchor'>";
      $primarymenu .= "<a href='#menu-primary'><i class='yatta-icon-menu-menu-top icon-menu'></i></a>";
      $primarymenu .= "<a href='#close'><i class='yatta-icon-close-menu-top icon-close'></i></a>";
      $primarymenu .= "</span>";



      $defaults = array(
          'theme_location'  => '',
          'menu'            => 'primary',
          'container'       => 0,
          'container_class' => '',
          'container_id'    => '',
          'menu_class'      => '',
          'menu_id'         => '',
          'echo'            => 0,
          'fallback_cb'     => 0,
          'before'          => '',
          'after'           => '',
          'link_before'     => '',
          'link_after'      => '',
          'items_wrap'      => '<ul>%3$s</ul>',
          'depth'           => 2,
          'walker'          => '',
      );

      $primarymenu .= wp_nav_menu( $defaults );

      $primarymenu .= "</nav>";
    } // End if (!empty($menu_items))

    if ( !empty( $args['before'] ) && !empty( $args['after'] ) ) {
      /* Open the primary menu <div> container. */
      $primarymenu .= $args['after'];
    }


  } 

  /* Allow developers to filter the HTML primarymenu. */
  $primarymenu = apply_filters( 'yatta_view_primarymenu_first_level_output', $primarymenu, $args );

  /* If $echo is setted to true, display $primarymenu. */
  if ( $args['echo'] )
    echo $primarymenu;

  /* Else return the $primarymenu. */
  else
    return $primarymenu;

  /* Hook */
  yatta_view_primarymenu_first_level_after();

}



/**
 * Display the second level (sub-menu) of the primarymenu.
 *
 * @since 1.0.0
 * @param array $args Arguments for how to load and display the primarymenu .
 * @return string|array The HTML code to display the primarymenu . | dates & location attributes in an array.
 */
function yatta_get_view_primarymenu_second_level( $args = array() ) {

  /* Hook */
  yatta_view_primarymenu_second_level_before();

  /* Create an empty variable for the primarymenu. */
  $primarymenu = '';

  /* Set the default arguments. */
  $defaults = array(
    'before'        => '',
    'after'         => '',
    'navigation_id' => 'id="menu-primary"',
    'anchor_class'  => 'class="menu-anchor"',
    'label_class'   => 'class="menu-label"',
    'echo'          => true,
  );

  /* Allow plugins/themes to filter the arguments. */
  $args = apply_filters( 'yatta_view_primarymenu_second_level_args', $args );

  /* Merge the input arguments and the defaults. */
  $args = wp_parse_args( $args, $defaults );

  if ( has_nav_menu( 'primary' ) ) {

    $primarymenu = "\n";

    if ( !empty( $args['before'] ) && !empty( $args['after'] ) ) {
      /* Open the primary menu <div> container. */
      $primarymenu .= "\n";
      $primarymenu .= $args['before'];
      $primarymenu .= "\n";
    }

    $args_menu = array (
        'order'                  => 'ASC',
        'orderby'                => 'menu_order',
        'post_type'              => 'nav_menu_item',
        'post_status'            => 'publish',
        'output'                 => ARRAY_A,
        'output_key'             => 'menu_order',
        'nopaging'               => true,
        'update_post_term_cache' => false
      );

    $menu_items = wp_get_nav_menu_items( 'primary', $args_menu );

    if ( !empty( $menu_items ) ) {
      $primarymenu .= "<nav " . $args['navigation_id'] . ">";




      $defaults = array(
          'theme_location'  => '',
          'menu'            => 'primary',
          'container'       => 0,
          'container_class' => '',
          'container_id'    => '',
          'menu_class'      => '',
          'menu_id'         => '',
          'echo'            => 0,
          'fallback_cb'     => 0,
          'before'          => '',
          'after'           => '',
          'link_before'     => '',
          'link_after'      => '',
          'items_wrap'      => '<ul>%3$s</ul>',
          'depth'           => 2,
          'walker'          => new SelectiveWalker,
      );

      $primarymenu .= wp_nav_menu( $defaults );

      $primarymenu .= "\n";
      $primarymenu .= "</nav>";
    } // End if (!empty($menu_items))

    if ( !empty( $args['before'] ) && !empty( $args['after'] ) ) {
      /* Open the primary menu <div> container. */
      $primarymenu .= "\n";
      $primarymenu .= $args['after'];
      $primarymenu .= "\n\t";
    }


  }

  /* Allow developers to filter the HTML primarymenu. */
  $primarymenu = apply_filters( 'yatta_view_primarymenu_output', $primarymenu, $args );

  /* If $echo is setted to true, display $primarymenu. */
  if ( $args['echo'] )
    echo $primarymenu;

  /* Else return the $primarymenu. */
  else
    return $primarymenu;

  /* Hook */
  yatta_view_primarymenu_second_level_after();

}


/**
 * Customize the primary menu to build the second level (sub-menu).
 *
 * @since 1.0.0
 * @param array $args Arguments for how to load and display the primarymenu .
 * @return string|array The HTML code to display the primarymenu . | dates & location attributes in an array.
 */
class SelectiveWalker extends Walker_Nav_Menu {

  function walk( $elements, $max_depth) {

    $args = array_slice(func_get_args(), 2);
    $output = '';

    if ($max_depth < -1) //invalid parameter
        return $output;

    if (empty($elements)) //nothing to walk
        return $output;

    $id_field = $this->db_fields['id'];
    $parent_field = $this->db_fields['parent'];

    // flat display
    if ( -1 == $max_depth ) {
        $empty_array = array();
        foreach ( $elements as $e )
            $this->display_element( $e, $empty_array, 1, 0, $args, $output );
        return $output;
    }

    /*
     * need to display in hierarchical order
     * separate elements into two buckets: top level and children elements
     * children_elements is two dimensional array, eg.
     * children_elements[10][] contains all sub-elements whose parent is 10.
     */
    $top_level_elements = array();
    $children_elements  = array();
    foreach ( $elements as $e) {
        if ( 0 == $e->$parent_field )
            $top_level_elements[] = $e;
        else
            $children_elements[ $e->$parent_field ][] = $e;
    }

    /*
     * when none of the elements is top level
     * assume the first one must be root of the sub elements
     */
    if ( empty($top_level_elements) ) {

        $first = array_slice( $elements, 0, 1 );
        $root = $first[0];

        $top_level_elements = array();
        $children_elements  = array();
        foreach ( $elements as $e) {
            if ( $root->$parent_field == $e->$parent_field )
                $top_level_elements[] = $e;
            else
                $children_elements[ $e->$parent_field ][] = $e;
        }
      }

      $current_element_markers = array( 'current-menu-item', 'current-menu-parent', 'current-menu-ancestor' );  //added by continent7
      foreach ( $top_level_elements as $e ){  //changed by continent7
          // descend only on current tree
          $descend_test = array_intersect( $current_element_markers, $e->classes );
          if ( !empty( $descend_test ) ) 
              $this->display_element( $e, $children_elements, 2, 0, $args, $output );
      }

      /*
       * if we are displaying all levels, and remaining children_elements is not empty,
       * then we got orphans, which should be displayed regardless
       */

       /* removed
        if ( ( $max_depth == 0 ) && count( $children_elements ) > 0 ) {
            $empty_array = array();
            foreach ( $children_elements as $orphans )
                foreach( $orphans as $op )
                    $this->display_element( $op, $empty_array, 1, 0, $args, $output );
         }
        */

       return $output;

  } // End walk function
} // End SelectiveWalker class


?>
