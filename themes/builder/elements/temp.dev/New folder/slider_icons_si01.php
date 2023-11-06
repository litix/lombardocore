<?php 
    global $tpath, $owl;
    $owl++;

    load_assets(array('owl'));
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $arrow = $tpath .'/images/icons/owl-arr-2.svg';

    ## options
    $opt = $e['display_fields'];
    $col = $opt['col_count']; 

    section_class('el-slider-icons slide-icons-1 si01 col-icon');
    div_start('dblock', array('data'=>data_set($opt)));
?>

<div class="slide-bg is-inner">
    <div class="container-xl">
    <div class="owl-<?php _e($owl); ?> owl-carousel">

    <?php 
    $rp = $e['icons'];

    if($rp):
        $i = 0;
        foreach($rp as $r):
            $tag = el_notlink($r['button']); //set <a> or <div>
    ?>

        <?php _e($tag[0]); ?>

            <div class="diconn">
                <?php el_img($r['iconn']); ?>
            </div>

            <?php 
                el_title($r['before_title'], array('css'=>'btitle'));
                el_title($r['mtitle'], array('class'=>'f21'));
                if(!$r['mtitle'])
                    el_title($r['title'], array('css'=>'ititle'));
                el_title($r['after_title'], array('css'=>'atitle'));
                el_text($r['editor']);
                el_text($r['text'], array('css'=>'ptext'));
                el_static_btn($r['button'], array('as'=>'div', 'div'=>'abtn-loop'));                 
            ?>   

        <?php _e($tag[1]); ?>       

    <?php 
        $i++;
        if($i >= $col) break;
        endforeach;
    endif;
    ?>

    </div> <!-- owl -->
    </div> <!-- container -->

    <button type="button" 
        class="owlbtn owlprev prev-<?php _e($owl); ?>">
        <?php el_img($arrow, array('lazy'=>false)); ?>
    </button>

    <button type="button" 
        class="owlbtn owlnext next-<?php _e($owl); ?>">
        <?php el_img($arrow, array('lazy'=>false)); ?>
    </button>     

</div> 

<?php div_end(); ?>

<?php if(!is_admin()): ?>   
<script>
var $ = jQuery.noConflict();
$(function() {

    var owl_<?php _e($owl); ?> = $('.owl-<?php _e($owl); ?>');
    owl_<?php _e($owl); ?>.owlCarousel({
        //animateOut: 'fadeOut',
        //animateIn: 'fadeIn',
        loop: true,
        lazyLoad:true,
        //autoHeight: false,
        autoplay: false,        
        //autoplayHoverPause: false,
        //autoplayTimeout: 9000,
        margin: 30, 
        dots: false, 
        navSpeed: 500, 
        autoplaySpeed: 500, 
        responsive:{
            0:{
                items:1
            },
            900:{
                items:2
            },
            1200:{
                items:<?php _e($col); ?>
            },            
        }
    }); 

    $('.next-<?php _e($owl); ?>').click(function() {
        owl_<?php _e($owl); ?>.trigger('next.owl.carousel');
    })

    $('.prev-<?php _e($owl); ?>').click(function() {
        owl_<?php _e($owl); ?>.trigger('prev.owl.carousel');
    })       

    /*
    owl_<?php _e($owl); ?>.on('changed.owl.carousel', function(event) {   
        owl_<?php _e($owl); ?>.trigger('stop.owl.autoplay');
        owl_<?php _e($owl); ?>.trigger('play.owl.autoplay');
    });
    */
   

});    
</script>  
<?php endif; ?> 

<?php 
## Updated    : Apr 14 2023
## Element    : Icons I01
## Group      : Templates [OPT] [1]
## Version    : 0.2
?>