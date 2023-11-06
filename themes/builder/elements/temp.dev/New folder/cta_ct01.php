<?php 
    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);



    $opt = $e['display_fields'];

    section_class('el-cta ca01');
    div_start('dflex', array('data'=>data_set($opt)));

    el_media($media, array('as'=>'bg'));
?>
<div class="container-xl">      
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


<?php div_end(); ?>

<?php 
## Updated    : Apr 15 2023
## Element    : Row Content RC01
## Group      : Templates [OPT] [1]
## Version    : 0.2
?>
