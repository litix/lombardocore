<?php

/* SETUP : THEME SETTINGS */

global $pro_folder;
include $pro_folder . 'templates.php';

/* OVERRIDES :
   1. menu
   2. font
*/
function pro_menu_override(){ 
    $menu_override_ts = get_field('menu_override',  'theme-settings'); 
    return $menu_override_ts;
}

function pro_font_override(){ 
    $font_override_ts = get_field('override_fonts', 'theme-settings');
    if(get_prototype() == true) {
        return $font_override_ts;
    } else {
        return false;
    }
}

/*------------------------------------------------*/
/* GET BUILDER MENU ++                            */  
/* CLASS: Adv_Menu of Basic_Menu                  */
/*------------------------------------------------*/

global $adv_menu;

function check_menu_override($var){
    $menu_override_ts = pro_menu_override();
    $ext_version_ts   = get_field('menu_extension', 'theme-settings');
    $menu_version_ts  = get_field('menu_selection', 'theme-settings');
    
    if($menu_override_ts != true){ 
        return 'none'; 
    }      
    if($var == 'menu') { return $menu_version_ts; }
    if($var == 'ext')  { return $ext_version_ts;  }
}

class Adv_Menu extends Basic_Menu { 
    
    public function check_setup(){
        global $prototype;
        $this->setup = $prototype;
    }
    
    /* MENUS see templates */
    public function pro_menu($menu_version) {
        global $menu_theme_array;
        foreach($menu_theme_array as $menu_ver => $menu_file) 
        {
            if($menu_version == $menu_ver){
                $this->adv_menu = get_template_part($menu_file);
            } 
        }        
    }
    
    /* EXTENSION see templates */
    public function pro_menu_ext($ext_version) {
        global $menuextra_theme_array;
        foreach($menuextra_theme_array as $ext_ver => $ext_file) 
        {
            if($ext_version == $ext_ver){
                $this->adv_ext = get_template_part($ext_file);
            } 
        }        
    }    

}

    $adv_menu = new Adv_Menu(); 

    function pro_nav(){
        global $adv_menu, $basic_menu;
        $version = check_menu_override('menu');
        $adv_menu->pro_menu($version);
    }

    function pro_nav_ext(){
        global $adv_menu, $basic_menu;
        $version = check_menu_override('ext');

        $adv_menu->pro_menu_ext($version);
    }

/*------------------------------------------------*/
/* SETTINGS : THEME LOADER                        */
/*------------------------------------------------*/
#USED FOR TEMPLATES :
function pro_theme_loading(){
    
    global $tpath;
    $css_folder = $tpath . '/elements/assets/theme/';
    
    $i = 0;
    if( have_rows('theme_loader', 'theme-settings') ): 
    while( have_rows('theme_loader', 'theme-settings') ): 
    the_row();        
    
        if($name = get_sub_field('name')):
            $name = clean_text($name) . $i . '_css';
        else:
            $name = 'uploadtheme_' . $i . '_css';
        endif;
        
        if($css = get_sub_field('theme')):
            $css = $css_folder . $css;
            wp_enqueue_style( $name, $css);
        endif;
    $i++;
    endwhile; 
    endif; 

}

add_action( 'wp_enqueue_scripts', 'pro_theme_loading', 21 ); 
add_action( 'admin_enqueue_scripts', 'pro_theme_loading', 20);


/*------------------------------------------------*/
/* SETTINGS : FONT LOADER                         */
/*------------------------------------------------*/
#ADD FONT CSS :
function pro_font_loading(){
    global $tpath;
    $css_folder = $tpath . '/assets/fonts/';

    $i = 0;
    if( have_rows('font_loader', 'theme-settings') ): 
    while( have_rows('font_loader', 'theme-settings') ): 
    the_row();        

        if($name = get_sub_field('name')):
            $name = clean_text($name) . $i . '_css';
        else:
            $name = 'uploadtheme_' . $i . '_css';
        endif;

        if($css = get_sub_field('font_css')):
            $css = $css_folder . $css;
            wp_enqueue_style( $name, $css);
        endif;
    $i++;
    endwhile; 
    endif;           
}

function adv_fonts() {
   if(pro_font_override() == true):
        wp_dequeue_style('fonts');
        pro_font_loading();
        preload_fonts();
   else:
        site_fonts(); /* enqueue */ 
   endif; 
}

add_action( 'wp_enqueue_scripts', 'adv_fonts', 31 ); 
add_action( 'admin_enqueue_scripts', 'adv_fonts', 31 ); 



/*------------------------------------------------*/
/* SETTINGS : FONT INPUT                          */
/*------------------------------------------------*/
/*
function manual_fonts() {
    if(get_persona() == true):     
        
     global $tpath, $elpath, $null_font;    
     $font_folder = $elpath . 'theme/fonts/';
        
        if( have_rows('font_input', 'theme-settings') ): 
        while( have_rows('font_input', 'theme-settings') ): 
        the_row();     
        
            $check = get_sub_field('font_family');
            
            $start  = "\n@font-face { \n";
            $family = "font-family: '" . get_sub_field('font_family') . "'; \n";
            $style  = "font-style: " . get_sub_field('font_style')  . "; \n";
            $weight = "font-weight: " . get_sub_field('font_weight') . "; \n";
            $src    = "src: local('" . get_sub_field('local1')      . "'), \n"; 
            if(get_sub_field('local2')) {
              $src .= "local('" . get_sub_field('local2')      . "'), \n";
            }
            $woff   = get_sub_field('woff');
            $woff2  = $woff . '2'; 
                
            $url    = "url('" . $font_folder . $woff2 . "') format('woff2'), \n";
            $url   .= "url('" . $font_folder . $woff . "') format('woff');  \n";
            $swap   = "font-display: swap;";
            $end    = "\n}\n\n";
            
            if($check):
                $fonts .= $start . $family . $style . $weight . $src . $url . $swap . $end;
            endif;
        
        endwhile; 
        endif;     
        
        if($null_font == true) {     
            $style = "<style>" . $fonts . '</style>';
            echo $style;
        }
        
        endif;
    }
    
    add_action('wp_head', 'manual_fonts', 100);
*/


/*------------------------------------------------*/
/* SETTINGS : EXTENSION IN THE FUTURE             */
/*------------------------------------------------*/
/* ADV BUILDER SETUP */
class BPrototype {

    public $setup;
    
    /* ADV THEME SETTING OPTIONS PAGE */
    public function set_options_page() {
        if( function_exists('acf_add_options_page') ) {
            acf_add_options_page(array(
                'page_title' => 'Theme Settings',
                'menu_title' => 'Theme Settings',
                'menu_slug' => 'theme-settings',
                'capability' => 'edit_posts',
                'position' => '3',
                'parent_slug' => '',
                'icon_url' => 'dashicons-hammer',
                'redirect' => true,
                'post_id' => 'theme-settings',
                'autoload' => false,
                'update_button' => 'Update',
                'updated_message' => 'Options Updated',
            ));          
        }
    }
        
}    

if($prototype == true):
    $Builder = new BPrototype();
    
    #$Builder->check_setup($prototype);
    $Builder->set_options_page();
endif;
 

/*------------------------------------------------*/
/* ADMIN ~ FAUX LOGIN                             */
/*------------------------------------------------*/

add_action( 'admin_enqueue_scripts', 'load_admin_style' );
function load_admin_style() {
    wp_register_style('admin_css', 
                      get_template_directory_uri() . '/assets/css/admin.css', 
                      false, 
                      '1.0.0');
}

/* #region - FILES AND FOLDERS */
    /* CLIENT INFO */
    global $pro_folder;

    $pro_folder = get_template_directory() . '/functions/builder-pro/';

    function pro_config(){
        do_action('pro_config');
    }

    /*-----------------------------------------------------------------------------*/    

    if (class_exists('ACF') and class_exists('ACFE')) {
        include $pro_folder . 'pro-setup.php';     /* Element Settings */
    }  

    if ( class_exists( 'WooCommerce' ) ) { 
        include 'functions/builder-pro/woocommerce.php';    
    }
/* #endregion */

/* #region - MENU LOADERS -----------------------------*/

    // see : pro-setup.php, bd-setup.php

    global $pro_template;
    $pro_template = 'template-parts/.template';


    ## TEMPLATE : MENU
    global $menu_template;
    $menu_template   = array(
        'none'       => 'template-parts/header-default',
        'ver-1'      => 'template-parts/.template/header-menu-1',
        'ver-2'      => 'template-parts/.template/header-menu-2',
    ); 

    ## TEMPLATE : MENU EXTENSION
    global $ext_template;
    $ext_template     = array(
        'none'        => 'template-parts/menu-extension-default',
        'pop-search'  => 'template-parts/.template/header-pop-search',
    );   

    ## TEMPLATE : FOOTER
    global $footer_template;
    $footer_template = array(
        'none'       => 'template-parts/footer-default',
        'ver-1'      => 'template-parts/.template/footer-1',
    ); 

    ## TEMPLATE : 404
    global $f404_template;
    $f404_template = array(
        'none'       => 'template-parts/404-default',
        'ver-1'      => 'template-parts/.template/404-1',
    );     

    ## TEMPLATE : SEARCH
    global $search_template;
    $search_template = array(
        'none'       => 'template-parts/search-loop-default',
        'ver-1'      => 'template-parts/.template/search-loop-1',
    ); 

    ## TEMPLATE : ARCHIVE
    global $single_template;
    $single_template = array(
        'none'       => 'template-parts/single-default',
        'ver-1'      => 'template-parts/.template/single-1',
    ); 

    ## TEMPLATE : SINGLE
    global $archive_template;
    $archive_template = array(
        'none'       => 'template-parts/archive-default',
        'ver-1'      => 'template-parts/.template/archive-1',
    ); 


    /* -------------------------------------------------------------- */  

    function load_pro_menuext($field) {

        $menuext_choices = array(
            'none'       => 'Default',
            'pop-search' => 'Pop Search',        
        );      

        $field['choices'] = array();

        foreach( $menuext_choices as $id => $name ) :
            $field['choices'][$id] = $name;    
        endforeach;    

        return $field;
    }  

    add_filter('acf/load_field/name=menu_extension', 'load_pro_menuext'); 

    /* -------------------------------------------------------------- */  

    function load_pro_menu($field) {
        $folder = 'ver_menu';
        $versions = version_ctr($folder);
        
        $choices = array('none' => ver_display($folder, 'ver-0'));

        for ($i = 1; $i <= $versions; $i++) {
            $b = array("ver-{$i}" => ver_display($folder, "ver-{$i}"));
            array_push($choices, $b);
        }    

        $field['choices'] = array();

        foreach( $choices as $id => $name ) :
            $field['choices'][$id] = $name;    
        endforeach;    

        return $field;
    }

    add_filter('acf/load_field/name=menu_selection', 'load_pro_menu');    

    /* -------------------------------------------------------------- */  

    function load_pro_footer($field) {
        $folder = 'ver_footer';
        $versions = version_ctr($folder);
        
        $choices = array('none' => ver_display($folder, 'ver-0'));
        for ($i = 1; $i <= $versions; $i++) {
            $b = array("ver-{$i}" => ver_display($folder, "ver-{$i}"));
            array_push($choices, $b);
        }    
        $field['choices'] = array();

        foreach( $choices as $id => $name ) :
            $field['choices'][$id] = $name;    
        endforeach;    

        return $field;
    }

    add_filter('acf/load_field/name=footer_selection', 'load_pro_footer');   

    /* -------------------------------------------------------------- */ 

    function load_pro_404($field) {
        $folder = 'ver_404';
        $versions = version_ctr($folder);
        
        $choices = array('none' => ver_display($folder, 'ver-0'));
        for ($i = 1; $i <= $versions; $i++) {
            $b = array("ver-{$i}" => ver_display($folder, "ver-{$i}"));
            array_push($choices, $b);
        }    
        $field['choices'] = array();

        foreach( $choices as $id => $name ) :
            $field['choices'][$id] = $name;    
        endforeach;    

        return $field;
    }

    add_filter('acf/load_field/name=404_selection', 'load_pro_404'); 

    /* -------------------------------------------------------------- */ 

    function load_pro_search($field) {
        $folder = 'ver_search';
        $versions = version_ctr($folder);
        
        $choices = array('none' => ver_display($folder, 'ver-0'));
        for ($i = 1; $i <= $versions; $i++) {
            $b = array("ver-{$i}" => ver_display($folder, "ver-{$i}"));
            array_push($choices, $b);
        }    
        $field['choices'] = array();

        foreach( $choices as $id => $name ) :
            $field['choices'][$id] = $name;    
        endforeach;    

        return $field;
    }

    add_filter('acf/load_field/name=search_selection', 'load_pro_search'); 

    /* -------------------------------------------------------------- */ 

    function load_pro_single($field) {
        $folder = 'ver_single';
        $versions = version_ctr($folder);
        
        $choices = array('none' => ver_display($folder, 'ver-0'));
        for ($i = 1; $i <= $versions; $i++) {
            $b = array("ver-{$i}" => ver_display($folder, "ver-{$i}"));
            array_push($choices, $b);
        }    
        $field['choices'] = array();

        foreach( $choices as $id => $name ) :
            $field['choices'][$id] = $name;    
        endforeach;    

        return $field;
    }

    add_filter('acf/load_field/name=single_selection', 'load_pro_single'); 

    /* -------------------------------------------------------------- */ 

    function load_pro_archive($field) {
        $folder = 'ver_archive';
        $versions = version_ctr($folder);
        
        $choices = array('none' => ver_display($folder, 'ver-0'));
        for ($i = 1; $i <= $versions; $i++) {
            $b = array("ver-{$i}" => ver_display($folder, "ver-{$i}"));
            array_push($choices, $b);
        }    
        $field['choices'] = array();

        foreach( $choices as $id => $name ) :
            $field['choices'][$id] = $name;    
        endforeach;    

        return $field;
    }

    add_filter('acf/load_field/name=archive_selection', 'load_pro_archive'); 

    /* -------------------------------------------------------------- */ 

 /* #endregion */

/* #region - WOOCOMMERCE -----------------------------*/

     /*------------------------------------------------*/
    /* WOOCOMMERCE                                    */
    /*------------------------------------------------*/
 
     /* stop generating thumbnails damnit */
     if ( class_exists( 'WooCommerce' ) ) {
         function add_image_insert_override($sizes){
             /*
             unset($sizes['thumbnail']);
             unset($sizes['medium']);
             unset($sizes['medium_large']);
             unset($sizes['large']);
             */
             unset($sizes['1536x1536']);
             unset($sizes['2048x2048']);        
             unset($sizes['blog-isotope']);
             unset($sizes['product_small_thumbnail']);
             unset($sizes['shop_catalog']);
             unset($sizes['shop_single']);
             unset($sizes['shop_single_small_thumbnail']);
             unset($sizes['shop_thumbnail']);
             unset($sizes['woocommerce_thumbnail']);
             unset($sizes['woocommerce_single']);
             unset($sizes['woocommerce_gallery_thumbnail']);
             return $sizes;
         }
         add_filter('intermediate_image_sizes_advanced', 'add_image_insert_override' );
         #add_filter('max_srcset_image_width', create_function('', 'return 1;'));
     }
     /* 
     Used for styling :
     Requirements : 1. you should know how to edit woocommerce theme
     */
     function mytheme_woocommerce() {
         add_theme_support( 'woocommerce' );
     }
     // add_action( 'after_setup_theme', 'mytheme_woocommerce' );
 
     /* Abort woocommerce on non-shop pages */
     function unload_wc_assets() {
         if ( ! class_exists( 'WooCommerce' ) ) {
             return; 
         }
 
         // abort
         if ( is_woocommerce() || is_cart() || is_checkout() || is_page( array( 'my-account' ) ) ) {
             return;
         }
 
         remove_action('wp_enqueue_scripts', 
                     [ WC_Frontend_Scripts::class, 'load_scripts' ] );
         remove_action('wp_print_scripts', 
                     [ WC_Frontend_Scripts::class, 'localize_printed_scripts' ], 5 );
         remove_action('wp_print_footer_scripts', 
                     [ WC_Frontend_Scripts::class, 'localize_printed_scripts' ], 5 );
     }
 
     add_action( 'get_header', 'unload_wc_assets' );
 
/* #endregion */
 
?>