<?php 
    load_assets(array('error-css', 'bs-full'));
    get_header();
    get_builder_menu();
    #level_check();
?> 
    
<main class="<?php echo builder_class(); ?> page-index">
    <?php 

        ## LINK functions/wp/wp_features.php#noob
        noob_check(); 
        
    ?>
</main>    

<?php 
    get_builder_end();
    get_footer(); 
?>