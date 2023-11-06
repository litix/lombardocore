<?php 
    /* template name: Dev Builder */
    get_header();
    get_builder_menu();
?>  
    
<main class="<?php echo builder_class(); ?>">
    
    <?php
    if(has_flexible('dev_layout')):
        the_flexible('dev_layout');
    endif;           
    ?>
    
</main>    
    
<?php 
    get_builder_end();
    get_footer(); 
?>