<!-- Version 1 -->
<?php 
    load_assets(array('menu-config', 'tpl-menu-1')); 
?>

<?php
   $data = "
        data-header=\"options\" 
        data-php=\"main-menu-1\"
   ";
?>

<div class="top_head">
    <div class="container-xl">
        <div class="flexic">
            <?php echo do_shortcode('[contact-phone icon="0" text="CALL US AT" linked=1 loop="1"]'); ?>
            <?php echo do_shortcode('[social-icons]'); ?>
        </div>
    </div>
</div>

<header <?php header_class('ver-1'); ?> <?php _e($data); ?>>
<div class="menu_wrap">
    <div class="container-xl">  
        <?php get_template_part('template-parts/.template/menu/menu-home', '1'); ?>  
        <?php get_template_part('template-parts/.template/menu/menu-float'); ?>   
        <?php get_template_part('template-parts/.template/menu/menu-mobile', '1'); ?>        
    </div>  
</div>        
</header>  

