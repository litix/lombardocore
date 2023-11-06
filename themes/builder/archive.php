<?php 
    get_header();
    get_builder_menu();
?> 
   
<main class="page-archive page-inner">
    <?php 

        ## LINK template-parts/archive.php
        get_archive_tpl(); 
        
    ?>
</main>    
    
<?php 
    get_builder_end();
    get_footer(); 
?>