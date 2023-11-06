<?php  
    global $tpath, $post_count;
    load_assets(array('select', 'element-ajax-css'));
    $layout = get_row_layout();
    $e = get_sub_field($layout);

    section_class("ajaxs-01", array('data'=>'data-axgrid'));
    div_start();

    //SETUP HERE:
    $ajx_ctr = "pp_3"; //unique ID
    $post_count = $e['post_count']; 
    /*
        $post_type = array('project','portfolio');
        $post_taxonomy = 'proj-cat';
    */
    $post_type = $e['post_type'];
    $post_taxonomy = $e['taxonomy'];

    $taxonomy_id = '';

    $ajxpost = array(   
        'posts_per_page' => $post_count,
        'post_type' => $post_type,
        'post_status' => 'publish'
    );    

    ## you must add filter functions 
    ## LINK functions-dev.php#scroll
?>
<div class="container-xl">

    <div class="tax-links">
        <?php 
            ajax_menu_links($post_taxonomy, $post_type, $ajx_ctr, $post_count);
            ajax_menu_links_mobile($post_taxonomy);
        ?>
        <div id="iloader"><div class="dots"></div></div>
    </div>

    <div class="ajax_grid row cpt-row" data-grid="ajax_<?php echo $ajx_ctr; ?>">

    <?php    
        $argss = $ajxpost;       

        $custom_query = new WP_Query( $argss );
        $bot = $custom_query->max_num_pages;
        $total = $custom_query->found_posts;
        
        if ( $custom_query->have_posts() ) : 
        while( $custom_query->have_posts() ) : $custom_query->the_post(); 
        
            global $post;
            /* also please check functions.php */
            $title = get_the_title($post->ID);
            $featured = tp_thumb($post->ID, array('echo'=>false));

            //$tax = tp_tax($post->ID, 'proj-cat', array('echo'=>false, 'div'=>'cat-links'));
            $tax = '';
            $href = 'href="' . get_the_permalink($post->ID) . '"';

            $data = '';
            ob_start();

            ?>
            
                <div class="col-lg-4">
                <div class="cpt">
                    <a class="cpt-link" <?= $href ?>>
                        <?= $featured ?>
                        <h5 class="cpt-title"> <?= $title ?></h5>
                    </a>
                    <?= $tax ?>
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

    <div id="seed" data-ctr="<?php echo $ajx_ctr; ?>"></div>

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

add_action('wp_footer', function() use ( $ajax_send ) { 
    ajax_scroll( $ajax_send ); 
});
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