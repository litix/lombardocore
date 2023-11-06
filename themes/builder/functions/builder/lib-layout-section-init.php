<?php 
# ELEMENT | LAYOUT
# Section wrapper for element layout | used in element templates
# SETTINGS X.0

# usage : section_class("el-grid imgs");
# note : if you are not using "div_start();" add a section_class('', 'end');
# improvement : use data

global $layout_array;
$layout_array = array();

function section_class($class = '', $array=array()) {

    $default = array( 
        'div'        =>  'div',
        's'          =>  'start',
        'id'         =>  '',
        'data-theme' =>  'default',
        'data'       =>  '',
    );

   #parameters
   $param = array_merge($default, $array); 

   ## class
   $class_array = array(
       'element',
       $class,
       apply_filters('section_BG', ''),
       apply_filters('section_MOBILE_BR', ''),
       apply_filters('section_TEXT_ALIGN', ''),
       apply_filters('section_CLASS', ''),
       apply_filters('section_VERSION', ''),
   );

   $classes = implode(" ", $class_array);
   $section_class = "class=\"{$classes}\"";

   ##data
   $row = get_row_layout();
   $data_row = "data-template=\"{$row}\"";

   ##theme
   $data_theme = '';
   $theme = $param['data-theme']; ## user
   $settings_theme = apply_filters('section_THEME', ''); ## admin

   ## user selects from a value
   if($settings_theme != 'default') {
       $theme = $settings_theme;
   }

   $data_theme = "data-theme=\"{$theme}\"";

   $datas = array(
        $data_theme,
        $data_row,
        $param['data'],
   );

   $data = implode(" ", $datas);

   ## id
   $id = $param['id'] ? "id=\"{$param['id']}\"" : "";

   ## attr
   $attr = implode(" ", array($section_class, $id, $data));

/*------------------------------------------------*/   

   ## fire starter     
   if($param['s'] == 'start'):
        check_fire();
        check_cluster();
   endif;

/*------------------------------------------------*/    
       
   ## start end

   $section = "<section $attr>";

    #start
    if($param['s'] == 'start') {
        set_setup();
        echo $section;
    }

    #custom
    if($param['s'] == 'custom') {
        set_setup();
        echo $section;
    }

    #end
    if($param['s'] == 'end') { 
        end_setup();
        echo "</section>";
    }

}

function set_setup(){
    div_id();         

    //$layout = get_row_layout();
    //echo $layout;
    //global $layout_array;
    //array_push($layout_array, $layout);

     # <- div id above section (settings x.0)
    //element_style(); 
}

function end_setup() {

}

function section_fire($array = array()) {

    $default = array( 
        'class'      =>  '',
        'id'         =>  '',
        'data-theme' =>  'default',
        'data'       =>  '',
        'otheme'     =>  false,
        'obg'        =>  false,
        'ocolor'     =>  false,
        'ooverlay'   =>  false,        
        'style'      =>  array()
    );

    #parameters
    $param = array_merge($default, $array); 

    ## class
    $class_array = array(
        'fire-element',
        $param['class'],
        apply_filters('section_BG', ''),
        apply_filters('section_CLASS', ''),
        apply_filters('section_VERSION', ''),
    );    

    $classes = implode(" ", $class_array);
    $section_class = "class=\"{$classes}\"";

    ## id
    $id = $param['id'] ? "id=\"{$param['id']}\"" : "";    

    $style = wrap_style($param['style']);
    $style = tag_attr_style($style);   

    ## data
    $row = get_row_layout();
    $data_row = "data-template=\"{$row}\"";

        ## theme override
        $override_theme = '';
        if($param['otheme'] == true)
            $override_theme = "data-theme=\"override\"";

        $override_bg = '';
        if($param['obg'] == true)
            $override_bg = "data-bgcolor=\"override\"";

        /*            
        $override_bgimg = '';
        if($param['ocolor'] == true)
            $override_bgimg = "data-bgimage=\"override\"";            
         
        $override_bgoverlay = '';
        if($param['ooverlay'] == true)
            $override_bgoverlay = "data-bgoverlay=\"override\"";              
        */        

    $datas = array(
        $override_theme,
        $override_bg,
        $data_row,
        $param['data'],
    );

    $data = implode(" ", $datas);

    ## attr
    $attr = implode(" ", array($section_class, $id, $data, $style));

    ## output
    $section = "<section $attr>";

    echo $section;
    echo apply_filters('after_wrap_is_media', '');
    echo apply_filters('after_wrap_is_overlay_custom', '');
    echo apply_filters('after_wrap_is_overlay_preset', '');       
}

function section_cluster($array = array()) {

    $default = array( 
        'class'      =>  '',
        'id'         =>  '',
        'data-theme' =>  'default',
        'data'       =>  '',
        'otheme'     =>  false,
        'obg'        =>  false,
        'ocolor'     =>  false,
        'ooverlay'   =>  false,        
        'style'      =>  array()
    );

    #parameters
    $param = array_merge($default, $array); 

    ## class
    $class_array = array(
        'element-cluster',
        $param['class'],
        apply_filters('section_BG', ''),
        apply_filters('section_CLASS', ''),
        apply_filters('section_VERSION', ''),
    );    

    $classes = implode(" ", $class_array);
    $section_class = "class=\"{$classes}\"";

    ## id
    $id = $param['id'] ? "id=\"{$param['id']}\"" : "";    

    $style = wrap_style($param['style']);
    $style = tag_attr_style($style);   

    ## data
    $row = get_row_layout();
    $data_row = "data-template=\"{$row}\"";

    ## attr
    $attr = implode(" ", array($section_class, $id, $data_row, $style));

    ## output
    $section = "<section $attr>";

    echo $section;
}

function check_fire() {

    global $fire;

    if($fire > 0) : ## someone started a fire! 

        $fire--;

        if($fire == 0)
            echo '</section>';
    endif;
}

function check_cluster() {
    global $cluster;

    if($cluster > 0) : ## initiate cluster! 
        $cluster--;

        if($cluster == 0)
            echo '</section>';
    endif;
}

function create_fire($amt) {
    
    $amount = 0;

    if($amt == '') {
        $amt = 2;
    }

    $amount = $amt;

    return $amount;
}

#note : </section> is called at div-init : div_end(); lib-layout-div-init.php
#note : see filters at lib-layout-section-param.php