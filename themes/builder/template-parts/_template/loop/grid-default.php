<?php
    $grid = 6; // 2
    $g = theme_config_th();

    if(isset($g['grid_column']))
        $grid = $g['grid_column'];
?>

<div class="row" data-design="grid-1.0">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>    
    <div class="col-md-<?php _e($grid); ?>">
        <article id="post-<?php echo $post->ID; ?>" class="box b">   

        <a class="post-link" href="<?php the_permalink(); ?>">    

            <!-- thumb -->
            <?php tp_thumb($post->ID, array('div'=>'post-thumb', 'as'=>'bg')); ?>
            <!-- date -->
            <?php tp_meta($post->ID, array('meta'=>'date','div'=>'post-meta')); ?>

            <!-- title -->
            <div class="post-title same-h">
                <h4 class="title"><?php the_title(); ?></h4>    
            </div>    
           
            <!-- excerpt -->
            <div class="post-excerpt match-h">
                <?php tp_excerpt($post->ID, array('char'=>'110')); ?>
            </div>

        </a>    
            
        <div class="div-meta">
            <!-- avatar -->
            <?php tp_meta($post->ID, array('meta'=>'avatar','div'=>'post-meta')); ?>
            <div>  
                <div class="post-cat group-cat">
                    <!-- author -->                    
                    <?php tp_meta($post->ID, array('meta'=>'name','div'=>'post-meta', 'text'=>'Author : ')); ?>
                    <!-- category -->                    
                    <?php 
                        tp_cat($post->ID, array(
                            'div'=>'post-meta', 
                            'taxonomy'=>'proj-cat',
                            'post_text'=>'Category : ',
                            'cpt_text'=>'Design : '
                        )); 
                    ?> 
                </div>
            </div>
        </div>            
        
        </article>    
    </div>
    
    <?php endwhile; ?>
    <?php else: ?>
    
    <div class="col-lg-12">
        <p>Sorry no available post.</p>
    </div>
    
    <?php endif; //close query loop ?>
</div><!-- row -->
        
<div class="post-pagination  clearfix">
    <?php pp_pagination_nav(); ?>
</div>   

<?php wp_reset_postdata(); ?>    