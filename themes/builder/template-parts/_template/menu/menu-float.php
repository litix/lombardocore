<div class="menu-bg" id="navbar-float">
<div class="container-xl">
<nav class="navbar navbar-expand-lg" <?php nav_setting(); ?>>

        <?php builder_logo('sticky'); ?>

        <div class="menu-toggle ml-auto">
        <button class="menu-oc-right opener" type="button" aria-label="Toggle navigation"> 
            <?php echo fa_icon('bars1'); ?>
        </button>
        </div>     
        
        <div class="collapse navbar-collapse">

            <div class="main-menu">
            <?php 
                wp_nav_menu( array(
                    'theme_location'  => 'main',
                    'depth'	          => 4,
                    'container'       => '',
                    'container_class' => '',
                    'container_id'    => '',
                    'menu_id'         => '',
                    'menu_class'      => 'navbar-nav',
                    'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                    'walker'          => new WP_Bootstrap_Navwalker(),
                ));                        
            ?> 
            </div>
            
            <?php get_builder_menu_ext(); ?>
        </div>               
    
</nav> 
</div>    
</div>    