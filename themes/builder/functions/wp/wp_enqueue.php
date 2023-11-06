<?php
## Enqueue 10.01.23
## It is encouraged to use child theme functions 
## enqueue your stuff there not here

/* -------------------------------------------------------- */

/* #region - [1] BOOTSTRAP */

    function bootstrap_wp() {
        $v = 4.6;
        $ver = constant('VER');

        global $js, $t_assets;  
        $bs = $js . 'bootstrap/css/';
        //https://getbootstrap.com/docs/4.6/getting-started/introduction/

        ## CSS
        wp_register_style('bs-reboot', $bs . 'bootstrap-reboot.min.css', '', $v); 
        wp_register_style('bs-grid',   $bs . 'bootstrap-grid.min.css', '', $v);   
        wp_register_style('bs-base',   $bs . 'min/basic.css', '', $v); 
        wp_register_style('bs-full',   $bs . 'bootstrap.css', '', $v); //load assets

        wp_enqueue_style('bs-reboot');    // reboot
        wp_enqueue_style('bs-grid');      // flex grid
        wp_enqueue_style('bs-base');      // bootstrap css

        ## Overrider - Base CSS
        wp_register_style('base_css',   $t_assets . 'css/base.css', '', $ver);    
        wp_register_style('datas_css',  $t_assets . 'css/datas.css', '', $ver);
        wp_enqueue_style('base_css');   // base css
        wp_enqueue_style('datas_css');  // data css
    }

    add_action( 'wp_enqueue_scripts', 'bootstrap_wp', 1 ); 

/* #endregion */


/* #region - [2] BASE MENU */

    function bd_menu_addon() { 
        $ver = constant('VER');

        global $t_assets;

        ## base menu
        wp_register_style('basemenu_css',   $t_assets . 'theme/base-menu.css', '', $ver);    
        wp_enqueue_style('basemenu_css');  
    }    

    add_action( 'wp_enqueue_scripts', 'bd_menu_addon', 2 ); 

/* #endregion */


/* #region - [25] STYLE (Parent)   */

    function your_theme_css() { 
        $ver = constant('VER');
        
        global $tpath, $spath;

        ## !native jQuery
        wp_enqueue_script('jquery');  

        wp_enqueue_style('main-style', get_stylesheet_uri());            
        wp_enqueue_style('mobile_css', $spath  . '/style-mobile.css', '', $ver);
    }    

    add_action( 'wp_enqueue_scripts', 'your_theme_css', 25 ); 

/* #endregion */


/* #region - [30] FONTS  */

    ## LINK functions/builder/lib-init-template-fonts.php

/* #endregion */


/* #region - HOOKS / SHORTCODE / FUNCTIONS */

    function after_body_hook() {
        // after <body> tag
        do_action('add_after_body_hook');
    }

    function add_ticker() {
        do_shortcode('[ticker echo="1"]');
    }

    add_action( 'add_after_body_hook', 'bd_default_scripts' );
    add_action( 'add_after_body_hook', 'add_ticker' );

    ## CHECK IF CHILD EXIST
    function check_child_css($filename = '') {
        global $ctheme, $jtheme;
        
        $dir = get_stylesheet_directory();
        $file = "{$dir}/assets/theme/{$filename}";

        if (file_exists($file)) { 
            return "{$ctheme}/{$filename}";
        } else {
            return "{$jtheme}/{$filename}";
        }
        
    }


/* endregion; */


/* #region - [20] DEFAULT SCRIPTS */

    function bd_default_scripts() {

        global $t_assets, $tpath, $spath, $js, $jtheme;  

        ## Lazyload 
        ## https://github.com/verlok/vanilla-lazyload

        wp_register_script('lazyload_js',   $js . 'lazyload/lazyload.amd.min.js','', 17.8);  
        wp_enqueue_script('lazyload_js');    


        ## Fancybox
        ## https://fancyapps.com/docs/ui/fancybox/

        wp_register_style('fancybox_css',   $js . 'fancyboxv4/fancybox.css','',4.1);
        wp_register_script('fancybox_js',   $js . 'fancyboxv4/fancybox.umd.js','', 4.1);
        
        wp_enqueue_style('fancybox_css');  
        wp_enqueue_script('fancybox_js');       


        ## ON APPEAR
        wp_register_script('appear_js',     $js . 'appear/jquery.appear.js','',1.1);    
        wp_enqueue_script('appear_js');


        ## BASE SCRIPT
        wp_register_script('base-script_js', $jtheme . '/base-script.js','', 1.1);
        wp_enqueue_script('base-script_js');

        ## MODALS
        wp_register_style('addon-modals_css', $jtheme . '/addon-modals.css','', 1.1);
        wp_enqueue_style('addon-modals_css');  
        
    }

    function bd_custom_scripts() { 
        global $spath;
        wp_register_script('script_js',     $spath  . '/script.js','', 1.1);        
        wp_enqueue_script('script_js');
    }

    add_action( 'get_footer', 'bd_custom_scripts' );


/* #endregion */


/* #region - [20] [25] ADMIN RENDER */

    ## base styles and script
    function bd_admin_base($hook) {
        
        global $t_assets, $js;
        
        $adm = $t_assets . 'admin/';
        $css = $t_assets . 'css/';   

        wp_enqueue_style('bs-grid',      $js  . 'bootstrap/css/bootstrap-grid.min.css'); 
        wp_enqueue_style('bs-base',      $js  . 'bootstrap/css/min/basic.css');        
        wp_enqueue_style('base',         $css . 'base.css');   
        wp_enqueue_style('datas',        $css . 'datas.css');
        wp_enqueue_style('override',     $adm . 'layout.css');

        wp_enqueue_style('addon-modals_css');

        wp_enqueue_script('layoutJS',    $adm . 'layout.js', array ( 'jquery' ), 1.1, true);
        wp_enqueue_script('lazyload_js', $js  . 'lazyload/lazyload.amd.min.js');  

        wp_localize_script('layoutJS',   'adminLocal', ['directory' => get_stylesheet_directory_uri() ]);       
    }
        
    add_action('admin_enqueue_scripts', 'bd_admin_base', 20);


    ## main style
    function bd_admin_render($hook) {
        global $spath;   
        wp_enqueue_style('previewer',    $spath  . '/style.css');
    }
        
    add_action('admin_enqueue_scripts', 'bd_admin_render', 25);


    ## resources
    function admin_resources( $current_page ) {
        global $t_assets;

        wp_enqueue_style( 'custom-admin-styles', $t_assets . 'admin/admin.css' );

        if ( $current_page == 'post.php' || $current_page == 'post-new.php' ) {
            wp_enqueue_script( 'acf-admin-js', $t_assets .'admin/admin.js', rand(1,100) );
            wp_localize_script('acf-admin-js', 'adminLocal', ['directory' => get_template_directory_uri() ]);
        }
    }

    add_action( 'admin_enqueue_scripts', 'admin_resources' );

/* #endregion */

## Assets
## LINK functions/wp/wp_assets.php