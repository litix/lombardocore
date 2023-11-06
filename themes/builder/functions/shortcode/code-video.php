<?php 
# VIDEO
# ACF FIELD : File | Video URL

/*------------------------------------------------*/

$lazy = constant("LAZY");

global $lazy_class;

$lazy_class   = ($lazy == true)  ?  'lazy ' : '';
//$temp_src = images/placeholder/1px.jpg

/*------------------------------------------------*/

function el_video($acf='', $array=array()) {  

    global $lazy_class;
    
    $default = array( 
        //default will negate null values
        'div'           =>  '',
        'class'         =>  '',
        'id'            =>  '',
        'echo'          =>  true,
        'data'          =>  '',
        'title'         =>  'video-content',
        'css'           =>  'bgvid',
        'lazy'          =>  true,
        'controls'      =>  '',
        'poster'        =>  '',
        'loop'          =>  'loop',                
        'autoplay'      =>  'autoplay',
        'muted'         =>  'muted',
        'playsinline'   =>  'playsinline',
        'type'          =>  'video/mp4',
        'style'         =>  array(),
    );

    #parameters
    $param = array_merge($default, $array);
    
    /* print_r($param['echo']); */

    #style [pending]
    $s = array('s'=>true);
    $s = array_merge($param['style'], $s);
    $style = css_style($s);

    #class
    $class = implode(" ", array($lazy_class, 'lazy-vid', $param['class']));

    #attributes - source
    $media_url = media_src($acf);
    $att_url   = vid_lazy_attr($media_url, $param['lazy'], $param['type']);
    $source_attr = implode(" ", array($att_url['src'], $att_url['type']));

    #attributes - video
    $media_attr = media_attr($param);
    //$vid_attr = implode(" ", array($media_attr['all'], $att_url['src']));
    $vid_attr = implode(" ", array($media_attr['all'], $style));

    if($acf)
        $acf = "<source {$source_attr}>";

    //generate the output parameters
    $tag = array(
        'div'       =>  $param['div'],
        'class'     =>  $class,
        'id'        =>  $param['id'],
        'echo'      =>  $param['echo'],
        'data'      =>  $param['data'],
        'css'       =>  $param['css'],
    );

    $vid_tag = array(
        'tag'        =>  'video',
        'attr'       =>  $vid_attr,
    );
  
    $tags = array_merge($tag, $vid_tag);
    return tag_builder($tags, $acf);    
}

/*------------------------------------------------*/

function el_bgvideo($acf='', $array=array()) {

    $default = array( 
        //default will negate null values
        'div'           =>  '',
        'class'         =>  '',
        'id'            =>  '',
        'echo'          =>  true,
        'data'          =>  '',
        'title'         =>  'video-content',
        'css'           =>  'bgvid',
        'lazy'          =>  true,
        'controls'      =>  '',
        'poster'        =>  '',
        'loop'          =>  'loop',                
        'autoplay'      =>  'autoplay',
        'muted'         =>  'muted',
        'playsinline'   =>  'playsinline',
        'type'          =>  'video/mp4',
        'style'         =>  array(),        
    );

    $param = array_merge($default, $array);
    
    el_video($acf, 
        array(
            'div'           => 'overlay overlay-bg overlay-fire', 
            'class'         => $param['class'], 
            'id'            => $param['id'],
            //'echo'          => $param['echo'],
            'data'          => $param['data'],
            'title'         => $param['title'],
            'css'           => $param['css'],            
            'lazy'          => $param['lazy'],
            'controls'      => $param['controls'],
            'poster'        => $param['poster'],
            'loop'          => $param['loop'],
            'autoplay'      => $param['autoplay'],
            'muted'         => $param['muted'],
            'playsinline'   => $param['playsinline'],
            'type'          => $param['type'],            
            'style'         => $param['style'],
        )
    );
}

/*------------------------------------------------*/

function el_popvideo($acf='', $array=array()) {

    load_assets(array('bootstrap'));

    global $videocount;
    $videocount++;

    global $lazy_class;
    global $tpath;

    $icon = $tpath . '/images/icons/zoom-vid.svg';    

    $default = array( 
        //default will negate null values
        'div'           =>  '',
        'class'         =>  '',
        'id'            =>  '',
        'echo'          =>  true,
        'data'          =>  '',
        'title'         =>  'popup-video',
        'lazy'          =>  true,
        'icon'          =>  $icon, 
        'thumb'         =>  '', /* thumbnail */
    );

    #parameters
    $param = array_merge($default, $array);

    #class
    $vid_class = implode(" ", array($lazy_class, 'pop-vid'));
    $a_class = "class=\"{$param['class']}\"";    

    #id
    $id = $param['id'] ? "id=\"{$param['id']}\"" : "";
    $lazy = $param['lazy'];
    
    if($acf) {
        $vid = el_video($acf, 
        array(
            'class' => $a_class, 
            'lazy'  => $lazy, 
            'echo'  => false,
            'autoplay' => '',
            'controls' => '',
            'muted'    => 'muted',
        ));

        if($param['thumb'])
            $vid = el_img($param['thumb'], array('class'=>$vid_class, 'echo'=>false));

        $media_url = media_src($acf);
        $modal = "videomodal{$videocount}";

        $file = pathinfo($media_url);
        $extension = $file['extension'];

        if($extension == 'mp4') {
            $href = $media_url ? "data-fancybox href=\"{$media_url}\" title=\"{$param['title']}\" target=\"_self\"" : "";
        }

        if($extension != 'mp4') {
            $href = $media_url ? "data-fancybox data-src=\"#videomodal{$videocount}\" title=\"{$param['title']}\"" : "";
        }

        $data = implode(" ", array($href, $id, $a_class, $param['data']));

        if($media_url) {
            $output = "<a {$data}>";
            $output .= $vid;

            if($param['icon']) {
                $icon = el_img($param['icon'], array('alt'=>'zoom-icon', 'class'=>'icon-pop', 'echo'=>false));
                $output .= "<div class=\"overlay dflex-center\">{$icon}</div>";
            }            

            $output .= "</a>";
            
            if($extension != 'mp4') {
                $output .= "<div class=\"fancy-modal\" id=\"videomodal{$videocount}\"";
                $output .= ' tabindex="-1" aria-labelledby="'. "videomodal{$videocount}" . '" aria-hidden="true">';
                $output .= '<div class="fancy-container">';
                $output .= el_video($media_url, array('echo'=>false, 'muted'=>'', 'controls'=>'controls'));
                $output .= '</div>';
                $output .= '</div>';
            }
        }
    }

    #div
    if($output)
        $output = tag_wrap($param['div'], $output);

    #echo
    if($param['echo'] == 1)
        echo $output;
        
    return $output;      
}


/*------------------------------------------------*/

function media_attr($param=array()) {
    $attr = array(
        'title'       => $param['title'],
        'controls'    => $param['controls'],         
        'poster'      => $param['poster'],
        'loop'        => $param['loop'], 
        'autoplay'    => $param['autoplay'],
        'muted'       => $param['muted'],
        'playsinline' => $param['playsinline'],
    );
    
    $title       = $param['title']       ? "title=\"{$param['title']}\"" : "";
    $controls    = $param['controls']    ? "controls=\"{$param['controls']}\"" : "";
    $loop        = $param['loop']        ? "loop=\"{$param['loop']}\"" : "";
    $autoplay    = $param['autoplay']    ? "autoplay=\"{$param['autoplay']}\"" : "";
    $muted       = $param['muted']       ? "muted=\"{$param['muted']}\"" : "";
    $playsinline = $param['playsinline'] ? "playsinline=\"{$param['playsinline']}\"" : "";
    

    $poster = '';
    if($param['poster'])
        $poster = image_src($param['poster']);
    
    $poster = $poster ? "poster=\"{$poster}\"" : "";

    $all = implode(" ", array($title, $controls, $loop, $autoplay, $muted, $playsinline, $poster));

    $data = array(
        'all'         => $all,
        'title'       => $title,
        'controls'    => $controls,
        'loop'        => $loop,
        'autoplay'    => $autoplay,
        'playsinline' => $playsinline,
        'muted'       => $muted,
        'poster'      => $poster,
    );

    return $data;
}

function vid_lazy_attr($url, $param_lazy=true, $param_type='') {
    $lazy = constant("LAZY");
    $temp_src = constant("TEMP_VSRC");
    
    global $temp_src;

    $src         = 'src="' . $url . '" ';
    $placholder  = 'src="' . $temp_src . '"';
    $lazysrc     = 'data-src="' . $url . '"';    
    //placeholder not implemented

    $type = $param_type ? "type=\"{$param_type}\"" : "";

    if($lazy == true) {
        if($param_lazy == true) {
            $src = $src . $lazysrc;
            $lazy_attr = "loading=\"lazy\"";
        }
    }

    $all = implode(" ", array($src, $lazy_attr, $type));
    $data = array(
        'src'  =>  $src, 
        'lazy' =>  $lazy_attr, 
        'type' =>  $type, 
        'all'  =>  $all
    );

    return $data;
}

function media_src($acf) {

    if(is_numeric($acf) == true) {
        $url = wp_get_attachment_url( $acf );    
    } else {
        $url = esc_attr($acf);
    }    

    if(is_array($acf) == true):  
        $url = $acf['url'];    
    endif;        
    
    return $url;
}


?>
