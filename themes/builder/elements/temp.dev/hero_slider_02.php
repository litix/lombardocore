<?php 
    global $spath, $owl;
    $owl++;

    load_assets(array('owl', 'wow'));
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $opt = data_fields($e);

    $arr = $spath .'/images/icons/owl-arr.svg';

    section_class('heroslider-02');
    div_start('dflex nowrap', array('data'=>data_set($opt), 'style'=>data_height($opt, 0)));  

    $rp = $e['slider']; 
?>

    <?php if($rp): ?>
    <div class="slide-bg">

        <div class="owl-<?php _e($owl); ?> owl-carousel">

        <?php 
            foreach($rp as $r): 
        ?>
                <div class="item iwrap">
                <?php el_media($r['media'], array('class'=>'overlay', 'as'=>'overlay')); ?>
                    <div class="overlay color"></div>
                    
                    <div class="container-xl">    
                        <div class="dinfo hero-opt">  
                            <?php 
                                el_img($r['icon'], array('div'=>'diconn'));
                                el_title($r['before_title'], array('css'=>'btitle'));
                                el_title($r['mtitle']);
                                el_title($r['title'], array('css'=>'ititle'));
                                el_title($r['after_title'], array('css'=>'atitle'));
                                el_text($r['editor']);
                                el_text($r['text'], array('css'=>'ptext'));
                                el_btnloop($r['button_loop']);
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