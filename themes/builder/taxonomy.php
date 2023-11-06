<?php 
    get_header();
    get_builder_menu();
?> 
   
<main class="page-taxonomy page-inner">
    <?php 
        ## your taxonomy will redirect to homepage
        ## unless you create taxonomy-[your-taxonomy-slug].php
        ## sample ## LINK taxonomy-proj-cat.php

        wp_safe_redirect( get_home_url(), 301 );
        exit;
    ?>
</main>    
    
<?php 
    get_builder_end();
    get_footer(); 
?>