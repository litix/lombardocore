<?php 
# MOBILE MENU
# field in THEME OPTIONS

# To Do : Move Mobile Extension

## see template-part : menu-mobile-X 

/*------------------------------------------------*/

/* #region ~ entrance animation */
# Theme Options > mobile > mobile_menu_display

function nav_mobile_setting(
    $id='menu-oc-right', 
    $class='mobile-menu', 
    $animate='off-right'
) 
{
    
    $div_id = "id=\"{$id}\"";
    $div_class = "class=\"{$class}\"";

    $e = theme_config_mobile();

    $acf = '';
    if(isset($e['mobile_menu_display']))
        $acf = $e['mobile_menu_display'];

    if($acf == '') { $acf = $animate; }
    $data = "data-animate=\"{$acf}\"";   
    
    echo "{$div_id} {$div_class} {$data}";
}
/* #endregion */

/*------------------------------------------------*/

# LEGACY
/* #region ~ mobile extension */
# Theme Options > mobile > mobile_ext

function nav_mobile_ext(){
    $e = theme_config_mobile();
    $x = $e['mobile_ext'];

    /*
    if($x['mobile_extension']):
    foreach( $x['mobile_extension'] as $f ):

        $row = $f['acf_fc_layout'];
        
        if($row == 'search_bar'):
            if($sb == 0) {
                echo "<div class=\"ext-margin\"></div>";
                get_template_part('template-parts/form-search');      
            }            
            $sb++;

        elseif($row == 'social_media_icons'): 
            if($si == 0) {            
                echo "<div class=\"ext-margin\"></div>";
                echo "<div class=\"mob-ext mob-social text-center\">";
                do_shortcode('[social_icons]');
                echo "</div>";
            }    
            $si++;

        elseif($row == 'contact_information'): 
            if($ci == 0) {      
                $chk = $f['contact'];
                
                echo "<div class=\"ext-margin\"></div>";
                echo "<div class=\"mob-ext mob-contact text-center\">";
                if( $chk && in_array('phone', $chk) ) {
                    do_shortcode('[contact data="phone"]');
                }  
                if( $chk && in_array('email', $chk) ) {
                    do_shortcode('[contact data="email"]');
                }  
                if( $chk && in_array('address', $chk) ) {
                    do_shortcode('[contact data="address"]');
                }  
                echo "</div>";
            }    
            $ci++;            

        elseif($row == 'logo'): 
            if($lo == 0) {
                echo "<div class=\"mob-ext mob-logo text-center\">";
                echo "<div class=\"ext-margin\"></div>";            
                builder_logo('main');
                echo "</div>";
            }    
            $lo++;            

        endif;

    endforeach;
    endif;   
    */
}

/* #endregion */

?>