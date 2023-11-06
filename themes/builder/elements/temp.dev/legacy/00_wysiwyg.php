<?php 
    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    section_class('el-content full');
    div_start();    
?>

<div class="container-xl">         
    <?php el_text($r['text']); ?>
</div>    

<?php div_end(); ?>
