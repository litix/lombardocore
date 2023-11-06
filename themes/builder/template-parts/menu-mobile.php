<!-- mobile oc -->
<div <?php nav_mobile_setting(); ?> 
    data-mobile-menu="options"
    data-php="tp-menu-mobile">
    <div class="box">

        <div class="menu-toggle text-right">
              <button class="menu-oc-right closer" type="button" aria-label="Toggle navigation"> 
                  <?php echo fa_icon('menu_close'); ?>
              </button>                     
        </div>
        
        <?php 
            wp_nav_menu( array(
                'theme_location'  => 'main',
                'depth'	          => 5,
                'container'       => '',
                'container_class' => '',
                'container_id'    => '',
                'menu_id'         => '',
                'menu_class'      => 'navbar-nav',
                'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                'walker'          => new WP_Bootstrap_Navwalker(),
            ));                        
        ?> 
        
        <?php 
            ## MENU EXTENSION
            ## LINK template-parts/menu-extension.php
            get_builder_menu_ext(); 
        ?>

        <?php //nav_mobile_ext(); ?>    
    </div>
</div>