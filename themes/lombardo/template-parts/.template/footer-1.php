<?php 
    load_assets(array('menu-config', 'tpl-footer-1'));
?>

<footer class="element footer-0">
    <div class="wrap">
        <h2 class="text-center">Footer Template</h2>
    </div>

    
    <div class="copyright">
        <div class="container-xl foot">
            <div><?php do_shortcode("[copyright]"); ?></div>
            <div><?php do_shortcode("[web_design]"); ?></div>
        </div>
    </div>

</footer> 

<?php get_template_part('template-parts/scroll-up');  ?>
