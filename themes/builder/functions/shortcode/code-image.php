<?php 
# TITLE
# ACF FIELD : Image | Image URL (no acf) | Image ID (no acf)

/*------------------------------------------------*/

$lazy = constant("LAZY");
$temp_src = constant("TEMP_SRC");

global $lazy_class;
$lazy_class   = ($lazy == true)  ?  'lazy ' : '';

/*------------------------------------------------*/

function el_img($acf='', $array=array()) {  

    global $lazy_class;

    $default = array( 
        //default will negate null values
        'div'       =>  '',
        'class'     =>  '',
        'id'        =>  '',
        'echo'      =>  true,
        'data'      =>  '',
        'css'       =>  'dimage',
        'lazy'      =>  true,
        'll'        =>  1, /* 1, 2, 3 */
        'src'       =>  '',
        'alt'       =>  '',
        'size'      =>  'full',
        'width'     =>  '',
        'height'    =>  '',
        'sizes'     =>  '',
        'span_after'=>  true,
    );

    #parameters
    $param = array_merge($default, $array);  

    #class
    $class = implode("", array($lazy_class, $param['class']));

    //print_r($param['size']);

    #image attributes
    $attr  = lazy_attr($acf, $param['size'], $param['lazy'], $param['ll']);
    $basic_attr = array($attr['src'], $attr['lazy'], $attr['data']);

    #image meta
    $meta = image_meta($acf, $param['alt']);
    $meta_attr = array($meta['alt'], $meta['title']);

    #image size
    $size = image_size($param['width'], $param['height'], $param['sizes']);
    $size_attr = array($size['all']);

    #combine 3 attr
    $image_attr = implode(" ", array_merge($basic_attr, $meta_attr, $size_attr));

    #title, caption, description
    $after = '';
    if($param['span_after'] == true)
        $after = $meta['after'];

    //generate the output parameters
    $tag = array(
        'div'       =>  $param['div'],
        'class'     =>  $class,
        'id'        =>  $param['id'],
        'echo'      =>  $param['echo'],
        'data'      =>  $param['data'],
        'css'       =>  $param['css'],
    );
 
    $image_tag = array(
        'tag'       =>  'img',
        'attr'      =>  $image_attr,
        'after'     =>  $after,
    );
    
    $tags = array_merge($tag, $image_tag);
    return tag_builder($tags, $acf);
}

/*------------------------------------------------*/

function el_popimage($acf='', $array=array()) { 

    global $lazy_class;
    global $tpath;

    $icon = $tpath . '/images/icons/zoom-img.svg';

    $output = '';
    $default = array( 
        //default will negate null values
        'div'       =>  '',
        'class'     =>  '',
        'id'        =>  '',
        'echo'      =>  true,
        'data'      =>  '',
        'title'     =>  'popup-image',
        'lazy'      =>  true,
        'icon'      =>  $icon
    );  

    #parameters
    $param = array_merge($default, $array);  

    #class
    $img_class = implode(" ", array($lazy_class, 'pop-img'));
    $a_class = "class=\"{$param['class']}\"";

    #id
    $id = $param['id'] ? "id=\"{$param['id']}\"" : "";

    if($acf) {

        $img = el_img($acf, array('class'=>$img_class, 'echo'=>false));
        $img_src = image_src($acf);

        $href = $img_src ? "href=\"{$img_src}\" title=\"{$param['title']}\" target=\"_self\"" : "";

        $data = implode(" ", array('data-fancybox', $href, $id, $a_class, $param['data']));

        if($img_src) {
            $output = "<a {$data}>";
            $output .= $img;

            if($param['icon']) {
                $icon = el_img($param['icon'], array('alt'=>'zoom-icon', 'class'=>'icon-pop', 'echo'=>false));
                $output .= "<div class=\"overlay dflex-center\">{$icon}</div>";
            }

            $output .= "</a>";
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

function image_src($acf='', $size='full'){

    if(is_numeric($acf) == true) {
        #as ID
        $url = wp_get_attachment_image_url( $acf, $size );
    } else {
        #as URL
        $url = $acf;
    }

    if(is_array($acf) == true) {
        #as Array

        if($size == 'full') {
            $url_size = $acf['url'];
        } else {
            $url_size = $acf['sizes'][ $size ];
        }
        //$width    = $acf['sizes'][ $init_size . '-width' ];
        //$height   = $acf['sizes'][ $init_size . '-height' ];
        //$url_size = ($size == 'full' ? $url : $url_size);
        $url = $url_size;
    }

    return $url;
}

function image_meta($acf, $param_alt='') {

    if(is_numeric($acf) == true) { #as ID  
    
        $attachment = get_post($acf);
        $alt        = esc_html(get_post_meta($acf, '_wp_attachment_image_alt', TRUE));          
        $alt       .= " {$param_alt}";
        $title      = esc_html($attachment->post_title);
        $caption    = $attachment->post_excerpt;
        $desc       = $attachment->post_content;

    } else { #as URL    

        $alt = $param_alt ? " {$param_alt}" : 'content-image';
        $title = '';
        $caption = '';
        $desc = '';

    }    

    if(is_array($acf) == true): #as Array    

        if(isset($acf['alt'])) {
            $alt     = esc_html($acf['alt']);
            $alt    .= " {$param_alt}";
        }

        if(isset($acf['title']))
            $title   = esc_html($acf['title']);
        
        if(isset($acf['caption']))
            $caption = esc_html($acf['caption']);

        if(isset($acf['description']))
            $desc    = esc_html($acf['description']);

    endif;

    $alt_only   = "{$alt}";
    $title_only = "{$title}";

    $alt     = "alt=\"{$alt}\"";
    $ttitle  = $title   ? "title=\"{$title}\"" : "" ;
    $dtitle  = $title   ? "<span class=\"nfo img-title\">{$title}</span>" : "";
    $caption = $caption ? "<span class=\"nfo img-caption\">{$caption}</span>" : "";
    $desc    = $desc    ? "<span class=\"nfo img-desc\">{$desc}</span>" : "";

    $meta_attr = implode(" ", array($alt, $ttitle));
    $meta_after = implode(" ", array($dtitle, $caption, $desc));
    $meta_after = "$meta_after";
    $meta = array(
        'alt'        => $alt,
        'title'      => $ttitle,
        'caption'    => $caption,
        'desc'       => $desc,
        'attr'       => $meta_attr,
        'after'      => $meta_after,
        'alt_only'   => $alt_only,
        'title_only' => $title_only,
    );

    return $meta;
}

function lazy_attr($acf, $size, $param_lazy, $ll) {
    $lazy = constant("LAZY");
    $temp_src = constant("TEMP_SRC");

    //$temp_src = images/placeholder/1px.jpg
    $lazy_attr = '';
    $data = '';

    $url        = image_src($acf, $size);
    $placholder = 'src="' . $temp_src . '"';
    $src        = 'src="' . $url . '"';
    $lazysrc    = 'data-src="' . $url . '" ' . $placholder;

    if($lazy == true) {

        if($param_lazy == true) {

            if($ll == 1):
              ## [✓] data-src (js base)
              ## [X] loading="lazy"
              $src = is_admin() ? $src : $lazysrc;
            endif;
            
            if($ll == 2):              
              ## [X] data-src 
              ## [✓] loading="lazy"
              $src = is_admin() ? $src : $src;
              $lazy_attr = "loading=\"lazy\"";              
            endif;

            if($ll == 3):              
              ## [✓] data-src 
              ## [✓] loading="lazy" creates error on IOS
              $src = is_admin() ? $src : $lazysrc;
              $lazy_attr = "loading=\"lazy\"";              
            endif;                       

            $data = "data-lazylvl=\"{$ll}\"";  
                 
        }

    }

    $data = array('src'=>$src, 'lazy'=>$lazy_attr, 'data'=>$data);

    return $data;
}

function image_size($w, $h, $sz) {

    $width  = $w  ? "width=\"{$w}\"" : "";
    $height = $h  ? "height=\"{$h}\"" : "";
    $sizes  = $sz ? "sizes=\"{$sz}\"" : "";

    $all = implode(" ", array($height, $width, $sizes));

    $meta_sizes = array(
        'all'       => $all,
        'width'     => $width,
        'height'    => $height,
        'sizes'     => $sizes,
    );

    return $meta_sizes;
}