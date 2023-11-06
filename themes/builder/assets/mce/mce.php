<?php

class bd_visual_editor {
    function __construct() {
        add_action('admin_init', array($this, 'init'));
    } // function __construct

    // callback for init
    // sets all the hooks only if user has capability & rich_editing is true 
    function init() {
        // Don't bother doing this stuff if the current user lacks permissions
        if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
            return;
        }

       // Add only in Rich Editor mode
       if ( get_user_option('rich_editing') == 'true') {
            add_filter('mce_buttons', array($this, 'add_button'));
            add_filter('mce_external_plugins', array($this, 'add_tinymce_plugin'));
            add_filter('tiny_mce_before_init', array($this, 'preserve_entities'));
       }
    } // function init


    // callback for mce_buttons filter
    // adds button to TinyMCE
    function add_button($buttons) {
        array_push($buttons, 'separator', 'customFont');                
        array_push($buttons, 'separator', 'four_spaces');        
        /*
        array_push($buttons, 'separator', 'xprompt');
        array_push($buttons, 'separator', 'epilink');        
        array_push($buttons, 'separator', 'wfaq_button');        
        */
        return $buttons;
    } // function add_button


    // callback for mce_external_plugins filter
    // attaches the JavaScript file to TinyMCE
    
    function add_tinymce_plugin($plugin_array) {
        global $tpath;
        $plugin_array['extra'] = $tpath . '/assets/mce/mce.js';
        return $plugin_array;
    }
    

    // callback for tiny_mce_before_init
    // stops TinyMCE (WordPress?) from automatically converting &nbsp; entities
    function preserve_entities( $initArray ) {
        // The odd entries are the entity *number*, the even entries are the entity *name*. If the entity has no name,
        // use the number, prefixed with a hash (for example, the service mark is "8480,#8480").
        $initArray['entities'] = '160,nbsp,' . $initArray['entities'];
        return $initArray;
    } // function preserve_entities
} 

function bd_theme_setup() {
    new bd_visual_editor();
}

add_action( 'after_setup_theme', 'bd_theme_setup' );