<?php 
# ELEMENT BACKGROUND
# ACF - THEME OPTIONS
# Layout Element > Settings

# Creates option for Layout Fields under THEME OPTIONS

/* --------------------------------------------------- */

# 1. Add Background color on Theme Options
# > Theme Options > Custom Background

# 2. Use Background on ELement Layout 
# > Element Settings > Background |  Element Settings > Overlay

/* --------------------------------------------------- */

/* #region ~ Add Color at Theme Option */

function load_BGcolor( $field ) {

    $field['choices'] = array();
    $opt = theme_config_es();

    $es = '';

    if(isset($opt['background_color']))
        $es = $opt['background_color'];

    $default_bgcolor = apply_filters('BGCOLOR', '');
    $custom_bgcolor = apply_filters('CUSTOM_BGCOLOR', '');

    $ds = $default_bgcolor;
    if($custom_bgcolor) {
        $ds = array_merge($custom_bgcolor, $default_bgcolor);
    }
        
        $dft ='Default';
        $field['choices'][$dft] = $dft;

        if($es):
            foreach( $es as $e ) :
                if(isset($e['color_name'])) {
                    $color = $e['color_name'];
                    $field['choices'][$color] = $color;
                }
            endforeach;    
        endif;

        foreach( $ds as $d ) :
            $field['choices'][$d] = $d;    
        endforeach;    

    return $field;
}

add_filter('acf/load_field/name=bg_color', 'load_BGcolor');

/* #endregion */

/* #region ~ Add Color at Theme Option */

function load_BGoverlay( $field ) {

    $field['choices'] = array();
    $opt = theme_config_es();

    $es = '';

    if(isset($opt['background_overlay']))
        $es = $opt['background_overlay'];

    $default_bgoverlay = apply_filters('BGOVERLAY', '');
    $custom_bgoverlay = apply_filters('CUSTOM_BGOVERLAY', '');

    $ds = $default_bgoverlay;
    if($custom_bgoverlay) {
        $ds = array_merge($custom_bgoverlay, $default_bgoverlay);
    }
        
        $dft ='none';
        $field['choices'][$dft] = $dft;

        if($es):
            foreach( $es as $e ) :
                if(isset($e['overlay_name'])) {
                    $color = $e['overlay_name'];
                    $field['choices'][$color] = $color;
                }
            endforeach;    
        endif;

        foreach( $ds as $d ) :
            $field['choices'][$d] = $d;    
        endforeach;    

    return $field;
}

add_filter('acf/load_field/name=bg_overlay', 'load_BGoverlay');

/* #endregion */

?>