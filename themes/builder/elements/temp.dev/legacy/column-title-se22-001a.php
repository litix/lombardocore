<?php 
    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    section_class('el-column tt');
    div_start();    

    $d = $e['display_fields'];
    $col = el_col($d['columns']);     
    $v = $d['version'];   

    $tx_1 = 1;
    $btn_1 = 0;
    $btn_2 = 1;

    $col_b = "col-md-12";
    $col_tt = "col-md-{$col[0]}";
    $col_tx = "col-md-{$col[2]}";   
    
    if($v == 'v3') {
        $col_tt = "col-md-4";
        $col_tx = "col-md-4";
        $btn_1 = 1;
        $btn_2 = 0;
        $text = bd_text($e['text_sub'], 'dtext', 0);
        $text_col = "<div class=\"col-md-4\">{$text}</div>";        
    }

    if($v == 'v2') {
        $tx_1 = 0;
        $text = bd_text($e['text'], 'dtext text_btm', 0);
        $text_col = "<div class=\"col-md-12\"><hr></div>
        <div class=\"col-md-12\">{$text}</div>";
    }
    
?>

<div class="container-xl">      
    <div class="row" <?php echo el_opt($d, 'row'); ?> <?php echo el_opt($d); ?>> 

        <div class="<?php echo $col_b; ?>">
            <?php bd_title($e['before_title'], "btitle", '', 1, 'btitle'); ?>
        </div>

        <div class="<?php echo $col_tt; ?>">
            <?php
                bd_title($e['title'], "dtitle", '', 1, 'mtitle' );
                bd_title($e['after_title'], "atitle", '', 1, 'atitle');
                cf_btnloop($e['button_loop'], 'btn-loop', $btn_1); 
            ?>    
        </div>

        <div class="<?php echo $col_tx; ?>">
            <?php 
                bd_text($e['text'], "dtext", $tx_1);    
                cf_btnloop($e['button_loop'], 'btn-loop', $btn_2); 
            ?>
        </div>

        <?php echo $text_col; ?>


    </div>

    <?php  ?>
</div>    

<?php div_end(); ?>

<style>
    .el-column .wrap { padding: 60px 0; }
    .el-column.tt .dtext { margin-top: 0px; }
    .el-column.tt .btitle { margin-bottom: 0; font-size: 20px; font-weight: bold; text-transform: inherit;  }
    .el-column.tt .dtitle { line-height: 130%; }
    .el-column.tt [data-tx="0"] .btn-loop { margin-top: 0; }
    .el-column.tt [data-ver="v2"] hr { border-color: var(--color1); margin-top: 40px; }
    .el-column.tt [data-ver="v2"] .btn-loop { text-align: right; margin-top: 0; }
    .el-column.tt .text_btm { margin-top: 20px; }
    
</style>

