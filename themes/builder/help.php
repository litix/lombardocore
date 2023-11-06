<?php
#LOGIC
el_function($field, array(
    'param'=>'param', 
    'var1'=>'foo', 
    'var2'=>'bar'
));

el_function ($field, $array = array());
{
    
    $default = array( 
        //initialy blank value
        'var1' => '',
        'var2' => ''
        //...
    );
    //combine input and 
    $param = array_merge($default, $array); //-> array ('param'=>'param')

    //process
    $var1 = "hello {$param['var1']}";
    $var2 = "hi {$param['var2']}";

    //generate the output
    $tags = array(
        'var1' => $var1
        'var2' => $var2
    )
        
    generate_output($tags, $field);
}

/*------------------------------------------------*/


/*------------------------------------------------*/

#cloned advlink - seamless
el_clink($e['cfg_button']);
el_link_attr($e['cfg_button'], 1, 1);

#cloned advlink - group
el_clink($e['bb']);
el_link_attr($e['bb'], 1, 1);

#ordinary advlink 
echo el_link_attr($e['link'], 0);

#cloned advlink in a repeater
el_btnloop($e['button_loop']);
el_btnloop($e['button_loop'], 
    array(
        'id'=>'your-id', 
        'class'=>'your-clss', 
        'data'=>'data-id="zephyr"'
    )
);

#advlink meta
$meta = el_link_meta($e['cfg_button'], 1);
echo $meta['all'];

#ordinary link meta
$meta = el_link_meta($e['your-link']);
echo $meta['all'];

#static button
el_bbtn($e['button']);

/*------------------------------------------------*/

#add div
tag_wrap('div-class', 'Hello');

/*------------------------------------------------*/

#youtube
el_youtube($e['youtube_url'], array('div'=>'h300'));
//autoplay
$arr = array('autoplay'=>1, 'mute'=>1, 'loop'=>1, 'div'=>'h300');
el_youtube($e['youtube_url'], $arr); 
//background
el_bgyoutube($e['youtube_url'], array('height'=>'160', 'div'=>'h300'));
//popup
el_popyoutube($e['youtube_url'], array('div'=>'h300'));
el_popyoutube($e['youtube_url'], array('div'=>'h300', 'thumb_url'=>'http://127.0.0.1/persona/wp-content/uploads/2022/08/image_5.svg'));


/*------------------------------------------------*/

#Map
el_gmap($e['address'], array('div'=>'h300')); 
//background
el_gmap($e['address'], array('div'=>'bg-iframe overlay map'));
//popup
$map_link = googlemap($e['address'], true);
echo "<a href=\"{$map_link}\" data-fancybox data-width=\"600\">View Map</a>";

/*------------------------------------------------*/

#video
el_bgvideo($e['video']); 

/*------------------------------------------------*/

#content (flex)
$rp = $e['cfg_content']; //print_r($rp); 
$div = '';
if($rp):
    foreach( $rp as $r ):

    $row = $r['acf_fc_layout'];
    
    if($row == 'main_title'):
        
        el_title($r['main_title'], array('div'=>$div));

    elseif($row == 'seo_title'): 
        
        el_title($r['seo_title'], array('css'=>'btitle', 'div'=>$div));

    elseif($row == 'alt_title'): 
        
        el_title($r['alt_title'], array('css'=>'atitle', 'div'=>$div));

    elseif($row == 'text'): 

        if($r['full'] == true):
            el_text($r['text_full'], array("class"=>"dtext dtext-f {$div}", 'full'=>true));
        else:
            el_text($r['text'], array("class"=>"dtext {$div}"));    
        endif;
        
    elseif($row == 'logo'): 

        el_img($r['logo'], array('div'=>$div));

    elseif($row == 'button'): 

        el_btnloop($r['button_loop'], array('div'=>"btn-loop {$div}"));

    endif;    

    endforeach; 
endif; 



/*------------------------------------------------*/



?> 

<div class="row">
    <div class="col-lg-4">
        <?php el_media($e['pop_me'], array('as'=>'pop')); ?>
    </div>
    <div class="col-lg-4">
    <?php
        echo '<div class="basic">';
            el_media($e['pop_me'], array('as'=>'bg'));
        echo '</div>';
    ?>
    </div>
    <div class="col-lg-4">
        <?php el_media($e['pop_me'], array('data'=>'style="height:250px"')); ?>
    </div>
</div>

<?php
## Flexible Field shortcut

if($e['flexible_field']):
  foreach( $e['flexible_field'] as $f ):

    $row = $f['acf_fc_layout'];
    
    if($row == 'sample_1'):
      $field = $f['field_name'];

    elseif($row == 'sample_2'): 
      $field = $f['field_name'];
      
    endif;    

  endforeach; 
endif;  

## Repeater

$icons = $e['repeater_field'];
if($icons):
foreach( $icons as $icon ) :
  echo $icon['icon'];
endforeach;
endif;

## Group

$group = $e['group_field'];
echo $group['field_of_group'];

## Checkbox
if( $acf && in_array('search', $acf) ) {

}

## CREATE IMAGE CHOICES HERE
/*
function ver_image_choices($selector){
    if($selector == 'vhero1') {
        $f = 'element_heroimg'; 
        $ds = array(
                'ver-1' => ver_display($f, 'ver-1'),
                'ver-2' => ver_display($f, 'ver-2'),
                'ver-3' => ver_display($f, 'ver-3'),
                'ver-4' => ver_display($f, 'ver-4'),
                'ver-5' => ver_display($f, 'ver-5'),                
        );
    }

    if($selector == 'vtitle1') {
        $f = 'element_title'; 
        $ds = array(
                'ver-1' => ver_display($f, 'ver-1'),
                'ver-2' => ver_display($f, 'ver-2'),
                'ver-3' => ver_display($f, 'ver-3'),
                'ver-4' => ver_display($f, 'ver-4'),
                'ver-5' => ver_display($f, 'ver-5'),
        );
    }
    return $ds;    
}

## FILTER HERE
function vhero_1($field) {
    $field['choices'] = array();
    $ds = ver_image_choices('vhero1');
    $field = vloop_choices($ds, $field);
    return $field;
}
add_filter('acf/load_field/name=vhero1', 'vhero_1');

## FILTER HERE
function vtitle_1($field) {
    $field['choices'] = array();
    $ds = ver_image_choices('vtitle1');
    $field = vloop_choices($ds, $field);
    return $field;
}
add_filter('acf/load_field/name=vtitle1', 'vtitle_1');

## add the section version to the class
function section_version(){
    if($ver = get_sub_field('vhero1')) { return $ver; }
    if($ver = get_sub_field('vtitle1')) { return $ver; }    
}

add_filter('section_VERSION', 'section_version');

/* #endregion */
?>