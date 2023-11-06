<?php 
    get_header();
    get_builder_menu();
?> 
    
<main class="<?php echo builder_class(); ?>">
    
    <?php
    if(has_flexible('layout')):
        the_flexible('layout');
    endif;           
    ?>
    
</main>    
    
<?php 
get_builder_end();
get_footer(); ?>