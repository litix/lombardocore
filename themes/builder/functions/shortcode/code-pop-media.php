<?php  
# POP MEDIA ~ media selector
# ACF FIELD : POP MEDIA

/*------------------------------------------------*/

function el_media($acf='', $array=array()) {

    global $tpath;
    
    $output = '';

    $icon_img = $tpath . '/images/icons/zoom-img.svg';
    $icon_vid = $tpath . '/images/icons/zoom-vid.svg';  
    $icon_yt  = $tpath . '/images/icons/zoom-yt.svg';  
    $icon_vm  = $tpath . '/images/icons/zoom-vm.svg';

    $default = array( 
        'div'       =>  '',
        'class'     =>  '',
        'id'        =>  '',
        'echo'      =>  true,
        'data'      =>  '',
        'll'        =>  1, /* 1, 2, 3 */
        'icon-vm'   =>  $icon_vm,
        'icon-yt'   =>  $icon_yt,
        'icon-vid'  =>  $icon_vid,
        'icon-img'  =>  $icon_img,
        'lazy'      =>  true, 
        'as'        =>  '', /* '' (default), bg, pop */
        'controls'  =>  'controls',
        'autoplay'  =>  '',
        'muted'     =>  '',
        'height'    =>  '',
        'style'     =>  array(),
    );    

    #parameters
    $param = array_merge($default, $array);    

    if(isset($acf)){

        #style [pending]
        $style = css_style($param['style']);

        #variables
        $media_type    = '';        
        $media_img     = '';        
        $media_yt      = '';
        $media_vm      = '';
        $thumbnail     = '';
        $thumbnail_src = '';

        if(isset($acf['media-type']))
            $media_type = $acf['media-type'];

        if(isset($acf['image']))
            $media_img  = $acf['image'];

        if(isset($acf['video']))
            $media_vid  = $acf['video'];

        if(isset($acf['url']))
            $media_yt   = $acf['url'];
        
        if(isset($acf['vurl']))
            $media_vm   = $acf['vurl'];

        if(isset($acf['thumbnail'])) {
            $thumbnail  = $acf['thumbnail'];
            $thumbnail_src = image_src($thumbnail);
        }


        $class = $param['class'] ? $param['class'] : "";
        $lazy = $param['lazy'];

        $array = array(
            'class' => $class, 
            'lazy'  => $lazy, 
            'echo'  => false
        );

        if($media_type == 'm-image'){

            switch ($param['as']) {

                case "overlay":

                    $def = array(
                        'div'   => "",
                        'class' => "overlay overlay-bg ppm {$class}",
                        'lazy'  => $lazy, 
                        'echo'  => false,
                        'data'  => $param['data'],
                        'll'    => $param['ll'],
                        'style' => $param['style']
                    );

                    $arr = array_merge($array, $def);
                    
                    $output = el_bg($media_img, $arr);

                break;

                case "bg":
                    $output = el_img($media_img, 
                    array(
                        'div'   => "overlay overlay-bg",
                        'class' => "img-bg ppm {$class}",
                        'lazy'  => $lazy, 
                        'echo'  => false,
                        'data'  => $param['data'],
                        'll'    => $param['ll'],
                    ));

                break;

                case "pop":
                    $output = el_popimage($media_img, 
                    array(
                        'class' => "pop-link ppm {$class}",
                        'lazy'  => $lazy, 
                        'echo'  => false,
                        'data'  => $param['data'],
                        'icon'  => $param['icon-img'],
                        'll'    => $param['ll'],
                    ));       

                break;

                default:
                    $output = el_img($media_img, 
                    array(
                        'class' => "ppm {$class}", 
                        'lazy'  => $lazy, 
                        'echo'  => false,
                        'data'  => $param['data'],
                        'll'    => $param['ll'],
                    ));
                    
            }

        }

        if($media_type == 'm-video'){

            switch ($param['as']) {
              
                case "overlay":

                    $def = array(
                        'class' => $param['class'],
                        'lazy'  => $lazy, 
                        'div'   => $param['div'],
                        'echo'  => $param['echo'],
                        'data'  => $param['data'],
                        'style' => $param['style']                        
                    );

                    $arr = array_merge($array, $def);

                    $output = el_bgvideo($media_vid, $arr);

                break;

                case "bg": #no
                    $output = el_bgvideo($media_vid, 
                    array(
                        'class' => "vid-bg ppm {$class}",
                        'lazy'  => $lazy, 
                        'echo'  => false,
                        'data'  => $param['data'],
                        'style' => $param['style']                        
                    ));

                break;

                case "pop": #no
                    $output = el_popvideo($media_vid, 
                    array(
                        'class' => "pop-link ppm {$class}",
                        'lazy'  => $lazy, 
                        'echo'  => false,
                        'data'  => $param['data'],
                        'icon'  => $param['icon-vid'],
                        'thumb' => $thumbnail,
                    ));                

                break;

                default:
                    $output = el_video($media_vid, 
                    array(
                        'class' => "ppm std-vid {$class}", 
                        'lazy'  => $lazy, 
                        'echo'  => false,
                        'data'  => $param['data'],
                        'autoplay' => $param['autoplay'],
                        'controls' => $param['controls'],
                        'muted'    => $param['muted'],
                        'poster'  => $thumbnail,
                    ));
                    
            }        
            
        }

        if($media_type == 'm-youtube'){
            
            switch ($param['as']) {

                case "overlay":
                    $output = el_bgyoutube($media_yt,
                    array(
                        'class'   => "yt-bg ppm {$class}", 
                        'lazy'    => $lazy, 
                        'echo'    => false,
                        'data'    => $param['data'],
                        'style'   => $param['style']
                    ));
                break;

                case "bg":
                    $output = el_bgyoutube($media_yt,
                    array(
                        'class'   => "yt-bg ppm {$class}", 
                        'lazy'    => $lazy, 
                        'echo'    => false,
                        'data'    => $param['data'],
                        'style'   => $param['style']                        
                    ));

                break;

                case "pop": #no
                    $output = el_popyoutube($media_yt,
                    array(
                        'class'     => "pop-link pp-iframe ppm {$class}", 
                        'lazy'      => $lazy, 
                        'echo'      => false,
                        'data'      => $param['data'],
                        'button'    => $param['icon-yt'],
                        'thumb_url' => $thumbnail_src,
                    ));      

                break;

                default:
                    $output = el_youtube($media_yt, 
                    array(
                        'class' => "ppm {$class}", 
                        'lazy'  => $lazy, 
                        'echo'  => false,
                        'data'  => $param['data'],
                        'style' => $param['style']                        
                    ));
            }

        }

        if($media_type == 'm-vimeo'){
            
            switch ($param['as']) {

                case "overlay":
                    $output = el_bgvimeo($media_vm,
                    array(
                        'class'   => "vm-bg ppm {$class}", 
                        'lazy'    => $lazy, 
                        'echo'    => false,
                        'data'    => $param['data'],
                        'style'   => $param['style']                        
                    ));

                break;

                case "bg":
                    $output = el_bgvimeo($media_vm,
                    array(
                        'class'   => "vm-bg ppm {$class}", 
                        'lazy'    => $lazy, 
                        'echo'    => false,
                        'data'    => $param['data'],
                        'style'   => $param['style']                        
                    ));

                break;

                case "pop": #no
                    $output = el_popvimeo($media_vm,
                    array(
                        'class'     => "pop-link ppm pp-iframe {$class}", 
                        'lazy'      => $lazy, 
                        'echo'      => false,
                        'data'      => $param['data'],
                        'button'    => $param['icon-vm'],
                        'thumb_url' => $thumbnail_src,
                    ));
                break;

                default:
                    $output = el_vimeo($media_vm, 
                    array(
                        'class' => "ppm {$class}", 
                        'lazy'  => $lazy, 
                        'echo'  => false,
                        'data'  => $param['data'],
                    )); 
            }

        }


        //$output = $media_type;
        #div
        $output = tag_wrap($param['div'], $output);

        #echo
        if($param['echo'] == true)
            echo $output;

        
        return $output;        

    }

}


function check_media($acf) {

    $status = false;
    if($acf) {
        if($acf['image'] != '' or $acf['video'] != '' or $acf['url'] != '' or $acf['vurl'] != '') {
            $status = true;
        } 
    }    

    return $status;
}
?>