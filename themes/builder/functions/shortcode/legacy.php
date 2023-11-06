<?php 
## LEGACY (used by older sites)
## Discontinued

/* #region MEDIA ---------------*/

    function bd_media_embed(
        $cfg = '', 
        $div = '',
        $empty = 0
    )
    {
        $type = $cfg['type'];

        if($type == 'img') {
            el_bgoverlay($cfg['image']);
        }

        if($type == 'vid') {
            el_bgvideo($cfg['video']);
        }

        if($type == 'yt') {
            el_bgyoutube($cfg['youtube'], array('height'=>'150'));
        }

        if($type == 'map') {
            el_gmap($cfg['map'], array('div'=>'overlay map', 'height'=>'150'));
        }
    }

        function bd_click($link, $class='') {

        $link = link_meta($link);

        if($link[0] != '') {
            $tag1 = "<a href=\"{$link[0]}\" target=\"{$link[2]}\" class=\"{$class}\">";
            $tag2 = '</a>';
        } else {
            $tag1 = "<div class=\"{$class}\">";
            $tag2 = '</div>';
        }        

        return array($tag1, $tag2);
    }
/* #endregion */

/* --------------------------------------------------------------------- */

### ARTICLE ###

  







/*-- LEGACY 2.0 ---------------------------------------------------------------------------*/

/*--------------------------------------------*/

/* #region ~ TAG */

function bd_tag(
    $acf = '',
    $tag = 'p',
    $class = '',
    $div = '',
    $echo = true
)
{   
    if($class != '') {
        $class = "class=\"{$class}\"";
    }    

    if($acf != ''):
        $acf = "<{$tag} {$class}>$acf</{$tag}>";

        $out = add_div($div, $acf);
        dprint($echo, $out);
    endif;
}

/* #endregion */

/* #region ~ TITLE */
function bd_title(
    $title = '', 
    $class = 'dtitle', 
    $div = '', 
    $echo = true, 
    $css = 'mtitle' /* type = 'mtitle, atitle, btitle', 'ititle' */
) 
{ 
    $h = opt_htag($css);    
    $style = opt_styler($css);

    $title = strip_tags($title, '<strong><span><em><del><br>');

    if($title):
        $data = "<{$h} class=\"{$class}\" {$style}>{$title}</{$h}>";
        $data = add_div($div, $data);
        dprint($echo, $data);
    endif;    

    return $data;
}
/* #endregion */

/* #region ~ TEXT */
function bd_text(
    $text = '', 
    $div = 'dtext',
    $echo = true,
    $css = 'dtext'   /* dtext, itext */
)
{   
$style = opt_styler($css);

$text = strip_tags($text, '<b><p><br><em><i><strike><strong><a><h1><h2><h3><h4><h5><h6><img><ol><ul><li><span>');

if($text != ''):
    $out = add_div($div, $text, $style);
    dprint($echo, $out);
endif;

return $out;
}
/* #endregion */

/*--------------------------------------------*/

/* #region ~ LAZY IMAGE */

function bd_img(
    $image = '',     
    $size = '',         
    $div = '',
    $echo = true,
    $css='dimage'
) 
{
#size will not return on URL format
$style = opt_media_styler($css);
if($div == '') { $img_style = $style; }

$url = acf_img($image, $size);

$meta = img_meta($image);   
$alt = $meta[0];
$caption = $meta[2];

if($caption) {
    $img_meta = "<div class=\"caption\">{$caption}</div>";
}

$img_data = is_admin() ? "src=\"{$url}\"" : "data-src=\"{$url}\" class=\"lazy\"";
//$img_data = "data-src=\"{$url}\" class=\"lazy\"";
if($image) { 
    $img = "<img loading=\"lazy\" {$img_data} alt=\"{$alt}\" {$img_style}>{$img_meta}";
}   

$out = add_div($div, $img, $style);
dprint($echo, $out);

return $out;
}

function bd_img_multi(
    $rp = '',
    $div = '',
    $echo = true        
)
{
if($rp):
    foreach( $rp as $r ) :
        bd_img($r['image'], '', $div);
    endforeach;    
endif;    
}


/* #endregion */

/* #region ~ IMAGE ATTR */

function acf_img ($image='', $size='') {

    if(is_numeric($image) == true) {
        #as ID
        $thumb = wp_get_attachment_image_url( $image, $size );
    } else {
        #as URL
        $thumb = $image;
    }

    if(is_array($image) == true) {
        #as Array
        $url = $image['url'];
        $width  = $image['sizes'][ $size . '-width' ];
        $height = $image['sizes'][ $size . '-height' ];
        $url_size = ($size == '' ? $url : $image['sizes'][ $size ]);
        $thumb = $url_size;
    }

    return $thumb;
}

function img_meta($image='') {
    /* $info = alt, title, caption */
    
    if(is_numeric($image) == true) {
    #as ID  
        $attachment = get_post($image);
        $alt = get_post_meta($image, '_wp_attachment_image_alt', TRUE);          
        $title = $attachment->post_title;
        $caption = $attachment->post_excerpt;
        $desc = $attachment->post_content;
    } else {
    #as URL    
        $alt = '';
        $title = '';
        $caption = '';
        $desc = '';
    }    

    if(is_array($image) == true):    
    #as URL    
        $alt = esc_html($image['alt']);
        $title = esc_html($image['title']);
        $caption = esc_html($image['caption']);
        $desc = esc_html($image['description']);
    endif;

    $out = array($alt, $title, $caption, $desc);

    return $out;
}
/* #endregion */

/*--------------------------------------------*/

/* #region ~ AUXILLARY */
function add_div ($div, $data, $style='') {
    if($div == '') {
        return $data;
    } else {
        return "<div class=\"{$div}\" {$style}>{$data}</div>"; 
    }
}

function dprint ($echo, $data) {
    if($echo == true) : 
        echo $data; 
    else: 
        return $data; 
    endif;
}

function link_meta($button) {
    $url = $button['url'];
    $title = $button['title'];
    $target = $button['target'] ? $button['target'] : '_self';

    return array($url, $title, $target);
}

/* #endregion */

/* #region ~ LAZY BACKGROUND IMAGE */

function bd_bgdiv(
    $image = '', 
    $size='',        
    $class='',
    $echo=true,
    $css='bgimg'
) 
{
    $url = acf_img($image, $size); 
    $meta = img_meta($image);   
    $alt = $meta[0];
    $caption = $meta[2];    

    if($caption) {
        $img_meta = "<div class=\"caption\">{$caption}</div>";
    }
    
    $data = is_admin() ? "style=\"background-image: url({$url});\"" : "data-bg=\"{$url}\"";
    //$data = "data-bg=\"{$url}\"";

    //$style = opt_media_styler($css, $bg);

    if($image) {
        $out = "<div 
        class=\"bg-img bg-lazy {$class}\" {$data}
        title=\"{$alt}\">
        </div>{$img_meta}";  
    }

    dprint($echo, $out);
    return $out;
}

function bd_bgoverlay(
    $image = '', 
    $class='overlay overlay-bg',
    $size='',            
    $echo=true,
    $opacity = ''
) 
{
    $url = acf_img($image, $size); 
    $meta = img_meta($image);   
    $alt = $meta[0];

    $data = is_admin() ? "style=\"background-image: url({$url});\"" : "data-bg=\"{$url}\"";
    //$data = "data-bg=\"{$url}\"";

    if($opacity) {
        $op = "data-opacity=\"{$opacity}\"";
    }

    if($image) {
        $out = "<div {$op} class=\"bg-img bg-lazy {$class}\" {$style} {$data} title=\"{$alt}\"></div>";
    }

    $out = add_div($div, $out);
    dprint($echo, $out);
    
}

/* #endregion */

/* #region ~ IMAGE URL */

function bd_img_url(
    $image = '', 
    $size = '',   
    $echo = true
) {
    $url = acf_img($image, $size); 
    dprint($echo, $url);

    return $url;
}

/* #endregion */

/* #region ~ LAZY ICON */

function bd_icon(
    $image = '',     
    $div = 'icon-bg dflex-center',
    $class = 'dicon',
    $echo = true,        
    $css = 'dicon'
) 
{
#size will not return on URL format
$style = opt_media_styler($css);
if($div == '') { $img_style = $style; }

$url = acf_img($image, $size);
$meta = img_meta($image);   
$alt = $meta[0];

$img_data = is_admin() ? "src=\"{$url}\" class=\"lazy {$class}\"" : "data-src=\"{$url}\" class=\"lazy {$class}\"";
//$img_data = "data-src=\"{$url}\" class=\"lazy {$class}\"";
    
if($image) {  $img = "<img loading=\"lazy\" {$img_data} alt=\"{$alt}\" {$img_style}>";  }   

$out = add_div($div, $img, $style);
dprint($echo, $out);

return $out;
}

/* #endregion */

/* #region ~ MEDIA SRC */

function file_meta($file) {
    if(is_numeric($file) == true) {
        $url = wp_get_attachment_url( $file );    
    } else {
        $url = esc_attr($url);
    }    

    if(is_array($file) == true):  
        $url = $file['url'];    
    endif;        
    
    return $url;
}

/* #endregion */

/* #region ~ LAZY VIDEO */

function bd_video(
    $video = '',
    $pos = 'center', /* center, top, bottom */         
    $div = '',    
    $opt1 = true,
    $opt2 = true,
    $opt3 = true,    
    $opt4 = true,
    $echo = true,
    $css = 'dvideo'
) 
{
    $url = file_meta($video);
    if($url == '') {
        $url = $video;
    }
    $vid_data = is_admin() ? "src=\"{$url}\"" : "data-src=\"{$url}\"";
    //$vid_data = "data-src=\"{$url}\"";
    $type = "type=\"video/mp4\"";

    if($opt1 == true) { $opt1 = "loop=\"loop\""; }
    if($opt2 == true) { $opt2 = "autoplay=\"autoplay\"";  }
    if($opt3 == true) { $opt3 = "muted=\"muted\""; }
    if($opt4 == true) { $opt4 = "playsinline=\"playsinline\""; }

    $class = "class=\"lazy vid\""; 

    $style = opt_media_styler($css);

    if($video) { 
        $data = "<video {$class} {$vid_data} {$opt1} {$opt2} {$opt3} {$opt4}>
        <source src=\"{$url}\" {$vid_data} {$type}></video>"; 
    }   

    $div = "dvideo bg-vid inlined {$pos} {$div}";

    $out = add_div($div, $data, $style);
    dprint($echo, $out);    
}

/* #endregion */

/* #region ~ LAZY BACKGROUND VIDEO */
function bd_bgvideo (
    $video = '',
    $pos = 'center', /* center, top, bottom */         
    $div = '',    
    $echo = true,
    $opacity = ''
) 
{
    $url = file_meta($video);
    if($url == '') {
        $url = $video;
    }    
    $vid_data = is_admin() ? "src=\"{$url}\"" : "data-src=\"{$url}\"";
    //$vid_data = "data-src=\"{$url}\"";
    $type = "type=\"video/mp4\"";

    $opt1 = "loop=\"loop\""; 
    $opt2 = "autoplay=\"autoplay\""; 
    $opt3 = "muted=\"muted\""; 
    $opt4 = "playsinline=\"playsinline\"";

    $class = "class=\"lazy vid\""; 

    if($video) { 
        $data = "<video {$class} {$vid_data} {$opt1} {$opt2} {$opt3} {$opt4}>
        <source src=\"{$url}\" {$vid_data} {$type}></video>"; 
    }   

    if($opacity) {
        $op = "data-opacity=\"{$opacity}\"";
    }

    $out = "<div {$op} class=\"bg-vid overlay {$pos} {$div}\">{$data}</div>";
    dprint($echo, $out);    
}
/* #endregion */

/* #region ~ FILE URL */

function bd_file_url(
    $file = '',
    $echo = true
) 
{
    $url = file_meta($file);
    dprint($echo, $url);
}

/* #endregion */

/* #region ~ YOUTUBE */
function bd_youtube(
    $url = '',
    $div = '',
    $echo = true,
    $css = 'iframe'
) {
    $id = youtube_id($url);
    $url = "https://www.youtube.com/embed/{$id}";
    $iframe_data = is_admin() ? "src=\"{$url}\"" : "data-src=\"{$url}\"";
    //$iframe_data = "data-src=\"{$url}\"";

    $a = 'accelerometer;';
    $b = 'autoplay;';
    $c = 'clipboard-write;';
    $d = 'encrypted-media;';
    $e = 'gyroscope;';
    $f = 'picture-in-picture';

    $class = "class=\"lazy diframe\""; 
    $allow = "allow=\"{$a} {$b} {$c} {$d} {$e} {$f}\"";  

    $w = 'width="100%"';
    $fb = 'frameborder="0"';
    $af = 'allowfullscreen';

    $data = "<iframe loading=\"lazy\" {$iframe_data} {$class} {$w} {$fb} {$allow} {$af}></iframe>";
    
    $style = opt_media_styler($css);
    $div = "bg-iframe {$div}";

    $out = add_div($div, $data, $style);
    dprint($echo, $out);          
}
/* #endregion */

/* #region ~ YOUTUBE BG */
function bd_bgyoutube (
    $url = '',
    $div = '',    
    $echo = true,
    $opacity = ''
) 
{
    $id = youtube_id($url);

    $basic = "?autoplay=1&loop=1&mute=1&playlist={$id}";
    $a = "enablejsapi=1";
    $f = "&showinfo=0";
    $g = "&wmode=transparent";
    $h = "&iv_load_policy=3";
    $i = "&modestbranding=1";
    $e = "&controls=0";        
    $b = "&loop=1";
    $c = "&start=0";
    $d = "&autoplay=1";        
    $k = "&mute=1";
    $j = "&playlist={$id}";

    $url = "https://www.youtube.com/embed/{$id}";
    //$url = "{$url}?{$a}{$b}{$c}{$d}{$e}{$f}{$g}{$h}{$i}";    
    $url = "{$url}{$basic}";

    $iframe_data = is_admin() ? "src=\"{$url}\"" : "data-src=\"{$url}\"";
    //$iframe_data = "data-src=\"{$url}\"";

    $class = "class=\"lazy diframe\""; 

    $w = 'width="100%"';
    $fb = 'frameborder="0"';
    $af = 'allowfullscreen="1"';

    $data  = "<div class=\"overlay vid-en\"></div>";   
    $data .= "<iframe loading=\"lazy\" {$iframe_data} {$class} {$w} {$fb} {$allow} {$af}></iframe>";


    if($opacity) {
        $op = "data-opacity=\"{$opacity}\"";
    }

    $out = "<div {$op} class=\"bg-yt overlay {$div}\">{$data}</div>";
    dprint($echo, $out);        
}   
/* #endregion */

/* #region ~ GMAP */
function bd_map(
    $data, 
    $div = 'bg-iframe',
    $echo = true
)
{
    $maps = 'https://maps.google.com/maps?q=';
    $map = address_link($data);
    $url = "{$maps}{$map}&output=embed";

    $iframe_data = is_admin() ? "src=\"{$url}\"" : "data-src=\"{$url}\"";
    //$iframe_data = "data-src=\"{$url}\"";

    $class = "class=\"lazy diframe\""; 
    $w = 'width="100%"';
    $fb = 'frameborder="0"';

    $data = "<iframe loading=\"lazy\" {$iframe_data} {$class} {$w} {$fb}></iframe>";
    
    $div = "bg-iframe {$div}";

    $out = add_div($div, $data, '');
    dprint($echo, $out);    
}
/* #endregion */

/* #region ~ IFRAME */

function bd_iframe(
    $iframe = '',     
    $div = 'bg-iframe',
    $echo = true,
    $css = 'iframe'
) 
{
    $url = $iframe;
    $iframe = is_admin() ? "src=\"{$url}\"" : "data-src=\"{$url}\" class=\"lazy\"";
    //$iframe = "data-src=\"{$url}\" class=\"lazy\"";

    if($url) { 
        $data = "<iframe loading=\"lazy\" {$iframe} width=\"100%\" allow=\"autoplay\"></iframe>"; 
    }   

    $style = opt_media_styler($css);
    $out = add_div($div, $data, $style);
    dprint($echo, $out);   
}

/* #endregion */

/*--------------------------------------------*/

/* #region ~ CFG BUTTTON */

function cf_btn(
    $cfg = '', 
    $div = '',
    $empty = 0,
    $group = 1 /* seamless or group */
) 
{
    if($group == 1) {
        $cfg = $cfg['cfg_button'];
    }
    
    $button = $cfg['cfg_link'];

    $b_url = $button['url'];
    $b_title = $button['title'];
    $b_target = $button['target'] ? $button['target'] : '_self';    
    $b_pop = $button['popup'];
    $b_design = $button['design'];
    $b_icon = $button['icon'];
    $b_icon_url = wp_get_attachment_image_url($b_icon);
    

    $pop = '';
    $pop = ($b_pop == true ?  ' data-fancybox' : '');

    if($b_url):

        if($b_design == 'more') {
            $href = "href=\"{$b_url}\" title=\"{$b_title}\" target=\"{$b_target}\"";
            $class = "class=\"link-text link-more\"";
        }  

        if($b_design == 'btn-d') {
            $href = "href=\"{$b_url}\" title=\"{$b_title}\" target=\"{$b_target}\"";
            $class = "class=\"btn btn-d\"";
        }

        if($b_design == 'btn-s') {
            $href = "href=\"{$b_url}\" title=\"{$b_title}\" target=\"{$b_target}\"";
            $class = "class=\"btn btn-s\"";
        }

        if($b_design == 'btn-a') {
            $href = "href=\"{$b_url}\" title=\"{$b_title}\" target=\"{$b_target}\"";
            $class = "class=\"btn btn-a\"";
        }       
        
        if($b_design == 'b-icon') {
            $data = 'data-icon="icon"';
            $href = "href=\"{$b_url}\" title=\"{$b_title}\" target=\"{$b_target}\"";
            $class = "class=\"btn btn-icon\"";
            $pre = bd_icon($b_icon,'','',0);
        }                

        if($b_design == 'btn-icon-text') {
            $data = 'data-icon="btn"';
            $bg = is_admin() ? "style=\"background-image: url({$b_icon_url});\"" : "data-bg=\"{$b_icon_url}\"";
            //$bg = " data-bg=\"{$b_icon_url}\"";
            $data = "{$data} {$bg}";
            $href = "href=\"{$b_url}\" title=\"{$b_title}\" target=\"{$b_target}\"";
            $class = "class=\"btn bg-lazy btn-n\"";
        }             

        if($b_design == 'pre-icon') {
            if($b_icon) { $data = 'data-icon="pre"'; }
            $href = "href=\"{$b_url}\" title=\"{$b_title}\" target=\"{$b_target}\"";
            $class = "class=\"btn w-icon\"";
            $pre = bd_icon($b_icon,'','',0);                
        }                        

        if($b_design == 'post-icon') {
            if($b_icon) { $data = 'data-icon="post"'; }
            $href = "href=\"{$b_url}\" title=\"{$b_title}\" target=\"{$b_target}\"";
            $class = "class=\"btn w-icon\"";
            $post = bd_icon($b_icon,'','',0);                
        }             

    endif;

    $ab  = "<a {$href} {$data} {$pop} {$class}>";
    $ab .= "{$pre}<span data-text=\"{$b_title}\">{$b_title}</span>{$post}"; 
    $ab .= "</a>";   
    
    if($empty == 1) {
        $ab  = "<div {$data} {$pop} {$class}>";
        $ab .= "{$pre}<span data-text=\"{$b_title}\">{$b_title}</span>{$post}"; 
        $ab .= "</div>";            
    }        

    return $ab;
}

function cf_btnloop(
    $cfg_loop, 
    $div='',
    $echo=true
) 
{
    $button_loop = $cfg_loop;

    if($button_loop):
        foreach( $button_loop as $button ) :
            $output .= cf_btn($button,'',false);
        endforeach;

        $data = add_div($div, $output);
        dprint($echo, $data);

    endif;
}    

function cf_btnlink($btn, $group=1)
{
    if($group == 1) {
        $cfg = $btn['cfg_button'];
    } else {
        $cfg = $btn;
    }
    
    return $cfg['cfg_link'];
}
/* #endregion */

/* #region ~ CFG LINK */

function cf_link(
    $cfg = '',
    $class = '',
    $echo = true
) 
{
    ## options
    $page = $cfg['page_link'];
    $link = $cfg['link'];
    $file = file_meta($cfg['media_link']);    
    $modal = $cfg['modal'];
    $as = $cfg['link_as'];
    $target = $cfg['new_window'];
    $preview = $cfg['preview'];

    if($as == 'fancypop') { 
        load_assets(array('fancybox'));
    }  

    ## options output
    if($target == true) { $target = "target=\"_blank\""; }
    
    if($as == 'page') { 
        $data = "href=\"{$page}\" {$target}";
    }

    if($as == 'url') { 
        $data = "href=\"{$link}\" {$target}";
    }

    if($as == 'file') { 
        $data = "href=\"{$file}\" target=\"_blank\"";

        if($preview == true) {
            $f = "data-fancybox";
            $w = "data-width=\"800\""; 
            $h = "data-height=\"600\"";
            $data = "href=\"{$file}\" {$f} {$w} {$h}";
        }
    }    

    if($as == 'modal') { 
        $data = "data-toggle=\"modal\" data-target=\"#{$modal}\"";
    }

    if($as == 'fancypop') { 
        $f = "data-fancybox";
        $w = "data-width=\"800\""; 
        $h = "data-height=\"600\"";
        $data = "href=\"{$link}\" {$f} {$w} {$h}";
    }

    if($class != '') {
        $data = $data . " class=\"{$class}\"";
    }

    dprint($echo, $data);
}

/* #endregion */

/* #region ~ ADVANCE BUTTTON */

function bd_btn(
    $btn = '', 
    $class = 'btn-d', 
    $div = '',
    $echo = true
) 
{
$btn = link_meta($btn);

if($btn[0]):
    $ab  = "<a href=\"{$btn[0]}\" target=\"{$btn[2]}\" class=\"btn {$class}\">";
    $ab .= "<span>{$btn[1]}</span>"; 
    $ab .= "</a>";
endif;

$out = add_div($div, $ab);
dprint($echo, $out);
}

function bd_link(
    $btn = '', 
    $class='more', 
    $div ='', 
    $echo=true
) 
{    
$btn = link_meta($btn);  

if($btn[0]):
    $ab  = "<a href=\"{$btn[0]}\" target=\"{$btn[2]}\" class=\"{$class}\">";
    $ab .= "<span>{$btn[1]}</span>"; 
    $ab .= "</a>";
endif;

$out = add_div($div, $ab);
dprint($echo, $out);

return $out;
}

function bd_href(
    $btn = '',
    $class = '',
    $target = true,
    $echo=true
) 
{
$btn = link_meta($btn);  
if($class != '') {
    $class = "class=\"{$class}\"";
}
if($btn[0]):
    $ab  = " href=\"{$btn[0]}\" ";
    if($target == true) {
        $ab .= "target=\"{$btn[2]}\" ";
    }
    $ab .= $class;
    dprint($echo, $ab);

    return $ab;
endif;  
}

/* #endregion */

/*--------------------------------------------*/

/* #region ARTICLE THUMBNAIL -----------------*/

function bd_post_thumbnail(
    $post_id = '',
    $size = 'large',
    $type = 'img', /* img or bg */
    $div = '',
    $echo = true
) 
{
$dimg = get_the_post_thumbnail($post_id);
$img_id = get_post_thumbnail_id($post_id);
//$url = get_the_post_thumbnail_url($post_id, $size);
//$alt = esc_html(get_post_meta($img_id, '_wp_attachment_image_alt', true));

if(!$dimg) {
    $f = get_field('utilities', 'options');
    $ph = $f['placeholders'];
    $ph = $ph['post_thumbnail'];

    if($type == 'img'):
        $out = bd_img($ph, '', '', 0);
    elseif($type == 'bg'):
        $out = bd_bgdiv($ph, '', 'bg-img bg-lazy post-img-bg', 0);
    endif;            
} 

if($dimg) {
    if($type == 'img'):
       $out = bd_img($img_id, '', '', 0);
    elseif($type == 'bg'):
       $out = bd_bgdiv($img_id, '', 'bg-img bg-lazy post-img-bg', 0);
    endif;
}

$out = add_div($div, $out);
dprint($echo, $dimg);    

return $out;
}

//add a placeholder

function bd_post_ph(
    $post_id, 
    $size = 'large',
    $type='img',
    $echo = true
)
{
$url = get_the_post_thumbnail_url($post_id, $size);
if(!$url) { 
    $url = get_placeholder(); 

    if($type == 'img'):
        $data = bd_img($url, 'large', '', 0);
    elseif($type == 'bg'):
        $data = bd_bgdiv($url, 'large','',0);
    endif;        

} else {

    if($type == 'img'):
        $data = bd_post_thumbnail($post_id, 'large', 'img', '', 0);
    elseif($type == 'bg'):
        $data = bd_post_thumbnail($post_id, 'large', 'bg', '', 0);
    endif;        
}

dprint($echo, $data);    
}

/* #endregion */

/* #region ARTICLE META : NAME< AVATAR, DATE -*/

function bd_post_meta(
    $pick='name', /* pick : name, avatar, date */
    $div = '', 
    $echo = true
) 
{
$auth_id = get_the_author_meta('ID');
$avatar = get_field('avatar', 'user_' . $auth_id);

if($avatar) {
    $avatar = "<div class=\"d-avatar dflex-center\">" . 
                bd_img($avatar, 0, 0, 0) . 
            "</div>";
}

if(!$avatar) {
    $avatar = get_avatar($auth_id);
}

if($pick == 'avatar') { $data = $avatar; }

if($pick == 'name') { 
    //$data = get_the_author(); 
    $data = get_the_author_meta( 'first_name' );
}
if($pick == 'date') { $data = get_the_date(); }

$out = add_div($div, $data);
dprint($echo, $out);    
}

/* #endregion */

/* #region ARTICLE CATEGORY ------------------*/

function bd_post_category(
    $post_id,
    $amt = 1,
    $div = '',
    $echo = 'true'
) 
{
$dcategory = get_the_category($post_id);

for ($i = 0; $i <= $amt; $i++) {
    $cat = $dcategory[$i]->cat_name;
    if($cat):
        $cat_link = get_category_link( $dcategory[$i]->term_id );
        //$data .= "<a href=\"{$cat_link}\" class=\"cat-link\">{$cat}</a>, ";    
        $data .= el_a($cat_link, array('class'=>'cat-link', 'title'=>$cat, 'echo'=>false)) . ",";

    endif;    
}    
$data = rtrim($data, ', ');    

$out = add_div($div, $data);
dprint($echo, $out);  

return $out;
}

/* #endregion */

/* #region ARTICLE TAGS ----------------------*/

function bd_show_tags(
    $div = '',
    $echo = true
)
{
$post_tags = get_the_tags();
$separator = '<span class="mx-2">|</span>';

if (!empty($post_tags)) {
    foreach ($post_tags as $tag) {
        $tag_link = get_tag_link($tag->term_id);
        $output .= "<a href=\"{$tag_link}\">{$tag->name}</a>{$separator}";
    }
    
    $data = $output;

    $out = add_div($div, $data);
    dprint($echo, $out);
}
}

/* #endregion */

/* #region ARTICLE CATEGORY ----------------------*/
function bd_show_category($post, $text) {
$type = get_post_type($post);
if($type == 'post') {
    $cat =  bd_post_category($post->ID, '2', '', 0);
    $data = $text . $cat; 
}
if($type == 'page') { 
    $data = 'Page';
}
return $data;
}


/* #endregion */  

?>
