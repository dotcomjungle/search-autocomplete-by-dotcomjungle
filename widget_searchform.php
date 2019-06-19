<?php
global $dcj_awesomplete_plugin_url
?>

<link rel="stylesheet" href="<?php echo $dcj_awesomplete_plugin_url . 'inc/awesomplete.css'; ?>" />
<script src="<?php echo $dcj_awesomplete_plugin_url . 'inc/awesomplete.js'; ?>" async></script>


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
    $dcj_post_title_array = wp_list_pluck( $dcj_posts_array, 'post_title' );

    ?>

<!-- creating an html unordered list output for awesomplete to access-->
    <ul id="dcj-awesomplete-datalist" style="display: none">

    <?php foreach( $dcj_post_title_array as $dcj_post_title ) { ?>
        <li><?php echo $dcj_post_title; ?></li>
    <?php }; ?>

    </ul>

<!-- simple html for awesomplete -->

    <form name="dcj-search">
        <input class="awesomplete" data-list="#dcj-awesomplete-datalist" name="awesomplete_search_input" type="text" />
        <button type="submit" class="search-submit">Search</button>
    </form>

