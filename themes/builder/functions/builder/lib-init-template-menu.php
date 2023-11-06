<?php 
# MENU INSTALL
# DEFAULT MENU 

// see template-parts/main-menu-default.php
// see template-parts/menu-extension-d.php

// see theme-options > Templates > Theme Menu
// see template-parts/_template/.template.php

global $basic_menu;

$basic_menu = new Basic_Menu();

class Basic_Menu {
    
    public $menu, $ext, $test;

    public function basic_nav(){
        
        $default = true;
        $e = theme_templates();
    
        $v = tpl_templates('tpl_menu');

        
            $versions = $v['tpl_array'];
            
            foreach($versions as $_ver => $_file) 
            {
                if(isset($e['tpl_menu'])):
                    if($e['tpl_menu'] == $_ver){
                        $this->menu = get_template_part($_file);
                        $default = false;
                    } 
                endif;
            }   
        
    
        if($default == true)
            $this->menu = get_template_part('template-parts/header');        
    }
    
    public function basic_nav_ext(){
        $this->ext = get_template_part('template-parts/menu-extension'); 
    }   
    
}  

function get_builder_menu(){
    global $basic_menu;
    $basic_menu->basic_nav();
}

function get_builder_menu_ext(){
    global $basic_menu;
    $basic_menu->basic_nav_ext();
}

## ADDON
/* -------------------------------------------------------------- */      

# MENU BOOTSRAP NAVWALKER
# Customize Nav (ul > Li) by adding Bootstrap classes

require_once 'lib-bs-navwalker.php';

function builder_menu() {
    wp_nav_menu( array(
        'theme_location'  => 'main',
        'depth'	          => 4,
        'container'       => '',
        'container_class' => '',
        'container_id'    => '',
        'menu_id'         => '',
        'menu_class'      => 'navbar-nav',
        'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
        'walker'          => new WP_Bootstrap_Navwalker(),
    )); 
}  

/* 
LEGACY 

function get_builder_menu(){
    global $basic_menu;

    if (function_exists('pro_nav')) {
        pro_nav();
    } else {
        $basic_menu->basic_nav();
    }
}

function get_builder_menu_ext(){
    global $basic_menu;

    if (function_exists( 'pro_nav_ext' )) {
        pro_nav_ext();
    } else {
        $basic_menu->basic_nav_ext();
    }
}

*/
?>
