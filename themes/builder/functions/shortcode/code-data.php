<?php 
# FLEXIBLE CONTENT

//clone : acf - CFG CONTENT

/*------------------------------------------------*/

function data_set($d='', $echo=0) { 

    $ticks = array();
    $field = array();

/* ----------------------------------------------------- */      
/* #region ## STUB - Display Fields */  

    /* #region ## NOTE - Text Content */     

    if(isset($d['bg'])) {
        if($d['bg'] == false)
            array_push($field, 'bg');
    }

    if(isset($d['logo'])) {
        if($d['logo'] == false)
            array_push($field, 'lo');
    }    

    if(isset($d['icon'])) {
        if($d['icon'] == false)
            array_push($field, 'ic');
    }    

    if(isset($d['before_title'])) {
        if($d['before_title'] == false)
            array_push($field, 'bt');
    }

    if(isset($d['after_title'])) {
        if($d['after_title'] == false)
            array_push($field, 'at');        
    }

    if(isset($d['title'])) {
        if($d['title'] == false)
            array_push($field, 'tt');
    }

    if(isset($d['mtitle'])) {
        if($d['mtitle'] == false)
            array_push($field, 'wt');
    }    

    if(isset($d['show_main_title'])) {
        if($d['show_main_title'] == false)
            array_push($field, 'wt');
    }      
        
    if(isset($d['text'])) {
        if($d['text'] == false)
            array_push($field, 'tx');        
    }

    if(isset($d['editor'])) {
        if($d['editor'] == false)
            array_push($field, 'wx');        
    }    

    if(isset($d['buttons'])) {
        if($d['buttons'] == false)
            array_push($field, 'bn');          
    }

    /* #endregion */  

    /* #region ## NOTE - Client */  

    if(isset($d['avatar'])) {
        if($d['avatar'] == false)
            array_push($field, 'av');          
    }    

    if(isset($d['quote'])) {
        if($d['quote'] == false)
            array_push($field, 'qq');          
    }

    if(isset($d['name'])) {
        if($d['name'] == false)
            array_push($field, 'nm');          
    } 

    /* #endregion */  

    /* #region ## NOTE - Post */     

    if(isset($d['position'])) {
        if($d['position'] == false)
            array_push($field, 'pn');          
    }    

    if(isset($d['post_thumbnail'])) {
        if($d['post_thumbnail'] == false)
            array_push($field, 'p_f');          
    }      

    if(isset($d['post_title'])) {
        if($d['post_title'] == false)
            array_push($field, 'p_t');          
    }   

    if(isset($d['post_excerpt'])) {
        if($d['post_excerpt'] == false)
            array_push($field, 'p_e');          
    }   

    if(isset($d['post_date'])) {
        if($d['post_date'] == false)
            array_push($field, 'p_d');          
    }    
    
    if(isset($d['post_author'])) {
        if($d['post_author'] == false)
            array_push($field, 'p_a');
    }   
    
    if(isset($d['post_category'])) {
        if($d['post_category'] == false)
            array_push($field, 'p_c');
    }     

    if(isset($d['post_meta'])) {
        if($d['post_meta'] == false)
            array_push($field, 'p_m');
    }      

    /* #endregion */  

/* #endregion */  
/* ----------------------------------------------------- */  


/* ----------------------------------------------------- */  
/* #region ## STUB - Row */  

    /* #region ## NOTE - custom height */ 

    $custom_row = array();

    $custom_h = '';
    if(isset($d['custom-h'])) {
        if($d['custom-h'] == true) {
            $custom_h = 'height';
            array_push($custom_row, $custom_h);
        }
    }      

    /* #endregion */

    /* #region ## NOTE - custom border */ 
    
    $custom_b = '';
    if(isset($d['border'])) {
        if($d['border'] == true) {
            $custom_b = 'border';
            array_push($custom_row, $custom_b);
        }
    } 

    /* #endregion */

    /* #region ## NOTE - custom box border */ 

    $custom_bb = '';
    if(isset($d['box_border'])) {
        if($d['box_border'] == true) {
            $custom_bb = 'box-border';
            array_push($custom_row, $custom_bb);
        }
    } 

    /* #endregion */

    /* #region ## NOTE - custom padding */ 

    $custom_p = '';
    if(isset($d['padding'])) {
        if($d['padding'] == true) {
            $custom_p = 'padding';
            array_push($custom_row, $custom_p);
        }
    }     

    /* #endregion */

    /* #region ## NOTE - custom box padding */ 

    $custom_bp = '';
    if(isset($d['box_padding'])) {
        if($d['box_padding'] == true) {
            $custom_bp = 'box-padding';
            array_push($custom_row, $custom_bp);
        }
    }     

    /* #endregion */    

    /* #region ## NOTE - align items center */ 

    $custom_v = '';
    if(isset($d['vertical'])) {
        if($d['vertical'] == true) {
            $custom_v = 'v-align';
            array_push($custom_row, $custom_v);
        }
    }      

    /* #endregion */

    /* #region ## NOTE - reverse */ 
    
    $rtl = '';
    if(isset($d['rtl'])) {
         $rtl = "data-rtl=\"0\"";    
         if($d['rtl'] == true)
            $rtl = "data-rtl=\"1\"";
          
          array_push($ticks, $rtl);        
    }     

    /* #endregion */

    /* #region ## NOTE - column 5/7, 4/8, etc.. */ 

    $col = '';
    if(isset($d['columns'])) {
        $col = $d['columns'];
        $col = "data-col=\"{$col[0]}-{$col[2]}\"";
        array_push($ticks, $col);
    }

    /* #endregion */

    /* #region ## NOTE - grid */ 

    $gridgal = '';
    if(isset($d['grid_gallery'])) {
        $gg = $d['grid_gallery'];
        $gridgal = "data-gg=\"{$gg}\"";
        array_push($ticks, $gridgal);
    }  

    $gridcol = '';
    if(isset($d['grid_column'])) {
        $gc = $d['grid_column'];
        $gridcol = "data-gc=\"{$gc}\"";
        array_push($ticks, $gridcol);
    }       

    /* #endregion */

/* #endregion */ 
/* ----------------------------------------------------- */     


/* ----------------------------------------------------- */  
/* #region ## STUB - Column */ 

    /* #region ## NOTE - Data Row */ 
    /* Row : bg position | text position | flex vertical | flex horizonal */

    $row_opt = array('custom');  

    if(isset($d['data_row'])):

        $dr = $d['data_row'];

        if($dr['row'] != true) {
            array_push($row_opt, 'none-row');
        }    

        if($dr['row'] == true):

            $bg_pos = '';
            if(isset($dr['bg_position'])) {
                $bg_pos = $dr['bg_position'];
                array_push($row_opt, $bg_pos);
            }

            $col_text = '';
            if(isset($dr['text_position'])) {
                $col_text = $dr['text_position'];
                array_push($row_opt, $col_text);
            }

            $flex_v = '';
            if(isset($dr['flex_vertical'])) {
                $flex_v = $dr['flex_vertical'];
                array_push($row_opt, $flex_v);
            }        

            $flex_h = '';
            if(isset($dr['flex_horizontal'])) {
                $flex_h = $dr['flex_horizontal'];
                array_push($row_opt, $flex_h);
            } 
            
        endif;

    endif;

    $row_data = '';
    if(isset($d['data_row'])) {
        $row_opt = implode(",", $row_opt);
        $row_data = "data-row=\"{$row_opt}\"";
        array_push($ticks, $row_data);
    }    

    /* #endregion */ 

/* #endregion */ 
/* ----------------------------------------------------- */  


/* ----------------------------------------------------- */  
/* #region ## STUB - GRID */ 

    /* #region ## NOTE - column count */ 

    $count = '';
    if(isset($d['col_count'])) {
        $c = $d['col_count'];
        $count = "data-ctr=\"{$c}\"";
        array_push($ticks, $count);
    }   

    $count = '';
    if(isset($d['count'])) {
        $c = $d['count'];
        $count = "data-ctr=\"{$c}\"";
        array_push($ticks, $count);
    }  

    /* #endregion */ 

/* #endregion */ 
/* ----------------------------------------------------- */  


/* ----------------------------------------------------- */  
/* #region ## STUB - IDENTIFIER */ 

    /* #region ## NOTE - version */ 

    $ver = '';
    if(isset($d['version'])) {
        $v = $d['version'];
        $ver = "data-version=\"{$v}\"";
        array_push($ticks, $ver);
    }       

    /* #endregion */ 

    /* #region ## NOTE - col-width */ 

    $colw = '';
    if(isset($d['col_width'])) {
        $colw = $d['col_width'];
        $colw = "data-colwidth=\"{$colw}\"";
        array_push($ticks, $colw);
    }  

    /* #endregion */ 

    /* #region ## NOTE - design */ 

    $data_design = '';
    if(isset($d['data_design'])) {
        $ds = $d['data_design'];
        $ds = "data-design=\"{$ds}\"";
        array_push($ticks, $ds);
    } 

    /* #endregion */ 

/* #endregion */ 
/* ----------------------------------------------------- */ 


/* ----------------------------------------------------- */  
/* #region ## STUB - MODIFIERS */ 

    /* #region ## NOTE - Modifiers */ 

    $hover = '';
    if(isset($d['ohover'])) {
        $h = $d['ohover'];
        $hover = "data-hover=\"{$h}\"";
        array_push($ticks, $hover);
    }

    $data_item = '';
    if(isset($d['data_items'])) {
        $di = $d['data_items'];
        $di = "data-items=\"{$di}\"";
        array_push($ticks, $di);
    } 

    /* #endregion */ 

/* #endregion */ 
/* ----------------------------------------------------- */  


/* ----------------------------------------------------- */  
/* #region ## STUB - INITIALIZER */ 

    /* #region ## NOTE - Assets Loader */ 
    /* assets group (load_asset + element) | see function data_assets() */

    if(isset($d['assets'])) {

        $a = $d['assets'];
        $e = '';

        if($a['load_asset'] == true){

            if(isset($a['element'])) 
                $e = $a['element'];

            $assets = "data-assets=\"loaded,{$e}\"";
            array_push($ticks, $assets);
            
            if(isset($a['element'])) 
                data_assets($e);
        }
    }  

    /* #endregion */ 

    /* #region ## NOTE - Display Fields */ 

    $df = implode(",", $field);
    $unshow = "data-unshow=\"{$df}\"";
    array_push($ticks, $unshow);

    /* #endregion */

    /* #region ## NOTE - Initializer */ 

    $custom_data = '';
    if(count($custom_row) > 0) {
        $custom_rows = implode(",", $custom_row);
        $custom_data = "data-custom=\"{$custom_rows}\"";
        array_push($ticks, $custom_data);
    }      

    /* #endregion */ 

/* #endregion */ 
/* ----------------------------------------------------- */      

   
    ## STUB - OUTPUT

    $output = implode(" ", $ticks);

    if($echo == 1)
        echo $output;
    
    return $output;

}

/*-------------------------------------------------------------*/
/*-------------------------------------------------------------*/


/* ANCHOR - HIDE/SHOW */

/* #region ## hide show common fields */ 

function data_fields($e) {
    $opt = '';

    if(isset($e['display_fields'])) {
        $opt = $e['display_fields'];
    }

    return $opt;
}

/* #endregion */ 

/*-------------------------------------------------------------*/

/* ANCHOR[id=data-assets]  */

/* #region ## DATA ASSETS */ 

function data_assets($e=''){
    
    if($e == 'grid-post'):
        
        load_assets(array('element-gridpost-css'));
    
    elseif($e == 'gform-sub'):

        load_assets(array('gform'));
        load_assets(array('element-gformsub-css'));

    elseif($e == 'quotes'):        

        load_assets(array('element-quotes-css'));

    elseif($e == 'tabs'):        

        load_assets(array('element-tabs-css'));
    
    elseif($e == 'tooltip'):        

        load_assets(array('element-tooltip-css'));

    elseif($e == 'cards'):        

        load_assets(array('element-cards-css'));    
        
    elseif($e == 'gmap'):        

        load_assets(array('element-gmap-css'));          

    endif;

}

/* #endregion */ 

/*-------------------------------------------------------------*/

/* ANCHOR[id=column-size] */

/* #region ## COLUMN SIZE (5/7 | 6/6 | 8/4)  */ 

function data_colsize($e) {
    
    $opt = '';
    $col = array(6,6);

    if(isset($e['display_fields'])) {
        $opt = $e['display_fields'];

        if(isset($opt['columns'])) {
            $col = explode('/', $opt['columns']);
        }
    }    

    return $col;

}

/* #endregion */ 

/*-------------------------------------------------------------*/

/* ANCHOR [id=bs-row] */

/* #region ## BS ROW (2 / 3 / 4 / 6) colums */ 

function data_colcount($e) {

    $cols = 3;

    if(isset($e['display_fields'])) {   
        $opt = $e['display_fields'];

        if(isset($opt['col_count'])) {
            
            $amt = $opt['col_count'];

            if($amt == 2) $cols = 6;
            if($amt == 3) $cols = 4;
            if($amt == 4) $cols = 3;
            if($amt == 5) $cols = 'x5';
            if($amt == 6) $cols = 2;
        }    

    }

    return $cols;
}

/* #endregion */ 

/*-------------------------------------------------------------*/

/* ANCHOR[id=opacity] */

/* #region ## OPACITY */ 

function field_opacity($amt, $echo=1) {
    if($amt > 100)
        $amt = 100;

    if($amt and $echo==1) {
        $s = array('opacity'=>"{$amt}%");
        $ss = array_merge(array('s'=>true), $s);
        $style = css_style($ss);   
    }

    if($amt and $echo==0) {        
        $style = array('opacity'=>"{$amt}%");
    }

    if($echo == 1)
        echo $style;

    return $style;    
}

/* #endregion */ 

/*-------------------------------------------------------------*/

/* ANCHOR[id=height] */

/* #region ## HEIGHT */

function data_height($d, $echo=1, $vari='mh') {
    
    $s = array();
    $hh = '';
    $data = '';

    if($echo == 1)
        $style = '';

    if($echo == 0)
        $style = array();

    if($vari == 'mh') {
        $hh = 'min-height';
    }
    if($vari == 'h') { 
        $hh = 'height';
    }          

    if(isset($d['h'])) {

        $h = $d['h'];
        
        if($h and $echo==1) {
            $s = array($hh=>"{$h}px");
            $ss = array_merge(array('s'=>true), $s);
            $style = css_style($ss);   
        }

        if($h and $echo==0) {        
            $style = array($hh=>"{$h}px");
        }

    }        

    if(isset($d['custom-h'])) {
        if($d['custom-h'] != true) {
            $style = array();
        }                    
    }    

    if($echo == 1 and is_array($style) != true)
        echo $style;        

    return $style;
}

/* #endregion */ 

/*-------------------------------------------------------------*/

/* ANCHOR[id=custom-height] */

/* #region ## CUSTOM HEIGHT */

function data_custom_height() {
    return array();
}

/* #endregion */ 

/*-------------------------------------------------------------*/

/* ANCHOR[id=overlay] */

/* #region ## OVERLAY */

function data_overlay($d){
    $o = array();

    $class = '';
    $style = array();

    if(isset($d['overlay'])) {
        $g = $d['overlay'];

        if(isset($g['preset'])) {
            $class = $g['preset'];
        }  

        if($class == 'c') {
            if(isset($g['custom_color'])) {
                if($g['custom_color'] != '') {
                    $style = array('background-color'=>$g['custom_color']);
                }
            }    
        }
    }        

    $tag = array(
        'class' => $class,
        'style' => $style,
    );

    return $tag;
}

/* #endregion */ 

/*-------------------------------------------------------------*/

/* ANCHOR[id=row-adv] */

/* #region ## ROW ADV / Flexic + gap */

function data_colgap($e, $echo=1, $vari='m') {

    $s = array();
    $val = 10;
    
    if($echo == 1)
        $style = '';

    if($echo == 0)
        $style = array();    

    if(isset($e['display_fields'])) { 
        $e = $e['display_fields'];        

        if(isset($e['gap'])) {
            if($e['gap'])
                $val = $e['gap'] / 2;
        }
    }

    if($vari == 'm') {
        $prop = 'margin';
        $s = array($prop => "0 -{$val}px");
    }

    if($vari == 'p') { 
        $prop = 'padding';
        $s = array($prop => "0 {$val}px");
    }        

    if($echo == 1 and $e['gap'] != 0) {
        $style = echo_style($s);
        echo $style;
    } 
    if($echo == 0 and $e['gap'] != 0) {
        $style = $s;
    }

    return $style;
}

/* #endregion */ 

/*-------------------------------------------------------------*/

/* ANCHOR[id=style] */

/* #region ## STYLE ARRAY */

function echo_style($s = array()) {
    $ss = array_merge(array('s'=>true), $s);
    $style = css_style($ss);  
    
    return $style;
}

/* #endregion */

/*-------------------------------------------------------------*/
/*-------------------------------------------------------------*/

function data_isrow($opt, $s=''){

    $ticks = array();
    $custom_row = array();
    $col = array(6,6);

    if($s == 'col') {
        if(isset($opt['columns'])) {
            $col = explode('/', $opt['columns']);
        }

        return $col;
    }

    if($s == 'opt') {    

        if(isset($opt['rtl'])) {
            $rtl = "data-rtl=\"0\"";    
            if($opt['rtl'] == true)
               $rtl = "data-rtl=\"1\"";
               array_push($ticks, $rtl);        
        }

        if(isset($opt['vertical'])) {
            if($opt['vertical'] == true) {
                $custom_v = 'v-align';
                array_push($custom_row, $custom_v);
            }
        }             

        if(count($custom_row) > 0) {
            $custom_rows = implode(",", $custom_row);
            $custom_data = "data-custom=\"{$custom_rows}\"";
            array_push($ticks, $custom_data);
        }          

        $output = implode(" ", $ticks);
        echo $output;
    }
    
}

/*-------------------------------------------------------------*/
/*-------------------------------------------------------------*/

function first_class($show_first=1, $i=1, $class1='', $class2="") {
    if($show_first == 1) {
        $class = ($i==1) ? $class1 : $class2;
    } else {
        $class = $class2;
    }
    return $class;
}


function to_wysiwyg($d, $e, $smp='', $adv='') {

    if($smp != '' and $adv != ''):

        if($d == true) {
            if(isset($e[$smp]))
                return $e[$smp];
        } else {
            if(isset($e[$adv]))
                return $e[$adv];
        }

    endif;   
    
    if($smp == '' and $adv == ''):

        if($d == true) {
            if(isset($e['card_smp']))
                return $e['card_smp'];
            
            if(isset($e['item_smp']))
                return $e['item_smp'];

            if(isset($e['slide_smp']))
                return $e['slide_smp'];    

        } else {
            if(isset($e['card_adv']))
                return $e['card_adv'];

            if(isset($e['item_adv']))
                return $e['item_adv'];  

            if(isset($e['slide_adv']))
                return $e['slide_adv'];                 

        }

    endif;

}


/*------------------------------------------------*/

## seamless = ['cfg_content']
## group = ['your-field']


function el_flex($acf='', $array=array()) {

    $default = array( 
        //default will negate null values
        'div'           =>  '',
        'class'         =>  '',
        'id'            =>  '',
        'echo'          =>  true,
        'data'          =>  '',
        'css'           =>  '',
        'class-items'   =>  'ff',
    );    

    #parameters
    $param = array_merge($default, $array);

    #class
    $class = implode(" ", array('dflexcontent dinfo', $param['class']));

    #item class
    $ic = '';
    if($param['class-items'])
        $ic = $param['class-items'];

    #set attributes 
    $flex_attr = '';

    #process the ACF       
    if(!$acf): 
        /* echo 'error'; */
    endif;

    $content = '';

    if($acf):

        foreach( $acf as $r ):
            $row = $r['acf_fc_layout'];

            $no_echo = array('echo'=>false);
            
            if($row == 'main_title'):

                $div = array("div"=>"{$ic} fmtitle");
                $a = array_merge($div, $no_echo);

                $content .= el_title($r['main_title'], $a);
        
            elseif($row == 'seo_title'): 

                $css = array('css'=>'btitle');
                $div = array("div"=>"{$ic} fbtitle");
                $a = array_merge($css, $div, $no_echo);

                $content .= el_title($r['seo_title'], $a);
        
            elseif($row == 'alt_title'):             

                $css = array('css'=>'atitle');
                $div = array("div"=>"{$ic} fatitle");
                $a = array_merge($css, $div, $no_echo);

                $content .= el_title($r['alt_title'], $a);
        
            elseif($row == 'logo'):     

                $div = array("div"=>"{$ic} flogo", "class"=>"ff-logo");
                $a = array_merge($div, $no_echo);

                $content .= el_img($r['logo'], $a);
            
            elseif($row == 'button'):     

                $div = array("div"=>"{$ic} fbuttons");
                $a = array_merge($div, $no_echo);

                $content .= el_btnloop($r['button_loop'], $a);

            elseif($row == 'text'): 

                if($r['full'] == true):

                    $a = array("class"=>"dtext dtext-f {$ic} ftext", 'full'=>true);
                    $a = array_merge($a, $no_echo);
                    $content .= el_text($r['text_full'], $a);
                    
                else:

                    $a = array("class"=>"dtext {$ic} ftext");
                    $a = array_merge($a, $no_echo);
                    $content .= el_text($r['text'], $a);    

                endif;    

            endif;    
        endforeach; 

    endif;     

    //generate the output parameters
    $class = tag_attr_class($class);
    $id    = tag_attr_id($param['id']);
    $data  = $param['data'];
    $css   = $param['css'];
    $attr  = $flex_attr;
    

    $base = array($class, $id, $data, $css, $attr);
    $tag_attr = implode(" ", $base);    

    $output = "<div {$tag_attr}>{$content}</div>";

    #div
    $output = tag_wrap($param['div'], $output);

    #echo
    if($param['echo'] == 1)
        echo $output;
    
    return $output;        
}

function flex_item_class($n=0, $ic, $class='item') {
    $n++;

    $item_class = "";

    if($ic) 
        $item_class = "{$ic} {$class}-{$n}";
    return $item_class;
}

/* --------------------------------------------------------------------- */




/*
function el_opt($d, $opt='show') {

    $show = '';
    //visibility control 

    $d['before_title'] == true ?  '' : $show .= ' data-bt="0"';
     $d['after_title'] == true ?  '' : $show .= ' data-at="0"'; 
           $d['title'] == true ?  '' : $show .= ' data-tt="0"';
            $d['text'] == true ?  '' : $show .= ' data-tx="0"';
         $d['buttons'] == true ?  '' : $show .= ' data-btn="0"';
     $d['button_show'] == true ?  $show .= ' data-btns="hide"' : '';

    //media control    
    $d['multi_img'] == true ? $show .= ' data-img="multi"' : $show .= ' data-img="single"';    
    $d['stretch_media'] == true ? $show .= ' data-width="stretch"' : '';
    $d['add_image'] == true ? $show .= '' : $show .= ' data-add="none"';
    
    //hover
    $d['hover'] ? $show .= ' data-hover="' . $d['hover'] . '"' : $show .= '';

    //version
    if($v = $d['version']) {
        $v ? $show .= ' data-ver="' . $v . '"' : $show .= '';
    }
   
    if($opt == 'show') {
        return $show;
    }

    //row control
    $row = '';
    
         $d['rtl'] == true ? $row .= ' data-rtl="1"' : $row .= ''; 
    $d['vertical'] == true ? $row .= ' data-align="center"' : $row .= ' data-align="top"';

    if($opt == 'row') {
        return $row;
    }   


}




function el_align($d) {
    $opt = '';

    $d['justify'] ? $opt .= ' data-justify="' . $d['justify'] . '"' : $opt .= '';

    return $opt;
}

function owl($field, $opt) {
    switch ($opt) {
        case "count":
          echo $field['count'];
          break;
        case "margin":
          echo $field['margin'];
          break;
        case "timeout":
          echo $field['timeout'];  
          break;
        case "speed":
          echo $field['speed'];  
          break;
        case "hoverpause":
          $field['hoverpause'] == true ?  $out = 'true' : $out = 'false';
          echo $out;
          break;
        case "dots":
          $field['dots'] == true ?  $out = 'true' : $out = 'false';
          echo $out;
          break;   
        default:
          echo "";
    }
}
// settings - site, logo, social_media, footer
// utilities - menu_extension, footer_menu, placeholders
// header
//$e = theme_opt_ex(settings, site); 

*/