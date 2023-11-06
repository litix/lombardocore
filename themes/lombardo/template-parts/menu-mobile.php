<!-- mobile oc -->
<div <?php nav_mobile_setting(); ?> data-mobile-menu="options" data-php="tp-menu-mobile">
    <div class="box">

        <div class="menu-toggle text-right">
            <button class="menu-oc-right closer" type="button" aria-label="Toggle navigation">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fff" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
                </svg>

            </button>
        </div>

        <?php
        wp_nav_menu(array(
            'theme_location'  => 'main',
            'depth'              => 5,
            'container'       => '',
            'container_class' => '',
            'container_id'    => '',
            'menu_id'         => '',
            'menu_class'      => 'navbar-nav',
            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
            'walker'          => new WP_Bootstrap_Navwalker(),
        ));
        ?>

        <?php //nav_mobile_ext(); 
        ?>
    </div>
</div>