<?php 
    load_assets(array('jarallax'));
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $opt = data_fields($e);

    section_class('jarallax-01', array('data-theme'=>'dark'));
    div_start('dflex', array('data'=>data_set($opt), 'style'=>data_height($opt, 0)));

    $video = $e['media']['video'];
    $url = media_src($video);
?>

<div class="custom-h jar">
    <?php if(!is_admin()) : ?>
        <div class="jarallax hide-sm" 
            data-speed="0.3" data-video-src="mp4:<?php echo $url; ?>">
        </div>    
        <?php 
            ##NOTE ~ mobile version
            el_media($e['media'], array('autoplay'=>'autoplay', 'controls'=>'0', 'class'=>'show-sm')); 
        ?>
    <?php else: ?>
        <?php el_media($e['media'], array('autoplay'=>0, 'controls'=>'0', 'class'=>'')); ?>
    <?php endif; ?>
</div>

<div class="overlay color"></div>

<div class="container-xl">    
    <div class="dinfo hero-opt">  
        <?php 
            el_img($e['icon'], array('div'=>'diconn'));
            el_title($e['before_title'], array('css'=>'btitle'));
            el_title($e['mtitle']);
            el_title($e['title'], array('css'=>'dtitle'));
            el_title($e['after_title'], array('css'=>'atitle'));
            el_text($e['editor']);
            el_text($e['text'], array('css'=>'ptext'));
            el_btnloop($e['button_loop']);
        ?>    
    </div>
</div>    

<?php div_end(); ?>

<?php if(!is_admin()): ?>   
<script>
var $ = jQuery.noConflict();
$(function() {

    jarallax(document.querySelectorAll(".jarallax"));

});    
</script>        
<?php endif; ?> 