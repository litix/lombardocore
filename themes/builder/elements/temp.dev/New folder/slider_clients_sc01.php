<?php  
    global $tpath, $owl;
    $owl++;

    load_assets(array('owl', 'wow'));
    $layout = get_row_layout();    
    $e = get_sub_field($layout);

    ## options
    $opt = $e['display_fields'];

    $arr = $tpath .'/images/icons/owl-arr-2.svg';
  
    section_class("el-slider sc01");
    div_start('dflex', array('data'=>data_set($opt)));  
 
    $rp = $e['clients']; 
?>

<?php if($rp): ?>
   
<div class="slide-bg is-inner">
    <div class="owl-<?php _e($owl); ?> owl-carousel">

        <?php 
            foreach($rp as $r): 
                $name = $r['name'];
        ?>
                <div class="item">
                    <div class="container-xl"> 

                        <?php 
                            el_text($r['editor'], array('class'=>'f26 itext')); 
                            el_text($r['quote'], array('class'=>'f26 ptext')); 
                        ?>

                            <div class="client-info flexic">
                                <div class="dinfo">
                                    <?php 
                                        el_bg($r['avatar'], array('class'=>'avatar','div'=>'round davatar')); 
                                        el_text($name, array('class'=>'client-name'));
                                        el_text($r['position'], array('class'=>'client-position'));
                                    ?>
                                </div>
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
        autoplay: false,        
        autoHeight: false,
        lazyLoad:true,
        autoplayHoverPause: false,
        autoplayTimeout: 9000,
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