<?php 
# MARGINS : TOP + BOTTOM

# LAYOUT Functions - SETTINGS X.0
# applied in shortcodes

/*------------------------------------------------*/

/* #region ~ FN MARGIN  */
function margin_args($top='', $btm='') {

    $condition = false;

    if($top) {
        $amt = opt_check_amt($top);        
        $top = num_filter($top);
        $top = "margin-top:{$top}{$amt};";
        $condition = true;
    }
    
    if($btm) {
        $amt = opt_check_amt($btm);        
        $btm = num_filter($btm);
        $btm = "margin-bottom:{$btm}{$amt};";
        $condition = true;
    }    

    if($condition == true){
        $args = "{$top} {$btm}";
        return $args;
    }    
}
/* #endregion */

/*------------------------------------------------*/

## IMPLEMENT

/* #region ~ element margin  */
function opt_tag_margin($css){

    $mt_t = '';
    $mt_b = '';
    $bt_t = '';
    $bt_b = '';
    $at_t = '';
    $at_b = '';
    $dt_t = '';
    $dt_b = '';
    $it_t = '';
    $it_b = '';
    $ix_t = '';
    $ix_b = '';
    $ic_t = '';
    $ic_b = '';
    $im_t = '';
    $im_b = '';
    $vd_t = '';
    $vd_b = '';
    $if_t = '';
    $if_b = '';

    if( have_rows('element_settings') ):
        while ( have_rows('element_settings') ) : the_row();

        if( have_rows('adjustment') ):
            while ( have_rows('adjustment') ) : the_row();

                if(get_row_layout() == 'main_title'):
                    $mt_t = get_sub_field('mtitle_mt');
                    $mt_b = get_sub_field('mtitle_mb');

                elseif(get_row_layout() == 'before_title'):    
                    $bt_t = get_sub_field('btitle_mt');
                    $bt_b = get_sub_field('btitle_mb');

                elseif(get_row_layout() == 'after_title'):   
                    $at_t = get_sub_field('atitle_mt');
                    $at_b = get_sub_field('atitle_mb');
                
                elseif(get_row_layout() == 'paragraph'):    
                    $dt_t = get_sub_field('dtext_mt');
                    $dt_b = get_sub_field('dtext_mb');

                elseif(get_row_layout() == 'box_title'):    
                    $it_t = get_sub_field('ititle_mt');
                    $it_b = get_sub_field('ititle_mb');

                elseif(get_row_layout() == 'box_text'):    
                    $ix_t = get_sub_field('itext_mt');
                    $ix_b = get_sub_field('itext_mb');

                elseif(get_row_layout() == 'box_icon'):    
                    $ic_t = get_sub_field('icon_mt');
                    $ic_b = get_sub_field('icon_mb');       
                    
                elseif(get_row_layout() == 'image'):    
                    $im_t = get_sub_field('image_mt');
                    $im_b = get_sub_field('image_mb');                   

                elseif(get_row_layout() == 'video'):    
                    $vd_t = get_sub_field('video_mt');
                    $vd_b = get_sub_field('video_mb');   

                elseif(get_row_layout() == 'iframe'):    
                    $if_t = get_sub_field('iframe_mt');
                    $if_b = get_sub_field('iframe_mb');   

                endif;    

            endwhile;
        endif;
        
        endwhile;
    endif;

    if($css == 'mtitle') { return margin_args($mt_t, $mt_b); }
    if($css == 'btitle') { return margin_args($bt_t, $bt_b); }
    if($css == 'atitle') { return margin_args($at_t, $at_b); }

    if($css == 'dtext')  { return margin_args($dt_t, $dt_b); }

    if($css == 'ititle') { return margin_args($it_t, $it_b); }
    if($css == 'itext')  { return margin_args($ix_t, $ix_b); }

    if($css == 'dicon')  { return margin_args($ic_t, $ic_b); }
    //if($css == 'dimage') { return margin_args($im_t, $im_b); }   
    if($css == 'bgimg')  { return margin_args($im_t, $im_b); }

    if($css == 'dvideo') { return margin_args($vd_t, $vd_b); }
    if($css == 'iframe') { return margin_args($if_t, $if_b); }
}

/* #endregion */