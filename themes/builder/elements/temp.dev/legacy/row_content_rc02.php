<?php 
    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    ## options
    $opt = $e['display_fields'];
    $col = $opt['columns_bg']; 

    section_class('el-column rc02');
    div_start('dflex', array('data'=>data_set($opt)));  
?>

<?php el_media($e['media'], array('as'=>'overlay')); ?>

<div class="container-xl">      
    <div class="row">

        <div class="col-lg-<?php echo $col[0]; ?> cc"></div>    
    
        <div class="col-lg-<?php echo $col[2]; ?> cc">
            <div class="dinfo">
            <?php 
                el_img($e['icon'], array('div'=>'diconn'));
                el_title($e['before_title'], array('css'=>'btitle'));
                el_title($e['mtitle'], array('class'=>'f40'));
                el_title($e['title'], array('class'=>'f40', 'css'=>'dtitle'));
                el_title($e['after_title'], array('css'=>'atitle'));
                el_text($e['editor']);
                el_text($e['text'], array('css'=>'ptext'));
                el_btnloop($e['button_loop']);
            ?>    
            </div>        
        </div>           

    </div>
</div>    

<?php div_end(); ?>