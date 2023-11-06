
<?php  
    load_assets(array());
    $layout = get_row_layout();    
    $e = get_sub_field($layout);

    section_class('el-flex el-title ft01');
    div_start(); 

    $opt = $e['display_fields'];
?>

<div class="container-xl">
    <?php el_flex($e['cfg_content'], array('class'=>'ff-info')) ?>
</div>    

<?php div_end(); ?>

<?php 
## Updated    : Mar 22 2023
## Element    : FF Title FT01
## Group      : Templates [FFX] [1]
## Version    : 0.1
?>