<?php 
    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    section_class('el-column');
    div_start();    

    $d = $e['display_fields'];
    $col = el_col($d['columns']);        
?>

<div class="container-xl" <?php echo el_opt($d); ?>>      
    <div class="row" <?php echo el_opt($d, 'row'); ?>>

    <div class="col-lg-<?php echo $col[0]; ?>">    
        <div class="dimage" data-img="single">
            <?php el_img($e['image']); ?>
        </div>
        <div class="dimage" data-img="multi">
            <?php bd_img_multi($e['images'], 's-img'); ?>
        </div>
    </div>    

    <div class="col-lg-<?php echo $col[2]; ?>">
        <div class="dinfo">
        <?php 
            el_title($e['before_title'], array('css'=>'btitle'));
            el_title($e['title']);
            el_title($e['after_title'], array('css'=>'atitle'));

            el_text($e['text']);

            el_btnloop($e['button_loop']);
        ?>    
        </div>        
    </div>        

    </div>
</div>    

<?php div_end(); ?>

<style>
    .el-column .wrap { padding: 60px 0; }
</style>