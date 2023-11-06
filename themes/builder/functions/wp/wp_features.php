<?php 
## WP FEATURES
## Updated : 03/26/2023 

/*-----------------------------------------------------------------------------*/ 

/* #region - MAIN MENU  */
    
    ## ANCHOR[id=menu]

    //register_nav_menu('main', 'main menu'); 

    ## remove ID from menu
    function remove_menu_id($id, $item, $args) { return ""; }
    add_filter('nav_menu_item_id', 'remove_menu_id', 10, 3);

/* #endregion */ 

/* #region - Variables  */

global $FLT_search, $CPT_deindex, $CPT_deindex_a; 
global $COUNT_search, $COUNT_archive, $PAGE_revision, $POST_revision;

$FLT_search     = array('post', 'page');

$REM_wpblocks   = true;
$REM_comments   = true;
$REM_emoji      = true;
$REM_thumbs     = false;
$REM_p_img      = true;
$HI_resimage    = false;
$RE_cache       = false;

$PAGE_revision  = 0;
$POST_revision  = 5;

$LAZY           = true;
$TEMP_src       = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
$TEMP_vsrc      = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';

$TTL_override   = true;
$RED_404        = false;

$COUNT_search   = 9;
$COUNT_archive  = 9;
$CPT_deindex    = array('media');
$CPT_deindex_a  = array();

/*-----------------------------------------------------------------------------*/ 

if($f = theme_config_feats()) { 
    $LAZY           = $f['lazy'];
    $REM_wpblocks   = $f['wpblocks'];
    $REM_comments   = $f['wpcomments'];
    $REM_emoji      = $f['wpemoji'];
    $REM_thumbs     = $f['wpthumbs'];
    $REM_p_img      = $f['wpptag'];
    $HI_resimage    = $f['wphires'];
    $TTL_override   = $f['wptitle'];
    $RED_404        = $f['wp404'];
    $RE_cache       = $f['wprecache'];    

    $r = $f['revisions'];
    $PAGE_revision  = $r['page_revision'];
    $POST_revision  = $r['post_revision'];

    $d = $f['display'];
    $COUNT_search   = $d['search_count'];
    $COUNT_archive  = $d['archive_count'];  
    
    $FLT_search     = $f['filter_search'];    
    $CPT_deindex    = $f['deindex'];  
    $CPT_deindex_a  = $f['deindex_a']; 
}

/* #endregion */ 

/* #region - LAZY Settings  */

    ## ANCHOR[id=lazy]

    define ("LAZY", $LAZY);
    define ("TEMP_SRC", $TEMP_src);
    define ("TEMP_VSRC", $TEMP_vsrc);

/* #endregion */          

/* #region - Element Background Feature (Settings) */

    ## 1. Background Color
    function default_BGCOLOR() {
        $default_color = array('White', 'Black', 'Grey', 'Transparent');
        return $default_color; 
    }

    add_filter('BGCOLOR', 'default_BGCOLOR');

    ## 1. Overlay
    function default_BGOVERLAY() {
        $default_color = array('overlay-1', 'overlay-2', 'overlay-3');
        return $default_color; 
    }

    add_filter('BGOVERLAY', 'default_BGOVERLAY');

/* #endregion */

/* #region - Remove <p> wrapping images in wysiwyg  */

    function filter_content_images($content){
        return preg_replace(
            '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content
        );
    }
    
    if($REM_p_img == true)
        add_filter('the_content', 'filter_content_images');

/* #endregion */

/* #region - limit the number of thumbnails  */

    ## ANCHOR[id=thumbnail]

    function unset_thumbnails($sizes){
        unset( $sizes['thumbnail']);
        //unset( $sizes['medium']);
        //unset( $sizes['medium_large']);
        unset( $sizes['large']); 
        unset( $sizes['1536×1536'] );
        unset( $sizes['2048×2048'] );    
        return $sizes;
    }

    if($REM_thumbs == true)
        add_filter('intermediate_image_sizes_advanced', 'unset_thumbnails' ); 

/* #endregion */

/* #region - Disable image-scaled.jpg  */

    if($HI_resimage == false)
        add_filter( 'big_image_size_threshold', '__return_false' );

/* #endregion */

/* #region - Disable comments  */

    ## ANCHOR[id=comments]

    function remove_comment_menu(){
        remove_menu_page( 'edit-comments.php' );
    }

    function remove_pp_comments(){
        remove_post_type_support( 'post', 'comments' );
        remove_post_type_support( 'page', 'comments' );
    }
    
    function remove_comment_bar() {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('comments');
    }

    if($REM_comments == true):
        add_action('admin_menu', 'remove_comment_menu');
        add_action('init', 'remove_pp_comments' );
        add_action('wp_before_admin_bar_render', 'remove_comment_bar' );
    endif;

/* #endregion */

/* #region - Redirect 404 page  */

    ## ANCHOR[id=404]

    function redirect_404(){
        if(is_404()):
            wp_safe_redirect( home_url('/') );
            exit;
        endif;
    }

    if($RED_404 == true)
        add_action( 'template_redirect',  'redirect_404'  );

/* #endregion */

/* #region - Count per page  */

    ## ANCHOR[id=count]

    function set_posts_per_page( $query ) { 
        
        global $wp_the_query, $COUNT_search, $COUNT_archive; 

        if ( ( ! is_admin() ) && ( $query === $wp_the_query ) && ( $query->is_search() ) ) {
            $query->set( 'posts_per_page', $COUNT_search );
        }
        elseif ( ( ! is_admin() ) && ( $query === $wp_the_query ) && ( $query->is_archive() ) ) {
            $query->set( 'posts_per_page', $COUNT_archive );
        }
        return $query;
    }

    add_action( 'pre_get_posts',  'set_posts_per_page'  );

/* #endregion */

/* #region - Title Overriding               */

    ## ANCHOR[id=title]

    function theme_title_override() {
        add_theme_support( 'title-tag' );
    }

    if($TTL_override == true) {
        add_action( 'after_setup_theme', 'theme_title_override' );
    }    

/* #endregion */

/* #region - Title Overriding               */
/*
    function remove_name_company(){
        return 'Theme Options';
    }
    add_filter( 'company_name_fltr', 'remove_name_company', 10, 4 );
*/



    

/* #endregion */

/* #region - Limit Post and Page Revisions  */

    ## ANCHOR[id=revision]

    function page_revisions($num, $post) {
        global $PAGE_revision;

        if('page' == $post->post_type) $num = $PAGE_revision;
        return $num;
    }

    add_filter( 'wp_revisions_to_keep', 'page_revisions', 10, 2 );

    function post_revisions($num, $post) {
        global $POST_revision;

        if('post' == $post->post_type) $num = $POST_revision;
        return $num;
    }

    add_filter( 'wp_revisions_to_keep', 'post_revisions', 10, 2 );

/* #endregion */

/* #region - Enable/Disable Wp Blocks       */

    ## ANCHOR[id=wp_block]

    function remove_wp_blocks(){
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
        wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
    }

    if($REM_wpblocks == true) 
        add_action( 'wp_enqueue_scripts', 'remove_wp_blocks', 100 );

/* #endregion */

/* #region - Enable/Disable Emoji           */

    ## ANCHOR[id=emoji]

    if($REM_emoji == true) {
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
    }

/* #endregion */

/* #region - Search by Post Type            */

    ## ANCHOR[id=search]

    function cpt_search_filter($query) {
        global $FLT_search;

        if ( !is_admin() && $query->is_main_query() ) {
            if ($query->is_search) {
                $query->set('post_type', $FLT_search);    
            }
        }
    }

    add_action('pre_get_posts','cpt_search_filter');

/* #endregion */

/* #region - Redirect Post Type            */

    ## ANCHOR[id=deindex]

    function deindex_cpt() {
        global $post, $CPT_deindex;
        if ( is_single()) {
            $array = $CPT_deindex;
            
            if($array):
            foreach ($array as $a):

                $cpt = get_post_type();
                
                if($cpt == $a) {
                    add_filter( 'wp_robots', function( $robots ) {
                        if ( is_singular($a) ) {
                        $robots['noindex']  = true;
                        $robots['nofollow'] = true;
                        }
                        return $robots;
                    } );  

                    
                    if (is_singular($a)) {
                        wp_redirect( home_url(), 301 );
                        exit;          
                    }
                }
                
 
            endforeach;
            endif;
        }
    }

    add_action( 'template_redirect', 'deindex_cpt' );  

/* #endregion */

/* #region - Redirect Archive            */

    ## ANCHOR[id=archive]

    function deindex_cpt_archive($name='') {
        global $post, $CPT_deindex_a;

        $array = $CPT_deindex_a;
        
        if($array):

            $term = get_queried_object();
            if($term):
                $tax = $term->taxonomy;   

                foreach ($array as $a){     
                    if($tax == $a) {
                        
                        add_filter( 'wp_robots', function( $robots ) {
                            $robots['noindex']  = true;
                            $robots['nofollow'] = true;
                            return $robots;
                        } );  
                        
                        wp_redirect( home_url(), 301 );
                        exit;          

                    }
                }
            endif;
        endif;
    }

    add_action( 'wp_head', 'deindex_cpt_archive' );  

/* #endregion */

/* #region - Defer Scripts */

    ## ANCHOR[id=defer]

    function defer_script($tag, $handle, $src) {
        ## if autoptimize is disabled

        $js1 = array ('mheight_js','lazyload_js','bsmenu_js','script_js','appear_js', 'popper_js');
        $js2 = array ('owl_js', 'bootstrap_js','fancybox_js','ls_slider_js','shuffle_js','countto_js');
        $js3 = array (/* you scripts in enqueue */);
        
        $defer_these_js = array_merge($js1,$js2,$js3);

        foreach($defer_these_js as $js) 
        {
            if($handle == $js) { 
                return "<script defer id={$handle} src='$src'></script>\n"; 
            }
        }  

        return $tag;
    }
    add_filter( 'script_loader_tag', 'defer_script', 10, 3 );

/* #endregion */   

/* #region - Featured image */

    ## ANCHOR[id=thumbnail]

    add_theme_support( 'post-thumbnails' );

/* #endregion */

/* #region - HTML 5 Format for styles and scripts */

    ## ANCHOR[id=html5]

    add_action(
        'after_setup_theme',
        function() {
            add_theme_support( 'html5', [ 'script', 'style' ] );
        }
    );

/* #endregion */  

/* #region - Widget */

    ## Register WIDGET support (Rare)

    ## ANCHOR[id=widget]

    if ( function_exists('register_sidebar') )
        register_sidebar(array(
            'name' => 'Builder Widget',
            'before_widget' => '<div class = "widget dwidget">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        )
    );

/* #endregion */    

/* #region - Markers for readable view source  */

    ## ANCHOR[id=marker]

    function dstyle_marker($tag, $handle, $src) {
        if($handle == 'main-style') { 
        return "<!-- MAIN STYLE -->\n" 
        . '<link rel=\'stylesheet\' id=\'' . $handle . '\' href=\'' . $src . '\' media=\'all\'>' 
        . "\n\n"; 
        }
        
        if($handle == 'base_css') { 
        return "\n<!-- HANDLES -->\n" 
        . '<link rel=\'stylesheet\' id=\'' . $handle . '\' href=\'' . $src . '\' media=\'all\'>' 
        . "\n"; 
        }     
        
        if($handle == 'admin_css') { 
        return "<!-- ADMIN CSS -->\n" 
        . '<link rel=\'stylesheet\' id=\'' . $handle . '\' href=\'' . $src . '\' media=\'all\'>' 
        . "\n<!-- FONT CHECK -->\n"; 
        }      
        
        return $tag;
    }
        
    add_filter( 'style_loader_tag', 'dstyle_marker', 10, 3 );


    function dscript_marker($tag, $handle, $src) {
        if($handle == 'bootstrap_js') { 
            return "<script defer src='$src'></script>\n\n"; 
        }    
        if($handle == 'script_js') { 
            return "<!-- Builder Script -->\n<script defer src='$src'></script>\n"; 
        }
        return $tag;
    }

    add_filter( 'script_loader_tag', 'dscript_marker', 10, 3 );    



/* #endregion */

/* #region - Theme Options Menu  */

    ## ANCHOR[id=theme_options]

    function call_company($string) {

        $string = company_name();
        
        if($show = theme_config_toggle()){
            if($show['show_to_menu'] == true)
                $string = 'Theme Options';
        }

        return $string;
    }

    add_filter( 'company_name_fltr', 'call_company', 10, 3);


    do_action(theme_options_menu());

/* #endregion */

/* #region - ADMIN  */

    ## ANCHOR[id=admin]

    ## Admin URL
    function wp_logo_url($url) {
        return home_url();
    }

    add_filter('login_headerurl', 'wp_logo_url');

    ## Admin Logo
    function wp_login_logo() { 

        $logo = '';
        $theme_url = get_stylesheet_directory_uri();
        $e = theme_logos();

        if(isset($e['main_logo']))
            $logo = $e['main_logo'];

        if(!$logo) {
            $logo = $theme_url . '/images/placeholder/logo.svg';
        }
        
        $style  = "<style>";
        $style .= "#login h1 a { background: url({$logo}) no-repeat center center; }";
        $style .= '
                    .wp-core-ui #login h1 a {
                        margin: 0 0 10px;
                        width: auto;
                        opacity: 0.5;
                        transition: 0.5s;
                        background-size: 70%;
                        background-position: center;
                        height: 60px;
                    }
                    
                    .wp-core-ui #login h1 a:hover {
                        opacity: 1;
                    }
        ';
        $style .= "</style> \n";

        echo $style;
    }
    add_action( 'login_enqueue_scripts', 'wp_login_logo' );

/* #endregion */ 

/* #region - ReCache           */

    ## ANCHOR[id=rechache]
    function remove_css_js_version( $src ) {  
        if( strpos( $src, '?ver=' ) )  
            $src = remove_query_arg( 'ver', $src );  
            return $src;  
    }  

    if($RE_cache == true) {
        add_filter( 'style_loader_src', 'remove_css_js_version', 9999 );  
        add_filter( 'script_loader_src', 'remove_css_js_version', 9999 );
    }

/* #endregion */

/* #region - NOOB CHECK  */

    ## ANCHOR[id=noob]

    function noob_fonts() {
        global $t_assets;        
        wp_register_style('afont', $t_assets . 'fonts/raleway/font.css','','1.0');  
        wp_enqueue_style('afont');
    }

    function noob_check() {
        global $tpath;

        ## LINK instructions.php
        $filepath = get_template_directory() . '/instructions.php';
        
        if (file_exists($filepath)) { 
            include $filepath;
        }

        add_action( 'get_footer', 'noob_fonts');
    }   

/* #endregion */