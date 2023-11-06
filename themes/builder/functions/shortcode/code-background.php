<?php 
# TITLE
# ACF FIELD : Image | Image URL | Image ID

/*------------------------------------------------*/

$lazy = constant("LAZY");

global $lazy_class;
$lazy_class   = ($lazy == true)  ?  'lazy ' : '';

/*------------------------------------------------*/

function el_bg($acf='', $array=array()) {  

    global $lazy_class;
    
    $default = array( 
        //default will negate null values
        'div'       =>  '',
        'class'     =>  '',
        'id'        =>  '',
        'echo'      =>  true,
        'data'      =>  '',
        'css'       =>  'bgimg',
        'lazy'      =>  true,
        'title'     =>  '',
        'size'      =>  'full',
        'style'     =>  array(),
    );

    #parameters
    $param = array_merge($default, $array);

    #class
    $class = implode(" ", array($lazy_class, 'bg-img', $param['class']));

    #style
    $ss = array_merge(array('s'=>true), $param['style']);
    $style = css_style($ss);

    #image attributes
    $attr  = bg_attr(
                $acf, 
                $param['size'], 
                $param['lazy'], 
                $param['title'],
                $param['style'],
            );

    $image_attr = $attr['all'];

    //generate the output parameters
    $tag = array(
        'div'       =>  $param['div'],
        'class'     =>  $class,
        'id'        =>  $param['id'],
        'echo'      =>  $param['echo'],
        'data'      =>  $param['data'],
        'css'       =>  $param['css'],
    );

    $after = '';
    
    $div_tag = array(
        'tag'       =>  'div',
        'attr'      =>  $image_attr,
        'after'     =>  $after,
    );

    $tags = array();

    if($acf) {
        $acf = "<span class=\"nfo\">{$attr['text']}</span>";       
        $tags = array_merge($tag, $div_tag);
    }
    
    return tag_builder($tags, $acf);    
}

/*------------------------------------------------*/

function el_bgoverlay($acf, $array=array()) {
    
    $default = array( 
        //default will negate null values
        'div'       =>  '',
        'class'     =>  'overlay overlay-bg',
        'id'        =>  '',
        'echo'      =>  true,
        'data'      =>  '',
        'css'       =>  'bgimg',
        'lazy'      =>  true,
        'title'     =>  '',
        'size'      =>  'full',
        'style'     =>  array(),
    );

    #parameters
    $param = array_merge($default, $array);

    el_bg($acf, 
        array(
            'class'=>$param['class']
        )
    );

}

/*------------------------------------------------*/

function bg_attr(
        $acf, 
        $size='full', 
        $param_lazy, 
        $param_title='',
        $param_style=array()
    ) {

    $style = '';
    $lazy = constant("LAZY");

    $im = image_meta($acf);
    $alt = $im['alt_only'];
    $title = "{$im['title_only']}";
    $text = ''; //???

    $ttitle = $alt ? $alt : $title;
    $text   = $text ? $ttitle : 'text';
    $ttitle = "title=\"{$ttitle} {$param_title}\"";
    
    $url    = image_src($acf, $size);

    ## not lazy
    $bg = array(
            's'=>true, 
            'background-image'=>"url({$url})"
        );
    $non_lazy_bg = array_merge($param_style, $bg);
   
    ## lazy
    $lazysrc = "data-bg=\"{$url}\"";
 
    ## lazy on admin regardless
    $bg = is_admin() ? $lazysrc : css_style($non_lazy_bg); 
    

    if($lazy == true) {
        if($param_lazy == true) {

            $bg = $lazysrc;

            $prop = array('s'=>true);
            $prop = array_merge($param_style, $prop);           
            $style = css_style($prop);

        }
    }

    $all = implode(" ", array($bg, $ttitle, $style));

    $data = array(
                'src'=>$bg, 
                'title'=>$ttitle, 
                'text'=>$text, 
                'style'=>$style,
                'all'=>$all
            );

    return $data;
}

function el_overlay($content='', $array=array()) {

    //default will negate null values
    $default = array( 
        'tag'       =>  'div',          
        'div'       =>  '',
        'class'     =>  '',
        'id'        =>  '',
        'echo'      =>  true,
        'data'      =>  '',
        'attr'      =>  '',
        'style'     =>  array(),
    );

    #parameters
    $param = array_merge($default, $array);   

    #class
    $default_class = 'overlay color opt';
    $class = implode(" ", array($default_class, $param['class']));
    $class = tag_attr_class($class);

    #style
    $ss = array_merge(array('s'=>true), $param['style']);
    $style = css_style($ss);

    $tag = $param['tag']; 

    $base = array(
        $tag,
        $class, 
        $param['id'], 
        $param['data'], 
        $param['attr'], 
        $style
    );
        
    $tag_attr = implode(" ", $base);

    $output = "<{$tag_attr}>";
    $output .= $content;
    $output .= "</$tag>";

    #div
    $output = tag_wrap($param['div'], $output);

    #echo
    if($param['echo'] == 1)
        echo $output;
    
    return $output;
}


?>
