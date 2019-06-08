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
$plugin_url = WP_PLUGIN_URL . '/awesomplete_plugin';


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

        require( 'awesomplete_datalist.php' )

        // trying to create a search form that accesses the awesomplete class here
        ?>
		<p>
            <link rel="stylesheet" href="inc/awesomplete.css" />
            <script src="inc/awesomplete.js" async></script>
            <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <label for="<?php echo $this->get_field_id( 'title' ); ?>">
                    <input class="awesomplete widefat" datalist="#awesomplete_datalist", id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
                    <button type="submit" class="search-submit">Search</button>
                </label>
            </form>
		</p>


        <?php
        // get_search_form();

		echo $args['after_widget'];

	}

	function update( $new_instance, $old_instance ) {
        // Save widget options

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
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

