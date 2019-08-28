<?php

/**
 *    Plugin Name: Search Autocomplete by Dotcomjungle
 *    Plugin URI: https://github.com/dotcomjungle/search-autocomplete-by-dotcomjungle
 *    Description: A customizable search widget that autocompletes the titles of products, blog posts, events, or anything else you choose.
 *    Version: 1.0
 *    Author: Dotcomjungle
 *    Author URI: https://www.dotcomjungle.com
 *    License: GPLv3 or later
 *
 * @author Julian Rice https://github.com/JRice15/
 * @author Dotcomjungle, Inc. https://github.com/dotcomjungle
 */


defined( 'ABSPATH' ) or die( 'Direct access to this file is not permitted' );

// Globals
$dcj_awesomplete_plugin_url = plugin_dir_url( __FILE__ );


// widget class
class DCJ_Awesomplete_Widget extends WP_Widget {

	function __construct() {

		$widget_ops = array(
			'classname'                   => 'dcj_awesomplete_widget',
			'description'                 => __( "Search Autocomplete by Dotcomjungle" ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'dcj_autocomplete_widget', "Search Autocomplete by Dotcomjungle", $widget_ops );
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
		require( 'widget-searchform.php' );

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
		$title    = esc_attr( $instance['title'] );

		require( 'widget-fields.php' );

	}
}

function dcj_awesomplete_register_widgets() {
	register_widget( 'DCJ_Awesomplete_Widget' );
}

add_action( 'widgets_init', 'dcj_awesomplete_register_widgets' );


// create options page
function dcj_awesomplete_add_options() {

	add_options_page(
		"Search Autocomplete by Dotcomjungle",
		'Search Autocomplete by Dotcomjungle',
		'manage_options',
		'dcj-autocomplete-options',
		'dcj_awesomplete_options_page'
	);

}

// output options page
function dcj_awesomplete_options_page() {

	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'perimission denied' );
	};

	$default_options = dcj_awes_defaults();

	$options = array();
	// update options on submit
	if ( esc_html( $_POST['dcj_awes_options_submitted'] ) == "yes" ) {
		if ( isset( $_POST['dcj_restore_defaults'] ) ) {
			$options = $default_options;
		} else {
			$options['awes_theme_color'] = esc_attr( $_POST['awes_theme_color'] );
			$options['display_button']   = esc_attr( $_POST['display_button'] );
			$options['max_items']        = max( array( absint( $_POST['max_items'] ), 1 ) );
			$options['min_chars']        = max( array( absint( $_POST['min_chars'] ), 1 ) );
			$options['input_name']       = preg_replace( '/\s+/', '', esc_attr( $_POST['input_name_select_1'] ) );
			$options['full_name']        = esc_attr( $_POST['full_name'] );
			$options['placeholder']      = esc_attr( $_POST['placeholder_text'] );
			$options['max_height']       = max( array( absint( $_POST['max_height'] ), 1 ) );
			$options['post_types']       = array();
			foreach ( get_post_types( array( 'public' => true ) ) as $type ) {
				$type                           = esc_attr( $type );
				$options['post_types'][ $type ] = esc_attr( $_POST[ 'type_' . $type ] );
			};
		}

		update_option( 'dcj_awes_options', $options );
	};

	// get options from database
	$options = get_option( 'dcj_awes_options' );
	if ( $options === false || $options == '' ) {
		$options = $default_options;
	};
	foreach ( get_post_types( array( 'public' => true ) ) as $type ) {
		if ( ! isset( $options['post_types'][ $type ] ) ) {
			$options['post_types'][ $type ] = '';
		}
	}

	require( 'options-page.php' );
}

add_action( 'admin_menu', 'dcj_awesomplete_add_options' );


// links in plugin area
function dcj_awes_plugin_action_links( $original_links ) {
	$more_links = array(
		'<a href="' . site_url() . '/wp-admin/options-general.php?page=dcj-autocomplete-options">Settings</a>',
		'<a href="https://github.com/dotcomjungle/search-autocomplete-by-dotcomjungle/blob/master/README.md">Documentation</a>',
	);
	$all_links  = array_merge( $more_links, $original_links );

	return $all_links;
}

add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'dcj_awes_plugin_action_links', 10, 1 );


// enqueue awesomplete scripts and styles
function dcj_awes_enqueue_scripts() {
	global $dcj_awesomplete_plugin_url;
	// js
	wp_enqueue_script( 'dcj_awesomplete_js', $dcj_awesomplete_plugin_url . 'inc/awesomplete.js' );

	// css
	$options = get_option( 'dcj_awes_options' );
	if ( empty( $options ) ) {
		$options = dcj_awes_defaults();
	};
	if ( $options['awes_theme_color'] === 'dark' ) {
		$theme_sheet = 'inc/awesomplete_dark.css';
	} elseif ( $options['awes_theme_color'] === 'grey' ) {
		$theme_sheet = 'inc/awesomplete_grey.css';
	} else {
		$theme_sheet = 'inc/awesomplete_light.css';
	}
	wp_enqueue_style( 'dcj_awesomplete_style_base', $dcj_awesomplete_plugin_url . 'inc/awesomplete_base.css' );
	wp_enqueue_style( 'dcj_awesomplete_style_theme', $dcj_awesomplete_plugin_url . $theme_sheet );
}

add_action( 'wp_enqueue_scripts', 'dcj_awes_enqueue_scripts' );


// default settings
function dcj_awes_defaults() {
	// set defaults
	$default_options = array(
		'awes_theme_color' => 'white',
		'highlight_color'  => 'yellow',
		'post_types'       => array(),
		'max_items'        => '5',
		'min_chars'        => '1',
		'display_button'   => 'yes',
		'input_name'       => '',
		'full_name'        => 'yes',
		'placeholder'      => 'Search...',
		'max_height'       => '500',
	);
	// add current post types
	foreach ( get_post_types( array( 'public' => true ) ) as $type ) {
		if ( $type === 'post' || $type === 'product' ) {
			$default_options['post_types'][ esc_attr( $type ) ] = 'yes';
		} else {
			$default_options['post_types'][ esc_attr( $type ) ] = null;
		}
	}

	return $default_options;
}

