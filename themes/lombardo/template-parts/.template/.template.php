<?php 
/* 
    ACF FIELD - THEME OPTIONS []
*/

/* -------------------------------------------------------------- */      

/* #region */

function tpl_templates($tpl){

    switch ($tpl):

    case "tpl_menu":
        $tpl_array = array(
            'ver-0'      => 'template-parts/header',                    ##
            'ver-1'      => 'template-parts/.template/main-menu-1',     ##
            'ver-2'      => 'template-parts/.template/main-menu-2',     ##
        );
        $ver_count = count($tpl_array);
        break;

    case "tpl_footer":    
        $tpl_array = array(
            'ver-0'      => 'template-parts/footer',                    ##
            'ver-1'      => 'template-parts/.template/footer-1',        ##
            'ver-2'      => 'template-parts/.template/footer-2',        ##
        );        
        $ver_count = count($tpl_array);
        break;

    case "tpl_404":    
        $tpl_array = array(
            'ver-0'      => 'template-parts/404',                       ##
            'ver-1'      => 'template-parts/.template/single-1',        ##
            'ver-2'      => 'template-parts/.template/single-2',        ##
        );        
        $ver_count = count($tpl_array);
        break;    

    case "tpl_single":    
        $tpl_array = array(
            'ver-0'      => 'template-parts/single',                    ##
            'ver-1'      => 'template-parts/.template/single-1',        ##
            'ver-2'      => 'template-parts/.template/single-2',        ##
        );        
        $ver_count = count($tpl_array);
        break;        

    case "tpl_archive":    
        $tpl_array = array(
            'ver-0'      => 'template-parts/archive',                   ##
            'ver-1'      => 'template-parts/.template/archive-1',       ##
            'ver-2'      => 'template-parts/.template/archive-2',       ##
        );        
        $ver_count = count($tpl_array);
        break;       
        
    case "tpl_search":    
        $tpl_array = array(
            'ver-0'      => 'template-parts/search',                    ##
            'ver-1'      => 'template-parts/.template/search-1',        ##
            'ver-2'      => 'template-parts/.template/search-2',        ##
        );        
        $ver_count = count($tpl_array);
        break;           

    endswitch;

    $folder = '';
    
    $ver_count = $ver_count - 1;

    if($tpl)
        return array(
            'count'         =>  $ver_count, 
            'folder'        =>  $folder,
            'tpl_array'     =>  $tpl_array
        );
}

/* #endregion */    

add_filter( 'acf/load_field/name=tpl_menu',    'tpl_acf' ); 
add_filter( 'acf/load_field/name=tpl_footer',  'tpl_acf' );
add_filter( 'acf/load_field/name=tpl_404',     'tpl_acf' );
add_filter( 'acf/load_field/name=tpl_single',  'tpl_acf' );
add_filter( 'acf/load_field/name=tpl_archive', 'tpl_acf' );
add_filter( 'acf/load_field/name=tpl_search',  'tpl_acf' );

/* NO TOUCH */
/* -------------------------------------------------------------- */      

/* #region */

function tpl_acf($field) {
        
    $set = tpl_templates($field['name']);
    $ver_count = $set['count'];
    
    //$choices = array('none' => ver_display($folder, 'ver-0'));
    $choices = array();

    for ($i = 0; $i <= $ver_count; $i++) {
        $b = array("ver-{$i}" => ver_display($field['name'], "ver-{$i}"));
        ## ver-0 => /template-parts/.template/.preview/tpl_menu/ver-0.jpg
        array_push($choices, $b);
    }    
    
    ## set radio to image selection
    $field['choices'] = array();

    foreach( $choices as $id => $name ) :
        $field['choices'][$id] = $name;    
    endforeach;    

    return $field;
}

/* #endregion */    

/* #region */

function ver_display($folder, $file){ 
    global $tplf;
    ## folder = tpl_menu
    ## file = ver-0

    $path = $tplf . "/.preview/{$folder}/{$file}.jpg";
    $img = "<img src=\"{$path}\" alt=\"\">";
    ## /template-parts/.template/.preview/tpl_menu/ver-0.jpg
    return $img;
}

function vloop_choices($ds, $field){
    foreach( $ds as $value=>$label) :
        $field['choices'][ $value ] = $label;   
    endforeach;

    return $field;
}

/* #endregion */

?>