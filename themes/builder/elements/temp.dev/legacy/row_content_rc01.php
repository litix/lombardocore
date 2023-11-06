<?php 
    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);



    $opt = $e['display_fields'];
    $col = $opt['columns'];

    section_class('el-column rc01');
    div_start('dflex', array('data'=>data_set($opt)));

?>
<div class="container-xl">      
    <div class="row">

        <?php if($e['media']): ?>
        <div class="col-lg-<?php echo $col[0]; ?> cc">    
            <div class="dimage" data-img="single">
                <?php el_media($e['media']); ?>
            </div>
        </div>    
        <?php endif; ?>
    
        <div class="col-lg-<?php echo $col[2]; ?> cc">
            <div class="dinfo">
            <?php 
                el_img($e['icon'], array('div'=>'diconn'));
                el_title($e['before_title'], array('css'=>'btitle'));
                el_title($e['mtitle'], array('class'=>'f40'));
                el_title($e['title'], array('class'=>'f40', 'css'=>'dtitle'));
                el_title($e['after_title'], array('css'=>'atitle'));
                el_text($e['editor']);
                el_text($e['text'], array('css'=>'ptext'));
                el_btnloop($e['button_loop']);
            ?>    
            </div>        
        </div>        
    
    </div>
</div>    


<?php div_end(); ?>

<?php 
## Updated    : Apr 15 2023
## Element    : Row Content RC01
## Group      : Templates [OPT] [1]
## Version    : 0.2
?>
