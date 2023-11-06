<?php 
# STYLE ADJUSTMENT for MEDIA (IMG)
# for individual element
# LAYOUT Functions - SETTINGS X.0

# function is applied in shortcodes

## options : WIDTH | HEIGHT | 

/*------------------------------------------------*/

/* #region ~ Media Styler */
# applies the media styles in settings into the shortcoded tags
# dimage, dicon, diframe, dvideo

function opt_media_styler($css, $bg='') {
    $echo = false;
    $width   = opt_media_width($css);
    $height  = opt_media_height($css);
    $margin  = opt_tag_margin($css);    
    $setting = opt_media_align($css);
    $styler = '';

    if($width) { $echo = true; }      
    if($height) { $echo = true; }      
    if($margin) { $echo = true; }  
    if($setting) { $echo = true; }

    if($css == 'bgimg') {
        $lazy_bg = "background-image: url($bg)";
        if(is_admin()) {
            $echo = true;
        }    
    }
    if($echo == true) {
        $styler = "style=\" {$width} {$height} {$margin} {$setting} {$lazy_bg}\"";
    }

    return $styler;
}

/* #endregion */

/*------------------------------------------------*/

## IMPLEMENT
/* #region ~ element width  */

function opt_media_width($css) {

    $var = 'width';
    $ic = '';
    $im = '';
    $vd = '';
    $if = '';

    if( have_rows('element_settings') ):
        while ( have_rows('element_settings') ) : the_row();

        if( have_rows('adjustment') ):
            while ( have_rows('adjustment') ) : the_row();
        
                if(get_row_layout() == 'box_icon'):    
                    $ic = get_sub_field('icon_w');
                    
                elseif(get_row_layout() == 'image'):    
                    $im = get_sub_field('image_w');

                elseif(get_row_layout() == 'video'):    
                    $vd = get_sub_field('video_w');

                elseif(get_row_layout() == 'iframe'):    
                    $if = get_sub_field('iframe_w');

                endif;    

            endwhile;
        endif;
        
        endwhile;
    endif;  

    if($css == 'dicon')  { return media_size_args($ic, $var); }
    if($css == 'dimage') { return media_size_args($im, $var); }
    if($css == 'bgimg')  { return media_size_args($im, $var); }
    if($css == 'dvideo') { return media_size_args($vd, $var); }
    if($css == 'iframe') { return media_size_args($if, $var); }
}

/* #endregion */

/*------------------------------------------------*/

/* #region ~ element height  */
function opt_media_height($css) {

    $var = 'height';
    $ic = '';
    $im = '';
    $vd = '';
    $if = '';

    if( have_rows('element_settings') ):
        while ( have_rows('element_settings') ) : the_row();
    
        if( have_rows('adjustment') ):
            while ( have_rows('adjustment') ) : the_row();
    
                if(get_row_layout() == 'box_icon'):    
                    $ic = get_sub_field('icon_h');
                    
                elseif(get_row_layout() == 'image'):    
                    $im = get_sub_field('image_h');
    
                elseif(get_row_layout() == 'video'):    
                    $vd = get_sub_field('video_h');
    
                elseif(get_row_layout() == 'iframe'):    
                    $if = get_sub_field('iframe_h');
    
                endif;    
    
            endwhile;
        endif;
        
        endwhile;
    endif;    

    if($css == 'dicon')  { return media_size_args($ic, $var); }
    if($css == 'dimage') { return media_size_args($im, $var); }
    if($css == 'bgimg')  { return media_size_args($im, $var); }
    if($css == 'dvideo') { return media_size_args($vd, $var); }
    if($css == 'iframe') { return media_size_args($if, $var); }
}

/* #endregion */

/*------------------------------------------------*/

/* #region ~ element */
function opt_media_align($css) {

    $im = '';

    if( have_rows('element_settings') ):
        while ( have_rows('element_settings') ) : the_row();

        if( have_rows('adjustment') ):
            while ( have_rows('adjustment') ) : the_row();
                            
                if(get_row_layout() == 'image'):    
                    $im = get_sub_field('image_position');
                endif;    

            endwhile;
        endif;
        
        endwhile;
    endif; 

    if($css == 'dimage')  { 
        return media_align_args($im, 'position', $css); 
    }
    if($css == 'bgimg')  { 
        return media_align_args($im, 'position', $css); 
    }    

}
/* #endregion */

/*------------------------------------------------*/

/* #region ~ FN */
function media_align_args($field, $a='', $css) {
    if($field) {
        if ($a == 'position') {
            if(strtolower($field) != 'default'):            
            if($css == 'dimage') {
                $args = 'display:flex; ';
                if($field == 'all-center') { 
                    $args .= "align-items:center; justify-content:center;"; 
                }
                if($field == 'top-center') { 
                    $args .= "align-items:flex-start; justify-content:center;"; 
                }
                if($field == 'btm-center') { 
                    $args .= "align-items:flex-end; justify-content:center;"; 
                }
                if($field == 'left-center') { 
                    $args .= "align-items:center; justify-content:flex-start;"; 
                }
                if($field == 'right-center') { 
                    $args .= "align-items:center; justify-content:flex-end;"; 
                }
            }      
            if($css == 'bgimg') {
                if($field == 'all-center') { 
                    $args .= "background-position:center center;"; 
                }
                if($field == 'top-center') { 
                    $args .= "background-position:center top;"; 
                }
                if($field == 'btm-center') { 
                    $args .= "background-position:center bottom;"; 
                }
                if($field == 'left-center') { 
                    $args .= "background-position:center left;"; 
                }
                if($field == 'right-center') { 
                    $args .= "background-position:center left;"; 
                }
            }                
            endif;
        } 
        return $args;
    }
}
/* #endregion */

/*------------------------------------------------*/

/* #region ~ FN SIZE  */
function media_size_args($field, $a='') {
    /* width, height */    
    if($field) {
        $amt = opt_check_amt($field);

        if($field != 'auto') {
            $field = num_filter($field);
        }      
        
        if ($a == 'width') {
            $args = "max-width:{$field}{$amt};";
        } 
        elseif ($a == 'height') {
            $args = "height:{$field}{$amt};";
        }
        return $args;
    }
}
/* #endregion */