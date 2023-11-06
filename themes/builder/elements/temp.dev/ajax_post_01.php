<?php  
    global $tpath, $post_count;
    load_assets(array('select', 'element-ajax-css', 'css-blog', 'height'));
    $layout = get_row_layout();
    $e = get_sub_field($layout);

    section_class("ajaxp-01", array('data'=>'data-axpost'));
    div_start();

    $ajx_ctr = 'pp_2'; //unique ID
    $post_count = $e['post_count']; 
    $post_type = array('post');
    $post_taxonomy = 'post';
    $taxonomy_id = '';

    $ajxpost = array(   
        'posts_per_page' => $post_count,
        'post_status' => 'publish',
        'post_type' => $post_type,
    );    

    ## you must add filter functions 
    ## LINK functions-dev.php#post
?>
<div class="container-xl">

    <div class="tax-links cat-links">
    <?php 
        ajax_menu_links($post_taxonomy, $post_type, $ajx_ctr, $post_count); 
        ajax_menu_links_mobile($post_taxonomy);
    ?>
    <div id="iloader"><div class="dots"></div></div>
    </div><!-- blog link -->

    <div class="ajax_grid row proj-row" data-grid="ajax_<?php echo $ajx_ctr; ?>" data-design="grid-1.0">
    <?php    

        $argss = $ajxpost;
        
        $custom_query = new WP_Query( $argss );
        $bot = $custom_query->max_num_pages;
        $total = $custom_query->found_posts;
    
        if ( $custom_query->have_posts() ) : 
        while( $custom_query->have_posts() ) : $custom_query->the_post(); 
        
            global $post;
            $title = get_the_title($post->ID);
            $title = el_tag($title, array('div'=>'post-title ititle same-h', 'tag'=>'h5', 'class'=>'title', 'echo'=>false));            
            $href = 'href="' . get_the_permalink($post->ID) . '"';
            
            $featured = tp_thumb($post->ID, array('div'=>'post-thumb', 'as'=>'bg', 'echo'=>false));
            $date = tp_meta($post->ID, array('meta'=>'date','div'=>'post-meta', 'echo'=>false));
            $excerpt = tp_excerpt($post->ID, array('char'=>'110', 'div'=>'post-excerpt match-h', 'echo'=>false));
            $meta = tp_cat($post->ID, array('div'=>'post-meta', 'post_text'=>'Category : ', 'echo'=>false));

            $data = '';
            ob_start();

            ?>

            <div class="col-lg-4">
                <div class="box b">
                    <a class="post-link" <?= $href ?>>
                        <?= $featured ?>
                        <?= $date ?>
                        <?= $title ?></h5>
                        <?= $excerpt ?>
                    </a>
                    <div class="div-meta">
                        <?= $meta ?>
                    </div>
                </div>
            </div>            
            
            <?php

            $data = ob_get_clean();
            echo $data;

        endwhile;
        endif;

        wp_reset_postdata(); 
        wp_reset_query(); 
           
    ?>        
    </div>

    <?php 
    if($total > $post_count): ?>
    <div class="text-center ajx_btn">
        <a class="ajax_post btn btn-1" data-ctr="<?php echo $ajx_ctr; ?>">
            <span>Load More</span>
        </a>      
    </div>
    <?php endif; ?>   
        

</div>                
<?php div_end(); ?>

<?php
//SEND DATA TO AJAX LOADER
$ajax_send = array(
    "type"   => $post_type, 
    "count"  => $post_count,
    "query"  => $ajxpost, 
    "ctr"    => $ajx_ctr, 
    "tax_id" => $taxonomy_id,
    "tax_name" => $post_taxonomy,
);    

add_action('wp_footer', function() use ( $ajax_send ) { ajax_load( $ajax_send ); });
?>

<script>
    var $ = jQuery.noConflict();
    $(function () {
        $('.tax-links .custom-option').click(function(e) {
            var clickID = $(this).data("id");
            var ctr = '<?php echo $ajx_ctr; ?>';
            $('.ajax_category[data-id="' + clickID + '"][data-ctr="' + ctr + '"]').click();            
        });    
    });    
</script>

<?php 
## Updated    : Mar 21 2023
## Element    : Ajax Post AP01
## Version    : 0.1
## Group      : Templates [JS] [1]
## Dependency : functions.php
?>