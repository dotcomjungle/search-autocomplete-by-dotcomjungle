<?php

// query for your post type
$post_type_query  = new WP_Query(  
    array (  
        'post_type'      => 'your-post-type',  
        'posts_per_page' => -1  
    )  
);   
// we need the array of posts
$posts_array      = $post_type_query->posts;   
// create a list with needed information
$post_title_array = wp_list_pluck( $posts_array, 'post_title' );

?>

<!-- creating an html unordered list output for awesomplete to access -->
<ul id="awesomplete_datalist">

<?php foreach( $post_title_array as $post_title ): ?>
    <li><?php echo $post_title; ?></li>
<?php endforeach; ?>

</ul>
