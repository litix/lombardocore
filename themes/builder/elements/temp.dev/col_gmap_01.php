<?php 
    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $opt = data_fields($e);

    section_class('cgmap-01');
    div_start('dflex', array('data'=>data_set($opt), 'style'=>data_height($opt, 0)));  
?>

<div class="overlay color"></div>
<?php el_gmap($e['address'], array('z'=>13, 'class'=>'cta-gmap')); ?>

<div class="container-xl">    
    <div class="dinfo col-info pos-abs">  
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

<?php div_end(); ?>