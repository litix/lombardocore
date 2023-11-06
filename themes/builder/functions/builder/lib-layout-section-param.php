<?php 
# ELEMENT | LAYOUT
# Section Filters for "section_class()"
# SETTINGS X.0


/*------------------------------------------------*/

# selects the Preset bg color from selection via input
# colors created at lib-element-background

# b2_layout > background > bg_color
# output : class="added class"


function section_class_BGcolor(){

    $id = el_settings_background('color');

    $bg = $id['bg_color'];

    $bg = ' bg-' . clean_text($bg);
    return $bg; 
    //output as class ie.: <section class="bg-green">
}

add_filter('section_BG', 'section_class_BGcolor');

/*------------------------------------------------*/

# removes br in mobile from true/false
# ACF Settings 3.1 > Mobile > remove_linebreak
# output : class="added class"

function section_class_Mobile_BR() {

    $br = el_settings_mobile('remove_linebreak');

    $div_class = ($br == true) ? ' no-br' : '';
    return $div_class;
}

add_filter('section_MOBILE_BR', 'section_class_Mobile_BR');

/*------------------------------------------------*/

# creates text alignment class for section
# ACF Settings 3.1 > Content > alignment
# output : class="added class"

function section_class_Text_align(){

    $id = el_settings_content('alignment');  

    $ta = $id['text_alignment'];

    return $ta;
    //output as class ie.: <section class="text-left">
}

add_filter('section_TEXT_ALIGN', 'section_class_Text_align');

/*------------------------------------------------*/

# creates a class for section
# ACF Settings 3.1 > Advanced > identifiers
# output : class="added class"

function section_class_Custom(){

    $id = el_settings_advanced('identifiers');

    $class = $id['section_class'];

    $class = ' ' . clean_text($class, array('lower'=>false, 'space'=>false));
    return $class;
    //output as class ie.: <section class="your class">
}

add_filter('section_CLASS', 'section_class_Custom');

/*------------------------------------------------*/

# creates an individual div with ID used in anchors (above section)
# ACF Settings 3.1 > Advanced > identifiers
# output : <div id="your-id"></div>

function div_id() {      

    $id = el_settings_advanced('identifiers');

    $sid = $id['section_id']; 
    $sid = clean_text($sid, array('lower'=>false, 'space'=>false));
    
    if($sid) {
        echo "<div id=\"{$sid}\" class=\"top-id\"></div>";
    }    
}

/*------------------------------------------------*/

# selects the light/dark theme from selection
# ACF Settings 3.1 > Theme > vtheme
# output : data-theme="theme selected"

function section_class_Theme(){

    $id = el_settings_theme();    

    $sth = $id['vtheme']; 

    $sth = strtolower($sth);
    $sth = str_ireplace(' ','-',$sth);

    //$sth = "data-theme=\"{$sth}\"";
    return $sth;
}

add_filter('section_THEME', 'section_class_Theme');

/*------------------------------------------------*/

# creates an css rules (above section)
# ie.: <style> #your-id { color: #ff0; } </style>

/*
REMOVED 

function element_style() {
    $es = get_sub_field('element_settings');
    $layout = $es['b2_custom_css'];    
    $css = $layout['css'];
    
    if($css) {
        $element_css = "<style>{$css}</style>";
        echo $element_css;
    }    
}
*/