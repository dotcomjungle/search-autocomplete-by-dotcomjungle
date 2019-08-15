<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


global $dcj_awesomplete_plugin_url;

?>

<script src="<?php echo $dcj_awesomplete_plugin_url . 'inc/awesomplete.js'; ?>"></script>


<!-- getting post titles and urls  -->
<?php
// get admin options for what post types to have awesomplete access
$options = get_option( 'dcj_awes_options' );
if ( $options === false || $options == '' ) {
	$query_post_types = dcj_awes_defaults()['post_types'];
} else {
	$query_post_types = array();
	foreach ( $options['post_types'] as $type => $on ) {
		if ( $on === 'yes' ) {
			$query_post_types[] = $type;
		}
	}
}

// query for your post type
$dcj_post_type_query = new WP_Query( array(
		'post_type'      => $query_post_types,
		'posts_per_page' => - 1
	)
);
// we need the array of posts
$dcj_posts_array = $dcj_post_type_query->posts;
// get IDs, add to master array
$dcj_post_id_array = wp_list_pluck( $dcj_posts_array, 'ID' );

// titles for awesomplete
$dcj_post_titles = array();
foreach ( $dcj_post_id_array as $dcj_post_id ) {
	$dcj_post_titles[] = get_the_title( $dcj_post_id );
};
// associative array for title to url
$dcj_title_to_urls = array();
foreach ( $dcj_post_id_array as $dcj_post_id ) {
	$dcj_title_to_urls[ get_the_title( $dcj_post_id ) ] = get_the_permalink( $dcj_post_id );
};
?>

<!-- default searchform-->
<div id="dcj_widget_search_form">
	<?php get_search_form(); ?>
</div>

<!-- get options for customization of awesomplete-->
<?php
$options = get_option( 'dcj_awes_options' );
if ( $options === false || $options == '' ) {
	// defaults
	$options = dcj_awes_defaults();
};
?>

<!-- awesomplete styles -->

<?php
if ( $options['awes_theme_color'] === 'dark' ) {
	$theme_sheet = 'awesomplete_dark';
} elseif ( $options['awes_theme_color'] === 'grey' ) {
	$theme_sheet = 'awesomplete_grey';
} else {
	$theme_sheet = 'awesomplete_light';
}

wp_enqueue_style( 'awesomplete_base', $dcj_awesomplete_plugin_url . 'inc/awesomplete_base.css' );
wp_enqueue_style( $theme_sheet, $dcj_awesomplete_plugin_url . 'inc/' . $theme_sheet . '.css' );

?>


<!-- simple js for awesomplete -->
<script>
    {
        function get_inputs() {
            const id_no_num = "<?php echo preg_replace( '/#.*/', '', $options['input_name'] ); ?>";
            var awesomplete_inputs;
            if (id_no_num === '') {
                // get first text input in search form
                let default_awesomplete_inputs = document.querySelectorAll(
                    '#dcj_widget_search_form input[type="text"], ' +
                    '#dcj_widget_search_form input[type="search"], ' +
                    '#dcj_widget_search_form input:not([type])'
                );
                awesomplete_inputs = [default_awesomplete_inputs[0]];
            } else {
                // get all inputs starting with id stub
                if ('<?php echo $options["full_name"]; ?>' === 'yes') {
                    awesomplete_inputs = document.querySelectorAll('input[name=' + id_no_num + ']');
                } else {
                    awesomplete_inputs = document.querySelectorAll('input[name^=' + id_no_num + ']');
                }
            }
            return awesomplete_inputs;
        }

        // create awesomplete object, add event listener for selection
        function create_awes(awesomplete_input) {
            new Awesomplete(awesomplete_input, {
                list: <?php echo json_encode( $dcj_post_titles ); ?>,
                minChars: <?php echo $options['min_chars']; ?>,
                maxItems: <?php echo $options['max_items']; ?>
            });
            let awes_form_div = awesomplete_input.closest('div.awesomplete');
            awes_form_div.addEventListener("awesomplete-selectcomplete", function () {
                let title = awesomplete_input.value;
                let title_to_url = <?php echo json_encode( $dcj_title_to_urls ); ?>;
                window.location.href = title_to_url[title];
            });
        }

        // for each input create awesomplete and style button
        let awes_inputs = get_inputs();
        for (i = 0; i < awes_inputs.length; i++) {
            create_awes(awes_inputs[i]);
            if ('<?php echo( $options['display_button'] ); ?>' === '') {
                let input_form = awes_inputs[i].closest('form');
                if (input_form.querySelector('div.awesomplete') !== null) {
                    let submit_button = input_form.querySelector(
                        'button[type="submit"], input[type="submit"]'
                    );
                    submit_button.style.display = 'none';
                }
            }
        }
    }

</script>


