<!-- DEFAULT -->
<?php 
load_assets(array('menu-config'));  ?>

<header <?php header_class('ver-0'); ?> data-header="options" data-php="tp-header">
  <div class="menu_wrap">
    <div class="container-xl">  
        <?php 
          get_template_part('template-parts/menu-home'); 
          get_template_part('template-parts/menu-mobile'); 
        ?>        
    </div>  
  </div>        
</header>  

<?php 
    ## Main Menu      - ## LINK template-parts/menu-home.php
    ## Mobile Menu    - ## LINK template-parts/menu-mobile.php
?>