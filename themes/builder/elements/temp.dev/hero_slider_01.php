<?php 
    global $spath, $owl;
    $owl++;

    load_assets(array('owl', 'wow'));
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $opt = data_fields($e);

    $arr = $spath .'/images/icons/owl-arr.svg';

    section_class('heroslider-01');
    div_start('dflex nowrap', array('data'=>data_set($opt), 'style'=>data_height($opt, 0)));  

    $rp = $e['gallery']; 
?>

    <?php if($rp): ?>
    <div class="slide-bg">

        <div class="owl-<?php _e($owl); ?> owl-carousel">

        <?php 
            foreach($rp as $r): 
        ?>
                <div class="item">
                    <?php el_bg($r, array('div'=>'item', 'class'=>'overlay')); ?>
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
    <?php endif; ?>

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

    new WOW().init();

    var owl_<?php _e($owl); ?> = $('.owl-<?php _e($owl); ?>');
    owl_<?php _e($owl); ?>.owlCarousel({
        /*
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        */
        loop: true,
        autoplay: true,        
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