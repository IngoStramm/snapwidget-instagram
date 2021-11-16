<?php

add_action('wp_enqueue_scripts', 'swi_frontend_scripts');

function swi_frontend_scripts()
{

    $min = (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1', '10.0.0.3'))) ? '' : '.min';

    if (empty($min)) :
        wp_enqueue_script('snapwidget-instagram-livereload', 'http://localhost:35729/livereload.js?snipver=1', array(), null, true);
    endif;

    // wp_register_script('snapwidget-instagram-script', SWI_URL . 'assets/js/snapwidget-instagram' . $min . '.js', array('jquery'), '1.0.0', true);

    // wp_enqueue_script('snapwidget-instagram-script');

    // wp_localize_script('snapwidget-instagram-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
    wp_enqueue_style('snapwidget-instagram-style', SWI_URL . 'assets/css/snapwidget-instagram.css', array(), false, 'all');
}
