<?php
/*
Plugin Name: Article Viewer
Description: Plugin that publishes an article viewer with key bindings to navigate to the previous / next article.
Plugin URI:
Version: 1.0.0
Author: Rodrigo Venancio
Author URI: http://rodrigovenancio.info/
*/

/* Create a page template without using the theme folder */
require_once( 'includes/custom-template.php' );

add_action( 'plugins_loaded', array( 'PageTemplater', 'get_instance' ) );

/* WP-API Extensions */
require_once( 'includes/extend-wp-api.php' );

add_action( 'rest_api_init', 'add_prev_post' );
add_action( 'rest_api_init', 'add_next_post' );