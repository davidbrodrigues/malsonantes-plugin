<?php
add_filter( 'the_content', 'filter_the_content_in_the_main_loop', 1 );

function filter_the_content_in_the_main_loop( $content ) {

    // Check if we're inside the main loop in a single Post.
    if ( is_singular() && in_the_loop() && is_main_query() ) {
        return $content . esc_html__( 'I’m filtering the content inside the main loop', 'wporg');
    }

    return $content;
}