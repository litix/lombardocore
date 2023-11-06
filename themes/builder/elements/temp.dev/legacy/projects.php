<?php 
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    load_assets(array('bootstrap'));

    section_class('el-projects');
    div_start();
?>

<div class="container-xl">      
    <div class="row">
    <div class="col-lg-6">
    <?php 
        $i=0;
        $rp = $e['links'];
        foreach( $rp as $r ) :    
        $child = $r['child'];    
        if($child == true) {
            $class = 'ml-5';
            
        } else {
            $class = '';
            
        }
        if($i == 0) {
            $a = 'true';
        } else {
            $a = 'false';
        }        
    ?>
        <a class="<?php echo $class; ?>" 
        data-toggle="collapse"
        data-target="#tab-<?php echo $i;?>" aria-expanded="<?php echo $a; ?>"
        href="#tab-<?php echo $i;?>">
            <?php echo $r['link']; ?><br>
        </a>    
    <?php 
        $i++;
        endforeach; ?> 
    </div>    
    <div class="col-lg-6">    
    <div class="tabs" id="tabb-1">
    <?php 
        $i=0;
        $rp = $e['links'];
        foreach( $rp as $r ) :    
        if($i == 0) {
            $class2 = 'show';
        } else {
            $class2 = '';
        }
    ?>
        <div id="tab-<?php echo $i; ?>" data-parent="#tabb-1" class="content collapse <?php echo $class2; ?>">
            <span class="mt-5"><?php echo $r['link']; ?></span><br>
            <?php echo $r['text']; ?><br>
        </div>
    <?php 
        $i++;
        endforeach; ?> 
    </div>        
    </div>        
    </div>

    <?php /*
    <h2>Projects Page : Portfolio Page</h2>
    <div class="row">
        <div class="col-lg-4">
            <h3>Taxonomies</h3>
            <?php
                $args = array(
                'hierarchical' => 1,
                'show_option_none' => '',
                'hide_empty' => 0,
                //'parent' => $texonomy->term_id,
                'taxonomy' => 'proj-cat'
                );
                $taxs = get_categories($args);
                foreach ($taxs as $tax):
            ?>

                <a href="<?php echo get_term_link( $tax->slug, $tax->taxonomy );?>">
                <?php echo $tax->name;?>
                </a><br>

            <?php
                endforeach;
            ?>             
        </div>
        <div class="col-lg-8">
            <h3>Loop</h3>

            <?php
            if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
            elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
            else { $paged = 1; }

                $custom_query_args = array(
                'post_type' => 'project',
                'posts_per_page' => 9,
                //'posts_per_page' => -1, //unlimited
                'paged' => $paged,
                'order' => 'ASC'
                );

                $custom_query = new WP_Query( $custom_query_args );
                
                if ( $custom_query->have_posts() ) : 
            ?>
                
            <?php while( $custom_query->have_posts() ) : $custom_query->the_post(); ?>

            <?php echo get_the_title(); ?>
            <?php echo get_the_excerpt(); ?>
                
            <?php endwhile; ?>

            <?php
                if ($custom_query->max_num_pages > 1) :
                    $orig_query = $wp_query;
                    $wp_query = $custom_query;
            ?>

                <div class="post-pagination  clearfix">
                    <?php pp_pagination_nav(); ?>
                </div>   
                
            <?php
                endif; //close acf
                endif; //close query loop
            ?>
                
            <?php wp_reset_postdata(); ?>            
        </div>
    </div>
    */ ?>
</div>    

<?php div_end(); ?>
<style>
    .el-projects { background-color: #F5f5f5; }
</style>


