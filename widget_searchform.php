<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


global $dcj_awesomplete_plugin_url;
global $default_options;

?>

<script src="<?php echo $dcj_awesomplete_plugin_url . 'inc/awesomplete.js'; ?>"></script>


<!-- getting post titles and urls  -->
    <?php
    // get admin options for what post types to have awesomplete access
    $options = get_option('dcj_awes_options');
    if ($options === false || $options == '') {
        $query_post_types = dcj_awes_defaults()['post_types'];
    } else {
        $query_post_types = array();
        foreach($options['post_types'] as $type => $on) {
            if ($on == 'true') {
                array_push($query_post_types, $type);
            }
        }
    }

    // query for your post type
    $dcj_post_type_query = new WP_Query(array(
            'post_type' => $query_post_types,
            'posts_per_page' => -1
        )
    );
    // we need the array of posts
    $dcj_posts_array = $dcj_post_type_query->posts;
    // get IDs, add to master array
    $dcj_post_id_array = wp_list_pluck($dcj_posts_array, 'ID');

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

<!-- options for customization of awesomplete-->
    <?php

    $options = get_option('dcj_awes_options');
    if ($options === false || $options == '') {
        // defaults
        $options = dcj_awes_defaults();
    };
    ?>


<!-- awesomplete styles -->

    <style>
        #wp-default-search-form button[type="submit"],
        #wp-default-search-form input[type="submit"] {
            display: <?php if ($options['display_button'] == 'true') {echo "inline-block";}
                                else {echo "none";}; ?>
        }
    </style>

    <?php
    if ($options['awes_theme_color'] == 'dark') {
        $theme_sheet = 'awesomplete_dark.css';
    } elseif ($options['awes_theme_color'] == 'grey') {
        $theme_sheet = 'awesomplete_grey.css';
    } else {
        $theme_sheet = 'awesomplete.css';
    }
    ?>
    <link rel="stylesheet" href="<?php echo $dcj_awesomplete_plugin_url . 'inc/' . $theme_sheet; ?>" />


<!-- simple js for awesomplete -->
    <script>
        // get first input in search form
        let awesomplete_inputs_list = document.querySelectorAll( "div#wp-default-search-form input" );
        let awesomplete_input = awesomplete_inputs_list[0];
        // create awesomplete object
        let awes = new Awesomplete(awesomplete_input, {
            list: <?php echo json_encode($dcj_post_titles); ?>,
            minChars: <?php echo $options['min_chars']; ?>,
            maxItems: <?php echo $options['max_items']; ?>
        });

        // event listener for redirect to selected site
        let awes_form_div = document.querySelector("div.awesomplete");
        awes_form_div.addEventListener("awesomplete-selectcomplete", function () {
            let title = awesomplete_input.value;
            let title_to_url = <?php echo json_encode($dcj_title_to_urls); ?>;
            window.location.href = title_to_url[title];
        });
    </script>


