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
        test
    </div>    

    <div class="col-lg-<?php echo $col[2]; ?>">
        <div class="dinfo">
        <?php 
            bd_title($e['before_title'], 'btitle', '', 1, 'btitle');
            bd_title($e['title'], 'dtitle', '', 1, 'mtitle' );
            bd_title($e['after_title'], 'atitle', '', 1, 'atitle');           
            bd_text($e['text'], 'dtext', 1);
            cf_btnloop($e['button_loop'], 'btn-loop', 1);
        ?>    
        </div>        
    </div>        

    </div>
</div>    

<?php div_end(); ?>

<style>
    .el-column .wrap { padding: 60px 0; }
</style>