<?php
include 'loop.php'; 

/* START HERE  */

global $tpath, $t_assets; // parent folder
global $spath, $s_assets; // child folder

/* #region */

    /* NOTE [MY WPENQUEUE] */

    function my_enqueue($hook) {
        
        global $spath;
        $js = $spath . '/assets/js';

        //wp_enqueue_style( 'red_css', "{$js}/red/red.css", '', 1.0 );
        //wp_enqueue_script( 'red_js', "{$js}/red/red.js", array(), '1.0.0', true );    
    }
        
    add_action('get_footer', 'my_enqueue');


    /* NOTE [MY ASSESTS LOADER] */

    function my_assets($array) {
        ## usage : my_assets(array('red'));
        
        global $spath;       
        $js = $spath . '/assets/js';

        ## RED
        if(in_array('red', $array, TRUE)) {
            
            /*
             wp_register_style('red_css', "{$js}/red/red.css", '', 1.0);    
             wp_register_script('red_js', "{$js}/red/red.js",'','1.0');

             wp_enqueue_style('red_css');  
             wp_enqueue_script('red_js'); 
            */
        }

        ## ADD MORE...
    }
    

/* #endregion */


/* NOTE [MY FUNCTIONS] */

## dont show "Add Gravity Form" in wysiwyg
add_filter( 'gform_display_add_form_button', '__return_false' );

## menudo
register_nav_menu('main', 'main menu');
















## --------------------------------------------------------------------- ##


/* *NOTE [CUSTOM GF BUTTON] */
/* #region */

/*
    function my_gfbutton( $button, $form ) {
        return "<button class='btn btn-1 gform_button' id='gform_submit_button_{$form['id']}'>
                <span>{$form['button']['text']}</span>
                </button>";
    }

    add_filter( 'gform_submit_button', 'my_gfbutton', 10, 2 );
*/

/* #endregion */


/* *NOTE [CUSTOM BG] */
/* #region */

/*
    function my_BGCOLOR(){
        ## theme options background color

        $colors = array('Red', 'Green', 'Blue');
        return $colors; 
    }

    add_filter('CUSTOM_BGCOLOR', 'my_BGCOLOR');

    function my_BGOVERLAY(){
        ## theme options background overlay
        $overlay = array('sample-1');
        return $overlay; 
    }

    add_filter('CUSTOM_BGOVERLAY', 'my_BGOVERLAY');
*/

/* #endregion */