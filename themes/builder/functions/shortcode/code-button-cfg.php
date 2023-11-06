<?php 
# BUTTON
# ACF FIELD : advanced link
# see builder/lib-acf-advlink.php

# clone field : cfg_button (group) > cfg_link (link) 

/*------------------------------------------------*/

/* #region ~ Button Clone */

function el_clink($acf='', $array=array()) {

    global $el_link_id;
    $el_link_id++;

    //default will negate null values
    $default = array( 
        'div'       =>  '',
        'class'     =>  '',
        'id'        =>  '',
        'echo'      =>  true,
        'data'      =>  '',        
        'rel'       =>  '', 
        'type'      =>  '',
    );

    #parameters
    $param = array_merge($default, $array);    

    if(isset($acf))
        $link = el_cfg_display($acf);  

    #advanced link data
    $design     =   $link['design'];
    $url        =   $link['url'];
    $title      =   $link['title'];      
    $target     =   $link['target'];
    $type       =   $link['type'];

    if(isset($link['popup']))
        $popup = $link['popup'];

    if(isset($link['modal']))
        $modal = $link['modal'];

    if(isset($link['icon']))
        $icon = wp_get_attachment_image($link['icon']);

    # generate class
    $btn_attr = el_cfg_attr($link);
    $class = implode(" ", array($param['class'], $btn_attr['class']));

    # generate popup"
    $link_meta = el_cfg_meta($link, $clone=0);
    $pop = $link_meta['pop'];

    # generate link popup ie. data-foo="bar"
    $data  = implode(" ", array($param['data'], $pop, $btn_attr['data']));

    # generate the icons
    $link_text = el_btn_attr($link);
    $link_text = $link_text['text'];
    
    #generate the modal
    $modal = el_btn_modal($link, $el_link_id);

    #generate addon
    $extras = array('rel'=>$param['rel']);   
    $extras = el_link_extra($extras);
    $extra_attr = $extras['all'];

    # generate link attributes (url, title, target + extra (param))
    if($pop != true) {
        $link_attr  = el_cfg_attr($link);       
        $attr  = implode(" ", array($link_attr, $extra_attr));
    } else {
        $attr = $link_meta['url'];
    }
    
    # final parameter
    $tag = array(
        'div'       =>  $param['div'],
        'class'     =>  $class,
        'id'        =>  $param['id'],
        'echo'      =>  $param['echo'],
    );

    $link_tag = array( 
        'tag'       =>  'a',
        'attr'      =>  $attr,
        'type'      =>  $type,
        'data'      =>  $data,
        'before'     =>  $modal,
    );

    $tags = array_merge($tag, $link_tag);

    return tag_builder($tags, $link_text);
}
/* #endregion */

/*------------------------------------------------*/

/* #region */

function el_cbtnloop($acf='', $div_array=array()) {
   
    $default = array( 
        'div'       =>  'btn-loop ',
        'class'     =>  '',
        'id'        =>  '',
        'echo'      =>  true,
        'data'      =>  '',
    );

    $param = array_merge($default, $div_array);  
    
    #parameters
    $class      =   tag_attr_class($param['class']);
    $id         =   tag_attr_id($param['id']);
    $echo       =   $param['echo'];
    $data       =   $param['data'];        

    $class = $param['div'] . $param['class'];
    $div_attr = implode(" ", array($data, $id));

    $output = '';
  
    if($acf):
        foreach( $acf as $clone ):
            $output .= el_clink($clone, array('echo'=>false));        
        endforeach;
    endif;    
      
    $output = tag_wrap($class, $output, $div_attr);

    if($param['echo'] == 1)
        echo $output;

    return $output;
}

/* #endregion */

# generate link attributes (url, title, target)
function el_cfg_attr($link, $clone=0) {   

    if($clone == 1)
         $link = el_btn_display($link, 0);

    $target = '_self';

        if(isset($link['target']))
            $target = $link['target'] ? $link['target'] : '_self';

        if(isset($link['url']))
            $url = "href=\"{$link['url']}\"";

        if(isset($link['title']))
            $title  = "title=\"{$link['title']}\"";
      
            $target = "target=\"{$target}\"";

        $output = implode(" ", array($url, $title, $target));   

        return $output;
    
}

/*------------------------------------------------*/

function el_cfg_meta($acf='', $clone=0, $echo=0) {   

    global $el_link_id;

    $link = ($clone == 1) ? $link = el_btn_display($acf, 0) : $acf;

    if(isset($link['popup'])) {
        $popup  = ($link['popup'] != '') ? $link['popup'] : false;
    }

    if(isset($link['modal'])) {
        $modal  = ($link['modal'] != '') ? $link['modal'] : false;    
    }

    $pop = '';

    if($acf){
        $url    = "href=\"{$link['url']}\"";
        $title  = "title=\"{$link['title']}\"";
        $target = $link['target'] ? $link['target'] : '_self';        
        $target = "target=\"{$target}\"";
    }

    if(isset($link['popup'])) {
        $pop = ($popup == true) ? 'data-fancybox' : '';
    }

    if(isset($link['modal'])) {
        //$pop = ($modal == true) ? "data-toggle=\"modal\" data-target=\"#linkmodal{$el_link_id}\"" : $pop;
        $pop = ($modal == true) ? "data-fancybox data-src=\"#linkmodal{$el_link_id}\"" : $pop;
    }

    if($acf){
        $all = implode(" ", array($url, $title, $target, $pop)); 

        $output = array(
            'all'         => $all,
            'pop'         => $pop,
            'url'         => $url,
            'title'       => $title,
            'title_only'  => $link['title'],
            'target'      => $target,
        );

        if($echo == 1)
            echo $output['all'];

        return $output;
    }
}

function el_bbtn($acf, $array=array()) {

    $default = array( 
        'as'        =>  'button', //div, span, etc        
        'class'     =>  '',
        'div'       =>  '',
        'id'        =>  '',
        'echo'      =>  true,
        'data'      =>  '',
        'type'      =>  '',
    );

    $param = array_merge($default, $array);  

    if(is_array($acf))
        $link = el_btn_display($acf);  

    # generate class
    $btn_attr = el_btn_attr($link);
    $class = implode(" ", array($param['class'], $btn_attr['class']));  

    # generate the data
    $data = implode(" ", array($btn_attr['data'], $param['data']));

    # generate the icons
    $link_text = el_btn_attr($link);
    $link_text = $link_text['text'];       

    //generate the output parameters
    $tag = array(
        'div'       =>  $param['div'],
        'class'     =>  $class,
        'id'        =>  $param['id'],
        'echo'      =>  $param['echo'],
    );

    $link_tag = array( 
        'tag'       =>  $param['as'],
        'attr'      =>  $btn_attr,
        'data'      =>  $data,
        'type'      =>  'button',
    );   

    $tags = array_merge($tag, $link_tag);

    return tag_builder($tags, $link_text);     
}

## Check if SEAMLESS OR GROUP (clone property : display)
function el_cfg_display($clone, $group = 0) {

    #clone inside repeater 
    if($group != 0):
        $multi = $clone['button']; 
        $cfg_group = $multi ? $multi['cfg_button'] : $clone['cfg_button'];
        $cfg_group = $cfg_group['cfg_link'];
    endif;

    #single clone
    if($group == 0):
        $solo = $clone['cfg_button'];
        $cfg_solo = $solo ? $solo['cfg_link'] : $clone['cfg_link'];
    endif;

    $display = ($group == 1) ? $cfg_group : $cfg_solo;

    return $display;
}
?>