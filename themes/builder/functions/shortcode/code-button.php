<?php 
# BUTTON
# ACF FIELD : advanced link
# see builder/lib-acf-advlink.php

# clone field : cfg_button (group) > cfg_link (link) 

/*------------------------------------------------*/

/* #region ~ Pop Button Field */

function el_advlink($acf='', $array=array()) {

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
        $link = $acf;  

    #advanced link data
    if(isset($link['design']))
        $design = $link['design'];
    
    if(isset($link['url']))
        $url = $link['url'];

    if(isset($link['title']))
        $title = $link['title'];      

    if(isset($link['target']))
        $target = $link['target'];

    $type = '';
    if(isset($link['type']))
        $type = $link['type'];

    if(isset($link['popup']))
        $popup = $link['popup'];

    if(isset($link['modal']))
        $modal = $link['modal'];

    if(isset($link['icon']))
        $icon = wp_get_attachment_image($link['icon']);

    if(isset($acf)) {
        # generate class - button design
        $btn_attr = el_btn_attr($link);
        $class = implode(" ", array($param['class'], $btn_attr['class']));

        # generate - href, title, target, pop
        $pop = false;
        $link_meta = el_link_meta($link);
        if(isset($link_meta['pop']))
            $pop = $link_meta['pop'];

        # generate link popup - ie. data-foo="bar"
        $data  = implode(" ", array($param['data'], $pop, $btn_attr['data']));

        # generate text 
        $link_text = '';
        $link_text = el_btn_attr($link);
        $link_text = $link_text['text'];
    
        #generate - modal
        $modal = el_btn_modal($link, $el_link_id);

        #generate addon
        $extras = array('rel'=>$param['rel']);   
        $extras = el_link_extra($extras);
        $extra_attr = $extras['all'];

        # isolate attributes (url, title, target + extra (param))
        if($pop != true) {
            $link_attr  = el_link_attr($link);       
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

}
/* #endregion */

/*------------------------------------------------*/

/* #region ~ Button Loop */

function el_btnloop($acf='', $div_array=array()) {
   
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
        foreach( $acf as $btn ):
            $output .= el_advlink($btn['button'], array('echo'=>false));        
        endforeach;
    endif;    
    
    if($acf):
        $output = tag_wrap($class, $output, $div_attr);
    endif;

    if($param['echo'] == 1)
        echo $output;


    return $output;
}

/*------------------------------------------------*/

/* #region ~ Link or Div */

function el_notlink($acf, $array=array()) { 

    $default = array( 
        'class'     =>  'item',
        'div'       =>  '',
        'id'        =>  '',
        'echo'      =>  true,
        'data'      =>  '',
        'type'      =>  '',
    );

    $param = array_merge($default, $array);  

    $data  = $param['data']; 
    $id    = tag_attr_id($param['id']);
    $class = tag_attr_class($param['class']);

    $tag = 'div';
    $attr = implode(" ", array($data, $id, $class));
    $tg[0] = "<{$tag} {$attr}>";
    $tg[1] = "</{$tag}>";    

    if($acf) {
        $link_meta = el_link_meta($acf);

        $href = '';

        if($link_meta) {

            $tag = 'a';
            $href = implode(" ", array($link_meta['all']));
            $attr = implode(" ", array($href, $data, $id, $class));

            $tg[0] = "<{$tag} {$attr}>";
            $tg[1] = "</{$tag}>";

        } 
        
    } 

    return array($tg[0],$tg[1]);
}

/* #endregion */

/* #region ~ Static Button */

function el_static_btn($acf, $array=array()) {

    $default = array( 
        'as'        =>  'button', //div, span, etc        
        'class'     =>  '',
        'div'       =>  '',
        'id'        =>  '',
        'echo'      =>  true,
        'data'      =>  '',
        'rel'       =>  '', 
        'type'      =>  '',
    );

    $param = array_merge($default, $array);  

    $link = $acf;  

    # generate class
    $btn_attr = el_btn_attr($link);
    $class = implode(" ", array($param['class'], $btn_attr['class']));  

    # generate the data
    $data = implode(" ", array($btn_attr['data'], $param['data']));

    # generate the text
    $link_text = el_btn_attr($link);
    $link_text = $link_text['text'];       

    # generate - href, title, target, pop
    $pop = false;
    $link_meta = el_link_meta($link);
    if(isset($link_meta['pop']))
        $pop = $link_meta['pop'];

    #generate addon
    $extras = array('rel'=>$param['rel']);   
    $extras = el_link_extra($extras);
    $extra_attr = $extras['all'];

    if($pop != true) {
        $link_attr  = el_link_attr($link);       
        $attr  = implode(" ", array($link_attr, $extra_attr));
    } else {
        $attr = $link_meta['url'];
    }

    //generate the output parameters
    $tag = array(
        'div'       =>  $param['div'],
        'class'     =>  $class,
        'id'        =>  $param['id'],
        'echo'      =>  $param['echo'],
    );

    $link_tag = array( 
        'tag'       =>  $param['as'],
        //'attr'      =>  $attr,
        'data'      =>  $data,
        'type'      =>  'button',
    );   

    $tags = array_merge($tag, $link_tag);

    return tag_builder($tags, $link_text);     
}

/* #endregion */

/*------------------------------------------------*/

/* #region ~ Regular Advance Link */

function el_link($acf='', $array=array()) {

    $default = array( 
        'class'     =>  'link-more',
        'div'       =>  '',
        'id'        =>  '',
        'echo'      =>  true,
        'data'      =>  '',
        'type'      =>  '',
        'popup'     =>  false,
    );

    $param = array_merge($default, $array);  


    $id     =  $param['id'];

    if($acf) {

        $url = $acf['url'];

        $a_class = el_link_active($url);

        #parameters
        $class = implode(" ", array($param['class'], $a_class));

        $attr = el_link_meta($acf);
        $attr = $attr['all'];

        $link_text = el_link_meta($acf);
        $link_text = $link_text['title_only']; 
        if($link_text)
            $link_text = "<span>{$link_text}</span>";

        if($param['popup'] == true)
            $attr .= " data-fancybox";

        # final parameter
        $tag = array(
            'div'       =>  $param['div'],
            'class'     =>  $class,
            'id'        =>  $param['id'],
            'echo'      =>  $param['echo'],
            'data'      =>  $param['data'],
        );

        $link_tag = array( 
            'tag'       =>  'a',
            'attr'      =>  $attr,
        );

        $tags = array_merge($tag, $link_tag);

        return tag_builder($tags, $link_text);
        
    }
}

/* #endregion */

/* #region ~ Regular Link */

function el_a($url='', $array=array()) {

    $default = array( 
        'class'     =>  'link-more',
        'div'       =>  '',
        'id'        =>  '',
        'echo'      =>  true,
        'data'      =>  '',
        'type'      =>  '',
        'target'    =>  '',
        'title'     =>  'link',
        'popup'     =>  false,
    );

    $param = array_merge($default, $array);  

    $target = $param['target'] ? $param['target'] : '_self';

    $fake_acf = array(
        'url'    => $url,
        'target' => $target,
        'title'  => esc_html($param['title']),
    );
    $attr = el_link_attr($fake_acf);
  
    $link_text = "<span>{$param['title']}</span>"; 

    # final parameter
    $tag = array(
        'div'       =>  $param['div'],
        'class'     =>  $param['class'],
        'id'        =>  $param['id'],
        'echo'      =>  $param['echo'],
        'data'      =>  $param['data'],
    );

    $link_tag = array( 
        'tag'       =>  'a',
        'attr'      =>  $attr,
    );

    $tags = array_merge($tag, $link_tag);

    return tag_builder($tags, $link_text);
}

/* #endregion */

## AUXILLIARIES
/*------------------------------------------------*/

/* #region ~ Button - Design */

# generate auxillaries
function el_btn_attr($link) {

    $icon   = '';
    $title  = '';
    $design = '';
    $output = '';
    $text   = '';

    if(isset($link['design']))
        $design = $link['design'];
    
    if(isset($link['title']))        
        $title = $link['title'];  

    if(isset($link['icon']))
        $icon = $link['icon'];

    $icon_url = wp_get_attachment_image_url($icon);
    $span_title = "<span class=\"a-span\" data-text=\"{$title}\">{$title}</span>";

    $pre = '';
    $pos = '';

    switch ($design) {

        case "more":
            $class = "link-text link-more";
            $data  = '';
            break;

        case "b-icon":
            $class = "btn btn-icon";
            $data = 'data-icon="icon"';
            $pre = el_img($icon, array('echo'=>false, 'll'=>2));
            break;

        case "btn-icon-text":
            $class = "btn btn-n";
            $data = 'data-icon="btn"';
            $pre = el_img($icon, array('echo'=>false, 'll'=>2));
            break;

        case "pre-icon":
            $class = "btn w-icon";
            $data = 'data-icon="pre"';
            $pre = el_img($icon, array('echo'=>false, 'll'=>2));
            break;

        case "post-icon":
            $class = "btn w-icon";
            $data = 'data-icon="post"';
            $pos = el_img($icon, array('echo'=>false, 'll'=>2));
            break;        
            
        default:
            $class = "btn {$design}";
            $data  = '';
            $icon  = '';
            $pre  = '';
            $post = '';
    }

    if($title)
        $text = "{$pre}{$span_title}{$pos}";

    $output = array('class'=>$class, 'data'=>$data, 'text'=>$text);

    return $output;
}

/* #endregion */

/* #region ~ Button - href, target, title, pop */

function el_link_meta($acf='', $echo=0) {   

    global $el_link_id;

    $url = '';
    $title = '';
    $target = '';
    $pop = '';

    if(isset($acf['popup'])) {
        $popup  = ($acf['popup'] != '') ? $acf['popup'] : false;
    }

    if(isset($acf['modal'])) {
        $modal  = ($acf['modal'] != '') ? $acf['modal'] : false;    
    }

    $pop = '';

    if($acf){
        $url    = "href=\"{$acf['url']}\"";
        $title  = "title=\"{$acf['title']}\"";
        $target = $acf['target'] ? $acf['target'] : '_self';        
        $target = "target=\"{$target}\"";
    }

    if(isset($acf['popup'])) {
        $pop = ($popup == true) ? 'data-fancybox' : '';
    }

    if(isset($acf['modal'])) {
        //$pop = ($modal == true) ? "data-toggle=\"modal\" data-target=\"#linkmodal{$el_link_id}\"" : $pop;
        if (str_contains($acf['url'], 'http')) {
            $pop = ($modal == true) ? "data-fancybox data-src=\"#linkmodal{$el_link_id}\"" : $pop;
        } else {
            $pop = ($modal == true) ? "data-fancybox data-src=\"{$acf['url']}\"" : $pop;
        }
        
    }

    if($acf){
        $all = implode(" ", array($url, $title, $target, $pop)); 

        $output = array(
            'all'         => $all,
            'pop'         => $pop,
            'url'         => $url,
            'title'       => $title,
            'title_only'  => $acf['title'],
            'target'      => $target,
        );

        //$output = $output['all'];          

        if($echo == 1) {
            $output = implode(" ", array($output['all']));
            echo $output;
        }         

        return $output;
    }
}

/* #endregion */

/* #region ~ Link is Active */

function el_link_active($url='') {
    global $post;
    $this_page = '';
    if(isset($post))
        $this_page = $post->ID;

    $current_url = get_the_permalink($this_page);  
    
    $menu_class = '';
    if($this_page):
        if($current_url == $url)
            $menu_class = 'is-active';
    endif;

    return $menu_class;
}

/* #endregion */

/* #region ~ Button - Modal */

function el_btn_modal($link, $el_link_id) {   

    $modal = '';
    $output = '';

    if(isset($link['url'])) {
        $url = $link['url'];
        
        if (str_contains($url, 'http')) {
            if(isset($link['modal'])) {
                $modal = $link['modal'];
            }
        }
        
        if($modal) {
            $output = "<div class=\"fancy-modal\" id=\"linkmodal{$el_link_id}\"";
            $output .= ' tabindex="-1" aria-labelledby="'. "linkmodal{$el_link_id}" . '" aria-hidden="true">';
            $output .= '<div class="fancy-container">';
            $output .= '<iframe class="lazy" loading="lazy" src="about:blank" data-src="' . $url . '"></iframe>';
            $output .= '</div>';
            $output .= '</div>';
        }
    }

    return $output;
}

/* #endregion */

/* #region ~ Button - Addon */
function el_link_extra($array=array()) {

    $default = array( 
        'rel'       =>  '', 
    );

    #parameters
    $param = array_merge($default, $array);

    $rel = '';
    if($param['rel'])
        $rel = "rel=\"{$param['rel']}\"";

    $all = implode(" ", array($rel)); 

    $output = array(
        'all'    => $all,
        'rel'    => $rel,
    );

    return $output;
}
/* #endregion */

/* #region ~ Link - Attributes */

function el_social_icon($url, $array=array()) {   

    global $spath;

    $x = $spath . '/images/social/twitter.svg';
    $linkedin = $spath . '/images/social/linkedin-1.svg';
    $email = $spath . '/images/social/email.svg';    

    $default = array( 
        's'         =>  '', //twitter, email, linkedin
        'class'     =>  'soc-link',
        'div'       =>  '',
        'id'        =>  '',
        'echo'      =>  true,
        'data'      =>  '',
        'type'      =>  '',
        'target'    =>  '_blank',
        'title'     =>  'link',
        'popup'     =>  false,
    );

    $param = array_merge($default, $array);  

    $target = $param['target'] ? $param['target'] : '_self';

    if($param['s'] == 'email')
        $url = "mailto:{$url}";

    $soc_link = array(
        'url'    => $url,
        'target' => $target,
        'title'  => esc_html($param['title']),
    );

    $attr = el_link_attr($soc_link);
  
    if($param['s'] == 'email'):
        $icon = $email;

    elseif($param['s'] == 'twitter'):
        $icon = $x;

    elseif($param['s'] == 'linkedin'):
        $icon = $linkedin;

    endif;

    $link_text = el_img($icon, array('echo'=>false)); 

    # final parameter
    $tag = array(
        'div'       =>  $param['div'],
        'class'     =>  $param['class'],
        'id'        =>  $param['id'],
        'echo'      =>  $param['echo'],
        'data'      =>  $param['data'],
    );

    $link_tag = array( 
        'tag'       =>  'a',
        'attr'      =>  $attr,
    );

    $tags = array_merge($tag, $link_tag);

    if($url) {
        return tag_builder($tags, $link_text);
    }
}

/* #endregion */

/* #region ~ Link - Attributes */

function el_link_attr($link) {   

    $url    = '';
    $title  = '';
    $output = '';

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

/* #endregion */





?>