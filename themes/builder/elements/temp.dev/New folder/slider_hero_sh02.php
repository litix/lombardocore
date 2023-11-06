<?php  
    global $tpath, $owl;
    $owl++;

    load_assets(array('owl', 'wow'));
    $layout = get_row_layout();    
    $e = get_sub_field($layout);

    ## options
    $opt = $e['display_fields'];
    $c = $opt['col_size'];

    $arr = $tpath .'/images/icons/owl-arr-2.svg';
    //$plane = $tpath .'/images/bg/plane.svg';
    //$tracks = $tpath .'/images/bg/track.png';    
   
    section_class("el-slider sh sh02");
    div_start('dflex nowrap', array('data'=>data_set($opt)));  
 
    $rp = $e['slider']; 
?>

<?php if($rp): ?>
<div class="slide-bg">

    <div class="owl-<?php _e($owl); ?> owl-carousel">

    <?php 
        foreach($rp as $r): 
    ?>
            <div class="item">
                
                <?php el_media($r['media'], array('class'=>'overlay', 'as'=>'overlay')); ?>
                <div class="overlay color"></div>

            </div>
    <?php 
            if(is_admin()) { break; }
        endforeach; 
    ?>

    </div>
    
    <?php 
    if($rp):
        if(count($rp) > 1):
    ?>
        <button type="button" 
                class="owlbtn owlprev prev-<?php _e($owl); ?>">
            <?php el_img($arr, array('lazy'=>false)); ?>
        </button>

        <button type="button" 
                class="owlbtn owlnext next-<?php _e($owl); ?>">
            <?php el_img($arr, array('lazy'=>false)); ?>
        </button>
    <?php 
        endif;
    endif;
    ?>

</div>   

<div class="overlay dinfo">
<div class="container-xl">
    <div class="row">
        <div class="col-md-<?php _e($c); ?>">
        <?php 
            el_img($e['icon'], array('div'=>'diconn'));
            el_title($e['before_title'], array('css'=>'btitle'));
            el_title($e['mtitle'], array('class'=>'f60'));
            el_title($e['mtitle'], array('class'=>'f60', 'css'=>'dtitle'));
            el_title($e['after_title'], array('css'=>'atitle'));
            el_text($e['editor']);
            el_text($e['text'], array('css'=>'ptext'));
            el_btnloop($e['button_loop']);
        ?>  
        </div>
    </div>
</div>
</div>
<?php endif; ?>    
     

<?php div_end(); ?>

<?php if(!is_admin()): ?>   
<script>
var $ = jQuery.noConflict();
$(function() {

    new WOW().init();

    var owl_<?php _e($owl); ?> = $('.owl-<?php _e($owl); ?>');
    owl_<?php _e($owl); ?>.owlCarousel({
        /*
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        */
        loop: true,
        autoplay: false,        
        autoHeight: false,
        lazyLoad:true,
        autoplayHoverPause: false,
        autoplayTimeout: 9000,
        margin: 0, 
        dots: true, 
        navSpeed: 500, 
        autoplaySpeed: 500, 
        items: 1,       
    }); 

    $('.next-<?php _e($owl); ?>').click(function() {
        owl_<?php _e($owl); ?>.trigger('next.owl.carousel');
    })

    $('.prev-<?php _e($owl); ?>').click(function() {
        owl_<?php _e($owl); ?>.trigger('prev.owl.carousel');
    })       

    owl_<?php _e($owl); ?>.on('changed.owl.carousel', function(event) {   
        owl_<?php _e($owl); ?>.trigger('stop.owl.autoplay');
        owl_<?php _e($owl); ?>.trigger('play.owl.autoplay');
        new WOW().init();
    });

});    
</script>        
<?php endif; ?> 

<?php 
## Updated    : Apr 11 2023
## Element    : Slider Hero SH01
## Group      : Templates [JS 01]
## Version    : 0.1
?>