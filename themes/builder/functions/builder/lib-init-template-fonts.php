<?php 
## FONTS
## this feature is for hosting local fonts aka downloaded woff2 fonts
## GOOFLE FONTS : https://gwfh.mranftl.com/fonts
## FONT CONVERTER : https://cloudconvert.com

## 'font_array' is loaded at 'config.php'  
## add woff2 fonts at 'assets/fonts' | edit the css at 'assets/css/font.css'

## Can be turned off to use Direct Google Font

## see your-theme/assests/fonts | your-theme/assests/css/fonts.css

/* #region ~ FONTS : builder fonts, fonts.css */

    #preload font
    function preload_fonts() {
        global $s_assets;
        global $font_array;

        foreach($font_array as $font_id => $font_file) {
            wp_register_style($font_id, $s_assets . $font_file,'','1.1');
        }

        foreach($font_array as $font_id => $font_file) {
            wp_enqueue_style($font_id); 
        }     
    }

    function site_fonts() {
        global $spath;
        
        preload_fonts();
        
        wp_register_style('fonts', "{$spath}/assets/css/fonts.css",'','1.0');  
        wp_enqueue_style('fonts');
    }

    function checkload_site_fonts(){
        if (function_exists( 'adv_fonts' )) {
            adv_fonts();
        } else {    
            site_fonts();
        }     
    }

    add_action( 'wp_enqueue_scripts', 'checkload_site_fonts', 30 ); 
    add_action( 'admin_enqueue_scripts', 'checkload_site_fonts', 21 );

/* #endregion */

## displays how fonts are added on the header (preload)

/* #region CUSTOM FONT ~ Handles, Preloads */  

    function preload_font($tag, $handle, $src, $fonts='') {

    global $font_array;            
    if($fonts == '')  {
        $fonts = $font_array;
    }

    $font_rel    = "rel='preload' ";
    $font_as     = "as='font' ";
    $font_type   = "type='font/woff2' ";   
    $font_count  = count($fonts);
    $font_origin = 'crossorigin="anonymous"';   
        
    $i = 1;       
    foreach($fonts as $font_id => $font_file) {
        
        if($i == $font_count) { $newline = "\n"; }      
        if($handle == $font_id):
            $param = "{$font_as} {$font_type} {$font_origin}";    
            return "<link {$font_rel} id=\"{$handle}\" href=\"{$src}\" {$param}>\n";
        endif;
        
        $i++;  
    }      
    return $tag;
    }

    add_filter( 'style_loader_tag', 'preload_font', 30, 3 );

/* #endregion */
?>