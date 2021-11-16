<?php

add_shortcode('sw_instagram', 'isw_shortcode');

function isw_shortcode()
{
    $swi_slug = isw_get_option('swi_slug');
    $swi_id = isw_get_option('swi_id');

    if (!$swi_slug || !$swi_id)
        return;

    $output = '';
    $output = '<div class="insta-wrap"><a href="https://www.instagram.com/' . $swi_slug . '/" target="_blank"></a><iframe src="https://snapwidget.com/embed/' . $swi_id . '" class="snapwidget-widget" allowtransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden;  width:1080px; height:360px"></iframe></div>';
    return $output;
}
