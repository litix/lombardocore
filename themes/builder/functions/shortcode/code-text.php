<?php 
# TEXT
# ACF FIELD : TEXT | TEXTAREA | WYSIWYG (simple text, full, basic)

/*------------------------------------------------*/

function el_text($acf='', $array=array()) {

    //default will negate null values
    $default = array( 
        'div'       =>  '',
        'class'     =>  '',
        'id'        =>  '',
        'echo'      =>  true,
        'data'      =>  '',
        'full'      =>  false,
        'css'       =>  '',        
    );

    #parameters
    $param = array_merge($default, $array);

    if($acf) {
        if($param['full'] != true)
        $acf = strip_tags($acf, '<b><p><br><em><i><strike><strong><a><h1><h2><h3><h4><h5><h6><img><ol><ul><li><span>');
    }
    
    $css = $param['css'] ? $param['css'] : 'dtext';
    $class = $param['class'] ? "{$param['class']}" : "{$css}";    
    
    //generate the output parameters
    $tag = array(
        'div'       =>  $param['div'],
        'class'     =>  $class,
        'id'        =>  $param['id'],
        'echo'      =>  $param['echo'],
        'data'      =>  $param['data'],
        'css'       =>  $css,
    );

    return tag_builder($tag, $acf);
}

/*------------------------------------------------*/

function el_tag($acf='', $array=array()) {

    //default will negate null values
    $default = array( 
        'div'       =>  '',
        'class'     =>  'dtag',
        'id'        =>  '',
        'echo'      =>  true,
        'data'      =>  '',
        'attr'      =>  '',
        'full'      =>  false,
        'css'       =>  '',  
        'tag'       =>  'div',  
    );

    #parameters
    $param = array_merge($default, $array);   
    $class = implode(" ", array($param['class']));
    $css = $param['css'];
    
    //generate the output parameters
    $tag = array(
        'tag'       =>  $param['tag'],
        'div'       =>  $param['div'],
        'class'     =>  $class,
        'id'        =>  $param['id'],
        'echo'      =>  $param['echo'],
        'data'      =>  $param['data'],
        'css'       =>  $css,
        'attr'      =>  $param['attr'],
    );

    return tag_builder($tag, $acf);
}
## HOW TO USE : 
/*
    ## SIMPLE
    el_text($field);

    ## PARAMETERS
    el_text($field, array('div'=>'div-wrap', 'class'=>'itext', 'id'=>'sample-1'));
    el_text($field, array('data'=>'data-boom="billy"'));
    el_text($field, array('css'=>'itext'));

    options : itext, dtext

    ## RETURN NO ECHO
    $variable = el_text($field, array('echo'=>'0'); 
*/
?>