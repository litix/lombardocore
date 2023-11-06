<?php 
    global $ax;
    $ax++;

    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $opt = data_fields($e);
    $col = data_colcount($e);
    
    section_class('axlessd-01');
    div_start('dflex', array('data'=>data_set($opt)));   

    $count = $opt['post_count'];

    $max_count = -1;
    $class = 'hide-me';

    if(is_admin()):
        $class = '';
        $max_count = $count;
    endif;   
?>

<div class="container-xl">

    <div class="dinfo">
    <?php 
        el_title($e['before_title'], array('css'=>'btitle'));
        el_title($e['mtitle'], array('css'=>'ititle'));
        if(!$e['mtitle'])
            el_title($e['title'], array('css'=>'ititle'));
        el_title($e['after_title'], array('css'=>'atitle'));
        el_text($e['editor']);
        el_text($e['text'], array('css'=>'ptext'));
    ?>          
    </div>

    <div class="row">
        <?php 
            $custom_query_args = array(
                'post_type' => $e['post_type'],
                'posts_per_page' => $max_count,            
                'orederby' => 'date',
                'order' => 'DESC'
            );
        
            $custom_query = new WP_Query( $custom_query_args );             

            if($custom_query):
            while( $custom_query->have_posts() ) : $custom_query->the_post();
            global $post;
            $id = $post->ID;        
            $title = get_the_title($id);
        ?>  

            <div class="col-md-<?php _e($col); ?> ax-<?= $ax ?> <?= $class ?>">
                <div class="cpt">
                    <a class="cpt-link" href="<?php echo get_the_permalink($id); ?>">
                        <?php tp_thumb($post->ID); ?>
                        <?php el_title($title, array('css'=>'ititle')); ?>
                    </a>
                </div>
            </div>

        <?php 
            endwhile;
            wp_reset_postdata();
            endif
        ?>
    </div>

    <div class="text-center">
        <a class="a-btn btn-2 mt-5" id="loadmore-<?= $ax ?>">
            <span>Loadmore</span>
        </a>
    </div>

</div>    

<?php div_end(); ?>

<?php if(!is_admin()): ?>   
<script>

<?php 
    /* NOTE : change this */
    $item = ".ax-{$ax}"; 
?>    

var $ = jQuery.noConflict();
$(function() {

    var item = $('<?= $item; ?>');
    size_<?= $ax; ?> = item.size();
	
    x_<?= $ax; ?> = <?= $count; ?>;
    adder_<?= $ax; ?> = <?= $count; ?>;

    $('<?= $item; ?>:lt(<?= $count; ?>)').show();
	
    $('#loadmore-<?= $ax ?>').click(function () {
        
        x_<?= $ax; ?> = (x_<?= $ax; ?>+adder_<?= $ax; ?> <= size_<?= $ax; ?>) ? x_<?= $ax; ?>+adder_<?= $ax; ?> : size_<?= $ax; ?>;
		
        $('<?= $item; ?>:lt('+x_<?= $ax; ?>+')').show();
		
        if(x_<?= $ax; ?> >= size_<?= $ax; ?>) { 
			$('#loadmore-<?= $ax ?>').hide(); 
		}

    });  
    

});   
</script>         
<?php endif; ?>