<?php 
# SHORT CODES ver 2.0 (01.01.2023)
// check lib-theme-opt-init

## Information // see lib-theme-opt-init

// see short-code-info
# theme_info()        
# theme_logos()       
# theme_social()      
# theme_footer()
# theme_contact()

# theme_menu_ext()
# theme_footer_menu()
# theme_placeholder()

/* ----------------------------------------- */

#GUIDE (shortcode)

// creating a simple shrotcode : 
// [hello]
function _hello() { 
    echo "<h4>Hello World<h4>";
}

add_shortcode('hello', '_hello');


// creating args shrotcode : 
// [postlink url="https://google.com" title="google" target="_blank"]

function _postlink($attr) {
    $args = shortcode_atts( array(
            'url' => '#',
            'title' => '',
            'target' => '_self'
    ), $attr );    
       
    $con = "<a href=\"{$args['url']}\" target=\"{$args['target']}\">{$args['title']}</a>";
    return $con;
}
 
function _postlink_init() {
    add_shortcode('postlink', '_postlink');
}
 
add_action('init', '_postlink_init');

// creating args with close tags
// [sc_atts text="hello" data="world"]your text[/sc_atts]

function _sc_atts($atts, $content, $tag) {
    $args = shortcode_atts( array(
        'text' => '',
        'data' => '',
        'link' => '#',
        'link_text' => 'Button',
    ), $atts );    

    $text = $args['text'];
    $text = strip_tags($text, '<b>, <h6>, <br>, <em>');

    $con  = "<a href=\"{$args['link']}\" class=\"box sample-cta\">";
    $con .= "<div class=\"content\">";
    $con .= "<div class=\"title\">{$text}</div>";
    $con .= "<div class=\"text\">{$content}</div>";    
    $con .= "</div>";
    $con .= "<button class=\"btn btn-a\"><span>{$args['link_text']}</span></button>";
    $con .= "</a>";

    return $con;
}    
function _sc_atts_init(){ add_shortcode('sc_atts', '_sc_atts'); }
 
add_action('init', '_sc_atts_init');

// close tags no args
// [box]sample[/box]

function _boxme($atts, $content, $tag) {
    $con = "<div class=\"box\">{$content}</div>";   
    return $con;
}
function _boxme_init(){ add_shortcode('box', '_boxme'); }
 
add_action('init', '_boxme_init');

?>