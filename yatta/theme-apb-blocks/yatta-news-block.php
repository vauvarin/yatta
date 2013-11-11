<?php

class AQ_News_Block extends AQ_Block {


    // set and create block
    function __construct() {

        $block_options = array(
            'name' => __( 'News' , 'yatta' ),
            'size' => 'span12',
        );
        
        // create the block
        parent::__construct( 'aq_news_block', $block_options );

    }

    function form( $instance ) {

        if ( is_plugin_active( 'yatta-news/yatta-news-plugin.class.php' ) ) {

            $defaults = array(
                    'title'                  => '',
                    'yatta_news_block_number' => '0',
            );
            $instance = wp_parse_args( $instance, $defaults );
            extract( $instance );

            $news_block_number_options = array(
                                    '0'  => __( 'All' , 'yatta' ),
                                    '1'  => '1',
                                    '2'  => '2',
                                    '3'  => '3',
                                    '4'  => '4',
                                    '5'  => '5',
                                    '6'  => '6',
                                    '7'  => '7',
                                    '8'  => '8',
                                    '9'  => '9',
                                    '10' => '10',
                                    '11' => '11',
                                    '12' => '12',
                                    '13' => '13',
                                    '14' => '14',
                                    '15' => '15',
                                    '16' => '16',
                                    '17' => '17',
                                    '18' => '18',
                                    '19' => '19',
                                    '20' => '20',
                                    );

            ?>

            <p class="description">
            <label for="<?php echo $this->get_field_id('title') ?>">
            <?php _e( 'Title (optional)' , 'yatta' ) ?>
            <?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
            </label>
            </p>

            <p class="description">
            <label for="<?php echo $this->get_field_id('yatta_news_block_number') ?>">
            <?php  _e( 'Number of news to display' , 'yatta' ) ?>
            <?php echo aq_field_select('yatta_news_block_number', $block_id, $news_block_number_options, $yatta_news_block_number) ?>
            </label>
            </p>

            <?php
        } else {
            $yatta_news_block_notice_plugin_deactivated = '<strong>' . gettext( 'The "News" plugin is deactivated.' ) . '</strong><br/><br/>'
            . gettext( '1- You need to display the News > activate the "News" plugin.' ) . '<br/>'
            . gettext( '2- You don\'t need to use the "News" block > delete this block.' ) . '<br/><br/>';

            printf( gettext( "%s" ) , $yatta_news_block_notice_plugin_deactivated );
        }

    }


    




    function block( $instance ) {
        extract( $instance );

        if ( is_plugin_active( 'yatta-news/yatta-news-plugin.class.php' ) ) {

            if( $title ) echo '<h2 class="yatta-block-header yatta-news-block-header">' . strip_tags( $title ) . '</h2>';

            /* Hook */
            yatta_apb_block_news();

            // Get all the news ( come from the hook above set in frontend/yatta-news-view.class.php > function get_array_posts() )
            global $yatta_apb_block_object_posts; // Object

            if ( $yatta_apb_block_object_posts ) {
                $i = 0;
                while ( $yatta_apb_block_object_posts->have_posts() ) : $yatta_apb_block_object_posts->the_post();
                    // Put all the posts in an Array
                    $yatta_apb_block_array_posts[ $i ] = $yatta_apb_block_object_posts->post; 
                $i++;
                endwhile;

                // Count the posts
                $yatta_apb_block_array_posts_size = count( $yatta_apb_block_array_posts ); 
            } else {
                echo "<br /><div class='yatta-notice'><h4 class='yatta-notice-title'>" . __( 'NOTICE - News' , 'yatta' ) . "</h4><p> " . __( 'No News found. Have you already added some news? Go to News > Add New.' , 'yatta' ) . "</p></div>";
            }

            if ( $yatta_apb_block_object_posts && ( (int) $yatta_news_block_number == 0 || (int) $yatta_news_block_number > (int) $yatta_apb_block_array_posts_size ) ) { 
                $yatta_news_block_number = $yatta_apb_block_array_posts_size;
            } 

            $yatta_posts_display = '';
            $yatta_posts_display .= "<ul class='yatta-block-ul yatta-news-block-ul'>";

            // Display the posts
            for ( $i = 0; $i < $yatta_news_block_number; $i++ ) { 
                $yatta_post = $yatta_apb_block_array_posts[ $i ];
                
                $yatta_posts_display .= "<li class='yatta-block-li yatta-news-block-li'>";
                $yatta_posts_display .= "<span class='yatta-news-block-date'>" . date( "d.m.Y", strtotime( $yatta_post->post_date ) ) . "</span>";
                $yatta_posts_display .= "<span class='yatta-news-block-title'><a href=" . $yatta_post->guid . ">" . $yatta_post->post_title . "</a></span>";
                
                $yatta_posts_display .= "</li>";
            }

            $yatta_posts_display .= "</ul>";

            echo $yatta_posts_display;

        }
        
    }



}
