<?php 
# THEME OPTIONS CSS
# Theme Options > Configuration > Custom CSS
# adds a Global CSS (rarely used)

function set_global_css() {
    global $custom_css;
    $custom_css = '';
    $custom_css .= opt_global_css();    

    if($custom_css) {
        $global_css = "<style>{$custom_css}</style>";
        echo $global_css;
    }
}

add_filter('wp_head', 'set_global_css');
add_filter('admin_head', 'set_global_css');

function opt_global_css() {
    $opt = get_field('css', 'options');
    $css = '';

    if(isset($opt['custom_css']))
        $css = $opt['custom_css'];
    
    if($css) {
        $css = strip_tags($css);
    }

    return $css;
}
?>