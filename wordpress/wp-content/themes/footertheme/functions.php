<?php
function footertheme_enqueue_scripts() {
    // Bootstrap 4 CSS
    wp_enqueue_style('bootstrap4', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');

    // Font Awesome
    wp_enqueue_style('fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

    // Style theme
    wp_enqueue_style('footertheme-style', get_stylesheet_uri());

    // jQuery có sẵn trong WP
    wp_enqueue_script('jquery');

    // Bootstrap JS
    wp_enqueue_script('bootstrap4', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'footertheme_enqueue_scripts');
