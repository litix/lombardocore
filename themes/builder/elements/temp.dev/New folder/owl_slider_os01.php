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
    
    section_class('el-owl os01');
    div_start('dflex', array('data'=>data_set($opt)));

    ## repeater
    $rp = $e['slides'];
?>

<div class="container-xl">     

    <?php if($rp): ?>
    <div class="slide-bg">    

        <div class="owl-<?php _e($owl); ?> owl-carousel">

            <?php    
                foreach($rp as $r):
                    $tag = el_notlink($r['button']);
            ?>

            <?php _e($tag[0]); ?>
                <?php el_bgoverlay($r['image']); ?>
                <div class="overlay color"></div>

                <!-- ver 1 -->
                <div class="pad">
                    <div class="dhead v1">
                        <?php 
                            el_img($r['icon'], array('div'=>'diconn'));
                            el_title($r['before_title'], array('css'=>'tt btitle'));
                            el_title($r['mtitle'], array('class'=>'tt f26 font1'));
                            if(!$r['mtitle'])
                                el_title($r['title'], array('css'=>'tt ititle', 'class'=>'f26 font1'));
                            el_title($r['after_title'], array('css'=>'tt atitle'));
                        ?>
                    </div>
                    <div class="dhead v2">
                        <?php 
                            el_img($r['icon'], array('div'=>'diconn'));
                            el_title($r['before_title'], array('css'=>'tt btitle'));
                            el_title($r['mtitle'], array('class'=>'tt f26 font1'));
                            if(!$r['mtitle'])
                                el_title($r['title'], array('css'=>'tt ititle', 'class'=>'f26 font1'));
                            el_title($r['after_title'], array('css'=>'tt atitle'));
                        ?>
                    </div>
                    <div class="dinfo">
                        <?php
                            el_text($r['editor']);
                            el_text($r['text'], array('css'=>'ptext'));
                            el_static_btn($r['button'], array('as'=>'div', 'div'=>'abtn-loop')); 
                        ?>   
                    </div>
                </div> 

            
            <?php _e($tag[1]); ?>

            <?php 
                endforeach; 
            ?>
        
        </div>

        <button type="button" 
            class="owlbtn btn-round owlprev prev-<?php _e($owl); ?>">
            <?php el_img($arrow, array('lazy'=>false)); ?>
        </button>

        <button type="button" 
            class="owlbtn btn-round owlnext next-<?php _e($owl); ?>">
            <?php el_img($arrow, array('lazy'=>false)); ?>
        </button>

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
        //animateOut: 'fadeOut',
        //animateIn: 'fadeIn',
        loop: true,
        lazyLoad:true,
        //autoHeight: false,
        autoplay: false,        
        //autoplayHoverPause: false,
        //autoplayTimeout: 9000,
        margin: 40, 
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
## Updated    : Apr 02 2023
## Element    : Owl Slider OS01
## Group      : Templates [OPT] [1]
## Version    : 0.1
?>