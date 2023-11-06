<?php 
# STYLE ADJUSTMENT
# Settings 3.0 > B2 Element Settings [element_settings] | Style Adjustment [adjustment]

## see /post.php?post=17&action=edit

/* #region ~ validator */
# validates amout via ie.: 20px returns px
function opt_check_amt($field, $a='') {
    $amt = '';
    $check = false;
    $field = strtolower($field);
    if($field) {
        if(strpos($field, 'em') >=  1) { $check = true; $amt = 'em'; }
        if(strpos($field, '%') >=   1) { $check = true; $amt = '%'; }
        if(strpos($field, 'px') >=  1) { $check = true; $amt = 'px'; }
        if(strpos($field, 'rem') >= 1) { $check = true; $amt = 'rem'; }
        if(strpos($field, 'vh') >=  1) { $check = true; $amt = 'vh'; }        
        if(strpos($field, 'vw') >=  1) { $check = true; $amt = 'vw'; }
        if(strpos($field, 'pt') >=  1) { $check = true; $amt = 'pt'; }
                  if($field == 'auto') { $check = true; $amt = ''; }
    }    
    if($check == false) {
        if($a != '') {
            return $a;
        } else {
            return 'px';
        }
    } else {
        return $amt;
    } 
}
/* #endregion */

/*------------------------------------------------*/

/* #region ~ Text Styler */
# applies the text styles in settings into the shortcoded tags
# mtitle, atitle, btitle, ititle, dtext, itext

function opt_styler($css) {
    $echo = false;
    $styler= '';

    $font_size    = opt_font_size($css);
    $line_height  = opt_line_height($css);
    $margin       = opt_tag_margin($css);

    if($font_size)   { $echo = true; }
    if($margin)      { $echo = true; }  
    if($line_height) { $echo = true; }

    if($echo == true) {
        $styler = "style=\"{$font_size} {$margin} {$line_height} \"";
    }

    return $styler;
}

/* #endregion */