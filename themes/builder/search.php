<?php 
    get_header();
    get_builder_menu();
?> 
    
<main class="page-search">
    <?php 

        ## LINK template-parts/search.php
        get_search_tpl(); 
        
    ?> 
</main>    
    
<?php 
    get_builder_end();
    get_footer(); 
?>