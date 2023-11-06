<?php

global $snbox, $tpath;
$snbox = $tpath . '/functions/builder/.prototype';

/*-----------------------------------------------------------------------------*/  

class BPrototype {

    public $setup;
    
    public function set_options_page() {
        if( function_exists('acf_add_options_page') ) {
            acf_add_options_page(array(
                'page_title' => 'Prototype',
                'menu_title' => 'Prototype',
                'menu_slug' => 'prototype',
                'capability' => 'edit_posts',
                'position' => '3',
                'parent_slug' => '',
                'icon_url' => 'dashicons-superhero',
                'redirect' => true,
                'post_id' => 'prototype',
                'autoload' => false,
                'update_button' => 'Update',
                'updated_message' => 'Options Updated',
            ));          
        }
    }
        
}    

# $Builder = new BPrototype();   
# $Builder->check_setup($prototype);
# $Builder->set_options_page();


## custom ACF ADMIN
function sandbox_admin_css($hook) {
    global $snbox;   
    
    wp_enqueue_style('custom_acf', $snbox  . '/css/admin.css','','1.0');
}
    
add_action('admin_enqueue_scripts', 'sandbox_admin_css', 30);

include 'utilities.php'; 