<?php 
    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $opt = data_fields($e);

    section_class('sep-01 separator');
    div_start('dflex', array('data'=>data_set($opt), 'style'=>data_height($opt, 0)));
?>
<!-- separator -->
<?php div_end(); ?>

