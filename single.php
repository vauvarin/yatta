<?php
/**
* The Template for displaying all single posts.
*
*
*
* @package WordPress
* @subpackage kattagami
* @see single.php
* @since 1.0.0
*/

get_header();

get_sidebar();


get_template_part('event');

?>

<div id='katt-page' class='katt-page'>

<?php 

if ( have_posts() ) : 

  while ( have_posts() ) : the_post(); 

?>

<div id="<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php echo "<div class='katt-pagenews-block-title'>" . get_the_title() . "</div>";  ?>
        <?php echo "<div class='katt-pagenews-block-date'>" . get_the_date( $d = 'd . m . Y' ) . "</div>";  ?>
        <?php echo "<div class='katt-pagenews-block-content'>" . get_the_content() . "</div>";  ?>
</div>

<?php

  endwhile; // end of the loop. 

else :

  echo "<br><div class='katt-notice'><h4 class='katt-notice-title'>" . __( 'NOTICE - News' , 'katt' ) . "</h4><p> " . __('No News found. Have you already added some news? Go to News > Add New' , 'katt' ) . "</p></div>";


endif; 
  
?>

</div>


<?php 

get_footer();
