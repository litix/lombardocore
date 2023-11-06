<!-- search -->
<div class="widget recent-post">
    <h3 class="wtitle">Recent Posts</h3> 
    <?php 
        $query = new WP_Query('post_type=post&posts_per_page=5'); 
        if ( $query->have_posts() ) :
    ?>                    
    <ul class="bullet">
    <?php while ( $query->have_posts() ) : $query->the_post(); ?>     
    <li>
        <a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
        </a>
    </li> 
    <?php endwhile; ?>
    </ul>
    <?php 
        endif; 
        wp_reset_postdata();
        wp_reset_query();
    ?>  
</div>