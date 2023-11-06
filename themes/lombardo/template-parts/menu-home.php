<nav <?php nav_setting(); ?> id="navbar-home" class="navbar navbar-expand-lg" data-main-menu="options"
    data-php="tp-menu-home">

    <div class="logo-desktop">
        <?php
        builder_logo('main');
        builder_logo('sticky');
        builder_logo('mobile');
        ?>
    </div>

    <div class="menu-toggle ml-auto">
        <button class="menu-oc-right opener" type="button" aria-label="Toggle navigation">
            <svg xmlns="http://www.w3.org/2000/svg" style="color:#fff;" fill="red" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
            </svg>
        </button>
    </div>
    <div class="navbar-collapse">

        <div class="main-menu">
            <?php
            wp_nav_menu(array(
                'theme_location'  => 'main',
                'depth'              => 4,
                'container'       => '',
                'container_class' => '',
                'container_id'    => '',
                'menu_id'         => '',
                'menu_class'      => 'navbar-nav',
                'walker'          => new WP_Bootstrap_Navwalker(),
            ));
            ?>
        </div>

        <div class="flex flex-shrink-0 flex-grow-0 ml-[29px]" data-tpl="default" data-php="tp-menu-extension">
            <?php
            echo do_shortcode('[child-menu-ext class="btn btn-1 btn-top"]');
            ?>
        </div>
    </div>
</nav>