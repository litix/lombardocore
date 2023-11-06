<?php 
    global $post;
    get_header(); 
    get_builder_menu();
?>  
    
<main class="single-post page-inner">
    <?php the_title(); ?>
    <?php the_post_navigation( array(
        'prev_text'  => __( 'Prev : %title' ),
        'next_text'  => __( 'Next : %title' ),
    ) );
    ?>
</main>    
    
<?php 
    get_builder_end();
    get_footer(); 
?>