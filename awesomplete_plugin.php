<?php

/*
 *	Plugin Name: DCJ Awesomplete Search Plugin
 *	Plugin URI: https://leaverou.github.io/awesomplete/
 *	Description: Awesomplete-powered autocomplete plugin
 *	Version: 1.0
 *	Author: Julian Rice
 *	Author URI: https://www.dotcomjungle.com
 *	License: GPL2
 *
*/



// Globals
$dcj_plugin_url = WP_PLUGIN_URL . '/awesomplete_plugin';


class DCJ_Awesomplete_Widget extends WP_Widget {

	function __construct() {

            $widget_ops = array(
                'classname'                   => 'dcj_awesomplete_widget',
                'description'                 => __( "Dotcomjungle's Awesomplete Search Widget" ),
                'customize_selective_refresh' => true,
            );
            parent::__construct( 'dcj_search', _x( "Dotcomjungle's Awesomplete Search Widget", 'Autocomplete search widget powered by Awesomplete' ), $widget_ops );
	}

	function widget( $args, $instance ) {
        // Widget output

		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';

		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		// create actual searchform
        require( 'widget_searchform.php' );

		// invisible actual search form, trying to either replicate this call
		//  'get_search_form' or pass search terms to it
		?>
		<div style="display: none">
			<?php get_search_form(); ?>
		</div>

		<?php

		echo $args['after_widget'];

	}

	function update( $new_instance, $old_instance ) {
        // Save widget options

		$instance          = $old_instance;
		$new_instance      = wp_parse_args( (array) $new_instance, array( 'title' => '' ) );
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		return $instance;
	}

	function form( $instance ) {
        // Output admin widget options form
        
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
        $title    = esc_attr($instance['title']);
        require( 'inc/widget-fields.php' );

	}
}

function dcj_awesomplete_register_widgets() {
    register_widget( 'DCJ_Awesomplete_Widget' );
}

add_action( 'widgets_init', 'dcj_awesomplete_register_widgets' );

