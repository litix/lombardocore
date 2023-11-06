<?php
/* #region */
#USED FOR TEMPLATES :

function snbx_theme(){
    
    global $tpath;
    
    $i = 0;   
    $rp = get_field('theme_loader', 'prototype');
    if($rp):
        foreach($rp as $r):
        
        $name = "/sandbox-theme-{$i}";
        $file = $tpath . "/{$r['theme']}";

        if($file)
            wp_enqueue_style($name, $file);

        $i++;
        endforeach;
    endif;  
}

    add_action( 'wp_enqueue_scripts', 'snbx_theme', 3 ); 
    add_action( 'admin_enqueue_scripts', 'snbx_theme', 21);

/* #endregion */
?>