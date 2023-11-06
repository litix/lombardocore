<?php
define ("VER", "3.2");
define ("LOG", "06-13-2023");
define ("TEMPLATE", "TD-3.2");

## TODO
## LINK functions/builder/lib-helper.php

/*-----------------------------------------------------------------------------*/ 

/* #region - VARIABLES */
    
    global $font_array;
    //increase site speed if you fill this out
    $font_array = array(
        //'montserrat-400' => 'fonts/montserrat/montserrat-v25-latin-regular.woff2'
    );   

    /*--------------------------------------------------------------------------*/ 

    global $tpath, $spath, $t_assets, $s_assets;
    global $js, $theme, $ctheme, $elpath, $acf_assets;
    global $dir, $tpl, $tplf, $tp;

    /*
        get_stylesheet_directory     ->  /var/www/yoursite/wp-content/themes/child_theme
        get_template_directory       ->  /var/www/yoursite/wp-content/themes/parent_theme

        get_stylesheet_directory_uri ->  https://example.com/wp-content/themes/child_theme
        get_template_directory_uri   ->  https://example.com/wp-content/themes/parent_theme
    */

    $tpath       = get_template_directory_uri();
    $spath       = get_stylesheet_directory_uri();

    $t_assets    = "{$tpath}/assets/";
    $s_assets    = "{$spath}/assets/";

    $js          = "{$tpath}/assets/js/";  
    $jtheme      = "{$tpath}/assets/theme";
    $ctheme      = "{$spath}/assets/theme";

    $elpath      = "{$tpath}/elements/";
    $acf_assets  = "{$tpath}/functions/builder/acf-assets/";
    

    $dir         = get_template_directory();

    $tpl         = "{$dir}/template-parts/_template";
    $tplf        = "{$tpath}/template-parts/_template";
    $tp          = "{$tpath}/template-parts/";

/* #endregion */

/*-----------------------------------------------------------------------------*/ 

/* #region - FILES AND FOLDERS */

    require_once get_template_directory() . '/assets/mce/mce.php'; 

    ## ENQUEUE
    include 'wp/wp_enqueue.php';               ## LINK functions/wp/wp_enqueue.php
    include 'wp/wp_assets.php';                ## LINK functions/wp/wp_assets.php

    if (class_exists('ACF') and class_exists('ACFE')) {
    
        include 'builder/index.php';            ## LINK functions/builder/index.php
        include 'wp/wp_features.php';           ## LINK functions/wp/wp_features.php
        include "{$tpl}/.template.php";         ## LINK template-parts/.template/.template.php

        include 'shortcode/index.php';          ## LINK functions/shortcode/index.php
        include 'wp/wp_ajax.php';               ## LINK functions/wp/wp_ajax.php

        catsandbox();    
    }

/* #endregion */

/*-----------------------------------------------------------------------------*/ 

/* #region - ERROR CHECKER */

    global $acf_error, $acfe_error, $no_fields;
    $errors = 0;

    if(!class_exists('ACF')) { 
        $acf_error = 1; 
        $errors++;
    }

    if(!class_exists('ACFE')) {
        $acfe_error = 1; 
        $errors++;
    }

    /*
    $acf_error = 1; 
    $acfe_error = 1;
    $errors++;
    */

    if(class_exists('ACF')) { 
        $group = acf_get_field_group('group_5f6d70f796c8f'); // your field group key
        if(!isset($group['active'])) {
            $no_fields = 1; 
            $errors++;        
        } 
    }

    //echo $errors;

    if($errors > 0) {
        if(!is_admin()) {           
            if ($GLOBALS['pagenow'] != 'wp-login.php')
                get_template_part('template-parts/error/plugin'); 
        }
    }

/* #endregion */

?>