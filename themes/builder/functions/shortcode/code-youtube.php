<?php 
# VIDEO - YouTUBE
# YouTube URL | Advanced Link | Text

//*yt click, *yt autoplay, *yt bg, *yt popup

/*------------------------------------------------*/

$lazy = constant("LAZY");

global $lazy_class;
$lazy_class   = ($lazy == true)  ?  'lazy ' : '';

global $yt_btn, $vm_btn, $tpath;
$yt_btn = $tpath . '/images/icons/yt-pop.svg';
$vm_btn = $tpath . '/images/icons/yt-pop.svg';

/*------------------------------------------------*/

/* #region ~ YT */

function el_youtube($acf='', $array=array()) {  

    global $lazy_class;
    
    $default = array( 
        //default will negate null values
        'div'               =>  '',
        'class'             =>  '',
        'id'                =>  '',
        'echo'              =>  true,
        'data'              =>  '',
        'css'               =>  'iframe',
        'title'             =>  'youtube-video',
        'lazy'              =>  true,
        //pop up
        'pop'               =>  false,
        'thumb'             =>  'maxresdefault',
        'thumb_url'         =>  '',
        //yt
        'url'               =>  '',
        'autoplay'          =>  0,
        'mute'              =>  0,
        'loop'              =>  0,
        'controls'          =>  1,
        'start'             =>  0,
        'showinfo'          =>  0,
        //iframe
        'height'            =>  '',
        'width'             =>  '100%',
        'referrerpolicy'    =>  '',
        'allowfullscreen'   =>  '',
        'frameborder'       =>  '0',
        'style'             =>  array(),        
    );

    #parameters
    $param = array_merge($default, $array);

    #style [pending] at iframe_attr

    #class
    $class = implode(" ", array($lazy_class, 'yt-vid', $param['class']));

    #url
    $url = youtube_url($acf, $param);

    #attributes - source
    $src_attr = youtube_src($url, $param['lazy']);
    $src_url = $src_attr['all'];

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

/* #endregion */

/* #region ~ YT BG */

function el_bgyoutube($acf='', $param=array()) {  
    $bg_array = array(
        'div'       =>  'overlay overlay-bg',
        'class'     =>  '',
        'id'        =>  '',
        'echo'      =>  true,
        'data'      =>  'data-as="bg"',
        'css'       =>  'iframe',
        'autoplay'  =>  1, 
        'mute'      =>  1, 
        'loop'      =>  1, 
        'controls'  =>  0, 
        'showinfo'  =>  0, 
        'start'     =>  0,
        'height'    =>  150,
        'style'     =>  array(),        
    );

    $param = array_merge($bg_array, $param);

    $output = el_youtube($acf, 
        array(
            'div'           => $param['div'], 
            'class'         => $param['class'], 
            'id'            => $param['id'],
            'data'          => $param['data'],
            'echo'          => false,
            'autoplay'      => $param['autoplay'],
            'mute'          => $param['mute'], 
            'loop'          => $param['loop'],  
            'controls'      => $param['controls'],   
            'showinfo'      => $param['showinfo'],   
            'start'         => $param['start'],  
            'height'        => $param['height'],  
            'style'         => $param['style']
        )
    );

    #echo
    if($param['echo'] == 1)
        echo $output;
        
    return $output;  
}

/* #endregion */

/* #region ~ YT POP */

function el_popyoutube($acf='', $param=array()) {

    global $yt_btn;

    $pop_array = array(
        'div'       =>  '',
        'class'     =>  '',
        'id'        =>  '',
        'echo'      =>  true,
        'data'      =>  '',
        'css'       =>  'iframe',
        'pop'       =>  true,
        'button'    =>  $yt_btn,
        'thumb'     =>  'maxresdefault',
        'thumb_url' =>  '',
        'title'     =>  'youtube-video',
    );

    $param = array_merge($pop_array, $param);

    //class
    $class = implode(" ", array($param['class'], 'pop-yt'));

    //thumbnail
    $size = $param['thumb'];
    $yt_thumb = youtube_thumb($acf, $size);
    
    ## custom thumb
    $custom_thumb = esc_url($param['thumb_url']);
    if($custom_thumb)
        $yt_thumb = $custom_thumb;

    //url
    $url = youtube_url($acf, $param);
    if($url)
        $href = "href=\"{$url}\"";
    
    //title
    $title = $param['title'];
    
    //href
    $data_attr = implode(" ", array('data-fancybox', $href, $title));

    //thumbnail
    $acf = el_img($yt_thumb, array('class'=>'yt-img','echo'=>false, 'alt'=>'youtube thumbnail'));

    //button
    if($param['button']) :
        $icon = el_img($param['button'], array('echo'=>false, 'class'=>'icon-btn', 'alt'=>'youtube button'));
        $post_attr = "<div class=\"overlay dflex-center\">{$icon}</div>";
    endif;

    //generate the output parameters
    $tag = array(
        'div'       =>  $param['div'],
        'class'     =>  $class,
        'id'        =>  $param['id'],
        'echo'      =>  $param['echo'],
        'data'      =>  $param['data'],
        'css'       =>  $param['css'],
    );
    
    $pop_tag = array(
        'tag'        =>  'a',
        'attr'       =>  $data_attr,
        'postwrap'   =>  $post_attr,      
    );
 
    $tags = array_merge($tag, $pop_tag);
    return tag_builder($tags, $acf);  
}

/* #endregion */

/* #region ~ YT URL */

function youtube_url($pass_url='', $param = array()) {

    $url = '';

    if(isset($param['autoplay']))
        $autoplay = ($param['autoplay'] == 1) ? "&autoplay=1" : "&autoplay=0";

    if(isset($param['controls']))
        $controls = ($param['controls'] == 1) ? "&controls=1" : "&controls=0";

    if(isset($param['showinfo']))
        $info = ($param['showinfo'] == 1) ? "&showinfo=1" : "&showinfo=0";    

    if(isset($param['start']))
        $start = ($param['start'] == 1)    ? "&start=1" : "&start=0";        

    if(isset($param['mute']))
        $mute = ($param['mute'] == 1)     ? "&mute=1" : "&mute=0";

    if(isset($param['loop']))
        $loop = ($param['loop'] == 1)     ? "&loop=1" : "&loop=0";

    $url_a = ""; //default

    if($param['pop'] == false) {
        $all = implode("", array($autoplay, $controls, $start, $mute, $loop, $info));
        $url_a = '?' . ltrim($all,"&");
    }

    if($pass_url){
        $url = $pass_url;
        $url = esc_url($url);
        $id = youtube_id($url);
        $url_a = $url_a . "&playlist={$id}"; //add this for a looping video
        $url = "https://www.youtube.com/embed/{$id}{$url_a}";
    }

    if($param['pop'] == true) {    
        $url = $pass_url;
        $url = esc_url($url);
        $id = youtube_id($url);
        $url = "https://youtu.be/{$id}";
    }  

    return $url;
}

/* #endregion */

/* #region ~ YT src, id, thumb */

function youtube_src($url='', $param_lazy=true) {

    $lazy = constant("LAZY");

    $src        = 'src="' . $url . '"';
    $lazysrc    = 'data-src="' . $url . '" ';

    if($lazy == true) {
        if($param_lazy == true) {
            $src = $lazysrc;
            $lazy_attr = "loading=\"lazy\"";       
        }
    }

    $all = implode(" ", array($src, $lazy_attr));
    $data = array('src'=>$src, 'lazy'=>$lazy_attr, 'all'=>$all);

    return $data;
}

function youtube_id($url) {
    if($url) {
    $parts = parse_url($url);
    if(isset($parts['query'])){
        parse_str($parts['query'], $qs);
        if(isset($qs['v'])){
            return $qs['v'];
        }else if(isset($qs['vi'])){
            return $qs['vi'];
        }
    }
    if(isset($parts['path'])){
        $path = explode('/', trim($parts['path'], '/'));
        return $path[count($path)-1];
    }
    return false;
    }
}

function youtube_thumb($link, $q='maxresdefault'){
	//default, hqdefault, mqdefault, sddefault, maxres
	$id = youtube_id($link);
	if($id) {
		$img_link = "http://img.youtube.com/vi/{$id}/{$q}.jpg";
        return $img_link;
	}
}

/* #endregion */

/*------------------------------------------------*/

// VIMEO
//https://player.vimeo.com/video/731162201
//?autoplay=1&loop=1&autopause=false&muted=1&api=1&controls=0&background=1&quality=2k


/* #region ~ VM */

function el_vimeo($acf='', $array=array()) {  

    global $lazy_class;
    
    $default = array( 
        //default will negate null values
        'div'               =>  '',
        'class'             =>  '',
        'id'                =>  '',
        'echo'              =>  true,
        'data'              =>  '',
        'css'               =>  'iframe',
        'title'             =>  'vimeo-video',
        'lazy'              =>  true,
        //pop up
        'pop'               =>  false,
        'thumb'             =>  'large',
        'thumb_url'         =>  '',
        //vm
        'url'               =>  '',
        'autoplay'          =>  0,
        'autopause'         =>  false,
        'loop'              =>  0,
        'muted'             =>  0,
        'api'               =>  1,
        'controls'          =>  1,
        'background'        =>  0,
        'transparent'       =>  0,
        'quality'           =>  '2k', //240p, 360p
        //iframe
        'height'            =>  '',
        'width'             =>  '100%',
        'referrerpolicy'    =>  '',
        'allowfullscreen'   =>  '',
        'frameborder'       =>  '0',
    );


    #parameters
    $param = array_merge($default, $array);

    #class
    $class = implode(" ", array($lazy_class, 'vm-vid', $param['class']));
    
    #url
    $url = vimeo_url($acf, $param);
    
    #attributes - source
    // its ok to yt function
    $src_attr = youtube_src($url, $param['lazy']);
    $src_url = $src_attr['all'];

    
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

/* #endregion */

/* #region ~ VM URL */

function vimeo_url($pass_url='', $param = array()) {

    $url = '';

    if(isset($param['autoplay']))
        $autoplay = ($param['autoplay'] == 1) ? "&autoplay=1" : "&autoplay=0";

    if(isset($param['autopause']))
        $autopause = ($param['autopause'] == true) ? "&autopause=true" : "&autopause=false";

    if(isset($param['loop']))
        $loop = ($param['loop'] == 1) ? "&loop=1" : "&loop=0";

    if(isset($param['muted']))
        $mute = ($param['muted'] == 1) ? "&muted=1" : "&muted=0";

    if(isset($param['api']))
        $api = ($param['api'] == 1) ? "&api=1" : "&api=0";
        
    if(isset($param['controls']))
        $controls = ($param['controls'] == 1) ? "&controls=1" : "&controls=0";

    if(isset($param['background']))
        $bg = ($param['background'] == 1) ? "&background=1" : "&background=0";    

    if(isset($param['transparent']))
        $alpha = ($param['transparent'] == 1) ? "&transparent=1" : "&transparent=0";                   

    if(isset($param['quality']))
        $q = ($param['quality'] != '') ? "&quality={$param['quality']}" : "";        

    $url_a = ""; //default

    if($param['pop'] == false) {
        $all = implode("", array($autoplay, $autopause, $loop, $mute, $api, $controls, $bg, $alpha, $q));
        $url_a = '?' . ltrim($all,"&");
    }

    if($pass_url){
        $url = $pass_url;
        $url = esc_url($url);
        $id = youtube_id($url);
        //$url_a = $url_a . "&playlist={$id}"; //add this for a looping video
        $url = "https://player.vimeo.com/video/{$id}{$url_a}";
    }

    if($param['pop'] == true) {    
        $url = $pass_url;
        $url = esc_url($url);
        $id = youtube_id($url);
        $url = "https://vimeo.com/{$id}";
    }  

    return $url;
}

/* #endregion */

/* #region ~ VM BG */

function el_bgvimeo($acf='', $param=array()) {  
    $bg_array = array(
        'div'        =>  'overlay overlay-bg',
        'class'      =>  '',
        'id'         =>  '',
        'echo'       =>  true,
        'data'       =>  'data-as="bg"',
        'css'        =>  'iframe',
        'autoplay'   =>  1, 
        'autopause'  =>  0,         
        'muted'      =>  1, 
        'loop'       =>  1, 
        'controls'   =>  0, 
        'background' =>  1,
        'quality'    =>  '2k',
        'height'     =>  150,
    );

    $param = array_merge($bg_array, $param);

    $output = el_vimeo($acf, 
        array(
            'div'           => $param['div'], 
            'class'         => $param['class'], 
            'id'            => $param['id'],
            'data'          => $param['data'],
            'echo'          => false,
            'autoplay'      => $param['autoplay'],
            'autopause'     => $param['autopause'],             
            'muted'         => $param['muted'],
            'loop'          => $param['loop'],             
            'controls'      => $param['controls'],                         
            'background'    => $param['background'],
            'quality'       => $param['quality'],
            'height'        => $param['height'],  
        )
    );

    #echo
    if($param['echo'] == 1)
        echo $output;
        
    return $output;  
}

/* #endregion */

/* #region ~ VM POP */

function el_popvimeo($acf='', $param=array()) {

    global $vm_btn;

    $pop_array = array(
        'div'       =>  '',
        'class'     =>  '',
        'id'        =>  '',
        'echo'      =>  true,
        'data'      =>  '',
        'css'       =>  'iframe',
        'pop'       =>  true,
        'button'    =>  $vm_btn,
        'thumb'     =>  'large',
        'thumb_url' =>  '',
        'title'     =>  'vimeo-video',
    );

    $param = array_merge($pop_array, $param);

    //class
    $class = implode(" ", array($param['class'], 'pop-yt'));

    //thumbnail
    $size = $param['thumb'];
    $vm_thumb = vimeo_thumb($acf, $size);
    
    

    ## custom thumb
    $custom_thumb = esc_url($param['thumb_url']);
    if($custom_thumb)
        $vm_thumb = $custom_thumb;

    //url
    $url = vimeo_url($acf, $param);
    if($url)
        $href = "href=\"{$url}\"";
    
    //title
    $title = $param['title'];
    
    //href
    $data_attr = implode(" ", array('data-fancybox', $href, $title));

    //thumbnail
    $acf = el_img($vm_thumb, array('class'=>'vm-img','echo'=>false, 'alt'=>'vimeo thumbnail'));

    //button
    if($param['button']) :
        $icon = el_img($param['button'], array('echo'=>false, 'class'=>'icon-btn', 'alt'=>'vimeo button'));
        $post_attr = "<div class=\"overlay dflex-center\">{$icon}</div>";
    endif;

    //generate the output parameters
    $tag = array(
        'div'       =>  $param['div'],
        'class'     =>  $class,
        'id'        =>  $param['id'],
        'echo'      =>  $param['echo'],
        'data'      =>  $param['data'],
        'css'       =>  $param['css'],
    );
    
    $pop_tag = array(
        'tag'        =>  'a',
        'attr'       =>  $data_attr,
        'postwrap'   =>  $post_attr,      
    );  
 
    $tags = array_merge($tag, $pop_tag);
    
    return tag_builder($tags, $acf);  
}

/* #endregion */


/* #region ~ VM src, id, thumb */

function vimeo_id($url='') {
    if($url) {
        if(preg_match("/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/?(showcase\/)*([0-9))([a-z]*\/)*([0-9]{6,11})[?]?.*/", $url, $output_array)) {
            return $output_array[6];
        }
    }
}

function vimeo_thumb($link, $q='large'){
    //large, medium, small
	//https://vumbnail.com/ is temporary
	$id = vimeo_id($link);

	if($id) {
		$img_link = "https://vumbnail.com/{$id}_{$q}.jpg";
        return $img_link;
	}
}

/* #endregion */


?>
