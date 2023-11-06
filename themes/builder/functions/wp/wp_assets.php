<?php

/* #region - REMOTE ENQUEUE  */

## ANCHOR[ASSETS] 

function load_assets($array) { 
    // stuff will go to footer

    $ver = constant('VER');
    
    //print_r($array);

    if(!is_array($array)) {
        $array = explode(",", $array);     
    }
      
    global $t_assets, $js, $jtheme, $ctheme;

    ## THEME OPTION - MENU
    if(in_array('menu-config', $array, TRUE)) {
        wp_register_style('animate_css', $jtheme . '/css-animate.css', '', 2.4);
        wp_register_style('bsmenu_css',  $jtheme . '/menu-config.css', '', 1.1);    
        wp_register_script('bsmenu_js',  $jtheme . '/menu-config.js','', 1.1);    

        wp_enqueue_style('animate_css');        
        wp_enqueue_style('bsmenu_css');                
        wp_enqueue_script('bsmenu_js');
    }    

    ## BOOTSTRAP SCRIPT
    if(in_array('bootstrap', $array, TRUE)) {
        wp_register_script('popper_js', $js . 'bootstrap/js/popper.min.js','', 1.14);    
        wp_register_script('bootstrap_js', $js . 'bootstrap/js/bootstrap.min.js','', 4.6);

        wp_enqueue_script('popper_js');  
        wp_enqueue_script('bootstrap_js');        
    }

    ## JQUERY
    ## ANCHOR[id=jquery] 

    ## OWL SLIDER
    ## https://owlcarousel2.github.io/OwlCarousel2/

    if(in_array('owl', $array, TRUE)) {           
        wp_register_style('owl_theme', $js . 'owl/owl.theme.default.min','', 2.3);     
        wp_register_style('owl_css', $js . 'owl/owl.carousel.min.css','', 2.3);     
        wp_register_script('owl_js', $js . 'owl/owl.carousel.min.js','', 2.3);
        wp_register_style('addon_owl', $jtheme . '/addon-owl.css');        

        wp_enqueue_script('owl_js');                
        wp_enqueue_style('owl_css');  
        wp_enqueue_style('addon_owl');
    }    

    ## APPEAR ON SCROLL 
    ## https://github.com/michalsnik/aos

    if(in_array('aos', $array, TRUE)) {    
        wp_register_style('aos_css', $js . 'aos/aos.css','', 2.3);     
        wp_register_script('aos_js', $js . 'aos/aos.js','', 2.3);
        
        wp_enqueue_script('aos_js');                
        wp_enqueue_style('aos_css');      
    }     

    ## SCROLL TO TOP
    if(in_array('scrolltop', $array, TRUE)) {    
        wp_register_script('scrolltop_js',  $js . 'scrolltop/scrolltop.js');
        wp_register_style('scrolltop_css', $js . 'scrolltop/scrolltop.css');        

        wp_enqueue_script('scrolltop_js');
        wp_enqueue_style('scrolltop_css');                 
    }       

    ## LIGHTSLIDER 
    ## http://sachinchoolur.github.io/lightslider/

    if(in_array('slider', $array, TRUE)) {
        wp_register_style('ls_slider_css',  $js . 'lightslider/css/lightslider.min.css','', 1.1);     
        wp_register_script('ls_slider_js',  $js . 'lightslider/lightslider.min.js','', 1.1);
        wp_register_style('ls_addon', $jtheme . '/addon-lightslider.css','', 1.1); 

        wp_enqueue_style('ls_slider_css');   
        wp_enqueue_script('ls_slider_js',  '','','',$in_footer=true); 
        wp_enqueue_style('ls_addon');   
    } 


    ## BS CAROUSEL SLIDER
    if(in_array('carousel', $array, TRUE)) {    
        wp_register_style('bs-carousel', $js . 'bootstrap/css/min/carousel.css', '', 4.6);
        wp_enqueue_style('bs-carousel');  
    }         

   
    ## MATCH HEIGHT
    if(in_array('height', $array, TRUE)) {
        wp_register_script('mheight_js', $js . 'match-height/jquery.matchHeight-min.js','', 1.0);
        wp_enqueue_script('mheight_js');    
    }  

    ## PARALLAX
    if(in_array('jarallax', $array, TRUE)) {
        wp_register_style('jax_css',    $js . "jarallax/jarallax.css", '', 1.0);    
        wp_register_script('jax_js',    $js . "jarallax/jarallax.js",'',1.0);
        wp_register_script('jaxvid_js', $js . "jarallax/jarallax-video.js",'',1.0);

        wp_enqueue_style('jax_css');  
        wp_enqueue_script('jax_js'); 
        wp_enqueue_script('jaxvid_js');         
    }


    ## SHUFFLE
    if(in_array('shuffle', $array, TRUE)) {
       wp_register_script('shuffle_js', $js . 'shuffle/shuffle.min.js','', 1.2); 
       wp_enqueue_script('shuffle_js');
    }    


    ## COUNT TO
    if(in_array('counter', $array, TRUE)) {
        wp_register_script('countto_js', $js . 'count-to/count-to.js','', 1.1);
        wp_enqueue_script('countto_js');
    }   
    

    ## UL to SELECT
    if(in_array('select', $array, TRUE)) {    
        wp_register_style('select_css', $js . 'select/select.css','', 1.1);     
        wp_register_script('select_js', $js . 'select/select.js','', 1.1);
    
        wp_enqueue_script('select_js');
        wp_enqueue_style('select_css');  
    } 


    ## UL to SELECT [Mobile Links]
    if(in_array('mobile-menu', $array, TRUE)) { 
        wp_register_style('mmlinks_css', $js . 'menu-accordion/menu.css','', 1.1);     
        wp_register_script('mmlinks_js', $js . 'menu-accordion/menu.js','', 1.1);
    
        wp_enqueue_style('mmlinks_css');  
        wp_enqueue_script('mmlinks_js'); 
    }


    ## WOW ANIMATION
    ## https://github.com/graingert/wow

    if(in_array('wow', $array, TRUE)) {    
        wp_register_style('wow_css', $js . 'wow/animate.min.css','', 1.1);     
        wp_register_script('wow_js', $js . 'wow/animate.min.js','', 1.1);

        wp_enqueue_script('wow_js');                
        wp_enqueue_style('wow_css');      
    } 


    ## SIMPLE MAPS
    ## https://simplemaps.com/docs/main-settings

    if(in_array('usmap', $array, TRUE)) {    
        wp_register_script('us_map_js', $js . 'simplemaps/usmap.js','', 1.1);
        wp_enqueue_script('us_map_js');                
        
        wp_register_style('simplemap_css', $jtheme . '/addon-simplemaps.css','', 1.1); 
        wp_enqueue_style('simplemap_css');      
    }     

    if(in_array('worldmap', $array, TRUE)) {    
        wp_register_script('world_map_js', $js . 'simplemaps/worldmap.js','', 1.1);
        wp_enqueue_script('world_map_js');                
        
        wp_register_style('simplemap_css', $jtheme . '/addon-simplemaps.css','', 1.1); 
        wp_enqueue_style('simplemap_css');      
    }     

    ## ANIMATED TEXT [SCROLLER]
    if(in_array('animate-text', $array, TRUE)) {    
        wp_register_style('anitxt_css', $js . 'anitext/animated-text.css','', 1.1); 
        wp_register_script('anitxt_js', $js . 'anitext/animated-text.js','', 1.1);  

        wp_enqueue_style('anitxt_css');          
        wp_enqueue_script('anitxt_js');                
    }             

    ## TOOLTIPSTER [TOOLTIP]
    if(in_array('tooltip', $array, TRUE)) {    
        wp_register_style('tooltip_css', $js . 'tooltipster/css/tooltipster.main.min.css','', 1.1); 
        wp_register_script('tooltip_js', $js . 'tooltipster/js/tooltipster.bundle.min.js','', 1.1);  

        wp_enqueue_style('tooltip_css');          
        wp_enqueue_script('tooltip_js');                
    }   

    ## Bootstrap
    ## ANCHOR[id=bootstrap] 

    if(in_array('bs-full', $array, TRUE)) {
        wp_enqueue_style('bs-full');  
    }

        ## BS CARDS
        if(in_array('cards', $array, TRUE)) {    
            wp_register_style('bs-cards', $js . 'bootstrap/css/min/cards.css', '', 4.6); 
            wp_enqueue_style('bs-cards');  
        }    

        ## BS FORMS
        if(in_array('form', $array, TRUE)) {    
            wp_register_style('bs-form', $js . 'bootstrap/css/min/form.css', '', 4.6);
            wp_enqueue_style('bs-form');  
        }  

        ## BS TABLE
        if(in_array('table', $array, TRUE)) {    
            wp_register_style('bs-table', $js . 'bootstrap/css/min/table.css', '', 4.6);    
            wp_enqueue_style('bs-table');  

            wp_register_style('el-table', $jtheme . '/element-table.css', '', 1.1);    
            wp_enqueue_style('el-table');  
        }  
  

    ## CSS

    ## ADDONS
    ## ANCHOR[id=addons] 

    if(in_array('gform', $array, TRUE)) {    
        wp_register_style('bs-form', $js . 'bootstrap/css/min/form.css', '', 4.6);
        wp_register_style('gform-css', $jtheme . '/addon-gform.css', '', 1.1);
        wp_register_script('gform-js', $jtheme . '/addon-gform.js','', 1.1);  

        wp_enqueue_style('bs-form');  
        wp_enqueue_style('gform-css');          
        wp_enqueue_script('gform-js');        
    } 

    ## FEATURES
    ## ANCHOR[id=features] 

    if(in_array('opt-ticker', $array, TRUE)) {    
        wp_register_script('opt-ticker-js', $jtheme . '/opt-newsticker.js','', 1.1);  
        wp_register_style('opt-ticker-css', $jtheme . '/opt-newsticker.css', '', 1.1);

        wp_enqueue_script('opt-ticker-js');        
        wp_enqueue_style('opt-ticker-css');  
    } 

    if(in_array('logoticker', $array, TRUE)) {    
        wp_register_style('logoticker-css', $jtheme . '/opt-logoticker.css', '', 1.1);
        wp_enqueue_style('logoticker-css');  
    } 

    if(in_array('pop-search', $array, TRUE)) {    
        wp_register_script('pop-search-js', $jtheme . '/opt-pop-search.js','', 1.1);  
        wp_register_style('pop-search-css', $jtheme . '/opt-pop-search.css', '', 1.1);

        wp_enqueue_script('pop-search-js');        
        wp_enqueue_style('pop-search-css');  
    }     


    ## ELEMENTS
    ## ANCHOR[id=elements] 


    ## ELEMENT - CSS
    if(in_array('element-ajax-css', $array, TRUE)) {
        wp_register_style('elajax-css', $jtheme . '/element-ajax.css', '', $ver);          
        wp_enqueue_style('elajax-css');  
    }   

    if(in_array('element-gridpost-css', $array, TRUE)) {
        wp_register_style('elgridpost-css', $jtheme . '/element-gridpost.css', '', $ver);          
        wp_enqueue_style('elgridpost-css');  
    } 

    if(in_array('element-gformsub-css', $array, TRUE)) {
        wp_enqueue_style('elgformsub-css', $jtheme . '/element-gformsub.css', '', $ver);          
    }     

    if(in_array('element-quotes-css', $array, TRUE)) {
        wp_enqueue_style('elquotes-css', $jtheme . '/element-quotes.css', '', $ver);          
    }     
    
    if(in_array('element-tabs-css', $array, TRUE)) {
        wp_enqueue_style('eltabs-css', $jtheme . '/element-tabs.css', '', $ver);          
    }     

    if(in_array('element-tooltip-css', $array, TRUE)) {
        wp_enqueue_style('eltooltip-css', $jtheme . '/element-tooltip.css', '', $ver);          
    }

    if(in_array('element-cards-css', $array, TRUE)) {
        wp_enqueue_style('elcards-css', $jtheme . '/element-cards.css', '', $ver);          
    }    

    if(in_array('element-gmap-css', $array, TRUE)) {
        wp_enqueue_style('elgmap-css', $jtheme . '/element-gmap.css', '', $ver);          
    }        

    ## TEMPLATES
    ## ANCHOR[id=templates]   


    ## INSTALLATION
    if(in_array('error-css', $array, TRUE)) {
        wp_register_style('error-css', $jtheme . '/css-installation.css', '', $ver);
        wp_enqueue_style('error-css');  
    } 

    ## BLOG CSS
    if(in_array('css-blog', $array, TRUE)) {
        wp_register_style('css-blog', $jtheme . '/css-blog.css', '', $ver);  
        wp_enqueue_style('css-blog');  
    }

    ## MENU 1
    ## css is located on /theme

    if(in_array('tpl-menu-1', $array, TRUE)) {
        $file = check_child_css('tpl-menu-1.css');
        wp_register_style('tpl-menu-1', $file, '', $ver);
        wp_enqueue_style('tpl-menu-1');  
    }  

    ## FOOTER 1
    if(in_array('tpl-footer-1', $array, TRUE)) {
        $file = check_child_css('tpl-footer-1.css');
        wp_register_style('tpl-footer-1', $file, '', $ver);
        wp_enqueue_style('tpl-footer-1');  
    }  

}


/* #endregion */