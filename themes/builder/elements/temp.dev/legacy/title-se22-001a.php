<?php 
    load_assets(array());
    $layout = get_row_layout('bootstrap');   
    $e = get_sub_field($layout);

    section_class('el-title');
    div_start();    

    $d = $e['display_fields'];
?>

<div class="container-xl" <?php //echo el_opt($d); ?>>      
    <div class="dinfo" <?php //echo el_align($d); ?>>
    <?php 
        el_title($e['before_title'], array('css'=>'btitle'));
        el_title($e['title']);
        el_title($e['after_title'], array('css'=>'atitle'));

        el_text($e['text']);
        el_btnloop($e['button_loop']);
    ?>    
    </div>        
</div>    

<?php div_end(); ?>

