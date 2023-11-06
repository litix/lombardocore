<?php 
# HEADER
# features and functions that customizes the header
# fields are under PAGE SETTINGS and THEME OPTIONS

# options :
# FIXED HEADER | NO HEADER 
# STIKCY LOGO | STICKY MENU | MENU POSITION | WIDTH

## LINK functions/builder/lib-conf-opt-menu.php

/* #region */

function header_class($ver='') {
    
    $page = page_settings();

    $page_menu_class = '';

    if(isset($page['menu_class']))
        $page_menu_class = $page['menu_class'];
       
    $logo   = nav_sticky_logo();
    $sticky = nav_sticky();
    $posn   = nav_position();
    $width  = nav_width();
    $anima  = nav_animated();

    $classes = array('header header-menu', 'element', $page_menu_class, $ver);
    $classes = implode(" ", $classes);
    
    $header_class = "class=\"$classes\"";

    $datas = array($logo, $sticky, $posn, $width, $anima);
    $datas = implode(" ", $datas);

    $header_attr = implode(" ", array($datas, $header_class));

    echo $header_attr;
}

/* #endregion */

?>