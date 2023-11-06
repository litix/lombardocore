<?php  
    global $tpath, $owl;
    $owl++;

    load_assets(array('owl'));
    $layout = get_row_layout();
    $e = get_sub_field($layout);

    section_class("el-owl logos");
    div_start();

    $d = $e['display_fields'];    

    $arr = $tpath .'/images/icons/owl-arr-1.svg';
?>

<div class="container-xl">
    <?php 
        $rp = $e['logos']; 
        if($rp):
    ?>

    <div class="slide-bg">
        
        <div class="owl-<?php _e($owl); ?> owl-carousel">
        <?php 
            foreach( $rp as $r ): 
            $tag = bd_click($r['link'], 'dlogo');

            echo $tag[0];
                bd_img($r['logo']); 
            echo $tag[1];

            endforeach; 
        ?>
        </div>

        <button type="button" role="presentation"
                class="owlbtn owlprev prev-<?php _e($owl); ?>">
            <?php bd_img($arr); ?>
        </button>

        <button type="button" role="presentation" 
                class="owlbtn owlnext next-<?php _e($owl); ?>">
            <?php bd_img($arr); ?>
        </button>
    </div>

    <?php endif; ?> 
</div>    
    
<?php div_end(); ?>
<?php if(!is_admin()): ?>   
<script>
var $ = jQuery.noConflict();
$(function() {
    //https://owlcarousel2.github.io/OwlCarousel2/docs/api-options.html

    var owl_<?php _e($owl); ?> = $('.owl-<?php _e($owl); ?>');
    owl_<?php _e($owl); ?>.owlCarousel({
        loop: true,
        autoplay: true,        
        autoplayHoverPause: <?php owl($d, 'hoverpause'); ?>,
        autoplayTimeout: <?php owl($d, 'timeout'); ?>,
        margin: <?php owl($d, 'margin'); ?>, 
        dots: <?php owl($d, 'dots'); ?>, 
        navSpeed: <?php owl($d, 'speed'); ?>, 
        autoplaySpeed: <?php owl($d, 'speed'); ?>, 
        items: <?php owl($d, 'count'); ?>,        
        responsive:{
            300:{
                items:1
            },
            480:{
                items:1
            },
            700:{
                items:2
            },            
            900:{
                items:3
            },
            1200:{
                items: <?php owl($d, 'count'); ?>
            }            
        }      
    }); 

    $('.next-<?php _e($owl); ?>').click(function() {
        owl_<?php _e($owl); ?>.trigger('next.owl.carousel');
    })

    $('.prev-<?php _e($owl); ?>').click(function() {
        owl_<?php _e($owl); ?>.trigger('prev.owl.carousel');
    })      
});    
</script>        
<?php endif; ?> 

<style>
    .el-owl .slide-bg { position: relative; }
    .el-owl .wrap { padding: 40px 0; }
    .el-owl .dlogo { transition: 0.3s; }
    .el-owl .dlogo img { max-height: 40px; }
    .el-owl .dlogo:hover { filter: brightness(0.7); }
    .el-owl .owl-carousel button.owl-dot { background-color: #C2D1D9; }
    .el-owl .owl-carousel button.owl-dot.active { filter: brightness(0.7); }
    .el-owl .owl-dots { margin-top: 30px; }
    .el-owl .owlbtn { transition: 0.3s; }
    .el-owl .owlbtn:hover { filter: brightness(0.7); }
</style>