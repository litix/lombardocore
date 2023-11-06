<?php 
    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $opt = data_fields($e);
    $col = data_colsize($e);

    section_class('rowmedia-01');
    div_start('dflex', array('data'=>data_set($opt)));

    $s = check_media($e['media']);
?>

<div class="container-xl">      
    <div class="row">

        <?php if($s == true): ?>
        <div class="col-md-<?php echo $col[0]; ?> cc">    
            <?php el_media($e['media']); ?>
        </div>    
        <?php endif; ?>
    
        <div class="col-md-<?php echo $col[1]; ?> cc">
            <div class="dinfo">
            <?php 
                el_img($e['icon'], array('div'=>'diconn'));
                el_title($e['before_title'], array('css'=>'btitle'));
                el_title($e['mtitle']);
                el_title($e['title'], array('css'=>'dtitle'));
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

