<?php 
    global $post;
    get_header(); 
    get_builder_menu();

?>  
    
<main class="single-post page-inner">

<article class="element">

<div class="wrap">
    <div class="container-xl p-5">
        <h2>Taxonomy Page : <?php single_term_title(); ?></h2>        

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

            $tax_id = get_queried_object()->term_id;

            if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
            elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
            else { $paged = 1; }

                $custom_query_args = array(

                'post_type' => 'project',
                'posts_per_page' => 9,
                //'posts_per_page' => -1, //unlimited
                'paged' => $paged,
                'order' => 'ASC',
                'tax_query' =>  array(
                    array(
                        'taxonomy' => 'proj-cat',
                        'field' => 'term_id',
                        'terms' => $tax_id
                    )     
                )                
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
    </div>
</div>
</article>


</main>    
    
<?php get_footer(); ?>