<?php
/*
Plugin Name: Article Viewer
Description: Plugin that publishes an article viewer with key bindings to navigate to the previous / next article.
Plugin URI:
Version: 1.0.0
Author: Rodrigo Venancio
Author URI: http://rodrigovenancio.info/
*/

require_once( 'includes/custom-template.php' );

add_action( 'plugins_loaded', array( 'PageTemplater', 'get_instance' ) );