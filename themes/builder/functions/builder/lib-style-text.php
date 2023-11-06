<?php 
# TEXT

# LAYOUT Functions - SETTINGS X.0
# applied in shortcodes

# FONT SIZE | LINE HEIGHT

/*------------------------------------------------*/

/* #region ~ FN TEXT  */
function text_args($field, $a='') {
    /* font-size, line-height */    
    if($field) {
        $amt = opt_check_amt($field);

        if($field != 'auto') {
            $field = num_filter($field);
        }        
        if ($a == 'font-size') {
            $args = "font-size:{$field}{$amt};";
        } 
        elseif ($a == 'line-height') {
            $args = "line-height:{$field}{$amt};";
        }
        return $args;
    }
}
/* #endregion */

/*------------------------------------------------*/

## IMPLEMENT

/* #region ~ apply font size  */
function opt_font_size($css) {

    $var = 'font-size';
    $mt = '';
    $bt = '';
    $at = '';
    $dt = '';
    $it = '';
    $ix = '';

    if( have_rows('element_settings') ):
        while ( have_rows('element_settings') ) : the_row();

        if( have_rows('adjustment') ):
            while ( have_rows('adjustment') ) : the_row();

                if(get_row_layout() == 'main_title'):
                    $mt = get_sub_field('mtitle');

                elseif(get_row_layout() == 'after_title'):   
                    $at = get_sub_field('atitle');
                
                elseif(get_row_layout() == 'before_title'):    
                    $bt = get_sub_field('btitle');
                
                elseif(get_row_layout() == 'paragraph'):    
                    $dt = get_sub_field('dtext');                   

                elseif(get_row_layout() == 'box_title'):    
                    $it = get_sub_field('ititle');                   

                elseif(get_row_layout() == 'box_text'):    
                    $ix = get_sub_field('itext');                     

                endif;    
                

            endwhile;
        endif;
        
        endwhile;
    endif;

    if($css == 'mtitle') { return text_args($mt, $var); }    
    if($css == 'btitle') { return text_args($bt, $var); }
    if($css == 'atitle') { return text_args($at, $var); }
    if($css == 'dtext')  { return text_args($dt, $var); }

    if($css == 'ititle') { return text_args($it, $var); }    
    if($css == 'itext')  { return text_args($ix, $var); }        
}
/* #endregion */

/*------------------------------------------------*/

/* #region ~ line height  */
function opt_line_height($css) {

    $var = 'line-height';
    $x = 0;

    $mt = '';
    $bt = '';
    $at = '';
    $dt = '';
    $it = '';
    $ix = '';

    if( have_rows('element_settings') ):
        while ( have_rows('element_settings') ) : the_row();

        if( have_rows('adjustment') ):
            while ( have_rows('adjustment') ) : the_row();

                if(get_row_layout() == 'main_title'):
                    $mt = get_sub_field('mtitle_lh');
                    
                elseif(get_row_layout() == 'paragraph'):    
                    $dt = get_sub_field('dtext_lh');                   

                elseif(get_row_layout() == 'box_title'):    
                    $it = get_sub_field('ititle_lh');                   

                elseif(get_row_layout() == 'box_text'):    
                    $ix = get_sub_field('itext_lh');                     

                endif;    
                

            endwhile;
        endif;
        
        endwhile;
    endif;    

    if($css == 'mtitle') { 
        $x = 1;
        return text_args($mt, $var); 
    }    
    if($css == 'dtext')  { 
        $x = 1;
        return text_args($dt, $var); 
    }

    if($css == 'ititle') { 
        $x = 1;
        return text_args($it, $var); 
    }    
    if($css == 'itext')  { 
        $x = 1;
        return text_args($ix, $var); 
    }      
    
    if($x == 0) {
        return "";
    }
    
}
/* #endregion */