<?php
/**
 * Add the next and previous post on WP-API
 */

function add_prev_post() {
    register_rest_field( 'post',
        'previous_post',
        array(
            'get_callback'    => 'retrieve_prev_post',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}

function add_next_post() {
    register_rest_field( 'post',
        'next_post',
        array(
            'get_callback'    => 'retrieve_next_post',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}

/**
 * Get the value of the previous post
 *
 * @param array $object Details of current post.
 */
function retrieve_prev_post( $object, $request ) {
    $post_id = $object[ 'id' ];
    global $post;
    $post = get_post( $post_id );
    $prev_post = get_previous_post();
    if ( ! empty( $prev_post ) ) {
        $prev_object = (object) [
            'id' => $prev_post->ID,
            'slug' => $prev_post->post_name,
            'title' => $prev_post->post_title,
        ];
        return $prev_object;
    }
}

/**
 * Get the value of the next post
 *
 * @param array $object Details of current post.
 */
function retrieve_next_post( $object, $request ) {
    $post_id = $object[ 'id' ];
    global $post;
    $post = get_post( $post_id );
    $next_post = get_next_post();
    if ( ! empty( $next_post ) ) {
        $next_object = (object) [
            'id' => $next_post->ID,
            'slug' => $next_post->post_name,
            'title' => $next_post->post_title,
        ];
        return $next_object;
    }

}