<?php 
    /* #region */
        $show = theme_config_toggle();
    /* #endregion */
?>

<div class="admin-site-header">
    <span>Header</span> 
</div>

<section class="admin-site-info" data-design="site-preview">
<div class="wrap">
<div class="si-panel" id="si-panel">

    <div class="si-group">

        <?php $unset = '<em class="empty">~</em>'; ?>

        <!-- Logo -->
        <div class="si-info" data-trigger="logos" data-group="1">
            <div class="si-label">Company Logo</div>
            <div class="si-data" data-el="logo"><?php el_img(build_acf_logo()); ?> 
            <span class="editme"><?php echo fa_icon('edit'); ?></span></div>
        </div>  

        <!-- Company Name -->
        <div class="si-info" data-trigger="site" data-group="1">
            <div class="si-label">Company</div>
            <div class="si-data"><?php echo company_name(); ?> <span class="editme"><?php echo fa_icon('edit'); ?></span></div>
        </div>
      
        <!-- Contact (Phone) -->
        <div class="si-info" data-trigger="contact" data-group="1">
            <div class="si-label">Phone Number <?php echo fa_icon('phone1'); ?></div>
            <div class="si-data">
                <div>
                    <?php 
                        $cc = '';
                        $c = 0;
                        $e = theme_contact();
                        if(isset($e['phone'])) {
                            $rp = $e['phone'];
                        
                            if($rp) {
                                $c = count($rp);
                                echo $rp[0]['contact'];
                                if($c > 1)
                                    $cc = $c - 1;
                                    if($cc >= 1) {
                                        echo " <span class=\"bub\">{$cc} more</span>";                            
                                    }
                            } else {
                                echo $unset;
                            }
                        }
                    ?> 
                </div>
                <span class="editme"><?php echo fa_icon('edit'); ?></span>
            </div>
        </div>        

        <!-- Contact (Email) -->
        <div class="si-info" data-trigger="contact" data-group="1">
            <div class="si-label">Email Address <?php echo fa_icon('mail'); ?></div>
            <div class="si-data">
                <div>
                    <?php 
                        $cc = '';
                        $c = 0;
                        $e = theme_contact();
                        if(isset($e['emails'])) {
                            $rp = $e['emails'];
                            if($rp) {
                                $c = count($rp);
                                echo $rp[0]['email'];
                                if($c > 1)
                                    $cc = $c - 1;
                                    if($cc >= 1) {
                                        echo " <span class=\"bub\">{$cc} more</span>";                            
                                    }
                            } else {
                                echo $unset;
                            }
                        }
                    ?> 
                </div>
                <span class="editme"><?php echo fa_icon('edit'); ?></span>
            </div>
        </div> 
 
        <!-- Contact (Address) -->
        <div class="si-info" data-trigger="contact" data-group="1">
            <div class="si-label">Address <?php echo fa_icon('map'); ?></div>
            <div class="si-data">
                <div>
                    <?php 
                        $cc = '';
                        $c = 0;
                        $e = theme_contact();
                        if(isset($e['address'])) {
                            $rp = $e['address'];
                            if($rp) {
                                $c = count($rp);
                                echo strip_tags($rp[0]['address']);
                                if($c > 1)
                                    $cc = $c - 1;
                                    if($cc >= 1) {
                                        echo " <span class=\"bub\">{$cc} more</span>";                            
                                    }                                
                            } else {
                                echo $unset;
                            }
                        }
                    ?> 
                </div>
                <span class="editme"><?php echo fa_icon('edit'); ?></span>
            </div>
        </div> 

        <!-- Social Media -->
        <div class="si-info" data-trigger="social_media" data-group="1">
            <div class="si-label">Social Media</div>
            <div class="si-data">
                <div class="social">
                    <?php 
                        $e = theme_social();
                        if(isset($e['social_links_r'])) {
                            $rp = $e['social_links_r'];
                            if($rp) {
                                foreach ($rp as $r):      
                                    el_img($r['icon']);
                                endforeach;
                            } else {
                                echo $unset;
                            }     
                        }                       
                    ?> 
                </div>
                <span class="editme"><?php echo fa_icon('edit'); ?></span>
            </div>
        </div> 

        <!-- Copyright -->
        <div class="si-info" data-trigger="footer" data-group="1">
            <div class="si-label">Copyright</div>
            <div class="si-data">
                <div>
                    <?php 
                    $e = theme_footer();
                    if(isset($e['copyright'])) {
                        if($e['copyright']) {
                            echo do_shortcode('[copyright]'); 
                        } else {
                            echo $unset;
                        }
                    }
                    ?> 
                </div>
                <span class="editme"><?php echo fa_icon('edit'); ?></span>
            </div>
        </div> 

        <?php 
        /* #region -- GOOGLE MY BUSINESS */ 
            if($show = theme_config_toggle()): 
        ?>

            <?php if($show['show_gmb'] == true): ?>
            <!-- Googlee Business -->
            <div class="si-info" data-trigger="site" data-group="1">
                <div class="si-label">Google Business</div>
                <div class="si-data">
                    <div>
                        <?php 
                        $e = theme_info();
                        if(isset($e['google_reviews'])){
                            $gb = $e['google_reviews'];
                            if(isset($gb['url'])) {
                                if($gb['url']) {
                                    echo $gb['url']; 
                                } else {
                                    echo $unset;
                                }
                            }
                        }
                        ?> 
                    </div>
                    <span class="editme"><?php echo fa_icon('edit'); ?></span>
                </div>
            </div>         

            <!-- About -->
            <div class="si-info" data-trigger="site" data-group="1">
                <div class="si-label">About (Footer)</div>
                <div class="si-data">
                    <div>
                        <?php 
                        $e = theme_info();
                        if(isset($e['about'])) {
                            $a = strip_tags($e['about']);
                            if($a) {
                                echo limitStrlen($a, 60); 
                            } else {
                                echo $unset;
                            }
                        }
                        ?> 
                    </div>
                    <span class="editme"><?php echo fa_icon('edit'); ?></span>
                </div>
            </div>  

            <!-- About: Office Hours -->
            <div class="si-info" data-trigger="site" data-group="1">
                <div class="si-label">Office Hours</div>
                <div class="si-data">
                    <div>
                        <?php 
                        $e = theme_info();
                        if(isset($e['office_hours'])) {
                            $h = $e['office_hours'];
                            if($h) {
                                echo '<em>schedules added</em>'; 
                            } else {
                                echo $unset;
                            }
                        }
                        ?> 
                    </div>
                    <span class="editme"><?php echo fa_icon('edit'); ?></span>
                </div>
            </div> 

            <?php endif; ?>

        <?php 
        endif; 
        /* #endregion */
        ?>

    </div>

    <div class="si-group rr">

        <!-- MENU BUTTONS -->
        <div class="si-info" data-trigger="menu_extension" data-group="2">
            <div class="si-label">Menu Button(s)</div>

            <div class="si-data is-btn">
                <div class="si-data-info scale">
                    <?php 
                    $e = theme_menu_ext();
                    if(isset($e['buttons'])){
                        $rp = $e['buttons'];
                                        
                        if($rp) {
                            echo do_shortcode('[menu-ext]');
                        } else {
                            echo $unset;
                        }
                    }
                    ?> 
                </div>
                <span class="editme"><?php echo fa_icon('edit'); ?></span>
            </div>
        </div>

        <?php 
        /* #region -- TOGGLE INFO */ 
        if($show = theme_config_toggle()): 
        ?>        

        <!-- MENU (EXTRA) BUTTONS -->
        <div class="si-info" data-trigger="menu_extension" data-group="2">
            <div class="si-label">Shortcode Button(s)</div>
            <div class="si-data is-btn">
                <div class="si-data-info scale">
                    <?php 
                    $e = theme_menu_ext();
                    if(isset($e['buttons_ex'])){
                        $rp = $e['buttons_ex'];
                                        
                        if($rp) {
                            echo do_shortcode('[menu-ext t="buttons_ex"]');
                        } else {
                            echo $unset;
                        }
                    }
                    ?> 
                </div>
                <span class="editme"><?php echo fa_icon('edit'); ?></span>
            </div>
        </div>

        <!-- FOOTER MENU -->
        <div class="si-info" data-trigger="footer_menu" data-group="2">
            <div class="si-label">Footer Menu</div>
            <div class="si-data">
                <div class="si-data-info">
                    <?php 
                    $e = theme_footer_menu();
                    if(isset($e['footer_menus'])){
                        $rp = $e['footer_menus'];
                                        
                        if($rp) {
                            $count = count($rp);
                            echo "<em>{$count} Menu(s) added</em>";
                        } else {
                            echo $unset;
                        }
                    }
                    ?> 
                </div>
                <span class="editme"><?php echo fa_icon('edit'); ?></span>
            </div>
        </div>      

        <!-- Footer Background -->
        <?php if($show['show_fbg'] == true): ?>
        <div class="si-info as-img" data-trigger="background" data-group="2">
            <div class="si-label">Footer Background</div>
            <div class="si-data">
                <div class="si-data-info">
                    <?php 
                        $e = theme_background();
                        if(isset($e['footer_background'])){
                            $bg = $e['footer_background'];

                            if($bg) {
                                el_img($bg);
                            } else {
                                echo $unset;
                            }
                        }
                    ?> 
                </div>
                <span class="editme"><?php echo fa_icon('edit'); ?></span>
            </div>
        </div>        
        <?php endif; ?>  

        <!-- Developer Addon -->
        <?php if($show['show_dev_addon'] == true): ?>
        <div class="si-info as-img" data-trigger="dev_addon" data-group="1">
            <div class="si-label">Information</div>
            <div class="si-data">
                <div class="si-data-info">
                    <?php 
                    $da = theme_opt('settings', 'dev_addon');
                    if(isset($da)) {
                        echo '<em>' . count($da) . ' field(s)</em>';
                    } else {
                        echo '~';
                    }
                    ?> 
                </div>
                <span class="editme"><?php echo fa_icon('edit'); ?></span>
            </div>
        </div>        
        <?php endif; ?>          

        <!-- Sidebar -->
        <?php if($show['show_sidebar'] == true): ?>
        <div class="si-info" data-trigger="sidebar" data-group="2">
            <div class="si-label">Sidebar</div>
            <div class="si-data">
                <div class="si-data-info">
                    <?php 
                    $e = theme_footer_menu();
                    if(isset($e['sidebar'])){

                    }
                    ?> 
                </div>
                <span class="editme"><?php echo fa_icon('edit'); ?></span>
            </div>
        </div>          
        <?php endif; ?>

        <!-- News Ticker -->
        <?php if($show['show_ticker'] == true): ?>
        <div class="si-info" data-trigger="news_ticker" data-group="2">
            <div class="si-label">News Ticker</div>
            <div class="si-data">
                <div class="si-data-info">
                    <?php 
                        $e      = theme_utility();
                        if(isset($e['news_ticker'])){
                            $tick   = $e['news_ticker'];
                            $enable = $tick['enable'];
                            $rp     = $tick['content']; 
                                        
                            if($enable == true) {
                                if($rp) {
                                    $count  = count($rp);
                                    echo "<em>{$count} message displayed</em>";
                                } else {
                                    echo "<em>No message displayed</em>";
                                }
                            } else {
                                echo '<em class="empty">disabled</em>';
                            }
                        }
                    ?> 
                </div>
                <span class="editme"><?php echo fa_icon('edit'); ?></span>
            </div>
        </div>    
        <?php endif; ?>
        
        <!-- Placeholder -->
        <?php if($show['show_placeholder'] == true): ?>
        <div class="si-info" data-trigger="placeholders" data-group="2">
            <div class="si-label">Placeholders</div>
            <div class="si-data">
                <div class="si-data-info">
                    <?php 
                        $e      = theme_utility();
                        if(isset($e['placeholders'])) {
                            $p      = $e['placeholders'];
                            $rp     = $p['cpt_thumbnail'];
                                        
                            if($rp) {
                                $count  = count($rp);
                                echo "<em>{$count} placeholders added</em>";
                            } else {
                                echo '<em class="empty">No thumbnails</em>';
                            }
                        }
                    ?> 
                </div>
                <span class="editme"><?php echo fa_icon('edit'); ?></span>
            </div>
        </div>  
        <?php endif; ?>

        <!-- Partners -->
        <?php if($show['show_partners'] == true): ?>
        <div class="si-info" data-trigger="partners" data-group="2">
            <div class="si-label">Partners</div>
            <div class="si-data">
                <div class="si-data-info">
                    <?php 
                        $e      = theme_utility();
                        if(isset($e['partners'])) {
                            $pn     = $e['partners'];
                            $slider = $pn['slider'];
                            $rp     = $pn['logos'];
                            $enable = $pn['enable'];

                            $stext = ($slider == true) ? 'with slider' : 'slider turned off';
                                        
                            if($enable == true) {

                                if($rp) {
                                    $count  = count($rp);
                                    echo "<em>{$count} logo(s) displayed : {$stext}</em>";
                                } else {
                                    echo "<em>No logo(s) displayed";
                                }

                            } else {
                                echo '<em class="empty">disabled</em>';
                            }
                        }
                    ?> 
                </div>
                <span class="editme"><?php echo fa_icon('edit'); ?></span>
            </div>
        </div>   
        <?php endif; ?> 

        <!-- Custom CTA -->
        <?php if($show['show_cb'] == true): ?>
        <div class="si-info" data-trigger="custom_cta" data-group="2">
            <div class="si-label">CTA / Banners</div>
            <div class="si-data">
                <div class="si-data-info">
                    <?php 
                        $e      = theme_utility();
                        if(isset($e['custom_cta'])) {
                            if($e['custom_cta']) {
                                $cta    = $e['custom_cta'];
                                $rp     = $cta['custom_ctas'];
                                
                                if($rp) {
                                    $count = count($rp);
                                    echo "<em>{$count} CTA(s) added</em>";
                                } else {
                                    echo $unset;
                                }
                            }
                        }
                    ?> 
                </div>
                <span class="editme"><?php echo fa_icon('edit'); ?></span>
            </div>
        </div>       
        <?php endif; ?>  

        <?php 
        endif; 
        /* #endregion */
        ?>

    </div>

</div> <!-- SI Panel -->   
 </div> <!-- wrap -->   
</section>    

<script>
    var $ = jQuery.noConflict();
    (function($){

        $('.btn-loop a').removeAttr('href');

        function click_tab(g){
            $('.acf-tab-group li:nth-child(' + g + ') a').click();
        }
        
        $('.si-info, .a-si').each(function(){       
            $(this).click(function() { 

                var g = $(this).data('group');
                click_tab(g);

                var trigger = $(this).data('trigger');
                $('div[data-name="'+ trigger +'"] a[data-modal]').click();
                
            });
        });


    })(jQuery)
</script>