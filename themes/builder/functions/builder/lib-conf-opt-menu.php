<?php 
# MENU
# Fields and options are at THEME OPTIONS
# features and functions that customizes the menu

# options :
# DROPDOWN TRIGGER | DROPDOWN ANIMATION | DROPDOWN ITEMS ANIMATION | *HEIGHT
# STICKY NAV LOGO | MENU WIDTH | MENU ALIGNMENT | STICKY ON/OFF

## see template-part : main-menu-X
## LINK functions/builder/lib-init-template-header.php

/*------------------------------------------------*/

/* #region ~ dropdown */
# Theme Options > header > menu_dropdown_display
# Theme Options > header > menu_dropdown_trigger
# Theme Options > header > menu_dropdown_animation
# Theme Options > header > menu_dropdown_items

function nav_setting(){ 

    $md = ''; 
    $ma = ''; 
    $mi = '';
    $nt = '';
    $e  = theme_config_header();

    if(isset($e['menu_dropdown_display']))
        $md = $e['menu_dropdown_display'];
    
    if(isset($e['menu_dropdown_animation']))
        $ma = $e['menu_dropdown_animation'];

    if(isset($e['menu_dropdown_items']))
        $mi = $e['menu_dropdown_items'];

    $nh = '';
    $nd = nav_dropdown($md, $ma, $mi);
    
    if(isset($e['menu_dropdown_trigger']))
        $nt = nav_trigger($e['menu_dropdown_trigger']);

    $attr = "{$nh} {$nd} {$nt}";
    echo $attr;
}

#dropdown data
function nav_dropdown($acf1, $acf2='', $acf3=''){
    
    if($acf1 == '') { $acf1 = 'default'; }

    if($acf1 == 'animate') {
        $data_trigger = "data-drop=\"{$acf1}\" data-move=\"{$acf2}\" data-item=\"{$acf3}\"";
    } else {
        $data_trigger = "data-drop=\"{$acf1}\"";
    }

    return $data_trigger;
}

/* #endregion */

/*------------------------------------------------*/

/* #region ~ logo for sticky nav */
# Theme Options > settings > logos
# setup the logo for the sticky nav

function nav_sticky_logo() {
    $logo = '';
    $menu_logo = '';

    $e = theme_logos();

    if(isset($e['sticky_logo']))
        $logo = $e['sticky_logo'];

    if($logo) { 
        $acf = 'sticky'; 
        $menu_logo = "data-logo=\"{$acf}\"";
    }
    return $menu_logo;
}
/* #endregion */

/*------------------------------------------------*/

/* #region ~ container width */
# Theme Options > header > menu_width
# width of the navigation

function nav_width() {
    $acf = '';
    $e  =  theme_config_header();    
    
    if(isset($e['menu_width']))
        $acf = $e['menu_width'];

    if($acf == '') { 
        $acf = 'container'; 
    }
    $menu_width = "data-width=\"{$acf}\"";
    return $menu_width;
}
/* #endregion */

/*------------------------------------------------*/

/* #region ~ alignment */
# Theme Options > header > menu_position
# menu position (left, center, right)

function nav_position() {
    $acf = '';
    $e  =  theme_config_header();    

    if(isset($e['menu_position']))
        $acf = $e['menu_position'];

    if($acf == '') { 
        $acf = 'left'; 
    }
    $menu_pos = "data-menu=\"{$acf}\"";
    return $menu_pos;
}
/* #endregion */

/*------------------------------------------------*/

/* #region ~ sticky on/off */
# Theme Options > header > menu_sticky
# sticky menu : on/off

function nav_sticky() {
    $acf = '';
    $e = theme_config_header();

    if(isset($e['menu_sticky']))
        $acf = $e['menu_sticky'];

    if($acf == '') { 
        $acf = 'sticky'; 
    }
    $sticky = "data-sticky=\"{$acf}\"";
    return $sticky;
}
/* #endregion */

/*------------------------------------------------*/

/* #region ~ trigger */
# Theme Options > header > menu_dropdown_trigger
# sticky menu : hover/click

function nav_trigger($acf){
    if($acf == '') { $acf = 'hover'; }
    $data_trigger = "data-trigger=\"{$acf}\"";
    return $data_trigger;
}
/* #endregion */

/*------------------------------------------------*/

/* #region ~ animation on/off */
# Theme Options > header > menu_animated

function nav_animated() {
    $acf = '';
    $e = theme_config_header();

    if(isset($e['menu_animated']))
        $acf = $e['menu_animated'];

    if($acf == '') { 
        $acf = 'no'; 
    }
    
    $sticky = "data-animated=\"{$acf}\"";
    return $sticky;
}
/* #endregion */

/*------------------------------------------------*/

/* #region ~ height */
# Theme Options > header > height
# removed
/*
removed : fails on reload -> change to padding instead
function nav_height($acf){
    if($acf != '') { 
        $data_height = "data-height=\"{$acf}\"";
        return $data_height;
    }   
}
*/
/* #endregion */

?>