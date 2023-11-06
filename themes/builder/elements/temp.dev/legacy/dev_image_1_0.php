<?php 
    $layout = get_row_layout();
    $e = get_sub_field($layout);

    section_class('el-sample');
    div_start();
?>
<?php 
$yt = 'https://www.youtube.com/watch?v=sQI9Pylc2JY';    
$map = 'https://snazzymaps.com/embed/298578';
#bd_bgvideo($e['video'], 'top'); 
#bd_bgyoutube($yt);
?>
<div class="container-xl">
    <div class="row">
        <div class="col-md-6">
            <?php bd_img( $e['image'], '', 'dimage'); ?>
            <?php #bd_img_caption($e['image']); ?>
        </div>
        <div class="col-md-6"><?php bd_bgdiv( $e['image'], ''); ?></div>
    </div>
    <div class="row mt-5">
        <div class="col-md-6">
            <?php 
            //bd_youtube($yt); 
            #bd_video($e['video'], 'center'); ?>
        </div>
        <div class="col-md-6">
            <?php 
            #bd_bgyoutube($yt);
            #bd_youtube($yt, '', 'default'); 
            #bd_iframe($map);
            ?>
        </div>
    </div>
    <div class="mt-5">
    <?php bd_btn($e['link'], 'btn-d'); 
    bd_link($e['link']); 
        bd_href($e['link'], 'btn-d'); 
    bd_tag($e['text']); ?>        

    <a <?php cf_link($e['cfg_link'], 'smaple'); ?>>Test</a>
    
    </div>
</div>    
    
<?php div_end(); ?>

