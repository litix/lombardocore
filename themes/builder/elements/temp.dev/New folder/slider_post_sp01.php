<?php 
    global $tpath, $owl, $post;
    $owl++;

    load_assets(array('owl'));

    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    ## options
    $opt = $e['display_fields'];
    $col = $opt['col_count'];

    #sample of show/hide    
    $date = $opt['post_date'];
    $author = $opt['post_date'];
    $meta = ($date == 1 or $author == 1) ? "" : "dnone";

    ## icon
    $arrow = $tpath .'/images/icons/owl-arr-2.svg';
    
    section_class('el-slider-post slide-post-1 sp01 col-post');
    div_start('dblock', array('data'=>data_set($opt)));  
?>

<div class="container-xl">   

    <div class="dtop flexic">
        <div class="dinfo">
        <?php 
            $d = $e['extra']; 
            
            el_img($d['icon'], array('div'=>'diconn'));
            el_title($d['before_title'], array('css'=>'btitle'));
            el_title($d['mtitle'], array('class'=>'f40'));
            el_title($d['title'], array('css'=>'dtitle'));
            el_title($d['after_title'], array('css'=>'atitle'));
            el_text($d['editor']);
            el_text($d['text'], array('css'=>'ptext'));
        ?>
        </div>
        <div class="btn-loop">
            <?php el_btnloop($d['button_loop']); ?>
        </div>
    </div>

    <?php 

        $loop = $e['post_loop'];
        $select = $loop['post_display'];
        $count = $loop['post_count'];

        if(is_admin()) { $count = $col; }

        ## recent : rc
        if($select == 'rc') {
            $custom_query_args = array(
                'post_type' => 'post',
                'posts_per_page' => $count,            
                'orederby' => 'date',
                'order' => 'DESC'
            );
        
            $custom_query = new WP_Query( $custom_query_args );       
        }

        ## featured : fp
        if($select == 'fp') {
            $rp = $loop['posts'];
        }

        ## random : rd
        if($select == 'rd') {
            $custom_query_args = array(
                'post_type' => 'post',
                'posts_per_page' => -1,
                '_shuffle_and_pick' => $count
            );
        
            $custom_query = new \WP_Query( $custom_query_args );        
        }
    ?>

</div>     

<div class="slide-bg is-inner">
    <div class="container-xl">
    <div class="owl-<?php _e($owl); ?> owl-carousel">

        <!-- recent -->
        <?php 
        if($select == 'rc'): 
            while( $custom_query->have_posts() ) : $custom_query->the_post();
        ?>

            <div class="item">
                <a href="<?php the_permalink(); ?>" class="post-item">
                    <div class="post-info">
                        <?php 
                            tp_thumb($post->ID, array('class'=>'post-thumbnail', 'as'=>'bg'));
                            tp_cat($post->ID, array('div'=>'post-category', 'link'=>false, 'count'=>'1', 'post_text'=>'')); 
                        ?> 
                        <h4 class="post-title"><?php the_title(); ?></h4>
                        <?php tp_excerpt($post->ID, array('char'=>'110', 'div'=>'post-excerpt')); ?> 
                    </div>

                    <div class="meta <?php _e($meta); ?>">
                        <?php tp_meta($post->ID, array('meta'=>'date','div'=>'post-meta post-date')); ?>
                        <span class="s post-date">|</span> 
                        <?php tp_meta($post->ID, array('meta'=>'name','div'=>'post-meta post-author', 'text'=>'By ')); ?>
                    </div>

                </a>
            </div>           

        <?php 
            endwhile;
            wp_reset_postdata();
        endif;
        ?>

        <!-- featured -->
        <?php 
        if($select == 'fp' and $rp):
            $i = 0;
            foreach($rp as $id):
        ?>

            <div class="item">
                <a href="<?php the_permalink(); ?>" class="post-item">
                    <div class="post-info">
                        <?php 
                            tp_thumb($id, array('class'=>'post-thumbnail', 'as'=>'bg'));
                            tp_cat($id, array('div'=>'post-category', 'link'=>false, 'count'=>'1', 'post_text'=>'')); 
                        ?> 
                        <h4 class="post-title"><?php echo get_the_title($id); ?></h4>
                        <?php tp_excerpt($id, array('char'=>'110', 'div'=>'post-excerpt')); ?> 
                    </div>
                    <div class="meta">
                        <?php tp_meta($id, array('meta'=>'date','div'=>'post-meta post-date')); ?>
                        <span class="s post-date">|</span> 
                        <?php tp_meta($id, array('meta'=>'name','div'=>'post-meta post-author', 'text'=>'By ')); ?>
                    </div>
                </a>
            </div> 

        <?php
            $i++;
            if($i == $count) break;
            endforeach;
        endif;
        ?>

        <!-- random -->
        <?php 
        if($select == 'rd'): 
            while( $custom_query->have_posts() ) : $custom_query->the_post();
        ?>

            <div class="item">
                <a href="<?php the_permalink(); ?>" class="post-item">
                    <div class="post-info">
                        <?php 
                            tp_thumb($post->ID, array('class'=>'post-thumbnail', 'as'=>'bg'));
                            tp_cat($post->ID, array('div'=>'post-category', 'link'=>false, 'count'=>'1', 'post_text'=>'')); 
                        ?> 
                        <h4 class="post-title"><?php the_title(); ?></h4>
                        <?php tp_excerpt($post->ID, array('char'=>'110', 'div'=>'post-excerpt')); ?> 
                    </div>
                    <div class="meta">
                        <?php tp_meta($post->ID, array('meta'=>'date','div'=>'post-meta post-date')); ?>
                        <span class="s post-date">|</span> 
                        <?php tp_meta($post->ID, array('meta'=>'name','div'=>'post-meta post-author', 'text'=>'By ')); ?>
                    </div>
                </a>
            </div> 

        <?php 
            endwhile;
            wp_reset_postdata();
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
## Updated    : Apr 02 2023
## Element    : Icons I02
## Group      : Templates [OPT] [1]
## Version    : 0.2
?>