<?php 
    global $spath, $owl;
    $owl++;

    load_assets(array('owl'));
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $opt = data_fields($e);

    $arr = $spath .'/images/icons/owl-arr.svg';

    section_class('qslider-01');
    div_start('dflex', array('data'=>data_set($opt)));     
?>

<div class="container-xl">

    <?php 
    $rp = $e['clients']; 
    if($rp): 
    ?>

    <div class="slide-bg is-inner">

        <div class="owl-<?php _e($owl); ?> owl-carousel">

        <?php 
            foreach($rp as $r): 
        ?>
                <div class="item">

                    <div class="col-info">
                    <?php 
                        el_text($r['text'], array('css'=>'ptext'));
                        el_text($r['editor']); 
                    ?>
                    </div>

                    <div class="dflex-center">

                        <div class="davatar round">
                            <?php el_bg($r['avatar'], array('class'=>'overlay')); ?>
                        </div>

                        <div class="meta">
                            <?php el_title($r['title'], array('css'=>'ititle')); ?>

                                <?php
                                    el_text($r['before_title'], array('class'=>'btitle posn'));
                                    el_text($r['after_title'], array('class'=>'btitle company'));               
                                ?>

                        </div>

                    </div>

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

</div>
<?php div_end(); ?>

<?php if(!is_admin()): ?>   
<script>
var $ = jQuery.noConflict();
$(function() {

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
        //autoplayHoverPause: false,
        //autoplayTimeout: 9000,
        margin: 0, 
        dots: false, 
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
    });

});    
</script>        
<?php endif; ?> 