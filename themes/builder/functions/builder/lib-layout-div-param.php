<?php 
# ELEMENT | SETTINGS
# ACF LAYOUT SETTINGS 
# SETTINGS X.0
# The ACF fields in the setting that adds options on <div class="wrap"></div>
 
## DIV HEIGHT  
# ACF Settings 3.1 > Volume > sizing
# outuput : style="min-height"

function wrap_height() {

    $acf = el_settings_volume('sizing');

    $h = $acf['height'];

    $amt = opt_check_amt($h);
    $h = num_filter($h);

    $args = '';

    if($h >= 1 and $h != ''){
        $args = css_style(
            array(
                'min-height'=>"{$h}{$amt}"
            )
        );        
    }

    return $args;    
}

## DIV PADDING
# ACF Settings 3.1 > Volume > padding
# outuput : style="padding-top: xx; padding-botto: xx;"

function wrap_padding(){

    $acf = el_settings_volume('padding');

    $padding_top = $acf['padding_top'];
    $padding_btm = $acf['padding_bottom'];

    $amt_1 = opt_check_amt($padding_top);
    $amt_2 = opt_check_amt($padding_btm);

    $padding_top = num_filter($padding_top);
    $padding_btm = num_filter($padding_btm);


    $sub_top = '';
    $sub_btm = '';  
    $condition = false;
    $args = '';
    

    if($padding_top or $padding_top === '0') {
        $sub_top = css_style(
            array(
                'padding-top'=>"{$padding_top}{$amt_1}"
            )
        );
        $condition = true;
    }

    if($padding_btm or $padding_btm === '0') {
        $sub_btm = css_style(
            array(
                'padding-bottom'=>"{$padding_btm}{$amt_2}"
            )
        );
        $condition = true;
    }

    if($condition == true) { 
        $args = $sub_top . $sub_btm; 
    }    

    return $args;    
}

## WRAP VERTICAL
# ACF Settings 3.1 > Content > alignment
# data-vflex="top center bottom"

function wrap_class_vertical(){

    $acf = el_settings_content('alignment');
    $v = $acf['vertical_alignment'];

    $v = "data-vflex=\"{$v}\"";

    return $v;
}

add_filter('wrap_data_vertical', 'wrap_class_vertical');

## WRAP Horizontal
# ACF Settings 3.1 > Content > alignment
# data-vflex="top center bottom"

function wrap_class_horizontal(){

    $acf = el_settings_content('alignment');
    $z = $acf['horizontal_alignment'];

    if($z)
        $z = "data-hflex=\"{$z}\"";

    return $z;
}

add_filter('wrap_data_horizontal', 'wrap_class_horizontal');


## WRAP Container
# ACF Settings 3.1 > Content > size
# data-container="width"

function wrap_container(){

    $acf = el_settings_content('size');
    $c = $acf['width'];

    if($c)    
        $c = "data-container=\"{$c}\"";

    return $c;
}

add_filter('wrap_data_container', 'wrap_container');


## WRAP BG COLOR
# ACF Settings 3.1 > Background > color
# style = "background-color: color;"

function wrap_bgcolor() {

    $acf = el_settings_background('color');

    $color = $acf['bg_color_custom'];

    $args = '';

    if($color){
        $args = css_style(
            array(
                'background-color'=>"{$color}"
            )
        );        
    }

    return $args;    
}

/*------------------------------------------------*/

## After Wrap

## <div pop-media></div>

function wrap_media() {

    $acf = el_settings_background('media'); 
    
    $bg = $acf['bg_media'];
    $opacity = $acf['opacity'];

    $opacity = num_filter($opacity);
    if($opacity > 100)
        $opacity = 100;

    $el = '';

    $css = array(
        's'=>true, 
        'opacity'=>"{$opacity}%"
    );
    
    if(isset($acf['bg_media'])) {

        $el = el_media($bg, 
                array(
                'class'=>'overlay overlay-set overlay-bg',                
                'echo'=>false,
                'as'=>'overlay',
                'style'=>$css
            ));
    }              

    return $el;    
}    

add_filter('after_wrap_is_media', 'wrap_media');

/*------------------------------------------------*/

## Background Overlay

## <div custom overlay></div>
function wrap_overlay_custom(){ 

    $acf = el_settings_background('overlay');
    $color = $acf['custom_overlay'];

    $css = array(
            's'=>true, 
            'background-color'=>$color
        );
  
    $el = el_overlay('', array(
        'echo'=>false,
        'class'=>'overlay set-color',
        'style'=>$css
    ));

    if($color)
        return $el;
}

add_filter('after_wrap_is_overlay_custom', 'wrap_overlay_custom');

## <div preset overlay></div>
function wrap_overlay_preset(){ 

    $acf = el_settings_background('overlay'); 
    $overlay = $acf['bg_overlay'];

    $el = '';

    if($overlay and $overlay != 'none')
        $el = el_overlay('', array(
            'echo'=>false,
            'class'=>"overlay pre-color {$overlay}",
        ));

    if($overlay)
        return $el;    
}

add_filter('after_wrap_is_overlay_preset', 'wrap_overlay_preset');

## data-overlay="custom, preset"
function wrap_overlay_data(){

    $en = false;

    $acf = el_settings_background('overlay');
    
    $data = array();

    $color_1 = $acf['custom_overlay'];
    $color_2 = $acf['bg_overlay'];
    
    if($color_1) {
        array_push($data, 'custom');
        $en = true;
    }

    if($color_2 and $color_2 != 'none') {
        array_push($data, 'preset');
        $en = true;
    }

    $data = implode(",", $data);

    if($en == true)
        $data = "data-overlay=\"$data\"";

    return $data;
}

add_filter('data_overlay_filter', 'wrap_overlay_data');


function wrap_content_after(){ 

    $acf = el_settings_hidden('hcontent');
    $text = $acf['text'];

    if($text != '') {
        $text = tag_wrap('hide-me', $text);
        return $text;
    }

}

add_filter('after_wrap_content', 'wrap_content_after');

/* --------------------------------------------------- */

