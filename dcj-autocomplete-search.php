<?php

/*
 *	Plugin Name: DCJ Autocomplete Search
 *	Plugin URI: https://www.dotcomjungle.com
 *	Description: Dotcomjungle's high power, low overhead autocomplete search widget. Highly customizable, it is powered by Lea Verou's 'Awesomplete' and built to work with any theme.
 *	Version: 1.0
 *	Author: Dotcomjungle
 *	Author URI: https://www.dotcomjungle.com
 *	License: GPLv3
*/


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// Globals
$dcj_awesomplete_plugin_url = plugin_dir_url(__FILE__);


class DCJ_Awesomplete_Widget extends WP_Widget {

	function __construct() {

            $widget_ops = array(
                'classname'                   => 'dcj_awesomplete_widget',
                'description'                 => __( "Dotcomjungle's Autocomplete Search Widget" ),
                'customize_selective_refresh' => true,
            );
            // todo: _x looks like a typo to me.
            parent::__construct( 'dcj_autocomplete_widget', _x( "Dotcomjungle's Autocomplete Search Widget", 'DCJs Autocomplete search widget powered by Awesomplete' ), $widget_ops );
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
        require('widget-searchform.php');

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

// regular widget output
add_action( 'widgets_init', 'dcj_awesomplete_register_widgets' );



function dcj_awesomplete_add_options() {

    add_options_page(
        "Dotcomjungle's Autocomplete Search Widget",
        'DCJ Autocomplete Search',
        'manage_options',
        'dcj-autocomplete-options',
        'dcj_awesomplete_options_page'
    );

};

function dcj_awesomplete_options_page () {

    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'perimission denied' );
    };

    $default_options = dcj_awes_defaults();

    $options = array();
    // update options on submit
    if ( esc_html($_POST['dcj_awes_options_submitted']) == "yes") {
        if (isset($_POST['dcj_restore_defaults'])) {
            $options = $default_options;
        } else {
            $options['awes_theme_color']    = esc_attr($_POST['awes_theme_color']);
            $options['display_button']      = esc_attr($_POST['display_button']);
            $options['max_items']           = max(array(absint($_POST['max_items']), 1));
            $options['min_chars']           = max(array(absint($_POST['min_chars']), 1));
            $options['input_name']          = preg_replace('/\s+/', '', esc_attr($_POST['input_name_select_1']));
            $options['full_name']           = esc_attr($_POST['full_name']);
            $options['post_types']          = array();
            foreach (get_post_types(array('public' => true)) as $type) {
                $type = esc_attr($type);
                $options['post_types'][$type] = esc_attr($_POST['type_'.$type]);
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
    foreach (get_post_types(array('public' => true)) as $type) {
        if (! isset($options['post_types'][$type])) {
            $options['post_types'][$type] = '';
        }
    }

    require('options-page.php');
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
        'display_button' => 'true',
        'input_name' => '',
        'full_name' => 'true'
    );
    // add current post types
    foreach (get_post_types(array('public' => true)) as $type) {
        if ($type === 'post' || $type === 'product') {
            $default_options['post_types'][esc_attr($type)] = 'true';
        } else {
            $default_options['post_types'][esc_attr($type)] = null;
        }
    }
    return $default_options;
}
