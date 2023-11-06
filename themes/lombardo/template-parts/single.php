<?php 
   ## LINK assets/theme/css-blog.css
   load_assets(array('css-blog', 'height'));

?>

<section class="element archive-title top-title">
    <div class="container">
        <div class="post-meta">
            <?php tp_meta($post->ID, array('meta'=>'name', 'text'=>'By : ', 'div'=>'post-author')); ?>
        </div>
        <h1 class="dtitle font-1"><?php the_title(); ?></h1>
    </div>
</section>

<article class="single-post" data-design="single-1.0">
<?php while ( have_posts() ) : the_post(); the_row(); ?> 

<div class="wrap"> 
<div class="container">
    <div class="row">

    <div class="col-lg-9">

        <div class="post-content">

            <!-- featured image / date -->
            <div class="post-thumb">
                <?php 
                    tp_thumb($post->ID); 
                    tp_meta($post->ID, array('meta'=>'date', 'div'=>'post-date'));
                ?>
            </div>

            <!-- content -->
            <div class="post-text" data-article>
                <?php the_content(); ?>
            </div>

            <!-- return -->
            <div class="div-back">
                <a class="link-back" onclick="history.back()">Back</a>
            </div>

            <!-- categories / tags -->
            <div class="div-meta">
                <?php 
                    tp_cat($post->ID, array('div'=>'post-cats')); 
                    tp_tags($post->ID, array('div'=>'post-tags'));
                ?>                
            </div>

            <!-- prev / next -->
            <?php tp_prevnext($post->ID, array('div'=>'div-nav', 'design'=>true)); ?>
            <?php the_post_navigation( array(
                'prev_text'  => __( 'Prev : %title' ),
                'next_text'  => __( 'Next : %title' ),
            ) );
            ?>

            
            <?php                
                #comments
                // if ( comments_open() || get_comments_number() ) {
                //    comments_template();
                // }   
            ?>                    
        </div>
    </div>

    <div class="col-lg-3">       
        <?php get_template_part("template-parts/sidebar"); ?>
    </div>

    </div> <!-- row -->


</div> <!-- container -->

</div> <!-- wrap -->
<?php endwhile; ?> 
</article> 



<div class="post-related">

    <!-- related articles -->
    <?php 
        $cat = get_the_category($post->ID);
        $cat = $cat[0]->cat_ID;

        $custom_query_args = array(
            'post_type' => 'post',
            'cat' => $cat,
            'posts_per_page' => -1,
            '_shuffle_and_pick' => 3
        );
    
        $custom_query = new \WP_Query( $custom_query_args );                 
    ?>
    <div class="container">
    <h4 class="dtitle">Related Articles</h4>

    <div class="row" data-design="grid-1.0">
        <?php 
            while( $custom_query->have_posts() ) : 
                $custom_query->the_post(); 
        ?>
        <div class="col-md-4">
            <article id="post-<?php echo $post->ID; ?>" class="box b">   
                <a class="post-link" href="<?php the_permalink(); ?>">    
                    <!-- thumb -->
                    <?php tp_thumb($post->ID, array('div'=>'post-thumb', 'as'=>'bg')); ?>

                    <!-- title -->
                    <div class="post-title same-h">
                        <h4 class="title"><?php the_title(); ?></h4>    
                    </div>    
                
                    <!-- excerpt -->
                    <div class="post-excerpt match-h">
                        <?php tp_excerpt($post->ID, array('char'=>'110')); ?>
                    </div>
                </a>    
            </article>  
        </div>  
        <?php 
            endwhile;
            wp_reset_postdata();
        ?>
    </div>
    </div>
</div>  

           