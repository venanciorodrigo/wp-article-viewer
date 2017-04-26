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
// print_r(get_option('article_viewer_categories')); exit();
class Article_Viewer_Plugin  {
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'create_plugin_article_viewer' ) );
        add_action( 'plugins_loaded', array( 'PageTemplater', 'get_instance' ) );
        add_action( 'admin_init', array( $this, 'setup_sections' ) );
        add_action( 'admin_init', array( $this, 'setup_fields' ) );
        add_action( 'rest_api_init', function () {
            register_rest_route( 'wp/v2', '/article-viewer', array(
                'methods'              => array( WP_REST_Server::READABLE ),
                'callback'             => array( $this, 'article_viewer_callback' ),
            ) );
        });
    }

    public function create_plugin_article_viewer() {
        // Add the menu item and page
        $page_title = 'Article Viewer';
        $menu_title = 'Article Viewer';
        $capability = 'manage_options';
        $slug = 'article-viewer';
        $callback = array( $this, 'plugin_settings_page_content' );
        $icon = 'dashicons-format-gallery';
        $position = 100;

        add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
    }

    // Create the page content and form to save the values selected by the user on the wp_options table.
    public function plugin_settings_page_content() { ?>
        <div class="wrap">
        <h2>Article Viewer - Settings</h2>
        <form method="post" action="options.php">
            <?php
                settings_fields( 'article_viewer_fields' );
                do_settings_sections( 'article_viewer_fields' );
                submit_button();
            ?>
        </form>
    </div> <?php
    }

    public function setup_sections() {
        add_settings_section( 'article_viewer_section', 'Select the categories that you want to show on the article viewer', false, 'article_viewer_fields' );
    }

    public function setup_fields() {
        // Categories Loop to create the checkboxes
        $categories_options = [];

        $categories = get_categories();

        foreach ($categories as $key => $category) {
            $categories_options[$category->term_id] = $category->name;
        }

        $fields = array(
            array(
                'uid' => 'article_viewer_categories',
                'label' => 'Categories: ',
                'section' => 'article_viewer_section',
                'type' => 'checkbox',
                'options' => $categories_options,
                'default' => array()
            )
        );

        // Register fields
        foreach( $fields as $field ){
            add_settings_field( $field['uid'], $field['label'], array( $this, 'field_callback' ), 'article_viewer_fields', $field['section'], $field );
            register_setting( 'article_viewer_fields', $field['uid'] );
        }
    }

    public function field_callback( $arguments ) {
        // Display Fields
        $value = get_option( $arguments['uid'] );

        if( ! $value ) {
            $value = $arguments['default'];
        }

        switch( $arguments['type'] ){
            case 'checkbox':
                if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
                    $options_markup = '';
                    $iterator = 0;
                    foreach( $arguments['options'] as $key => $label ){
                        $iterator++;
                        $options_markup .= sprintf( '<label for="%1$s_%6$s"><input id="%1$s_%6$s" name="%1$s[]" type="%2$s" value="%3$s" %4$s /> %5$s</label><br/>', $arguments['uid'], $arguments['type'], $key, checked( $value[ array_search( $key, $value, false ) ], $key, false ), $label, $iterator );
                    }
                    printf( '<fieldset>%s</fieldset>', $options_markup );
                }
            break;
        }
    }

    /**
     * Extend the WP-AP
     * Adding custom endpoint to show only posts related to the categories selected by the user.
     */
    public function article_viewer_callback() {
        return get_option('article_viewer_categories');
    }

}

new Article_Viewer_Plugin();

?>