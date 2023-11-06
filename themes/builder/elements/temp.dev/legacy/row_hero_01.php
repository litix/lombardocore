<?php 
    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    ## options
    $opt = $e['display_fields'];

    section_class('rh-01', array('data-theme'=>'dark'));
    div_start('dflex', array('data'=>data_set($opt)));  
?>

<?php el_media($e['media'], array('as'=>'overlay')); ?>
<div class="overlay color"></div>

<div class="container-xl">      
    <div class="row">
        <div class="col-info">
        <?php 
            el_img($e['icon'], array('div'=>'diconn'));
            el_title($e['before_title'], array('css'=>'btitle'));
            el_title($e['mtitle'], array());
            el_title($e['title'], array('css'=>'dtitle'));
            el_title($e['after_title'], array('css'=>'atitle'));
            el_text($e['editor']);
            el_text($e['text'], array('css'=>'ptext'));
            el_btnloop($e['button_loop']);
        ?>    
    </div>
</div>    

<?php div_end(); ?>