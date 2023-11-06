<?php 
    get_header();
    get_builder_menu();
?> 
    
<main class="post-article page-inner">
    <?php 
        ## LINK template-parts/single.php
        get_single_tpl(); 
    ?>  
</main>    
    
<?php 
    get_builder_end();
    get_footer(); 
?>                 
