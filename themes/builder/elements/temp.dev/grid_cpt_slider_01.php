<?php 
    global $post, $spath, $owl;
    $owl++;
    
    load_assets(array('owl', 'height'));

    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    ## options
    $opt = data_fields($e);
    $col = $opt['col_count'];
    
    $arrow = $spath .'/images/icons/owl-arr.svg';
   
    section_class('slidercpt-01');
    div_start('dflex', array('data'=>data_set($opt)));  

    $loop = $e['post_loop'];
    $select = $loop['post_display'];
    $post_type = $loop['post_type'];
    $count = $loop['post_count'];  
?>
<div class="w-100">

<div class="container-xl">   
    <div class="dinfo dflex-between">
        <div>
        <?php 
            $d = $e['extra']; 
            
            el_img($d['icon'], array('div'=>'diconn'));
            el_title($d['before_title'], array('css'=>'btitle'));
            el_title($d['mtitle']);
            el_title($d['title'], array('css'=>'dtitle'));
            el_title($d['after_title'], array('css'=>'atitle'));
            el_text($d['editor']);
            el_text($d['text'], array('css'=>'ptext'));
        ?>
        </div>
        <?php el_btnloop($d['button_loop']); ?>
    </div>
</div>    


<div class="slide-bg is-grid">        
    <div class="owl-<?php _e($owl); ?> owl-carousel">

        <?php 

        ## *NOTE - RECENT 

        if($select == 'rc'):

            $array = array(
                        'post_type'=>$post_type,
                        'type'=>'recent', 
                        'col'=>$col,
                        'count'=>$count,
                        'div'=>"item same-h"
                    );

            el_loop('', $array);

        endif;


        ## *NOTE - FEATURED 

        if($select == 'fp'):

            $array = array(
                        'post_type'=>$post_type,                
                        'type'=>'relationship', 
                        'col'=>$col,
                        'count'=>$count,
                        'div'=>"item same-h"                        
                    );
            
            el_loop($loop['posts'], $array);

        endif;


        ## *NOTE - FEATURED

        if($select == 'rd'):
            
            $array = array(
                        'post_type'=>$post_type,                
                        'type'=>'random', 
                        'col'=>$col,
                        'count'=>$count,
                        'div'=>"item same-h"                        
                    );
            
            el_loop('', $array);

        endif;

        ?>

    </div>

        <button type="button" 
            class="owlbtn owlprev prev-<?php _e($owl); ?>">
            <?php el_img($arrow, array('lazy'=>false)); ?>
        </button>

        <button type="button" 
            class="owlbtn owlnext next-<?php _e($owl); ?>">
            <?php el_img($arrow, array('lazy'=>false)); ?>
        </button>             

    </div>
 
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
        lazyLoad:false,
        //autoHeight: false,
        autoplay: true,        
        autoplayHoverPause: false,
        autoplayTimeout: 5000,
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
    
    owl_<?php _e($owl); ?>.on('changed.owl.carousel', function(event) {   
        LL.update();
    });  

});    
</script>  
<?php endif; ?> 