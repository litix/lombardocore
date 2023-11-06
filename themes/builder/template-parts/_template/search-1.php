<?php 
    load_assets(array('height', 'post'));
    
?>
<section class="element archive-posts ver-1">
<div class="wrap">
<div class="container-xl">
<div class="row loop-3">
    <?php 
        if ( have_posts() ) : while ( have_posts() ) : the_post();
    ?>    
    <div class="col-md-4">
        <article id="post-<?php echo $post->ID; ?>" class="boxed archive-single">   

        <a class="post-link" href="<?php the_permalink(); ?>">    

        <!-- thumb -->
        <div class="post-thumb">
            <?php bd_post_ph($post->ID, '', 'img'); ?>
            <div class="overlay"></div>
        </div>    

        <div class="post-date"><?php echo get_the_date(); ?></div> 

        <!-- title -->
        <div class="post-title same-h">
            <h4 class="title"><?php the_title(); ?></h4>    
        </div>    
           
        <div class="post-excerpt match-h">
            <?php echo limit_text(get_the_excerpt(), 15); ?>
        </div>
        </a>    
            
        <div class="post-meta">
            <div class="post-av">
                <?php bd_post_meta('avatar'); ?>
            </div>
            <div>
                       
            <div class="post-cat group-cat">
                <div>Posted By : <?php bd_post_meta('name'); ?></div>
                <?php echo bd_show_category($post->ID, 'Categories : '); ?> 
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
</div>
        
    <div class="post-pagination  clearfix">
        <?php pp_pagination_nav(); ?>
    </div>   
    
    <?php //wp_reset_postdata(); ?>    
</div>

</div>
</section>    