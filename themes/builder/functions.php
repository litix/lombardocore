<?php
include 'functions/config.php';

#YOUR FUNCITONS HERE

add_image_size( 'icon-size', 80, 80 );

function hello_world() {
    echo 'hello world';
}


/* NOTE [SETUP COOKIE] */
/* #region - Plugin : GRAVITY FORM */ 

    /*
    ## Setup a Cookie
    function set_cookie_token( $entry, $form ) {
        setcookie('gform_token', 'true', time() + (86400 * 30), "/"); 
    }
    add_action( 'gform_after_submission_1', 'set_cookie_token', 10, 2 );
    */

/* #endregion */  

/* NOTE [CONTACT FORM 7] */
/* #region - Plugin : CONTACT FORM 7             */ 

    /*
        function contact_enqueue(){
            if(!is_page('contact' )) :       
                add_filter( 'wpcf7_load_js', '__return_false' );
                add_filter( 'wpcf7_load_css', '__return_false' );   
            endif;    
        }

        contact_enqueue();
    */    
  
/* #endregion */ 
  
/* NOTE [COMMENTS] */
/* #region - PLugin : COMMENTS */ 
    
    /* wpDiscuz */
    //comments_template(); <-- add to content-post
  
/* #endregion */


/* NOTE [ACF] */
/* #region - PLugin : ACF */ 
    /*
        add_action('acfe/flexible/render/before_template/name=dev_layout', 'my_acf_before_layout', 10, 3);
        function my_acf_before_layout($field, $layout, $is_preview){

            global $t_assets;
            wp_enqueue_script('tst_js', $t_assets . 'js/test.js'); 
            // do_something();

        }
    */
/* #endregion */
?>