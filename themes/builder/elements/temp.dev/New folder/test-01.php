<?php 
    load_assets(array('bootstrap'));
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    section_class("el-test");
    div_start();    
?>
<div class="container-xl">
<div style="min-height: 500px">

<div class="row">
    <div class="col-lg-4">
        <?php el_media($e['pop_m'], array('as'=>'pop')); ?>
    </div>
    <div class="col-lg-4">
    <?php
        echo '<div class="basic">';
            el_media($e['pop_m'], array('as'=>'bg'));
        echo '</div>';
    ?>
    </div>
    <div class="col-lg-4">
        <?php el_media($e['pop_m'], array('data'=>'style="height:250px"')); ?>
    </div>
</div>

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

<div class="row">
    <div class="col-lg-4">
        <?php el_media($e['pop_media'], array('as'=>'pop')); ?>
    </div>
    <div class="col-lg-4">
    <?php
        echo '<div class="basic">';
            el_media($e['pop_media'], array('as'=>'bg'));
        echo '</div>';
    ?>
    </div>
    <div class="col-lg-4">
        <?php el_media($e['pop_media']); ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <?php el_media($e['popper'], array('as'=>'pop')); ?>
    </div>
    <div class="col-lg-4">
    <?php
        echo '<div class="basic">';
            el_media($e['popper'], array('as'=>'bg'));
        echo '</div>';
    ?>
    </div>
    <div class="col-lg-4">
        <?php el_media($e['popper']); ?>
    </div>
</div>

<?php 

//el_advlink($e['pop']);


/*
*/

//
//el_popyoutube($e['youtube_url'], array('div'=>'h300'));

//$s = $e['pop_media'];
//print_r($s);
//post_thumb(1943);
//post_thumb(1938);
//post_thumb(1938, array('as'=>'img'));
//echo tp_thumb(1938, array('as'=>'img', 'echo'=>false));


//$img = fn_opt_thumbnail(1);
//el_img($img);

//el_tag($e['address']);
//el_flex($e['cfg_content'], array('class-items'=>'flex-item'));
//el_clink($e['bb']);
/*
$rp = $e['cfg_content']; 
$item = '';
if($rp):
    foreach( $rp as $r ):

    $row = $r['acf_fc_layout'];
    
    if($row == 'main_title'):
        el_title($r['main_title'], array('div'=>$item));

    elseif($row == 'seo_title'):        
        el_title($r['seo_title'], array('css'=>'btitle', 'div'=>$item));

    elseif($row == 'alt_title'):         
        el_title($r['alt_title'], array('css'=>'atitle', 'div'=>$item));

    elseif($row == 'text'): 

        if($r['full'] == true):
            el_text($r['text_full'], array("class"=>"dtext dtext-f {$item}", 'full'=>true));
        else:
            el_text($r['text'], array("class"=>"dtext {$item}"));    
        endif;
        
    elseif($row == 'logo'): 
        el_img($r['logo'], array('height'=>70, 'div'=>$item));

    elseif($row == 'button'): 
        el_btnloop($r['button_loop'], array('div'=>"btn-loop {$item}"));

    endif;    

    endforeach; 
endif;     
*/     
?>
</div>
</div>
<div class="container-xl">   
<?php
    //el_bgyoutube($e['youtube_url'], array('div'=>'h300'));
    //el_youtube($e['youtube_url']);
    //el_video($e['video'], array('controls'=>'controls','autoplay'=>''));
    //el_link_meta($e['cfg_button'], 1, 1);
    //el_clink($e['cfg_button'], array('rel'=>'noindex'));
    //$arr = array('alt'=>'hello', 'width'=>50, 'height'=>50,);
    //el_img($e['image_1'], $arr);
    //el_img($e['image_2'], $arr);
    //el_img($e['image_3'], $arr);
    //el_bgoverlay($e['image_3']);
    //print_r(get_field('settings', 'options'));
    //el_img('http://127.0.0.1/persona/wp-content/uploads/2021/02/flame-logo.svg');
    //el_a('#');
?>
<a href="<?php //echo googlemap($e['address'], true) ?>" data-fancybox data-width="600">
  View Map
 </a>
</div>    
<?php div_end(); ?>
