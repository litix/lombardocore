<?php 

  ## LINK assets/theme/tpl-footer-1.css
  load_assets(array('menu-config', 'tpl-footer-1'));

?>

<div class="mh"></div>

<footer class="element footer-0" data-tpl="default">
    <div class="wrap">
        <?php //echo do_shortcode('[footer-bg]'); ?>

        <div class="container-xl">
            <?php echo do_shortcode('[partners]'); ?>
            <?php 
                $ex = theme_addon(); 
                if(isset($ex)){
                    echo $ex['motto'];
                }
                //fa_icon('facebook', 1);
            ?>
        </div>

        <div class="container-xl">
            <div class="row">
                <div class="col-md-4">
                <?php 
                    echo do_shortcode('[menu-ext t="buttons_ex"]');
                    //builder_logo('footer');
                    echo do_shortcode('[company-logo location="footer"]');
                    //echo do_shortcode('[company-name]');
                    echo do_shortcode('[company-about]');
                    echo '<div class="mb-4"></div>';
                    echo do_shortcode('[company-hours]');
                ?>
                </div>
                <div class="col-md-4">
                <?php 

                    ##PHONE
                    //single
                    echo do_shortcode('[contact-phone icon="1" linked="1" loop="1"]');
                    //loop
                    echo do_shortcode('[contact-phone icon="1"]');
                    
                    echo "<hr>";

                    ##EMAIL
                    //single
                    echo do_shortcode('[contact-email icon="1" loop="1"]');
                    //loop
                    echo do_shortcode('[contact-email icon="1"]');

                    echo "<hr>";

                    ##ADDRESS
                    //single
                    echo do_shortcode('[contact-address icon="1" linked="1" loop="1"]');
                    //loop
                    echo do_shortcode('[contact-address icon="1" linked="1" loop="-1"]');

                ?>
                </div>
                <div class="col-md-4">
                <?php 
                    echo do_shortcode('[social-icons]');  
                    echo do_shortcode('[google-reviews]');  
                    //echo do_shortcode('[search-form w="250"]');  
                    
                    echo do_shortcode('[footer-menu menu="0"]');
                    echo do_shortcode('[footer-menu menu="1"]');
                    echo do_shortcode('[footer-menu menu="2"]');

                    echo do_shortcode('[footer-menu main=true]');
                ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="copyright">
        <div class="container-xl foot">
            <?php do_shortcode("[copyright echo=1]"); ?>
            <?php do_shortcode("[web-design echo=1]"); ?>
            <?php echo do_shortcode('[disclaimer]');  ?>
            <?php echo do_shortcode('[mini-links]');  ?>
        </div>
    </div>

</footer> 

<?php do_shortcode('[scroll-up echo="1"]'); ?>