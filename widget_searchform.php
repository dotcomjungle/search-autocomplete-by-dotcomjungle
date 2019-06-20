<?php
global $dcj_awesomplete_plugin_url;
?>


<link rel="stylesheet" href="<?php echo $dcj_awesomplete_plugin_url . 'inc/awesomplete.css'; ?>" />
<script src="<?php echo $dcj_awesomplete_plugin_url . 'inc/awesomplete.js'; ?>"></script>


<div id="dev_out"></div>

<!-- create datalist of post titles as invisible <ul> for awesomplete -->
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

    ?>

<!-- creating an html unordered list output for awesomplete to access   style="display: none"  -->
    <ul id="dcj-awesomplete-datalist" >
    <?php
    $dcj_title_and_urls = array();
    foreach( $dcj_post_id_array as $dcj_post_id ) {
        array_push( $dcj_title_and_urls, array(
                "label" => get_the_title($dcj_post_id),
                "value" => get_the_permalink($dcj_post_id)
        ));
    };
    ?>
    </ul>

<!-- simple js for awesomplete -->

    <form id="dcj_awesomplete_search_form" name="dcj-search">
        <input id="awesomplete_search_input" name="awesomplete_search_input" type="text" />
        <button id="awesomplete_search_submit" type="submit" class="search-submit">Search</button>
    </form>

    <script>
        let awesomplete_input = document.getElementById("awesomplete_search_input");
        let awes = new Awesomplete( awesomplete_input, {
            list: <?php echo json_encode($dcj_title_and_urls); ?>
        });
        let awes_form = document.getElementById("dcj_awesomplete_search_form");
        awes_form.addEventListener("awesomplete-select", function() {
            // console.log("yep");
            window.location.href = document.getElementById("awesomplete_search_input").value;
        });
    </script>

