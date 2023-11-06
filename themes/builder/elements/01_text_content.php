<?php 
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    section_class('el-content full');
    div_start();    
?>

<div class="container-xl">   
    <?php el_text($e['text']); ?>
</div>    

<?php div_end(); ?>