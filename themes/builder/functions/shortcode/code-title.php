<?php 
# TITLE
# ACF FIELD : TEXT | TEXTAREA | WYSIWYG (simple title)

/*------------------------------------------------*/

function el_title($acf='', $array=array()) {

    //default will negate null values
    $default = array( 
        'div'       =>  '',
        'class'     =>  '',
        'id'        =>  '',
        'echo'      =>  true,
        'data'      =>  '',
        'css'       =>  'mtitle',        
        'tag'       =>  '',
    );

    if($acf)
        $acf = strip_tags($acf, '<strong><span><em><del><br>');

    #parameters
    $param = array_merge($default, $array);

    $class = $param['class'] ? "{$param['css']} {$param['class']}" : "{$param['css']}";  
    
    $ttag = $param['tag'] ? $param['tag'] : tag_h($param['css']);

    //generate the output parameters
    $tag = array(
        'div'       =>  $param['div'],
        'class'     =>  $class,
        'id'        =>  $param['id'],
        'echo'      =>  $param['echo'],
        'data'      =>  $param['data'],
        'css'       =>  $param['css'],
        'tag'       =>  $ttag
    );

    return tag_builder($tag, $acf);
}

/*------------------------------------------------*/
## HOW TO USE : 
/*
    ## COMMON : 
    el_title($e['title']);
    el_title($e['before_title'], array('css'=>'btitle'));
    el_title($e['after_title'], array('css'=>'atitle'));

    css = mtitle (main), atitle (2nd), btitle (3rd), ititle (loop)
*/

/*
    ## SIMPLE
    el_title($field);

    ## PARAMETERS
    el_title($field, array('div'=>'div-title', 'class'=>'dtitle', id=>'title-1'));

    ## RETURN NO ECHO
    $variable = el_title($field, array('echo'=>'0') 
*/
?>
