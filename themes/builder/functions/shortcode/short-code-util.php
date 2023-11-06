<?php 
#SHORTCODES

/* #region - FOOTER BACKGROUND  */
function fn_footer_bg($attr) {
    $args = shortcode_atts( array(
        'echo'  => 0,
    ), $attr );

    $e = theme_background();
    $bg = $e['footer_background'];

    $output = el_bg($bg, array('class'=>'overlay overlay-bg footer-bg', 'echo'=>false));

    if($args['echo'] == 1)
        echo $output;

    return $output;
}

add_shortcode('footer-bg', 'fn_footer_bg');
/* #endregion */

/* ----------------------------------------- */

/* #region - PARNERS (LOGO SLIDER)  */
function fn_partners($attr) {

    $args = shortcode_atts( array(
        'h'     => 'auto',
        'echo'  => 0,
        'arrow' => '/images/icons/owl-arr-1.svg'
    ), $attr );
    
    global $tpath, $owl, $jtheme;
    $owl++;
    $arrow = $tpath . $args['arrow'];
    $arrow = el_img($arrow, array('echo'=>false));

    $e = theme_utility();

    $tick = '';
    $count = 0;

    $slider_on = false;
    if(isset($e['partners'])):

        $tick = $e['partners'];
     
        $owl_height = "height: {$args['h']}px";
        $owl_style = tag_attr_style($owl_height);

        load_assets(array('logoticker', 'owl'));
        
        $rp         = $tick['logos'];
        $count      = $tick['count'];
        $slider_on  = $tick['slider'];  

    endif;

    $slider_class = $slider_on==true ? "owl-logo-ticker owl-carousel" : "owl-noslide";

    if($count < 1)
        $rp = '';

    $output = "<div class=\"{$slider_class}\">";
    if($rp):
    foreach($rp as $r):

        $link = '';
        $link = $r['link'];
          
        if(isset($link['url'])) {
            $attr = el_link_attr($link);
            $tag1 = "<a {$attr} class=\"logo-h\">";
            $tag2 = "</a>";
        } else {
            $tag1 = "<div class=\"logo-h\">";
            $tag2 = "</div>";
        }
   
        $item = $tag1;
        $item .= el_img($r['logo'], array('echo'=>false, 'class'=>'logo', 'lazy'=>false));
        $item .= $tag2;
        $output .= tag_wrap('item', $item);

    endforeach;
    endif;
    $output .= '</div>';    
   
    if($rp):
        if($slider_on == true) {
            if(count($rp) > 1) {
                $output .= "<button class=\"owlprev owl-prev-{$owl}\">{$arrow}</button>";
                $output .= "<button class=\"owlnext owl-next-{$owl}\">{$arrow}</button>";
            }
            
            $output .= '
                <script>
                var $ = jQuery.noConflict();
                $(function() {
                    var owl'.$owl.' = $(".owl-logo-ticker");
                    owl'.$owl.'.owlCarousel({
                        autoplay:   true,
                        loop:       true,
                        margin:     20,
                        nav:        false,
                        dots:       false,
                        items:      '.$count.',
                        mouseDrag:  true,
                        autoplayHoverPause: false,
                        lazyLoad: true,
                    });

                    $(".owl-next-'.$owl.'").click(function() {
                        owl'.$owl.'.trigger("next.owl.carousel");
                    })

                    $(".owl-prev-'.$owl.'").click(function() {
                        owl'.$owl.'.trigger("prev.owl.carousel");
                    })  
                });
                </script>';   

        }

    endif;

    $output = tag_wrap('logo-ticker', $output);  

    if($args['echo'] == 1)
        echo $output;

    return $output;
}

add_shortcode('partners', 'fn_partners');
/* #endregion */

/* ----------------------------------------- */

/* #region - MENU EXTENSION  */
function fn_menu_ext($attr) {
    $args = shortcode_atts( array(
        'echo'  => 0,
        't'     => 'buttons', //button, buttons_ex
        'b'     => -1
    ), $attr );

    $output = '';
    $e = theme_menu_ext();

    if($args['t'] == 'buttons') {
        if($args['b'] < 0) {
            if(isset($e['buttons']))
                $output = el_btnloop($e['buttons'], array('echo'=>false));
        } else {
                $btn = '';
                $b = $args['b'];
                if(isset($e['buttons'][$b]['button']))
                    $btn = $e['buttons'][$b]['button'];
                $output = el_advlink($btn, array('echo'=>false));          
        }
    }

    if($args['t'] == 'buttons_ex') {
        if($args['b'] < 0) {
            if(isset($e['buttons_ex']))
                $output = el_btnloop($e['buttons_ex'], array('echo'=>false));        
        } else {
            $b = $args['b'];
            $btn = $e['buttons_ex'][$b]['button'];
            $output = el_advlink($btn, array('echo'=>false));          
        }
    }

    if($args['echo'] == 1)
        echo $output;

    return $output;
    
}

add_shortcode('menu-ext', 'fn_menu_ext');
/* #endregion */

/* ----------------------------------------- */

/* #region - FOOTER MENU  */
function fn_footer_menu($attr) {
    global $wp;

    load_assets(array('mobile-menu'));
    $current_slug = add_query_arg( array(), $wp->request );
    $args = shortcode_atts( array(
        'echo'  => 0,
        'menu'  => 0, /* n = menu position */
        'main'  => false, /* 1 = use main menu */
        'text'  => 'Select Link'
    ), $attr );

    $output = '';

    $e = theme_footer_menu();

    if($args['main'] == false):

        if(isset($e['footer_menus'])) {

            $n = $args['menu'];

            $menu = $e['footer_menus'];

            if(isset($menu[$n]['menu'])) {
                $menu = $menu[$n]['menu']; //group title        
                $rp = $menu['menu']; //group links

                $output = el_title($menu['title'], array('echo'=>false, 'class'=>'desktop-view', 'css'=>'ftitle'));

                ## desktop menu
                $output .= '<ul class="menu-links desktop-view">';
                if($rp):
                    foreach($rp as $r):
                        $menu_class = 'is-link';
                        $link = el_link($r['link'], array('echo'=>false, 'class'=>"{$menu_class}"));
                        $output .= tag_wrap('menu-item', $link, '', 'li'); 
                    endforeach;
                endif;
                $output .= '</ul>';

                ## mobile menu
                $output .= '<ul class="menu-links is-mobile mobile-view">';

                if($menu['title']) {
                    $text = $menu['title'];
                } else {
                    $text = $args['text'];
                }
                
                $output .= tag_wrap('menu-item', $text, '', 'li');

                if($rp):
                    foreach($rp as $r):
                        $menu_class = 'is-link';
                        $link = el_link($r['link'], array('echo'=>false, 'class'=>"{$menu_class}"));
                        $output .= tag_wrap('menu-link', $link, '', 'li'); 
                    endforeach;
                endif;
                $output .= '</ul>';                
            }
        }

        $output = tag_wrap('footer-menu', $output);  

        if($args['echo'] == 1)
            echo $output;
    
        return $output;            

    endif;    


    if($args['main'] == true):

        echo "<div class=\"footer-menu\">";

        wp_nav_menu( array(
            'theme_location'  => 'main',
            'depth'	          => 0,
            'container'       => '',
            'container_class' => '',
            'container_id'    => '',
            'menu_id'         => '',
            'menu_class'      => 'menu-links desktop-view',
            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
            'walker'          => new WP_Bootstrap_Navwalker(),
        ));         

        wp_nav_menu( array(
            'theme_location'  => 'main',
            'depth'	          => 0,
            'container'       => '',
            'container_class' => '',
            'container_id'    => '',
            'menu_id'         => '',
            'menu_class'      => 'menu-links is-mobile mobile-view',
            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
            'walker'          => new WP_Bootstrap_Navwalker(),
        ));

        echo "</div>";

    endif;        

          
    
}

add_shortcode('footer-menu', 'fn_footer_menu');
/* #endregion */




/* ----------------------------------------- */

/* #region - NEWS TICKER  */
function fn_top_tick($attr) {
    
    $args = shortcode_atts( array(
        'echo'  => 0,
        'h'     => 22,
        'arrow' => '/images/icons/owl-arr-1.svg'
    ), $attr );
    
    global $tpath;
    $arrow = $tpath . $args['arrow'];
    $arrow = el_img($arrow, array('echo'=>false));

    $x = fa_icon('close1');
    $tick = '';
    $cookie = '';
    $enabled = '';
    $rp = '';
    $output = '';
    $e = theme_utility();
    
    if(isset($e['news_ticker'])) {
        $tick = $e['news_ticker'];
        $owl_height = "height: {$args['h']}px";
        $owl_style = tag_attr_style($owl_height);
    }

    load_assets(array('owl'));
    
    if($tick != '') {
        $cookie = $tick['cookies'];
        $enabled = $tick['enable'];
    }

    $link_attr = 'href="' . site_url('/?tick=off') . '"';

    ## cookies
    if($cookie == true) {
        $tickbtn = "<a {$link_attr} class=\"svg-close\" data-dismiss=\"alert\" aria-label=\"Close\">{$x}</a>";
    } else {
        $tickbtn = '<button type="button" class="svg-close" data-dismiss="alert" aria-label="Close">' . $x . '</button>';
    }

    if(isset($_GET['tick'])) {
        $off = true;
        setcookie("tick", "off", time() + (86400 * 7), "/");
    }
    if(isset($_COOKIE['tick'])) 
        $off = true;
        
    if($cookie == false)
        $off = false;

    if(isset($tick['content']))        
        $rp = $tick['content']; 

    if(isset($e['news_ticker'])):

        ## carousel
        $output = '<div class="owl-ticker owl-carousel">';
        if($rp):
        foreach($rp as $r):
            $text = strip_tags($r['text'], '<strong><span><em><b><i><a><del><a>');
            $text = tag_wrap('item', $text);
            $output .= $text;

        endforeach;
        endif;
        $output .= '</div>';

        if($rp):
            if(count($rp) > 1) {
                $output .= "<button class=\"prev-1 tick-btn owl-prev\">{$arrow}</button>";
                $output .= "<button class=\"next-1 tick-btn owl-next\">{$arrow}</button>";
            }
        endif;

        $output = tag_wrap('owl-bg', $output, $owl_style);

        $output .= $tickbtn;    
        $output = tag_wrap('top-alert', $output);
        $id = 'id="top-ticker"';
        $output = tag_wrap('top-ticker element', $output, $id);  

        if($enabled == true and $off != true) {
            if($args['echo'] == 1)
            echo $output;
            load_assets(array('opt-ticker', 'owl'));

            return $output;
        }
    endif;
}

add_shortcode('ticker', 'fn_top_tick');
/* #endregion */

/* #region - SOCIAL MEDIA ICONS  */

function generate_social_icon($url) {

    global $tpath;

    $icon = '';

    $tw = $tpath . '/images/icons/social/sm-tw.svg';
    $ig = $tpath . '/images/icons/social/sm-ig.svg';
    $fb = $tpath . '/images/icons/social/sm-fb.svg';
    $in = $tpath . '/images/icons/social/sm-in.svg';
    $yt = $tpath . '/images/icons/social/sm-yt.svg';

    if(strpos($url,"instagram") > 1) { $icon = $ig; }
    if(strpos($url, "facebook") > 1) { $icon = $fb; }
    if(strpos($url, "twitter")  > 1) { $icon = $tw; }
    if(strpos($url, "youtube")  > 1) { $icon = $yt; }
    if(strpos($url, "linked")   > 1) { $icon = $in; }
    
    return $icon;
}

/* #endregion */