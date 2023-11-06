<?php 
    get_header();
    get_builder_menu();
?> 
   
<main class="page-404 page-inner">
    <?php 

        ## LINK template-parts/404.php
        get_404_tpl(); 
        
    ?>
</main>    
    
<?php 
    get_builder_end();
    get_footer(); 
?>