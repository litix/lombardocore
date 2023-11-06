<?php  
    global $spath, $owl;
    $owl++;

    load_assets(array('owl'));
    $layout = get_row_layout();    
    $e = get_sub_field($layout);

    $opt = data_fields($e);

    $arr = $spath .'/images/icons/owl-arr.svg';
  
    section_class("slidergallery-01");
    div_start('dflex', array('data'=>data_set($opt)));  
 
    $rp = $e['slider']; 
    $count = $opt['count']; 
    $i = 1;
?>

<?php if($rp): ?>
<div class="container-xl">      
<div class="row">
    <div class="col-info">    

    <div class="slide-bg" <?php data_height($opt, 1, 'h'); ?>>
        <div class="owl-<?php _e($owl); ?> owl-carousel">

            <?php foreach($rp as $r):  ?>
            
            <div class="item">
                <?php el_bg($r, array('class'=>'overlay', 'lazy'=>false)); ?>
            </div>

            <?php
                
                if(is_admin()):
                    if($i >= $opt['count'])
                        break; 
                endif;    

                $i++;
                endforeach; 
            ?>

        </div>
        
        <?php 
        if($rp):
            if(count($rp) > 1):
        ?>
            <button type="button" 
                    class="owlbtn btn-round owlprev prev-<?php _e($owl); ?>">
                <?php el_img($arr, array('lazy'=>false)); ?>
            </button>

            <button type="button" 
                    class="owlbtn btn-round owlnext next-<?php _e($owl); ?>">
                <?php el_img($arr, array('lazy'=>false)); ?>
            </button>
        <?php 
            endif;
        endif;
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

    var owl_<?php _e($owl); ?> = $('.owl-<?php _e($owl); ?>');
    owl_<?php _e($owl); ?>.owlCarousel({
        /*
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        */
        loop: true,
        autoplay: <?php _e($opt['autoplay']); ?>,        
        autoHeight: false,
        lazyLoad:true,
        autoplayHoverPause: false,
        autoplayTimeout: 7000,
        margin: <?php _e($opt['gap']); ?>, 
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
                items:<?php _e($count); ?>
            },            
        }     
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