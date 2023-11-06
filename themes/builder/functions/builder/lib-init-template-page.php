<?php 
# WP PAGE CLASS
# https://codex.wordpress.org/Conditional_Tags
# Adds css-class on a page for css editing purposes
# ACF : Page Settings Options

function builder_class() {

    global $post;
    $cpt = get_post_type();
    
    if(is_page()){ $default = 'page-builder page-inner'; }   
    if(is_front_page()){ $default = 'page-home'; }

    $page = page_settings();
    $pageclass = $page['page_class'];

    $classes = array($default, $pageclass);
    $class   = implode(" ", $classes);

    return $class;
}

function page_settings() {
    global $post;
    
    if(isset($post->ID)) {
        $page = $post->ID;

        $opt = get_field('page_settings', $page);

        $class1 = '';
        $class2 = '';

        if(isset($opt['menu_overlay'])) {
            if($opt['menu_overlay'] == true) {
                $class1 = "menu-overlay";
            }
        }

        if(isset($opt['hide_menu'])) {
            if($opt['hide_menu'] == true) {
                $class2 = "dnone";
            }
        }

        ## menu class
        $mclasses = array($class1, $class2);
        $mclass = implode(" ", $mclasses);

        ## page class
        $page_class = '';

        if(isset($opt['page_class']))
            $page_class = esc_html($opt['page_class']);

        $page_option = array(
            'menu_class'    => $mclass,
            'page_class'    => $page_class,
        );

        return $page_option;
    }
}

add_filter( 'body_class', function( $classes ) {
    global $post;
    ## page class
    $page_class = '';

    if(isset($post->ID)) {
        $page = $post->ID;
        $opt = get_field('page_settings', $page);

        if(isset($opt['page_class']))
            $page_class = esc_html($opt['page_class']);           
    }

	return array_merge( $classes, array( $page_class ) );

} );

?>