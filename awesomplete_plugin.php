<?php

/*
 *	Plugin Name: DCJ Awesomplete Search Plugin
 *	Plugin URI: https://leaverou.github.io/awesomplete/
 *	Description: Dotcomjungle's Awesomplete-powered autocomplete search-widget
 *	Version: 1.0
 *	Author: Julian Rice
 *	Author URI: https://www.dotcomjungle.com
 *	License: GPL2
 *
*/


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// Globals
$dcj_awesomplete_plugin_url = plugins_url() . "/awesomplete_plugin/";


class DCJ_Awesomplete_Widget extends WP_Widget {

	function __construct() {

            $widget_ops = array(
                'classname'                   => 'dcj_awesomplete_widget',
                'description'                 => __( "Dotcomjungle's Awesomplete Search Widget" ),
                'customize_selective_refresh' => true,
            );
            parent::__construct( 'dcj_awesomplete_widget', _x( "Dotcomjungle's Awesomplete Search Widget", 'DCJs Autocomplete search widget powered by Awesomplete' ), $widget_ops );
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

        require( 'widget-fields.php' );

	}
}

function dcj_awesomplete_register_widgets() {
    register_widget( 'DCJ_Awesomplete_Widget' );
}

add_action( 'widgets_init', 'dcj_awesomplete_register_widgets' );






function dcj_awesomplete_add_options() {

    // use the add_options_page function
    // add_options_page( $page_title, $menu_title, $capability, $menu-slug, $function)

    add_options_page(
        "Dotcomjungle's Awesomplete Search Widget",
        'DCJ Awesomplete Search',
        'manage_options',
        'dcj-awesomplete-options',
        'dcj_awesomplete_options_page'
    );
    //

};

function dcj_awesomplete_options_page () {

    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'perimission denied' );
    };

    $default_options = dcj_awes_defaults();

    $options = array();
    // update options on submit
    if ( $_POST['dcj_awes_options_submitted'] == "yes") {
        if (isset($_POST['dcj_restore_defaults'])) {
            $options = $default_options;
        } else {
            $options['awes_theme_color']    = $_POST['awes_theme_color'];
            $options['highlight_color']     = $_POST['highlight_color'];
            $options['display_button']      = $_POST['display_button'];
            $options['max_items']           = absint($_POST['max_items']);
            $options['min_chars']           = absint($_POST['min_chars']);
            $options['post_types']          = array();
            foreach (get_post_types(array('public' => true)) as $type) {
                $options['post_types'][$type] = $_POST['type_'.$type];
            };
            $options['last_update']         = time();
        }

        update_option('dcj_awes_options', $options);

    };

    // get options from database
    $options = get_option('dcj_awes_options');
    if ($options === false || $options == '') {
        $options = $default_options;
    };

    require('options_page.php');

}

add_action( 'admin_menu', 'dcj_awesomplete_add_options');


function dcj_awes_defaults() {
    // set defaults
    $default_options = array(
        'awes_theme_color' => 'white',
        'highlight_color' => 'yellow',
        'post_types' => array(),
        'max_items' => '5',
        'min_chars' => '2',
        'display_button' => 'true'
    );
    // add current post types
    foreach (get_post_types(array('public' => true)) as $type) {
        if ($type == 'post' || $type == 'product') {
            $default_options['post_types'][$type] = 'true';
        } else {
            $default_options['post_types'][$type] = null;
        }
    }
    return $default_options;
}