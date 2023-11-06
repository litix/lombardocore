<?php 
# INIT
# Basic Functions
# CLASS | ID | <H-tag> settings

/* 
    ## TODO create a tag_data 

    input - array('data'=>array('head'=>'test', 'wex'=>'quas')) 
    ouput - <div data-head="test" data-wex="quas"></div>

    creat style paramenter
    input - array("style"=>"margin: 10px")
    output - <div style="margin: 10px"></div>

*/


/*
BUILD VAL

    function build_val( $val ) {
        if ( !is_array( $val ) || count( $val ) == 0 ) {
            return '';
        }

        return implode(' ', $val);
    }

    $classes = array(
        'output-box',
        'class-2',
        'class-3',
    );

    array_push( $classes, 'class-4' );

    <div class="<?= build_val( $classes ) ?>">

BUILD ATTR

    function build_attr( $attr ) {
        if ( !is_array( $attr ) || count( $attr ) == 0 ) {
            return '';
        }
        
        $temp = array();
        
        foreach( $attr as $key => $value ) {
            array_push($temp, $key . '="' . $value . '"');
        }

        return implode(' ', $temp);
    }

    $attr = array(
        'id'        => 'elem_id',
        'data-src'  => './src/img.png',
        'class'     => 'output-box',
    );

    $attr['data-id'] = 25;
    ?>
    
    <div <?= build_attr( $attr ) ?>>
*/

/*------------------------------------------------*/

/* #region ~ TAG BUILDER */
function tag_builder($tag, $acf) {
    global $tag_id;
    $tag_id++;

    global $tag_default_attr;

    $param = array_merge($tag_default_attr, $tag);
    
    #parameters
    $class      =   tag_attr_class($param['class']);
    $id         =   tag_attr_id($param['id']);
    $div        =   $param['div'];
    $echo       =   $param['echo'];
    $data       =   $param['data'];
    $tag        =   $param['tag'];
    $css        =   $param['css'];
    $opt_style  =   opt_styler($css);
    $style      =   css_style($param['style']);
    
    $attr       =   $param['attr'];
    $title      =   $param['title'];
    $type       =   tag_attr_type($param['type']);

    $pre_wrap   =   $param['prewrap'];
    $pos_wrap   =   $param['postwrap'];

    $before     =   $param['before'];
    $after      =   $param['after'];

    #generate the tag
    if($acf) {
        #output : tags-start-end
        $base = array($tag, $data, $id, $class, $attr, $type, $title, $opt_style, $style);
        
        $tag_attr = implode(" ", $base);

        if($tag == 'iframe') {
            $acf = '';
        }       

        if(is_array($acf)) { $acf = $acf['ID']; }
        
        $output = "<{$tag_attr}>";
        $output .= "{$pre_wrap}{$acf}{$pos_wrap}";
        $output .= "</$tag>";

        if($tag == 'img') {
            #output : single tag
            $img_attr = implode(" ", array($tag, $attr, $data, $id, $class, $style));
            $output = "<{$img_attr}>";
        }  

        #div
        $output = tag_wrap($div, $output);
        $output = tag_insert($output, $before, $after);

        #echo
        if($echo == 1)
            echo $output;
        
        return $output;
    }       
}

/* #region ~ CLASS */
function tag_attr_class($class) {

    $attr = "class=\"{$class}\"";
    return $attr;
}
/* #endregion */

/* #region ~ ID */
function tag_attr_id($id) {

    $attr = $id ? "id=\"{$id}\"" : "";
    return $attr;
}
/* #endregion */

/* #region ~ TYPE */
function tag_attr_type($t) {

    $attr = $t ? "data-class=\"{$t}\"" : "";
    return $attr;
}
/* #endregion */

/* #region ~ STYLE */
function tag_attr_style($s='') {

    $attr = $s ? "style=\"{$s}\"" : "";
    return $attr;
}


function css_style($array=array()) {  
    /*
        i : css_style('margin-top'=>'10px', 'height'=>'10px');
        o : margin-top: 10px; height: 10px;
    */

    $default = array(
        'echo'      =>  false,
        's'         =>  false,
    );
    
    $param = array_merge($default, $array);

    $output = "";
    $prop = "";
    $i = 0;

    foreach($array as $key => $val):

        if($key != 'echo' and $key != 's'):
            $prop .= $key . ': ' . $val . '; ';
            
            $i++;
        endif;

    endforeach;

    if($i >= 1) {
        $output = $prop;

        if($param['s'] == true)
            $output = " style=\"{$prop}\"";
    }

    if($param['echo'] == true)
        echo $output;
        
    return $output;          
}

/* #endregion */

/* #region ~ OUTER TAG */
function tag_wrap($div, $output, $param='', $tag='div') {

    $wrap = ($div) ? "<{$tag} class=\"{$div}\" {$param}>{$output}</{$tag}>" : $output;
    return $wrap;
}
/* #endregion */

/* #region ~ Tag INSERT */
function tag_insert($output, $before='',$after='') {
    $output = "{$before} {$output} {$after}";
    return $output;
}
/* #endregion */

/* #region ~ TITLE (h1-h6) */
function tag_h($css){
    
    $tag = '';
    
    if($css == 'mtitle') { $tag = el_settings_tag('tag'); }
    if($css == 'dtitle') { $tag = el_settings_tag('tag'); }
    if($css == 'btitle') { $tag = el_settings_tag('tag_bt'); }
    if($css == 'atitle') { $tag = el_settings_tag('tag_at'); }
    if($css == 'ititle') { $tag = el_settings_tag('tag_box'); }

    if($tag == '')
        $tag = 'h4';

    return $tag;
}
/* #endregion */

/* #region ~ Attributes */
    global $tag_default_attr;

    $tag_default_attr = array(
        'tag'       => 'div',
        'div'       => '',
        'class'     => '',
        'id'        => '',
        'echo'      => true,
        'data'      => '',
        'style'     => array(),
        'css'       => '',  
        'src'       => '',
        'type'      => '',   
        'rel'       => '',   
        'attr'      => '',    
        'img_attr'  => '',
        'title'     => '',
        'href'      => '',
        'target'    => '',
        'prewrap'   => '',
        'postwrap'  => '',    
        'prepend'   => '',
        'append'    => '',   
        'before'    => '',
        'after'     => '',       
    );
/* #endregion */