<?php

add_shortcode('gcdonate', 'gc_donate_shortcode');
add_shortcode('donate', 'gc_donate_shortcode');
function gc_donate_shortcode($attrs=array(), $content='', $code='')
{
    if( $content ){
        $attrs['description'] = $content;
    }
    return gc_donate($attrs);
}