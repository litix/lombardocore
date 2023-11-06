<?php 
#SHORTCODES

// [search-form] [search-form-pop] [scroll-up]

/* ----------------------------------------- */

function fn_search_form($attr) {
    load_assets(array('pop-search'));
    $args = shortcode_atts( array(
        'echo'  => 0,
        'text' => 'Search...',
        'w' => '',
    ), $attr );

    global $formid;
    $formid++;

    $style = '';

    if($args['w']) {
        $w = "width: {$args['w']}px";
        $style = tag_attr_style($w);
    }
    $btn = fa_icon('search');

    $role   = "role=\"search\"";
    $id     = "id=\"searchform-{$formid}\"";
    $method = "method=\"get\"";
    $action = 'action="' . site_url('/') . '"';

    $form = '';

    $attr = implode(" ", array($role, $id, $method, $action, $style));

    $form .= "<form {$attr}>";
    $form .= "<div>";
    $form .= "<label class=\"novisual\" for=\"text-search-{$formid}\">Search</label>";
    $form .= "<input id=\"text-search-{$formid}\" type=\"text\" placeholder=\"{$args['text']}\" name=\"s\">";   
    $form .= "</div>";
    $form .= "<button class=\"btn\" type=\"submit\"><span class=\"novisual\">Search</span>{$btn}</button>";
    $form .= "</form>";  

    $output = tag_wrap('ext-show-search', $form); 

    if($args['echo'] == 1)
        echo $output;

    return $output;
}

add_shortcode('search-form', 'fn_search_form');

/* ----------------------------------------- */

## Pop Search
## see ## LINK assets/theme/theme.js
## see ## LINK assets/theme/theme.css

function fn_search_form_pop($attr) {
    load_assets(array('pop-search'));
    $args = shortcode_atts( array(
        'echo'  => 0,
        'text' => 'Search and hit enter...',
    ), $attr );

    global $formid;
    $formid++;

    $role   = "role=\"search\"";
    $id     = "id=\"searchform-{$formid}\"";
    $method = "method=\"get\"";
    $text   = "placeholder=\"{$args['text']}\"";
    $type   = "type=\"text\"";
    $action = 'action="' . site_url('/') . '"';
    $style  = '';

    $icon_search = '<span class="i-search">' . fa_icon('search') . '</span>';
    $icon_close  = '<span class="i-close">'  . fa_icon('close1') . '</span>';
    $a = "<button data-trigger=\"search\" class=\"sactive\">{$icon_search}{$icon_close}</button>";

    $attr = implode(" ", array($role, $id, $method, $action, $style));

    $output = $a;
    $form  = "<form {$attr}>";
    $form .= "<label class=\"novisual\">Search</label>";
    $form .= "<div><input id=\"text-search-{$formid}\" {$type} {$text} name=\"s\"></div>";
    $form .= "</form>";
          
    $output .= tag_wrap('show-search', $form); 
    $output = tag_wrap('pop-search', $output); 

    if($args['echo'] == 1)
        echo $output;

    return $output;
}

add_shortcode('search-form-pop', 'fn_search_form_pop');

/* ----------------------------------------- */

## Scroll to Top button
## see assets/js/scrolltop

function fn_scroll_up($attr) {
    load_assets(array('scrolltop'));
    global $wp;

    $args = shortcode_atts( array(
        'echo'  => 0,
    ), $attr );

    global $wp;
    $current_url = home_url($wp->request);
    
    $scroll = '';
    $scroll .= "<a class=\"dflex-center\" href=\"{$current_url}/#\">";
    $scroll .= fa_icon('angle_up');
    $scroll .= "<span class=\"novisual\">up</span>";
    $scroll .= "</a>";
 
    $output = tag_wrap('scroll-up', $scroll); 

    if($args['echo'] == 1)
        echo $output;

    return $output;
}

add_shortcode('scroll-up', 'fn_scroll_up');