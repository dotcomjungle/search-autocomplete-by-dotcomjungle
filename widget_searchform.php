<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


global $dcj_awesomplete_plugin_url;
?>


<link rel="stylesheet" href="<?php echo $dcj_awesomplete_plugin_url . 'inc/awesomplete.css'; ?>" />
<script src="<?php echo $dcj_awesomplete_plugin_url . 'inc/awesomplete.js'; ?>"></script>


<!-- getting post titles and urls  -->
    <?php
    // query for your post type
    $dcj_post_type_query  = new WP_Query(
        array (
            'post_type'      => 'post',
            'posts_per_page' => -1
        )
    );
    // we need the array of posts
    $dcj_posts_array      = $dcj_post_type_query->posts;
    // create a list with needed information
    $dcj_post_id_array = wp_list_pluck( $dcj_posts_array, 'ID' );

    // titles for awesomplete
    $dcj_post_titles = array();
    foreach( $dcj_post_id_array as $dcj_post_id ) {
        array_push( $dcj_post_titles, get_the_title($dcj_post_id) );
    };
    // associative array for title to url
    $dcj_title_to_urls = array();
    foreach( $dcj_post_id_array as $dcj_post_id ) {
        $dcj_title_to_urls[get_the_title($dcj_post_id)] = get_the_permalink($dcj_post_id);
    };

    ?>

<!-- default searchform-->
    <div id="wp-default-search-form">
        <?php get_search_form(); ?>
    </div>

    <script>
        let awesomplete_inputs_list = document.querySelectorAll( "div#wp-default-search-form input" );
        let awesomplete_input = awesomplete_inputs_list[0];
    </script>


<!-- simple js for awesomplete -->
    <script>
        // create awesomplete object
        // let awesomplete_input = document.getElementById("awesomplete_search_input");
        let awes = new Awesomplete(awesomplete_input, {
            list: <?php echo json_encode($dcj_post_titles); ?>
        });

        // redirect to selected site
        let awes_form_div = document.querySelector("div.awesomplete");
        awes_form_div.addEventListener("awesomplete-selectcomplete", function () {
            let title = awesomplete_input.value;
            let title_to_url = <?php echo json_encode($dcj_title_to_urls); ?>;
            window.location.href = title_to_url[title];
        });
    </script>

<!-- fixing awesomplete styles-->
    <style>
        div.awesomplete {
            width: 100%;
        }
        div.awesomplete > input {
            width: 100%;
        }
        div.awesomplete mark, ul, li {
            color: black;
        }
    </style>