<?php 
# IFRAMES | GOOGLE MAP
# URL | Text

/*------------------------------------------------*/

$lazy = constant("LAZY");

global $lazy_class;
$lazy_class   = ($lazy == true)  ?  'lazy ' : '';

/*------------------------------------------------*/

function el_gmap($acf='', $array=array()) {

    global $lazy_class;

    $default = array( 
        'div'               =>  '',
        'class'             =>  '',
        'id'                =>  '',
        'echo'              =>  true,
        'data'              =>  '',
        'css'               =>  'iframe',
        'title'             =>  'google-map', 
        'lazy'              =>  true,   
        'address'           =>  'address',
        'height'            =>  '',
        'width'             =>  '',
        'referrerpolicy'    =>  '',
        'allowfullscreen'   =>  '',
        'frameborder'       =>  '0',        
        'z'                 =>  '16',
    );
    
    $param = array_merge($default, $array);

    #class
    $class = implode(" ", array($lazy_class, 'g-map', $param['class']));

    #url
    $src_attr = googlemap_src($acf, $param['lazy'], $param['z']);
    $src_url  = $src_attr['all'];
    
    #attributes - iframe
    $iframe_param = iframe_attr($param);
    $iframe_attr = implode(" ", array($src_attr['all'], $iframe_param['all']));

    //generate the output parameters
    $tag = array(
        'div'       =>  $param['div'],
        'class'     =>  $class,
        'id'        =>  $param['id'],
        'echo'      =>  $param['echo'],
        'data'      =>  $param['data'],
        'css'       =>  $param['css'],
    );
    
    $gmap_tag = array(
        'tag'       =>  'iframe',
        'attr'      =>  $iframe_attr,
    );
 
    $tags = array_merge($tag, $gmap_tag);
    return tag_builder($tags, $acf);   
}

/*------------------------------------------------*/

function el_iframe($acf='', $array=array()){
    //acf or link/src
    global $lazy_class;

    $default = array( 
        'div'               =>  '',
        'class'             =>  '',
        'id'                =>  '',
        'echo'              =>  true,
        'data'              =>  '',
        'css'               =>  'iframe',
        'title'             =>  'iframe', 
        'lazy'              =>  true,   
        'height'            =>  '',
        'width'             =>  '100',
        'referrerpolicy'    =>  '',
        'frameborder'       =>  '0',        
    );

    $param = array_merge($default, $array);

    #class
    $class = implode(" ", array($lazy_class, 'd-iframe', $param['class']));

    #url
    $src_attr = iframe_src($acf, $param['lazy']);
    $src_url  = $src_attr['all'];

    #attributes - iframe
    $iframe_param = iframe_attr($param);
    $iframe_attr = implode(" ", array($src_attr['all'], $iframe_param['all']));

    //generate the output parameters
    $tag = array(
        'div'       =>  $param['div'],
        'class'     =>  $class,
        'id'        =>  $param['id'],
        'echo'      =>  $param['echo'],
        'data'      =>  $param['data'],
        'css'       =>  $param['css'],
    );

    $iframe_tag = array(
        'tag'       =>  'iframe',
        'attr'      =>  $iframe_attr,
    );
 
    $tags = array_merge($tag, $iframe_tag);
    return tag_builder($tags, $acf);  
}

/*------------------------------------------------*/


// allowfullscreen | referrerpolicy | frameborder | width | height | title

/* #region ~ Attr */

function iframe_attr($param = array()) {

    $s = array('s'=>true);
    $style = array();
  
    if(isset($param['style']))
        $style = array_merge($s, $param['style']);

    $width   = num_filter($param['width']);
    $height  = num_filter($param['height']);
    $border  = num_filter($param['frameborder']);

    $allowfs = $param['allowfullscreen'] ? "allowfullscreen" : "";
    $policy  = $param['referrerpolicy'] ? "referrerpolicy=\"{$param['referrerpolicy']}\"" : "";
    $border  = $border ? "frameborder=\"{$border}\"" : "";
    $width   = $width  ? "width=\"{$width}\"" : "";
    $title   = $param['title'] ? "title=\"{$param['title']}\"" : "";

    $height  = $height ? array('height'=>"{$height}%") : array();    

    $style = array_merge($style, $height);
    $style = css_style($style);

    $all = implode(" ", array($allowfs, $policy, $border, $width, $title, $style));
    $data = array('all'=>$all);

    return $data;    
}

/* #endregion */

function iframe_src($url='', $param_lazy=true) {   

    $lazy = constant("LAZY");

    $fakesrc    = 'src="about:blank"';
    $src        = 'src="' . $url . '"';
    $lazysrc    = 'data-src="' . $url . '" ';    

    if($lazy == true) {
        if($param_lazy == true) {
            $src = $lazysrc;
            $lazy_attr = "loading=\"lazy\"";       
        }
    }   

    $all = implode(" ", array($src, $fakesrc, $lazy_attr));
    $data = array('src'=>$src, 'lazy'=>$lazy_attr, 'all'=>$all);

    return $data;
}

function googlemap_src($url='', $param_lazy=true, $z=16) {
    
    $lazy = constant("LAZY");

    $url = googlemap($url, false, $z);

    $fakesrc    = 'src="about:blank"';
    $src        = 'src="' . $url . '"';
    $lazysrc    = 'data-src="' . $url . '" ';    

    if($lazy == true) {
        if($param_lazy == true) {
            $src = $lazysrc;
            $lazy_attr = "loading=\"lazy\"";       
        }
    }   

    $all = implode(" ", array($src, $fakesrc, $lazy_attr));
    $data = array('src'=>$src, 'lazy'=>$lazy_attr, 'all'=>$all);

    return $data;
}

function googlemap($data='', $pop=false, $z=16) {
    
    $goole_url = 'https://maps.google.com/maps?q=';
    $embed = "&output=embed&z={$z}";

    if($pop == true) {
        $goole_url = 'https://www.google.com/maps/search/';
        $embed = '';
    }

    $q = address_link($data);
    $url = implode("", array($goole_url, $q, $embed));

    return $url;
}

function address_link($string='') {
    // ie. 404 sample, city 1000, state
    $map = strip_tags($string);
    $map = str_replace(",","",$map);
    $map = str_replace("\n","+",$map);
    $map = str_replace(" ","+",$map);           
    $map = rtrim($map, "+");

    return $map;
    //address link : 404+sample+address+91210+CA
}