<?php 
# THEME OPTIONS SELECTORS
# Fields under options - functions and features
# note: these functions are also used under shorcodes

## see shortcodes/

/* ----------------------------------------- */

## information
function theme_addon()       { return theme_opt('settings', 'dev_addon'); }
function theme_info()        { return theme_opt('settings', 'site'); }
function theme_contact()     { return theme_opt('settings', 'contact'); }
function theme_logos()       { return theme_opt('settings', 'logos'); }
function theme_social()      { return theme_opt('settings', 'social_media'); }
function theme_footer()      { return theme_opt('settings', 'footer'); }

## utitlities
function theme_utility()     { return theme_opt('utilities'); }
function theme_menu_ext()    { return theme_opt('utilities', 'menu_extension'); }
function theme_footer_menu() { return theme_opt('utilities', 'footer_menu'); }
function theme_placeholder() { return theme_opt('utilities', 'placeholders'); }
function theme_background()  { return theme_opt('utilities', 'background'); }
function theme_cta()         { return theme_opt('utilities', 'custom_cta'); }

## Configuration
function theme_config_header() { return theme_opt('configuration','header'); }
function theme_config_mobile() { return theme_opt('configuration','mobile'); }
function theme_config_feats()  { return theme_opt('configuration','wp_features'); }
function theme_config_es()     { return theme_opt('configuration','element_settings'); }
function theme_config_th()     { return theme_opt('configuration','theme_layout'); }
function theme_config_toggle() { return theme_opt('configuration','toggle_information'); }

## templates
function theme_templates()     { return theme_opt('templates'); }

/*dev*/
function theme_dev_list()      { return theme_opt('notes','dev_guidelines'); }


/* ----------------------------------------- */

function theme_opt($parent='', $child='') {
    $opt = get_field($parent, 'options');

    $e = $opt;

    if($child)
        if(isset($opt[$child]))
            $e = $opt[$child];

    return $e;
}

?>