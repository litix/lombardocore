<?php 
    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    section_class('el-flex');
    div_start();    

    $d = $e['display_fields'];
    
?>

<div class="container-xl" <?php //echo el_opt($d); ?>>      
    <div class="dinfo">

        <?php 
        el_flex($e['cfg_content'], array('class-items'=>'f-item'));
       
        ?>

    </div>        
</div>    

<?php div_end(); ?>

<style>
    .el-flex .wrap { padding: 60px 0; }
    .el-flex .f-item { margin-top: 20px; }
    .el-flex .f-item:first-child { margin-top: 0px; }
    .el-flex .dtext { margin-top: 30px; }
</style>

