<?php 
# H1-H6 Tag
# ELEMENT | LAYOUT ~ TAG SETTINGS

## see /wp-admin/post.php?post=17&action=edit
# feature is used at shortcode 

## Settings 3.0 > H Tags
function el_settings_tag($field){
    $es = get_sub_field('element_settings');

    if(isset($es['b2_title_tag'])) {
        $layout = $es['b2_title_tag'];
        return $layout[$field];
    }
}

/* #region */
function opt_htag($css){
    if($css == 'mtitle') { return el_settings_tag('tag'); }
    if($css == 'dtitle') { return el_settings_tag('tag'); }
    if($css == 'btitle') { return el_settings_tag('tag_bt'); }
    if($css == 'atitle') { return el_settings_tag('tag_at'); }
    if($css == 'ititle') { return el_settings_tag('tag_box'); }
}
/* #endregion */