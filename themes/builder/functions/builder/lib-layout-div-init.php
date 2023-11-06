<?php 
# ELEMENT | LAYOUT
# Div wrapper for element layout | used in element templates
# SETTINGS X.0

# element usage: div_start(); ..code.. div_end();
# options : PADDING | HEIGHT

## <div wrap style={xxx}></div>
function wrap_style($style=array()) {

    $args = '';

    $args .= css_style($style);
    $args .= wrap_height();
    $args .= wrap_padding();
    $args .= wrap_bgcolor();

    return $args;
}


## <div wrap data-{xxx}></div>
function wrap_datas() {

    $v = apply_filters('wrap_data_vertical', '');   
    $h = apply_filters('wrap_data_horizontal', '');
    $c = apply_filters('wrap_data_container', '');
    //$args .= apply_filters('overlay_custom', '');
    //$args .= wrap_bgcolor();

    $args = implode(" ", array($v, $h, $c));

    return $args;     
}

function div_start($class='dflex', $array=array()) {
    
    global $ignite; //safety catcher
    $ignite = 0;
    $ignite++;

    $default = array( 
        'f'     =>  'x',
        'class' =>  $class,
        'id'    =>  '',
        'data'  =>  '',
        'style' =>  array(),
    );

    #parameters --------------------- */
    $param = array_merge($default, $array);

    #id --------------------- */
    $id = tag_attr_id($param['id']);

    #class --------------------- */

    $default_class = 'wrap';
    $custom_class = '';
    $param_class = $param['class'];

    $class_array = implode(" ", 
        array(
            $default_class, 
            $param_class,
            $custom_class
        )
    );

    $class = tag_attr_class($class_array);

    #stlye --------------------- */
    ## pending param['style];
    $style = wrap_style($param['style']);
    $style = tag_attr_style($style);    
    
    #param data --------------------- */
    $data  = $param['data'];

    #data --------------------- */
    $wdata = wrap_datas();   
    
    /* --------------------- */

    $attr  = ''; 
    
    $tag_attr = implode(" ", 
        array(
            $class, 
            $id, 
            $data, 
            $attr, 
            $wdata,
            $style, 
        )
    );

    #extender --------------------- */
    ## element after wrap
    //$wrap_after = wrap_after();
    
    echo "<div {$tag_attr}>";
    echo apply_filters('after_wrap_is_media', '');
    echo apply_filters('after_wrap_is_overlay_custom', '');
    echo apply_filters('after_wrap_is_overlay_preset', '');   
    echo apply_filters('after_wrap_content', '');
}


function div_end($array=array()) {
    global $ignite;

    $default = array( 
        'f'  =>  'x',
    );

    #parameters
    $param = array_merge($default, $array);
    
    #process
    if($ignite == 1){
        echo '</div>'; //end div wrap        
    }

    $ignite = 0;    

    section_class('', array('s'=>'end')); //end section
    div_script_lazybg();
}

function div_script_lazybg() {
    //lazy image script
    if(is_admin()) {
        
        echo "<script>
        var $ = jQuery.noConflict();

        $(function() {

            $('video, iframe').each(function() {
                var v = $(this);
                if(v.length > 0) {
                    var lazy = v.data('src');
                    v.attr('src', lazy);
                }
            });

            $('.bg-img').each(function() {
                var bg = $(this);
                if(bg.length > 0) { 
                    var lazy = bg.data('bg');
                    bg.css('background-image', 'url(\"'+lazy+'\")');
                }
            });

        });


        </script>";
    }
}

/*
add_action('div_start', function() use ($s) { 
    div_wrap('start'); }, 10
);

add_action('div_end', function() use ($s) { 
    div_wrap('end'); 
}, 20);
*/

/*
function div_start($array=array()) {
    //do_action('div_start');
    $default = array( 
        'f'           =>  'start',
    );

    #parameters
    $param = array_merge($default, $array);

    div_wrap(array('f'=>'start'));
}

function div_end($array=array()) {
    //do_action('div_end');
    $default = array( 
        'f'           =>  'end',
    );

    #parameters
    $param = array_merge($default, $array);

    div_wrap(array('f'=>'end'));
}

function div_wrap($array=array()) {

    $default = array(
        'f' => 'start'
    );

    $param = array_merge($default, $array);


    if($param['f'] == 'start'):
        
        $args = '';
        $args .= div_height(false);
        $args .= div_padding(false);
        if($args != '') $style = "style=\"{$args}\" ";
        

        $class = div_class_vertical();
        if($class != '') {
            $class = "class=\"wrap {$class}\"";
        } else {
            $class = "class=\"wrap\"";
        }

        $output = "<div {$class} {$style} {$data}>";
        echo $output;    
    endif;    

    if($param['f'] == 'end'): 
        echo '</div>';
        section_class('', 'end');
        div_script_lazybg();
    endif;
}



add_action('div_start', function() use ($s) { 
    div_wrap('start'); }, 10
);

add_action('div_end', function() use ($s) { 
    div_wrap('end'); 
}, 20);
*/